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
    $lvl=$row['SMITHING'];

    $sql="SELECT fish.name as name,image,fish.id as id,speed,lvl,drop_chance,fish.Item_ID as item,price FROM fish JOIN items ON items.ID=fish.Item_ID WHERE fish.id={$id}";
    $resoult=mysqli_query($connect,$sql);
    $row=mysqli_fetch_assoc($resoult);
    $required_lvl=$row["lvl"];
    if($required_lvl<=$lvl)
    {
        $price=$row['price'];
        $drop=$row['drop_chance'];
        $item=$row['item'];
        $speed=$row["speed"]-(($lvl-1)*0.01);

        $sql="SELECT * FROM users WHERE ID={$_SESSION["LOG-IN"]}";
        $resoult=mysqli_query($connect,$sql);
        $row=mysqli_fetch_assoc($resoult);
        $upgrade=$row['m_upgrade'];
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
            
            $skill="FISHING";
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
            $skill_xp+=$price;
            $skill_xp_need=round(100*pow(1.5,($skill_lvl-1)));
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



            $sql="SELECT * FROM statistic WHERE ID='{$_SESSION['LOG-IN']}';"; 
            $resoult=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($resoult);
            $LUCK = $row['LUCK'];
            $drop+=($LUCK-10)*0.1;
            $random=rand(1,100);
            if($random<=$drop)
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
                    $QUANTITY++;
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
                        $QUANTITY=1;
                        $sql="UPDATE inventory SET quantity=$QUANTITY, Item_ID=$item WHERE SID='{$SID[0]}';";
                        mysqli_query($connect,$sql);
                    }
                }
            }
        }
    }
}
?>