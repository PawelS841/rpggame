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

        <section id="choice">
            <section class="choice" onclick="market()">KUP</section>
            <section class="choice" id="choice_center" onclick="market_sell()">SPRZEDAJ</section>
            <section class="choice" onclick="market_offer()">OFERTY</section>
        </section>
        <section class="offers">
            <section class="items" id="offers">
            <?php      
                $connect=mysqli_connect("localhost","root","","rpg");
                $sql="SELECT * FROM inventory LEFT JOIN items ON inventory.Item_ID=items.ID WHERE user_ID={$_SESSION["LOG-IN"]} ORDER BY quantity desc;";
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    if($row['Item_ID']!=0)
                    {
                        echo"
                            <section class='inventory_slot' onclick='show_offer(\"#offer{$row['SID']}\")'>
                                <img src='../items/{$row['image']}' alt='{$row['image']}'>
                            </section>
                        ";
                    }

                } 
                ?>
            </section>

            <?php
                $resoult=mysqli_query($connect,$sql);

                 while($row=mysqli_fetch_assoc($resoult))
                 {
                     if($row['Item_ID']!=0)
                     {
                         echo"
                             <section class='place_offer' id='offer{$row['SID']}'>
                                <section class='sell_slot'>
                                    <img src='../items/{$row['image']}' alt='{$row['image']}'>
                                </section>
                                <span>{$row['name']}</span>
                                <span>{$row['quantity']}</span>
                                <form action='place_offer.php' method='post'>
                                        <input type='number' class='hide' name='item' value='{$row['Item_ID']}'>
                                        Cena:<input type='number' name='price'>
                                        Ilość:<input type='number' name='quantity' min='0' max='{$row['quantity']}'>
                                        <input type='submit' value='Wystaw'>
                                </form>
                                <button class='cancel' onclick='cancel()'><img src='../icons/back.svg' alt='back'></button>
                            </section>
                         ";
                     }
 
                 } 
            ?>
            
        </section>
    </main>
</body>
<script src="script.js"></script>
<script src="market.js"></script>
</html>