<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
{
    header("Location:index.php");
}
if(isset($_POST["STR"])&&isset($_POST["DEX"])&&isset($_POST["INT"])&&isset($_POST["VIT"])&&isset($_POST["END"])&&isset($_POST["LUCK"]))
{
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM statistic WHERE ID='{$_SESSION['LOG-IN']}';"; 
    $resoult=mysqli_query($connect,$sql);
    $SUMA=$_POST["STR"]+$_POST["DEX"]+$_POST["INT"]+$_POST["VIT"]+$_POST["END"]+$_POST["LUCK"];
    while($row=mysqli_fetch_assoc($resoult))
    {
        $CHECK_SUM=60+(($row["LVL"]-1)*10);
        $STR=$row["STR"];
        $DEX=$row["DEX"];
        $INT=$row["INT"];
        $VIT=$row["VIT"];
        $END=$row["END"];
        $LUCK=$row["LUCK"];
    }
    if($SUMA<=$CHECK_SUM && $_POST["STR"]>=$STR && $_POST["DEX"]>=$DEX && $_POST["INT"]>=$INT && $_POST["VIT"]>=$VIT && $_POST["END"]>=$END && $_POST["LUCK"]>=$LUCK)
    {
        $sql="UPDATE statistic SET STR='{$_POST["STR"]}',DEX='{$_POST["DEX"]}',`INT`='{$_POST["INT"]}',VIT='{$_POST["VIT"]}',END='{$_POST["END"]}',LUCK='{$_POST["LUCK"]}' WHERE ID='{$_SESSION["LOG-IN"]}';";
        mysqli_query($connect,$sql);
    }
}
?>