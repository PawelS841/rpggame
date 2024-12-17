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
        <form action="email_change.php" method="post">
        <?php
            $connect=mysqli_connect("localhost","root","","rpg");
            $sql="SELECT * FROM users WHERE ID='{$_SESSION["LOG-IN"]}';"; 
            $resoult=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($resoult);
            echo "<input type='email' value='{$row['Email']}' name='email'>";
            if(isset($_SESSION['email_change_error']))
            {
                if($_SESSION['email_change_error']==1)
                    echo "<p>EMAIL MUSI BYĆ EMAILEM LUB MUSI BYĆ WYPEŁNIONY</p>";
                if($_SESSION['email_change_error']==2)
                    echo "<p>EMAIL JEST ZAJĘTY</p>";
                unset($_SESSION['email_change_error']);
            }
            ?>
            <input type="submit">
        </form>
    </main>
</body>
<script>
    let change=0
    function hide()
    {
        let w=window.innerWidth
        console.log(w);
        if(change==0 && w>900)
        {
            document.getElementById("menu").style.width="7.5%"
            document.getElementById("glowny").style.width="90%"

            let icons=document.querySelectorAll(".menu_icon");
            let text=document.querySelectorAll(".menu_text");

            for (let i = 0; i < icons.length; i++) {
                icons[i].style.width="100%"               
            }
            for (let i = 0; i < text.length; i++) {
                text[i].style.width="0%"
                text[i].style.opacity="0"               
            }
            change=1
        }
        else if(w>900)
        {
            document.getElementById("menu").style.width="17.5%"
            document.getElementById("glowny").style.width="80%"

            let icons=document.querySelectorAll(".menu_icon");
            let text=document.querySelectorAll(".menu_text");

            for (let i = 0; i < icons.length; i++) {
                icons[i].style.width="20%"
                
            }
            for (let i = 0; i < text.length; i++) {
                text[i].style.width="80%"
                text[i].style.opacity="1"
            }
            change=0
        }
    }

    
    function settings()
    {
        location.replace("../settings")
    }

    function equipment()
    {
        location.replace("../equipment")
    }

    function city()
    {
        location.replace("../city")
    }

    function exploration()
    {
        location.replace("../exploration")
    }

    function backpack()
    {
        location.replace("../backpack")
    }

    function character()
    {
        location.replace("../character")
    }

    function logout()
    {
        location.replace("../logout.php")
    }
</script>
</html>