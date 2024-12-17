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
    $sql="SELECT * FROM market  WHERE ID={$ID}";
    $resoult=mysqli_query($connect,$sql);

    if(mysqli_num_rows($resoult)==1)
    {
        $row=mysqli_fetch_assoc($resoult);
        $item=$row['Item_ID'];
        $seller_ID=$row['user_ID'];
        $price=$row['price'];
        $offer_quantity=$row['quantity'];

        $sql="SELECT * FROM users WHERE ID={$seller_ID};";
        $resoult=mysqli_query($connect,$sql);       
        $row=mysqli_fetch_assoc($resoult);
        $seller_money=$row['money'];
        $seller_money+=$price;

        $sql="SELECT * FROM users WHERE ID={$_SESSION["LOG-IN"]};";
        $resoult=mysqli_query($connect,$sql);       
        $row=mysqli_fetch_assoc($resoult);
        $money=$row['money'];
        $money-=$price;

        if($money>=0)
        {
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
            $sql="UPDATE users SET money = {$seller_money} WHERE ID ={$seller_ID}";
            mysqli_query($connect,$sql);
            $sql="UPDATE users SET money = {$money} WHERE ID ={$_SESSION['LOG-IN']}";
            mysqli_query($connect,$sql);
            $sql="DELETE FROM market WHERE ID = {$ID}";
            mysqli_query($connect,$sql);
            echo "destroy {$money}";
        }
    }
}
?>