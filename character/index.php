<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../icons/favicon.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["LOG-IN"]))
            {
                header("Location:../index.php");
            }
        
            function xpscale($x){
                $suffix = "";
                if($x>10000)
                    while ($x > 1000) {
                        $x /= 1000;
                        $suffix .= "k";
                    }
                while (substr($suffix, -3) === "kkk") {
                    $suffix = 'G' . substr($suffix, 0, -3);
                }
                while (substr($suffix, -3) === "GGG") {
                    $suffix = 'P' . substr($suffix, 0, -3);
                }
                $x=$x*10;
                $x=round($x);
                $x=$x/10;
                return $x.$suffix;
            }

            
    ?>
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
            <section class="stats_container">
                <?php
                    $connect=mysqli_connect("localhost","root","","rpg");
                    $sql="SELECT * FROM statistic WHERE ID='{$_SESSION['LOG-IN']}';"; 
                    $resoult=mysqli_query($connect,$sql);
                    while($row=mysqli_fetch_assoc($resoult))
                    {
                        $xp_need=round(100*pow(1.5,($row["LVL"]-1)));
                        $xp_need=xpscale($xp_need);
                        $xp=xpscale($row['XP']);
                        $stat_sum=$row["STR"]+$row["DEX"]+$row["INT"]+$row["VIT"]+$row["END"]+$row["LUCK"];
                        echo "<section class='skill_lvl'><span>POZIOM</span><span>{$row['LVL']}</span><span>{$xp}/{$xp_need} XP<span></section>";
                        echo '<section class="stat_point">PUNKTY DO ROZDANIA: <span id="points">'.(($stat_sum-60-($row["LVL"]-1)*10)*-1).'</span></section>';
                        echo "<section class='stats'><img src='../icons/minus.svg' alt='minus' class='stat_button' onclick='decreas_point(\"STR\")'><span>SIŁA<br><span id='STR'>{$row["STR"]}</span></span><img src='../icons/plus.svg' alt='plus' class='stat_button' onclick='increas_point(\"STR\")'></section>";
                        echo "<section class='stats'><img src='../icons/minus.svg' alt='minus' class='stat_button' onclick='decreas_point(\"DEX\")'><span>ZRĘCZNOŚĆ <br> <span id='DEX'>{$row["DEX"]}</span></span><img src='../icons/plus.svg' alt='plus' class='stat_button' onclick='increas_point(\"DEX\")'></section>";
                        echo "<section class='stats'><img src='../icons/minus.svg' alt='minus' class='stat_button' onclick='decreas_point(\"INT\")'><span>INTELIGENCJA <br> <span id='INT'>{$row["INT"]}</span></span><img src='../icons/plus.svg' alt='plus' class='stat_button' onclick='increas_point(\"INT\")'></section>";
                        echo "<section class='stats'><img src='../icons/minus.svg' alt='minus' class='stat_button' onclick='decreas_point(\"VIT\")'><span>ZDROWIE <br> <span id='VIT'>{$row["VIT"]}</span></span><img src='../icons/plus.svg' alt='plus' class='stat_button' onclick='increas_point(\"VIT\")'></section>";
                        echo "<section class='stats'><img src='../icons/minus.svg' alt='minus' class='stat_button' onclick='decreas_point(\"END\")'><span>WYTRZYMAŁOŚĆ <br> <span id='END'>{$row["END"]}</span></span><img src='../icons/plus.svg' alt='plus' class='stat_button' onclick='increas_point(\"END\")'></section>";
                        echo "<section class='stats'><img src='../icons/minus.svg' alt='minus' class='stat_button' onclick='decreas_point(\"LUCK\")'><span>SZCZĘŚĆIE <br> <span id='LUCK'>{$row["LUCK"]}</span></span><img src='../icons/plus.svg' alt='plus' class='stat_button' onclick='increas_point(\"LUCK\")'></section>";
                    }
                
                ?>
                
                <section class="accept_stats" onclick="stat_accept()">POTWIERDŹ ROZDANIE PUNKTÓW</section>
            </section>





            <section class="stats_container">
                <?php
                    $sql="SELECT * FROM skill_xp JOIN skill ON skill_xp.ID=skill.ID WHERE skill_xp.ID={$_SESSION["LOG-IN"]};";
                    $resoult=mysqli_query($connect,$sql);
                    while($row=mysqli_fetch_assoc($resoult))
                    {
                        $sword_xp_need=round(100*pow(1.5,($row["SWORD"]-1)));
                        $sword_xp_need=xpscale($sword_xp_need);
                        $sword_xp=xpscale($row["SWORD_XP"]);
                        echo "<section class='skill_lvl'><span>WALKA MIECZEM</span><span>LVL {$row["SWORD"]}</span><span>{$sword_xp}/{$sword_xp_need} XP</span></section>";
                    
                        $hammer_xp_need=round(100*pow(1.5,($row["HAMMER"]-1)));
                        $hammer_xp_need=xpscale($hammer_xp_need);
                        $hammer_xp=xpscale($row["HAMMER_XP"]);
                        echo "<section class='skill_lvl'><span>WALKA MŁOTEM</span><span>LVL {$row["HAMMER"]}</span><span>{$hammer_xp}/{$hammer_xp_need} XP</span></section>";
                        
                        $dagger_xp_need=round(100*pow(1.5,($row["DAGGER"]-1)));
                        $dagger_xp_need=xpscale($dagger_xp_need);
                        $dagger_xp=xpscale($row["DAGGER_XP"]);
                        echo "<section class='skill_lvl'><span>WALKA SZTYLETEM</span><span>LVL {$row["DAGGER"]}</span><span>{$dagger_xp}/{$dagger_xp_need} XP</span></section>";
                    
                        $bow_xp_need=round(100*pow(1.5,($row["BOW"]-1)));
                        $bow_xp_need=xpscale($bow_xp_need);
                        $bow_xp=xpscale($row["BOW_XP"]);
                        echo "<section class='skill_lvl'><span>ŁUCZNICTWO</span><span>LVL {$row["BOW"]}</span><span>{$bow_xp}/{$bow_xp_need} XP</span></section>";
                    
                        $magic_xp_need=round(100*pow(1.5,($row["MAGIC"]-1)));
                        $magic_xp_need=xpscale($magic_xp_need);
                        $magic_xp=xpscale($row["MAGIC_XP"]);
                        echo "<section class='skill_lvl'><span>MAGIA</span><span>LVL {$row["MAGIC"]}</span><span>{$magic_xp}/{$magic_xp_need} XP</span></section>";
                    
                        $fishing_xp_need=round(100*pow(1.5,($row["FISHING"]-1)));
                        $fishing_xp_need=xpscale($fishing_xp_need);
                        $fishing_xp=xpscale($row["FISHING_XP"]);
                        echo "<section class='skill_lvl'><span>WĘDKARSTWO</span><span>LVL {$row["FISHING"]}</span><span>{$fishing_xp}/{$fishing_xp_need} XP</span></section>";
                        
                        $sneaking_xp_need=round(100*pow(1.5,($row["SNEAKING"]-1)));
                        $sneaking_xp_need=xpscale($sneaking_xp_need);
                        $sneaking_xp=xpscale($row["SNEAKING_XP"]);
                        echo "<section class='skill_lvl'><span>SKRADANIE</span><span>LVL {$row["SNEAKING"]}</span><span>{$sneaking_xp}/{$sneaking_xp_need} XP</span></section>";
                    
                        $smithing_xp_need=round(100*pow(1.5,($row["SMITHING"]-1)));
                        $smithing_xp_need=xpscale($smithing_xp_need);
                        $smithing_xp=xpscale($row["SMITHING_XP"]);
                        echo "<section class='skill_lvl'><span>KOWALSTWO</span><span>LVL {$row["SMITHING"]}</span><span>{$smithing_xp}/{$smithing_xp_need} XP</span></section>";
                    
                        
                        $enchanting_xp_need=round(100*pow(1.5,($row["ENCHANTING"]-1)));
                        $enchanting_xp_need=xpscale($enchanting_xp_need);
                        $enchanting_xp=xpscale($row["ENCHANTING_XP"]);
                        echo "<section class='skill_lvl'><span>ZAKLINANIE</span><span>LVL {$row["ENCHANTING"]}</span><span>{$enchanting_xp}/{$enchanting_xp_need} XP</span></section>";
                        
                        
                        $alchemy_xp_need=round(100*pow(1.5,($row["ALCHEMY"]-1)));
                        $alchemy_xp_need=xpscale($alchemy_xp_need);
                        $alchemy_xp=xpscale($row["ALCHEMY_XP"]);
                        echo "<section class='skill_lvl'><span>ALCHEMIA</span><span>LVL {$row["ALCHEMY"]}</span><span>{$alchemy_xp}/{$alchemy_xp_need} XP</span></section>";

                        
                        $cooking_xp_need=round(100*pow(1.5,($row["COOKING"]-1)));
                        $cooking_xp_need=xpscale($cooking_xp_need);
                        $cooking_xp=xpscale($row["COOKING_XP"]);
                        echo "<section class='skill_lvl'><span>GOTOWANIE</span><span>LVL {$row["COOKING"]}</span><span>{$cooking_xp}/{$cooking_xp_need} XP</span></section>";
                    }           
                ?>
            </section>
        </main>
</body>
<script src="script.js"></script>
</html>