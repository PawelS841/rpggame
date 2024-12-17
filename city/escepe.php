<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
{
    header("Location:../index.php");
}
if(isset($_POST["id"]))
{
    $id=$_POST["id"];

    $connect=mysqli_connect("localhost","root","","rpg");
    $sql="SELECT * FROM skill WHERE ID={$_SESSION["LOG-IN"]}";
    $resoult=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($resoult);
    $lvl=$row['SNEAKING'];
    $sql="SELECT * FROM theft WHERE id={$id}";
    $resoult=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($resoult);
    $required_lvl=$row["lvl"];
    if($required_lvl<=$lvl)
    {
        $drop=$row['chance'];
        $speed=$row["speed"]-(($lvl-1)*0.01);
        $min=$row['min_amount'];
        $max=$row['max_amount'];
        $profit=rand($min,$max);
        $sql="SELECT * FROM users WHERE ID={$_SESSION["LOG-IN"]}";
        $resoult=mysqli_query($connect,$sql);
        $row=mysqli_fetch_assoc($resoult);
        $upgrade=$row['t_upgrade'];
        $speed-=0.05*$upgrade;
        if($speed<0.1)
            $speed=0.1;
        $past_time=$_SESSION['time'];
        $_SESSION['time']=time();
        $time=time();
        $time-=$past_time;
        $time-=1;
        if($time<=$speed)
        {
            
            $skill="SNEAKING";
            $sql="SELECT * FROM skill_XP WHERE ID='{$_SESSION["LOG-IN"]}';";
            $resoult=mysqli_query($connect,$sql);
            while($row=mysqli_fetch_assoc($resoult))
            {
                $skill_xp=$row[$skill."_XP"];
            }

            $sql="SELECT * FROM skill WHERE ID='{$_SESSION["LOG-IN"]}';";
            $resoult=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($resoult);
            $skill_lvl=$row[$skill];
            $skill_xp+=$profit;
            $skill_xp_need=round(100*pow(1.5,($skill_lvl-1)));
           



            $sql="SELECT * FROM statistic WHERE ID='{$_SESSION['LOG-IN']}';"; 
            $resoult=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($resoult);
            $LUCK = $row['LUCK'];
            $drop+=($LUCK-10)*0.1;
            $random=rand(1,100);
            if($random<=$drop)
            {
                if($skill_xp>=$skill_xp_need)
                {
                        $skill_xp-=$skill_xp_need;
                        $skill_lvl++;
                        $speed-=0.01;
                        if($speed<0.1)
                            $speed=0.1;
                        echo $speed;
                        $sql="UPDATE skill_xp SET {$skill}_XP={$skill_xp} WHERE ID='{$_SESSION["LOG-IN"]}';";
                        mysqli_query($connect,$sql);
                        $sql="UPDATE skill SET {$skill}={$skill_lvl} WHERE ID='{$_SESSION["LOG-IN"]}';";
                        mysqli_query($connect,$sql);
                }
                else
                {
                    $sql="UPDATE skill_xp SET {$skill}_XP={$skill_xp} WHERE ID='{$_SESSION["LOG-IN"]}';";
                    mysqli_query($connect,$sql);
                }
                $sql="SELECT * FROM users WHERE ID='{$_SESSION["LOG-IN"]}'";
                $resoult=mysqli_query($connect,$sql);
                $row=mysqli_fetch_assoc($resoult);
                $money=$row['money'];
                $money+=$profit;
                $sql="UPDATE `users` SET money='{$money}' WHERE ID='{$_SESSION["LOG-IN"]}'";
                mysqli_query($connect,$sql);
            }
        }
    }
}
?>