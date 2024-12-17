<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
    {
        header("Location:../index.php");
    }
if(isset($_POST['item'])&&isset($_POST['price'])&&isset($_POST['quantity']))
{
    $item=$_POST['item'];
    $price=$_POST['price'];
    $quantity=$_POST['quantity'];
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM inventory WHERE user_ID={$_SESSION["LOG-IN"]} AND Item_ID=$item";
    $resoult=mysqli_query($connect,$sql);
    if(mysqli_num_rows($resoult)==1)
    {
        $row=mysqli_fetch_assoc($resoult);
        $base_quantity=$row['quantity'];
        $SID=$row['SID'];
        if($quantity>0&&$quantity<=$base_quantity)
        {   
            $base_quantity-=$quantity;
            if($base_quantity>0)
                $sql="UPDATE `inventory` SET quantity='{$base_quantity}' WHERE SID={$SID}";
            else
                $sql="UPDATE `inventory` SET Item_ID='0',quantity='0' WHERE SID={$SID}";
            mysqli_query($connect,$sql);
            $sql="INSERT INTO `market` VALUES ('','{$_SESSION["LOG-IN"]}','$item','{$quantity}','{$price}')";
            mysqli_query($connect,$sql);
            header("Location:market_sell.php"); 
        }
        else
            header("Location:market_sell.php"); 
    }
    else
        header("Location:market_sell.php"); 
}
else
    header("Location:market_sell.php"); 
?>