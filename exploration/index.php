<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../icons/favicon.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <?php
        session_start();
        if(!isset($_SESSION["LOG-IN"]))
            {
                header("Location:../index.php");
            }
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
        <section class="container">
            <?php
                $connect=mysqli_connect("localhost","root","","rpg");
                $sql="SELECT * FROM regions;";
                $resoult=mysqli_query($connect,$sql);
                while($row=mysqli_fetch_assoc($resoult))
                {
                    echo"
                        <section class='region'>
                            <section class='name' onclick='width(this, 0)'>{$row["name"]}</section>";

                            $sqlsecond="SELECT * FROM enemies WHERE region='{$row['ID']}' ORDER BY lvl asc;";
                            $resoultsecond=mysqli_query($connect,$sqlsecond);
                            while($rowsecond=mysqli_fetch_assoc($resoultsecond))
                            {
                                $monster_image=$rowsecond['image'];
                                echo "
                                    <section class='enemy'>
                                        <img src='../enemy/$monster_image' alt='$monster_image'>
                                        <span>
                                            {$rowsecond['name']}
                                            HP: {$rowsecond['hp']}
                                            LVL: {$rowsecond['lvl']}
                                        </span>
                                        <section class='battle' onclick='battle(\"{$rowsecond['ID']}\")'>
                                            WALCZ
                                        </section>
                                    </section>
                                ";
                            }

                        echo"</section>";
                }
            
            
            ?>
        </section>
    </main>
</body>
<script src="script.js"></script>
</html>