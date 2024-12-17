<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
    {
        header("Location:../index.php");
    }
if(isset($_POST['offert']))
{
    $ID=$_POST['offert'];
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM market  WHERE user_ID={$_SESSION["LOG-IN"]} AND ID={$ID}";
    $resoult=mysqli_query($connect,$sql);

    if(mysqli_num_rows($resoult)==1)
    {
        $row=mysqli_fetch_assoc($resoult);
        $item=$row['Item_ID'];
        $offer_quantity=$row['quantity'];
        $sql="SELECT * FROM inventory WHERE Item_ID='{$item}' AND user_ID='{$_SESSION['LOG-IN']}';";
        $resoult=mysqli_query($connect,$sql);
        $space=mysqli_num_rows($resoult);
        if($space==1)
        {
            while($row=mysqli_fetch_assoc($resoult))
            {
                $SID=$row['SID'];
                $QUANTITY=$row['quantity'];
            }
            $QUANTITY+=$offer_quantity;
            $sql="UPDATE inventory SET quantity=$QUANTITY WHERE SID='{$SID}';";
            mysqli_query($connect,$sql);
        }
        else
        {
            $sql="SELECT * FROM inventory WHERE Item_ID='0' AND user_ID='{$_SESSION['LOG-IN']}';";
            $resoult=mysqli_query($connect,$sql);
            $space=mysqli_num_rows($resoult);
            if($space>0)
            {
                while($row=mysqli_fetch_assoc($resoult))
                {
                    $SID[]=$row['SID'];
                }
                $QUANTITY=$offer_quantity;
                $sql="UPDATE inventory SET quantity=$QUANTITY, Item_ID=$item WHERE SID='{$SID[0]}';";
                mysqli_query($connect,$sql);
            }
        }

        $sql="DELETE FROM market WHERE ID = {$ID}";
        mysqli_query($connect,$sql);
        echo "destroy";
    }
}
?>