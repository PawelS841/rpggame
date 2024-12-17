<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
{
    header("Location:../index.php");
}
if(isset($_POST['id']))
{
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM inventory WHERE user_ID='{$_SESSION['LOG-IN']}' AND Item_id={$_POST['id']};";
    $resoult=mysqli_query($connect,$sql);
    $how_many=mysqli_num_rows($resoult);
    if($how_many==1)
    {
        while($row=mysqli_fetch_assoc($resoult))
        {
            $quantity=$row['quantity'];
            $SID=$row['SID'];
        }
        if(($quantity-1)>0)
        {
            $quantity-=1;
            $sql="UPDATE inventory SET quantity={$quantity} WHERE SID={$SID}";
            mysqli_query($connect,$sql);
            $_SESSION['food']=1;
        }
        else
        {
            $sql="UPDATE inventory SET Item_ID='0',quantity='0' WHERE SID={$SID}";
            mysqli_query($connect,$sql);
            $_SESSION['food']=1;
        }
    }
    else
    {
        $sql="SELECT * FROM equipment WHERE food={$_POST['id']} AND ID='{$_SESSION['LOG-IN']}'";
        $resoult=mysqli_query($connect,$sql);
        $how_many=mysqli_num_rows($resoult);
        if($how_many==1)
        {
            $sql="UPDATE equipment SET food=0 WHERE ID={$_SESSION['LOG-IN']}";
            mysqli_query($connect,$sql);
            $_SESSION['food']=1;
        }
    }
}
?>