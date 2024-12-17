<?php
session_start();
if(!isset($_SESSION["LOG-IN"]))
{
    header("Location:../index.php");
}
if(isset($_POST["monster"])&&isset($_SESSION['potion'])&&isset($_SESSION['food'])&&isset($_SESSION['time']))
{
    $_SESSION['monster'] = $_POST['monster'];
    $monster=$_POST["monster"];
    $connect=mysqli_connect("localhost","root","","rpg");
    $current_time=time();
    $past_time=$_SESSION['time'];
    $time=$current_time-$past_time; 

    $monster_hp=$_SESSION['monster_hp'];
    $monster_AS=$_SESSION['monster_AS'];
    $monster_dmg=$_SESSION['monster_dmg'];
    $player_AS=$_SESSION['player_AS'];
    $player_hp=$_SESSION['player_hp'];
    $player_dmg=$_SESSION['player_dmg'];
    if($_SESSION['potion']==1)
    {
        $monster_dmg-=$_SESSION["potion_ADD_def"];
        $player_dmg+=$_SESSION["potion_ADD_atk"];
        $player_hp+=$_SESSION["potion_ADD_hp"];
    }

    if($_SESSION['food']==1)
    {
        $monster_dmg-=$_SESSION["food_ADD_def"];
        $player_dmg+=$_SESSION["food_ADD_atk"];
        $player_hp+=$_SESSION["food_ADD_hp"];
    }
    if($player_dmg<1)
        $player_dmg=1; 
    if($monster_dmg<1)
        $monster_dmg=1; 


    $hit_count=1;
    while(($monster_hp-$player_dmg)>0)
    {
        $monster_hp-=$player_dmg;
        $hit_count++;
    }
    $monsterdeath=($hit_count*$player_AS)+$player_AS+2;

    $fhit_count=1;
    while(($monster_hp-$player_dmg)>0)
    {
        $monster_hp-=$player_dmg;
        $fhit_count++;
        if($fhit_count%3==0)
            $monster_hp-=3*$player_dmg;
    }
    $fastestmonsterdeath=($fhit_count*$player_AS)+$player_AS;

    $monster_hit_count=1;
    while(($player_hp-$monster_dmg)>0)
    {
        $player_hp-=$monster_dmg;
        $monster_hit_count++;
    }
    $plater_death=($monster_hit_count*$monster_AS)+$monster_AS+1; 

    if($fastestmonsterdeath>$plater_death)
        echo "przegrałeś";
    else if($time>=$fastestmonsterdeath &&$time<=$monsterdeath)
    {
        echo"test1";
        $sql="SELECT * FROM statistic WHERE ID='{$_SESSION["LOG-IN"]}';";
        $resoult=mysqli_query($connect,$sql);
        while($row=mysqli_fetch_assoc($resoult))
        {
            $xp=$row['XP'];
            $LVL=$row['LVL'];
        }
        $xp_need=round(100*pow(1.5,($LVL-1)));
        $xp+=$_SESSION['monster_xp'];
        if($xp>=$xp_need)
        {
                $xp-=$xp_need;
                $LVL++;
                $sql="UPDATE statistic SET XP={$xp}, LVL={$LVL} WHERE ID='{$_SESSION["LOG-IN"]}';";
                mysqli_query($connect,$sql);
        }
        else
        {
            $sql="UPDATE statistic SET XP={$xp} WHERE ID='{$_SESSION["LOG-IN"]}';";
            mysqli_query($connect,$sql);
        }





        $skill=$_SESSION["weapon_type"];
        if($skill!=0)
        {
            $sql="SELECT * FROM skill_XP WHERE ID='{$_SESSION["LOG-IN"]}';";
            $resoult=mysqli_query($connect,$sql);
            while($row=mysqli_fetch_assoc($resoult))
            {
                $skill_xp=$row[$skill."_XP"];
            }

            $sql="SELECT * FROM skill WHERE ID='{$_SESSION["LOG-IN"]}';";
            $resoult=mysqli_query($connect,$sql);
            while($row=mysqli_fetch_assoc($resoult))
            {
                $skill_lvl=$row[$skill];
            }
            $skill_xp+=$player_dmg*$hit_count;
            $skill_xp_need=round(100*pow(1.5,($skill_lvl-1)));
            if($skill_xp>=$skill_xp_need)
            {
                    $skill_xp-=$skill_xp_need;
                    $skill_lvl++;
                    $sql="UPDATE skill_xp SET {$skill}_XP={$skill_xp} WHERE ID='{$_SESSION["LOG-IN"]}';";
                    mysqli_query($connect,$sql);
                    $sql="UPDATE skill SET {$skill}={$skill_lvl} WHERE ID='{$_SESSION["LOG-IN"]}';";
                    
            }
            else
            {
                $sql="UPDATE skill_xp SET {$skill}_XP={$skill_xp} WHERE ID='{$_SESSION["LOG-IN"]}';";
                mysqli_query($connect,$sql);
            }
        }


        $sql="SELECT * FROM enemies WHERE ID='{$monster}';";
        $resoult=mysqli_query($connect,$sql);
        while($row=mysqli_fetch_assoc($resoult))
        {
            $drop_1=$row['drop_1'];
            $drop_chance_1=$row['drop_chance_1']+(($_SESSION['LUCK']-10)*0.1);

            $drop_2=$row['drop_2'];
            $drop_chance_2=$row['drop_chance_2']+(($_SESSION['LUCK']-10)*0.1);

            $drop_3=$row['drop_3'];
            $drop_chance_3=$row['drop_chance_3']+(($_SESSION['LUCK']-10)*0.1);
        }

        if($drop_3!=0)
        {
            $random=rand(1,100);
            if($random<=$drop_chance_3)
            {
                $sql="SELECT * FROM inventory WHERE Item_ID='{$drop_3}' AND user_ID='{$_SESSION['LOG-IN']}';";
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
                            $SID=$row['SID'];
                        }
                        $QUANTITY=1;
                        $sql="UPDATE inventory SET quantity=$QUANTITY, Item_ID=$drop_3 WHERE SID='{$SID[0]}';";
                        mysqli_query($connect,$sql);
                    }
                }
            }
        }

        if($drop_2!=0)
        {
            $random=rand(1,100);
            if($random<=$drop_chance_2)
            {
                $sql="SELECT * FROM inventory WHERE Item_ID='{$drop_2}' AND user_ID='{$_SESSION['LOG-IN']}';";
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
                            $SID=$row['SID'];
                        }
                        $QUANTITY=1;
                        $sql="UPDATE inventory SET quantity=$QUANTITY, Item_ID=$drop_2 WHERE SID='{$SID[0]}';";
                        mysqli_query($connect,$sql);
                    }
                }
            }
        }

        if($drop_1!=0)
        {
            $random=rand(1,100);
            if($random<=$drop_chance_1)
            {

                $sql="SELECT * FROM inventory WHERE Item_ID='{$drop_1}' AND user_ID='{$_SESSION['LOG-IN']}';";
                $resoult=mysqli_query($connect,$sql);
                $space=mysqli_num_rows($resoult);
                if($space==1)
                {
                    echo"drop";
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
                    echo$sql;
                    $resoult=mysqli_query($connect,$sql);
                    $space=mysqli_num_rows($resoult);
                    if($space>0)
                    {
                        while($row=mysqli_fetch_assoc($resoult))
                        {
                            $SID[]=$row['SID'];
                        }
                        $QUANTITY=1;
                        $sql="UPDATE inventory SET quantity=$QUANTITY, Item_ID=$drop_1 WHERE SID='{$SID[0]}';";
                        mysqli_query($connect,$sql);
                    }
                }
            }
        }

    }
}
?>