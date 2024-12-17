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
        <header>
            <?php
            $connect=mysqli_connect("localhost","root","","rpg");
            $sql="SELECT money FROM users WHERE ID={$_SESSION["LOG-IN"]};";
            $resoult=mysqli_query($connect,$sql);
            while($row=mysqli_fetch_assoc($resoult))
            {
                $money=scale($row['money'],100000);
                echo "<section><span id='money'>{$money}</span><img src='../icons/coin.svg' alt='coin'></section>";
            }
            $sql="SELECT * FROM statistic WHERE ID='{$_SESSION['LOG-IN']}';"; 
            $resoult=mysqli_query($connect,$sql);
            while($row=mysqli_fetch_assoc($resoult))
                echo "<section>POZIOM: {$row['LVL']}</section>";
            
            ?>
        </header>
        <section class="inventory">
                <?php        
                $sql="SELECT * FROM inventory LEFT JOIN items ON inventory.Item_ID=items.ID WHERE user_ID={$_SESSION["LOG-IN"]} ORDER BY quantity desc;";
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    if($row['Item_ID']==0)
                        echo "<section class='inventory_slot'></section>";
                    else
                    {
                        $quantity=scale($row['quantity'],1000);
                        echo"
                            <section class='inventory_slot' id='slot{$row['SID']}' onclick='show_desc(\"#id{$row['SID']}\")'>
                                <img src='../items/{$row['image']}' alt=''>
                                <span id='IQ{$row['SID']}'>$quantity</span>
                            </section>
                        ";
                    }

                } 
                ?>
        </section> 

        <section class="description">
            <?php
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    if($row['Item_ID']!=0)
                    {
                        $quantity=scale($row['quantity'],1000);
                        $price=scale($row['price'],1000);
                        echo"
                            <section class='item_desc' id='id{$row['SID']}'>
                                <img src='../items/{$row['image']}' alt=''>
                                <section>{$row['name']}</section>
                                <section>{$row['description']}</section>
                                <section>Ilość:&nbsp;<span id='Q{$row['SID']}'>{$row['quantity']}</span></section>
                                <section>Wartość: $price monet</section>
                        ";
                        if($row['P_dmg']!=0)
                        {
                            echo"<section>Obrażenia kłute: {$row['P_dmg']}</section>";
                        }
                        if($row['S_dmg']!=0)
                        {
                            echo"<section>Obrażenia cięte: {$row['S_dmg']}</section>";
                        }
                        if($row['B_dmg']!=0)
                        {
                            echo"<section>Obrażenia obuchowe: {$row['B_dmg']}</section>";
                        }
                        if($row['F_dmg']!=0)
                        {
                            echo"<section>Obrażenia od ognia: {$row['F_dmg']}</section>";
                        }
                        if($row['I_dmg']!=0)
                        {
                            echo"<section>Obrażenia od lodu: {$row['I_dmg']}</section>";
                        }
                        if($row['E_dmg']!=0)
                        {
                            echo"<section>Obrażenia od elektryczności: {$row['E_dmg']}</section>";
                        }
                        if($row['P_def']!=0)
                        {
                            echo"<section>obrona przed obrażeniami kłutymi: {$row['P_def']}</section>";
                        }
                        if($row['S_def']!=0)
                        {
                            echo"<section>obrona przed obrażeniami ciętymi: {$row['S_def']}</section>";
                        }
                        if($row['B_def']!=0)
                        {
                            echo"<section>obrona przed obrażeniami obuchowymi: {$row['B_def']}</section>";
                        }
                        if($row['F_def']!=0)
                        {
                            echo"<section>obrona przed obrażeniami od ognia: {$row['F_def']}</section>";
                        }
                        if($row['I_def']!=0)
                        {
                            echo"<section>obrona przed obrażeniami od lodu: {$row['I_def']}</section>";
                        }
                        if($row['E_def']!=0)
                        {
                            echo"<section>obrona przed obrażeniami od elektryczności: {$row['E_def']}</section>";
                        }
                        if($row['ADD_def']!=0)
                        {
                            echo"<section>+{$row['ADD_def']} do obrony</section>";
                        }
                        if($row['ADD_atk']!=0)
                        {
                            echo"<section>+{$row['ADD_atk']} do ataku</section>";
                        }
                        if($row['ADD_hp']!=0)
                        {
                            echo"<section>{$row['ADD_hp']} do leczenia</section>";
                        }

                        echo"
                            <section id='HM{$row['SID']}'>0</section>
                            <input class='slider' type='range' id='S{$row['SID']}' min='0' max='{$row['quantity']}' value='0' oninput='slider(\"{$row['SID']}\")'>
                            <section class='sell_button' onclick='sell(\"{$row['SID']}\",\"{$row['price']}\")'>Sprzedaj</section>
                            <section class='cancel_button' onclick='cancel()'>Anuluj</section>
                        </section>";
                    }
                }
            ?>
        </section>
    </main>
</body>
<script src="script.js"></script>
</html>