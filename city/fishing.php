<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_resorces.css">
    <link rel="shortcut icon" href="../icons/favicon.svg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&amp;display=swap" rel="stylesheet">
    <style type="text/css"></style><style type="text/css" id="operaUserStyle"></style></head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["LOG-IN"]))
            {
                header("Location:../index.php");
            }
        if(!isset($_SESSION["resource"]))
            {
                header("Location:fish.php");
            }
        $connect=mysqli_connect("localhost","root","","rpg");
        $sql="SELECT * FROM skill WHERE ID={$_SESSION["LOG-IN"]}";
        $resoult=mysqli_query($connect,$sql);
        $row=mysqli_fetch_assoc($resoult);
        $lvl=$row['FISHING'];
        $id=$_SESSION["resource"];


        $sql="SELECT fish.name as name,image,fish.id as id,speed,lvl FROM fish JOIN items ON items.ID=fish.Item_ID WHERE fish.id={$id}";
        $resoult=mysqli_query($connect,$sql);
        $row=mysqli_fetch_assoc($resoult);
        $required_lvl=$row["lvl"];
        if($required_lvl>$lvl)
            header("Location:mining.php");
        $speed=$row["speed"]-(($lvl-1)*0.01);
        $sql="SELECT * FROM users WHERE ID={$_SESSION["LOG-IN"]}";
        $resoult=mysqli_query($connect,$sql);
        $row=mysqli_fetch_assoc($resoult);
        $upgrade=$row['f_upgrade'];
        $speed-=0.05*$upgrade;
        if($speed<0.1)
            $speed=0.1;
        $_SESSION['time']=time();
        echo"
        <script>
        let speed={$speed}
        let id={$id}
        </script>";
        unset($_SESSION["resource"]);
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
    <main id="sorceget">    
        <section class="return" onclick="return_fish()">Powrót</section>
        <img src="../icons/pond.svg" alt="rock.svg" class="source_img">
        <section class="speed">
            <section id="speed"></section>
        </section>
    </main>
    
    <script src="resource.js"></script>
    <script src="script.js"></script>
<script>
    setTimeout(() => {
        throw_rod()    
    }, 1);
    let loop=setInterval(() => {
        throw_rod()
    }, (speed*1000)+100);
</script>
</body></html>