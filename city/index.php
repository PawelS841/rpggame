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
    function scale($x, $y){
        $suffix = "";
        if($x>$y)
            while ($x >= 1000) {
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
    <section class="header">
            <section><img src="../icons/merchant.svg" alt="market" onclick="merchant()"></section>
            <section><img src="../icons/market.svg" alt="market" onclick="market()"></section>
            <section><img src="../icons/fishing.svg" alt="market"onclick="fishing()"></section>
            <section><img src="../icons/hood.svg" alt="market" onclick="sneak()"></section>
            <section><img src="../icons/pickaxe.svg" alt="market" onclick="mine()"></section>
            <section><img src="../icons/anvil.svg" alt="market"onclick="blacksmith()"></section>
            <section><img src="../icons/enchant.svg" alt="market"onclick="magic()"></section>
            <section><img src="../icons/alchemy.svg" alt="market"onclick="alchemy()"></section>
            <section><img src="../icons/cook.svg" alt="market"onclick="cook()"></section>
        </section>

        <?php
            $connect=mysqli_connect("localhost","root","","rpg");
            $sql="SELECT * FROM users WHERE ID={$_SESSION["LOG-IN"]};";
            $resoult=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($resoult);
            $backpack=round(100*pow(1.5,($row["b_upgrade"])));
            $mining=round(100*pow(1.5,($row["m_upgrade"])));
            $theft=round(100*pow(1.5,($row["t_upgrade"])));
            $fish=round(100*pow(1.5,($row["f_upgrade"])));
            echo "<script>
            let money={$row['money']}
            let backpack_u={$backpack}
            let mining={$mining}
            let theft={$theft}
            let fish={$fish}
            </script>";
            
            $money=scale($row['money'],100000);
            $backpack=scale($backpack,100000);
            $mining=scale($mining,100000);
            $theft=scale($theft,100000);       
            $fish=scale($fish,100000);      

            echo "<section class='money'><span id='money'>{$money}</span><img src='../icons/coin.svg' alt='coin'></section>";


            ?>
        <section class="shop">
            <section class="upgrade">
                <section class="image"><img src="../icons/backpack_u.svg" alt=""></section>
                <section class="desc">
                    <span>Ulepsz plecak</span>
                    <span id="cena1">cena: <?php echo$backpack;?></span>
                </section>
                <section class="buy"><button  onclick="buy(1)">ulepsz</button></section>
            </section>
            <section class="upgrade">
                <section class="image"><img src="../icons/pickaxe_u.svg" alt=""></section>
                <section class="desc">
                    <span>Ulepsz prędkość kopania</span>
                    <span id="cena2">cena: <?php echo$mining;?></span>
                </section>
                <section class="buy"><button onclick="buy(2)">ulepsz</button></section>
            </section>
            <section class="upgrade">
                <section class="image"><img src="../icons/hood_u.svg" alt=""></section>
                <section class="desc">
                    <span>Ulepsz prędkość kradnięcia</span>
                    <span id="cena3">cena: <?php echo$theft;?></span>
                </section>
                <section class="buy"><button onclick="buy(3)">ulepsz</button></section>
            </section>
            <section class="upgrade">
                <section class="image"><img src="../icons/fishing_u.svg" alt=""></section>
                <section class="desc">
                    <span>Ulepsz prędkość wędkowania</span>
                    <span id="cena4">cena: <?php echo$fish;?></span>
                </section>
                <section class="buy"><button onclick="buy(4)">ulepsz</button></section>
            </section>
        </section>
    </main>
</body>
<script src="merchant.js"></script>
<script src="script.js"></script>
</html>