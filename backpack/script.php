<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
{
    header("Location:../index.php");
}
if(isset($_POST["id"])&&isset($_POST["sell_quantity"]))
{
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM inventory WHERE SID={$_POST["id"]};";
    $resoult=mysqli_query($connect,$sql);
    while($row=mysqli_fetch_assoc($resoult))
    {
        $item_id=$row['Item_ID'];
        $quantity=$row['quantity'];
    }
    $sql="SELECT * FROM items WHERE ID={$item_id};";
    $resoult=mysqli_query($connect,$sql);
    while($row=mysqli_fetch_assoc($resoult))
    {
        $price=$row['price'];
    }
    $sql="SELECT money FROM users WHERE ID={$_SESSION["LOG-IN"]};";
    $resoult=mysqli_query($connect,$sql);
    while($row=mysqli_fetch_assoc($resoult))
    {
        $money=$row['money'];
    }
    $money+=$_POST["sell_quantity"]*$price;
    if($_POST["sell_quantity"]==$quantity)
    {
        $sql="UPDATE inventory SET Item_ID='0',quantity='0' WHERE SID={$_POST["id"]};";
        mysqli_query($connect,$sql);
        $sql="UPDATE users SET money='{$money}' WHERE ID={$_SESSION["LOG-IN"]};";
        mysqli_query($connect,$sql);
    }   
    else if($_POST["sell_quantity"]<$quantity)
    {
        $new_qunatity=$quantity-$_POST["sell_quantity"];
        $sql="UPDATE inventory SET quantity='{$new_qunatity}' WHERE SID={$_POST["id"]};";
        mysqli_query($connect,$sql);
        $sql="UPDATE users SET money='{$money}' WHERE ID={$_SESSION["LOG-IN"]};";
        mysqli_query($connect,$sql);
    }
}
?>