<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_battle.css">
    <link rel="shortcut icon" href="../icons/favicon.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <?php
        session_start();
        if(!isset($_SESSION["LOG-IN"]))
            {
                header("Location:../index.php");
            }
        if(!isset($_SESSION["monster"]))
            {
                header("Location:index.php");
            }
            
        $_SESSION['potion']=0;
        $_SESSION['food']=0;
        $_SESSION['time']=time();
        $monster=$_SESSION["monster"];
        unset($_SESSION["monster"]);
    ?>
</head>
<body>
<aside id="menu">
        <section class="menu" onclick="hide()">
            <div class="menu_icon"><img src="../icons/menu.svg" alt=""></div>
            <div class="menu_text">MENU</div>
        </section>

        <section class="menu" onclick="character()">
            <div class="menu_icon"><img src="../icons/skill.svg" alt=""></div>
            <div class="menu_text">CECHY</div>
        </section>

        <section class="menu" onclick="equipment()">
            <div class="menu_icon"><img src="../icons/equipment.svg" alt=""></div>
            <div class="menu_text">EKWIPUNEK</div>
        </section>

        <section class="menu" onclick="backpack()">
            <div class="menu_icon"><img src="../icons/backpack.svg" alt=""></div>
            <div class="menu_text">PLECAK</div>
        </section>
        
        <section class="menu" onclick="city()">
            <div class="menu_icon"><img src="../icons/city.svg" alt=""></div>
            <div class="menu_text">MIASTO</div>
        </section>

        <section class="menu" onclick="exploration()">
            <div class="menu_icon"><img src="../icons/explor.svg" alt=""></div>
            <div class="menu_text">EKSPROLACJA</div>
        </section>

        <section class="menu" onclick="settings()">
            <div class="menu_icon"><img src="../icons/settings.svg" alt=""></div>
            <div class="menu_text">USTAWIENIA</div>
        </section>
        
        <section class="menu" onclick="logout()">
            <div class="menu_icon"><img src="../icons/logout.svg" alt=""></div>
            <div class="menu_text">WYLOGUJ</div>
        </section>
        
    </aside>
    <main id="glowny">
            <?php
                $PDMG=0;
                $SDMG=0;
                $BDMG=0;
                $FDMG=0;
                $IDMG=0;
                $EDMG=0;
                $PDEF=0;
                $SDEF=0;
                $BDEF=0;
                $FDEF=0;
                $IDEF=0;
                $EDEF=0;
                $ASPD=1;
                $connect=mysqli_connect("localhost","root","","rpg");
                $sql="SELECT * FROM equipment LEFT JOIN items ON items.ID=equipment.helmet WHERE equipment.ID='{$_SESSION['LOG-IN']}';";
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    if($row['helmet']!=0)
                    {
                        $PDMG += $row['P_dmg'];
                        $SDMG += $row['S_dmg'];
                        $BDMG += $row['B_dmg'];
                        $FDMG += $row['F_dmg'];
                        $IDMG += $row['I_dmg'];
                        $EDMG += $row['E_dmg'];
                        $PDEF += $row['P_def'];
                        $SDEF += $row['S_def'];
                        $BDEF += $row['B_def'];
                        $FDEF += $row['F_def'];
                        $IDEF += $row['I_def'];
                        $EDEF += $row['E_def'];
                        $ASPD += $row['A_s'];
                    }
                }
                $sql="SELECT * FROM equipment LEFT JOIN items ON items.ID=equipment.chestplate WHERE equipment.ID='{$_SESSION['LOG-IN']}';";
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    if($row['chestplate']!=0)
                    {
                        $PDMG += $row['P_dmg'];
                        $SDMG += $row['S_dmg'];
                        $BDMG += $row['B_dmg'];
                        $FDMG += $row['F_dmg'];
                        $IDMG += $row['I_dmg'];
                        $EDMG += $row['E_dmg'];
                        $PDEF += $row['P_def'];
                        $SDEF += $row['S_def'];
                        $BDEF += $row['B_def'];
                        $FDEF += $row['F_def'];
                        $IDEF += $row['I_def'];
                        $EDEF += $row['E_def'];
                        $ASPD += $row['A_s'];
                    }
                }



                $sql="SELECT * FROM equipment LEFT JOIN items ON items.ID=equipment.leggins WHERE equipment.ID='{$_SESSION['LOG-IN']}';";
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    if($row['leggins']!=0)
                    {
                        $PDMG += $row['P_dmg'];
                        $SDMG += $row['S_dmg'];
                        $BDMG += $row['B_dmg'];
                        $FDMG += $row['F_dmg'];
                        $IDMG += $row['I_dmg'];
                        $EDMG += $row['E_dmg'];
                        $PDEF += $row['P_def'];
                        $SDEF += $row['S_def'];
                        $BDEF += $row['B_def'];
                        $FDEF += $row['F_def'];
                        $IDEF += $row['I_def'];
                        $EDEF += $row['E_def'];
                        $ASPD += $row['A_s'];
                    }
                }
                            
                            
                            

                $sql="SELECT * FROM equipment LEFT JOIN items ON items.ID=equipment.weapon WHERE equipment.ID='{$_SESSION['LOG-IN']}';";
                $resoult=mysqli_query($connect,$sql);
                $_SESSION["weapon_type"]=0;
                while($row=mysqli_fetch_assoc($resoult))
                {
                    if($row['weapon']!=0)
                    {
                        $PDMG += $row['P_dmg'];
                        $SDMG += $row['S_dmg'];
                        $BDMG += $row['B_dmg'];
                        $FDMG += $row['F_dmg'];
                        $IDMG += $row['I_dmg'];
                        $EDMG += $row['E_dmg'];
                        $PDEF += $row['P_def'];
                        $SDEF += $row['S_def'];
                        $BDEF += $row['B_def'];
                        $FDEF += $row['F_def'];
                        $IDEF += $row['I_def'];
                        $EDEF += $row['E_def'];
                        $ASPD += $row['A_s'];

                        $_SESSION["weapon_type"]=$row['weapon_type'];
                        
                    }
                }
                $skill=$_SESSION["weapon_type"];

                $potion_image=null;
                $food_image=null;
                $sql="SELECT * FROM equipment LEFT JOIN items ON items.ID=equipment.potion WHERE equipment.ID='{$_SESSION['LOG-IN']}';";
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    if($row['potion']!=0)
                    {
                        $potion_image=$row['image'];
                        $potion_ADD_def=$row['ADD_def'];
                        $potion_ADD_atk=$row['ADD_atk'];
                        $potion_ADD_hp=$row['ADD_hp'];
                        $potion_ID=$row['ID'];
                        $_SESSION["potion_ADD_def"]=$row['ADD_def'];
                        $_SESSION["potion_ADD_atk"]=$row['ADD_atk'];
                        $_SESSION["potion_ADD_hp"]=$row['ADD_atk'];
                    }
                }

                $sql="SELECT * FROM equipment LEFT JOIN items ON items.ID=equipment.food WHERE equipment.ID='{$_SESSION['LOG-IN']}';";
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    if($row['food']!=0)
                    {
                        $food_image=$row['image'];
                        $food_ADD_def=$row['ADD_def'];
                        $food_ADD_atk=$row['ADD_atk'];
                        $food_ADD_hp=$row['ADD_hp'];
                        $food_ID=$row['ID'];
                        $_SESSION["food_ADD_def"]=$row['ADD_def'];
                        $_SESSION["food_ADD_atk"]=$row['ADD_atk'];
                        $_SESSION["food_ADD_hp"]=$row['ADD_atk'];

                    }
                }
                $sql="SELECT * FROM statistic WHERE ID='{$_SESSION['LOG-IN']}';"; 
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    $STR = $row['STR'];
                    $DEX = $row['DEX'];
                    $INT = $row['INT'];
                    $VIT = $row['VIT'];
                    $END = $row['END'];
                    $_SESSION['LUCK'] = $row['LUCK'];
                }
                $hp=(100 *0.025*$VIT);
                $PDMG*=(0.025*$STR);
                $SDMG*=(0.025*$STR);
                $BDMG*=(0.025*$STR);

                $FDMG*=(0.025*$INT );
                $IDMG*=(0.025*$INT );
                $EDMG*=(0.025*$INT );

                $PDEF*=(0.025*$END);
                $SDEF*=(0.025*$END);
                $BDEF*=(0.025*$END);

                $FDEF*=(0.025*$END);
                $IDEF*=(0.025*$END);
                $EDEF*=(0.025*$END);

                $ASPD-=(0.001*$DEX);

                $hp*=10;
                $hp=round($hp);
                $hp/=10;

                $sql="SELECT * FROM enemies WHERE ID='{$monster}';";
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult)){
                    $monsterhp=$row['hp'];
                    $monsterhp=$row['hp'];
                    $PDMG_monster = $row['P_dmg'];
                    $SDMG_monster = $row['S_dmg'];
                    $BDMG_monster = $row['B_dmg'];
                    $FDMG_monster = $row['F_dmg'];
                    $IDMG_monster = $row['I_dmg'];
                    $EDMG_monster = $row['E_dmg'];
                    
                    $PDEF_monster = $row['P_def'];
                    $SDEF_monster = $row['S_def'];
                    $BDEF_monster = $row['B_def'];
                    $FDEF_monster = $row['F_def'];
                    $IDEF_monster = $row['I_def'];
                    $EDEF_monster = $row['E_def']; 
                    $ASPD_monster = $row['A_s']; 

                    $monster_image = $row["image"]; 
                    $_SESSION['monster_xp']=$row['xp']; 
                }

                $attack=0;
                if($PDEF_monster<$PDMG)
                    $attack+=$PDMG-$PDEF_monster;
                if($SDEF_monster<$SDMG)
                    $attack+=$SDMG-$SDEF_monster;

                if($BDEF_monster<$BDMG)
                    $attack+=$BDMG-$BDEF_monster;

                if($FDEF_monster<$FDMG)
                    $attack+=$FDMG-$FDEF_monster;

                if($IDEF_monster<$IDMG)
                    $attack+=$IDMG-$IDEF_monster;
                if($EDEF_monster<$EDMG)
                    $attack+=$EDMG-$EDEF_monster;
                if($attack<1)
                    $attack=1; 

                if($skill!=0)
                {
                    $sql="SELECT * FROM skill WHERE ID='{$_SESSION["LOG-IN"]}';";
                    $resoult=mysqli_query($connect,$sql);
                    while($row=mysqli_fetch_assoc($resoult))
                    {
                        $skill_lvl=$row[$skill];
                    }
                    $attack+=$attack*$skill_lvl*0.01;
                }
                if($ASPD<0.01)
                    $ASPD=0.01;
                


                $monster_attack=0;
                if($PDEF<$PDMG_monster)
                    $monster_attack+=$PDMG_monster-$PDEF;

                if($SDEF<$SDMG_monster)
                    $monster_attack+=$SDMG_monster-$SDEF;

                if($BDEF<$BDMG_monster)
                    $monster_attack+=$BDMG_monster-$BDEF;

                if($FDEF<$FDMG_monster)
                    $monster_attack+=$FDMG_monster-$FDEF;

                if($IDEF<$IDMG_monster)
                    $monster_attack+=$IDMG_monster-$IDEF;

                if($EDEF<$EDMG_monster)
                    $monster_attack+=$EDMG_monster-$EDEF;
                if($monster_attack<1)
                    $monster_attack=1; 

                $_SESSION['monster_hp']=$monsterhp;
                $_SESSION['monster_AS']=$ASPD_monster;
                $_SESSION['monster_dmg']=$monster_attack;
                $_SESSION['player_AS']=$ASPD;
                $_SESSION['player_hp']=$hp;
                $_SESSION['player_dmg']=$attack;

                echo"
                    <script>
                        let attackspeed={$ASPD}
                        let monsterattackspeed={$ASPD_monster}
                        let playerdmg={$attack}
                        let monsterdmg={$monster_attack}
                        let monsterid={$monster}
                    </script>
                ";
            ?>

        <section class="container">
            <?php
                echo "<img src='../enemy/$monster_image' alt='$monster_image'>";
            ?>
            <section class="enemyUI">
                <section class="enemyhp">
                    <section id="enemyhp"></section>
                    <section id="ehpo">
                        <?php
                            echo $monsterhp;
                            ?>
                    </section>
                </section>
                
            </section>
            <section class="enemyUI">
                <section class="enemyspeed">
                    <section id="enemyspeed"></section>
                </section>
            </section>
        </section>



        
        <footer>
            <section class="player">
                <section class="consumable_container">
                <?php
                        if(!is_null($potion_image))
                           echo "<img class='consumable' src='../items/{$potion_image}' alt='potion' onclick='potion(this,{$potion_ADD_atk},{$potion_ADD_def},{$potion_ADD_hp},{$potion_ID})' id='potion'>";
                        else
                           echo "<img src='../icons/potion.png' alt='potion' id='potion'>";
                    ?>   
<?php
                    if(!is_null($food_image))
                       echo "<img class='consumable' src='../items/{$food_image}' alt='food' id='food' onclick='food(this,{$food_ADD_atk},{$food_ADD_def},{$food_ADD_hp},{$food_ID})'>";
                    else
                       echo "<img src='../icons/food.png' alt='food' id='food'>";
                ?>
                <img src="../icons/crit.svg" alt="crit" id="crit" onclick="crit()">
                </section>      
                <section class="playerui">
                    <section class="playerhp">
                        <section id="playerhp"></section>
                        <section id="phpo">
                            <?php
                            echo $hp;
                            ?>
                        </section>
                    </section>
                    <section class="playerspeed">
                        <section id="playerspeed"></section>
                    </section>
                </section>
                
            </section>
        </footer>
    </main>
    
</body>
<script src="battle_script.js"></script>
</html>