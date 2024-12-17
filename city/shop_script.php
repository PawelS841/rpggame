<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
    {
        header("Location:../index.php");
    }
if(isset($_POST['uppgrade']))
{
    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM users WHERE ID={$_SESSION["LOG-IN"]};";
    $resoult=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($resoult);
    $money=$row['money'];
    $backpack=round(100*pow(1.5,($row["b_upgrade"])));
    $mining=round(100*pow(1.5,($row["m_upgrade"])));
    $theft=round(100*pow(1.5,($row["t_upgrade"])));
    $fish=round(100*pow(1.5,($row["f_upgrade"])));

    $backpack_upgrade=$row["b_upgrade"];
    $mining_upgrade=$row["m_upgrade"];
    $theft_upgrade=$row["t_upgrade"];
    $fish_upgrade=$row["f_upgrade"];
    switch ($_POST['uppgrade']) {
        case 1:
            if(($money-$backpack)>=0)
            {
                $money-=$backpack;
                $backpack_upgrade+=1;
                $sql="UPDATE users SET money='{$money}',b_upgrade='{$backpack_upgrade}'WHERE ID={$_SESSION["LOG-IN"]};";
                mysqli_query($connect,$sql);
                $sql="INSERT INTO inventory (SID, user_ID) VALUES ('','{$_SESSION["LOG-IN"]}');";
                    for ($i=0; $i < 2; $i++) { 
                        mysqli_query($connect,$sql);
                    }
            }
            break;
        case 2:
            if(($money-$mining)>=0)
            {
                $money-=$mining;
                $mining_upgrade+=1;
                $sql="UPDATE users SET money='{$money}',m_upgrade='{$mining_upgrade}'WHERE ID={$_SESSION["LOG-IN"]};";
                mysqli_query($connect,$sql);
            }
            break;
        case 3:
            if(($money-$theft)>=0)
            {
                $money-=$theft;
                $theft_upgrade+=1;
                $sql="UPDATE users SET money='{$money}',t_upgrade='{$theft_upgrade}'WHERE ID={$_SESSION["LOG-IN"]};";
                mysqli_query($connect,$sql);
            }
            break;
        case 4:
            if(($money-$fish)>=0)
            {
                $money-=$fish;
                $fish_upgrade+=1;
                $sql="UPDATE users SET money='{$money}',f_upgrade='{$fish_upgrade}'WHERE ID={$_SESSION["LOG-IN"]};";
                mysqli_query($connect,$sql);
            }
            break;
        default:
            break;
    }
}
?>