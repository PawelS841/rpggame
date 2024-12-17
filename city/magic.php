<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_craft.css">
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
        <section class="location">
        <?php
            $connect=mysqli_connect("localhost","root","","rpg");
            $sql="SELECT * FROM skill WHERE ID={$_SESSION["LOG-IN"]}";
            $resoult=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($resoult);
            $lvl=$row['ENCHANTING'];

            $sql="SELECT * FROM recipes JOIN items ON items.ID=recipes.Item_ID WHERE lvl<={$lvl} AND recipes.type='ENCHANTING'  ORDER BY lvl";
            $resoult=mysqli_query($connect,$sql);
            while($row=mysqli_fetch_assoc($resoult))
            {
                echo"
                    <section class='source'>
                        <section class='item'>
                        <img src='../items/{$row['image']}'>

                        </section>
                        <section class='ingridients'>";
                        $dane=$row['RID'].",";
                        if($row['ingredient_1']!=0)
                        {
                            $dane.=$row['ingredient_1'];
                            $dane.=",";
                            $dane.=$row['ingredient_1a'];

                            $sqls="SELECT * FROM items WHERE ID={$row['ingredient_1']}";
                            $resoults=mysqli_query($connect,$sqls);
                            $rows=mysqli_fetch_assoc($resoults);
                            $image=$rows['image'];
                            $quantity=0;
                            $sqls="SELECT * FROM inventory WHERE Item_ID={$row['ingredient_1']} AND inventory.user_ID={$_SESSION['LOG-IN']};";
                            $resoults=mysqli_query($connect,$sqls);
                            if(mysqli_num_rows($resoults)==1)
                            {
                                $rows=mysqli_fetch_assoc($resoults);
                                $quantity=$rows['quantity'];
                            }
                            echo "<span class='ingredient'><span class='material{$row['ingredient_1']}'>{$quantity}</span>/{$row['ingredient_1a']} <img src='../items/{$image}' alt=''></span>";
                        }
                        else
                            $dane.="0,0";



                        if($row['ingredient_2']!=0)
                        {
                            $dane.=",";
                            $dane.=$row['ingredient_2'];
                            $dane.=",";
                            $dane.=$row['ingredient_2a'];
                            $sqls="SELECT * FROM items WHERE ID={$row['ingredient_2']}";
                            $resoults=mysqli_query($connect,$sqls);
                            $rows=mysqli_fetch_assoc($resoults);
                            $image=$rows['image'];
                            $quantity=0;
                            $sqls="SELECT * FROM inventory WHERE Item_ID={$row['ingredient_2']} AND inventory.user_ID={$_SESSION['LOG-IN']};";
                            $resoults=mysqli_query($connect,$sqls);
                            if(mysqli_num_rows($resoults)==1)
                            {
                                $rows=mysqli_fetch_assoc($resoults);
                                $quantity=$rows['quantity'];
                            }
                            echo "<span class='ingredient'><span class='material{$row['ingredient_2']}'>{$quantity}</span>/{$row['ingredient_2a']} <img src='../items/{$image}' alt=''></span>";
                        }
                        else
                            $dane.=",0,0";
                        if($row['ingredient_3']!=0)
                        {
                            $dane.=",";
                            $dane.=$row['ingredient_3'];
                            $dane.=",";
                            $dane.=$row['ingredient_3a'];
                            $sqls="SELECT * FROM items WHERE ID={$row['ingredient_3']}";
                            $resoults=mysqli_query($connect,$sqls);
                            $rows=mysqli_fetch_assoc($resoults);
                            $image=$rows['image'];
                            $quantity=0;
                            $sqls="SELECT * FROM inventory WHERE Item_ID={$row['ingredient_3']} AND inventory.user_ID={$_SESSION['LOG-IN']};";
                            $resoults=mysqli_query($connect,$sqls);
                            if(mysqli_num_rows($resoults)==1)
                            {
                                $rows=mysqli_fetch_assoc($resoults);
                                $quantity=$rows['quantity'];
                            }
                            echo "<span class='ingredient'><span class='material{$row['ingredient_3']}'>{$quantity}</span>/{$row['ingredient_3a']} <img src='../items/{$image}' alt=''></span>";
                        }
                        else
                            $dane.=",0,0";

                echo"
                            <span class='create' onclick='craft({$dane})'>stwórz</span>
                        </section>
                    </section>                
                ";
            }
        ?>           
        </section>
    </main>
</body>
<script src="craft.js"></script>
<script src="script.js"></script>
</html>