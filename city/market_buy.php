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
        <?php
            $connect=mysqli_connect("localhost","root","","rpg");
            $sql="SELECT * FROM users WHERE ID={$_SESSION["LOG-IN"]};";
            $resoult=mysqli_query($connect,$sql);       
            $row=mysqli_fetch_assoc($resoult);
            echo "<script>
            let money={$row['money']}
            </script>";
            $money=scale($row['money'],100000);
            echo "<section class='money'><button class='back' onclick='back()'><img src='../icons/back.svg' alt='back'></button><span id='money'>{$money}</span><img src='../icons/coin.svg' alt='coin'></section>";
        ?>
        <section class="offers_buy">
            <?php
                $connect=mysqli_connect("localhost","root","","rpg");
                $sql="SELECT market.ID as ID, image,name,market.price as cena,quantity FROM market LEFT JOIN items ON market.item_ID=items.ID WHERE user_ID!={$_SESSION["LOG-IN"]}";
                if(isset($_POST['nazwa']))
                {
                    if(!empty($_POST['nazwa']))
                    {
                        $nazwa=$_POST['nazwa'];
                        $sql .= " AND name LIKE '%$nazwa%'";
                    }
                }
                if(isset($_POST['bigger']))
                {
                    if(!empty($_POST['bigger']))
                    {
                        $bigger=$_POST['bigger'];
                        $sql .= " AND market.price>='$bigger'";
                    }
                }
                if(isset($_POST['smaller']))
                {
                    if(!empty($_POST['smaller']))
                    {
                        $smaller=$_POST['smaller'];
                        $sql .= " AND market.price<='$smaller'";
                    }
                }
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                $price=scale($row['cena'],10000);
                $quantity=scale($row['quantity'],10000);
                echo"
                    <section class='single_offer'>
                    <section class='offer_slot'>
                        <img src='../items/{$row['image']}' alt=''>
                    </section>
                    <span class='name_span'>{$row['name']}</span>           
                    <span class='span_reszta'>Cena: {$price}</span>
                    <span class='span_reszta'>Ilość: {$quantity}</span>
                    <span onclick='buy({$row['ID']},this)' class='buy_offer'>KUP</span>
                </section>
                ";
                }
            
            ?>
           
        </section>
    </main>
</body>
<script src="script.js"></script>
<script src="market.js"></script>
</html>