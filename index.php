<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="icons/favicon.svg" type="image/x-icon">
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION["LOG-IN"]))
            {
                header("Location:character");
            }
    ?>
    <main>
        <form action="login.php" method="post">
            <label for="Login">Login:</label>
            <input type="text" name="Login" id="Login">
            <label for="Password">Hasło:</label>
            <input type="password" name="Password" id="Password">
            <?php
                if(isset($_SESSION["Login_error"]))
                    switch ($_SESSION["Login_error"]) {
                        case 1:
                            echo "<section>WYPEŁNIJ POLA</section><br>";
                            break;
                        case 2:
                            echo "<section>ZŁY LOGIN LUB HASŁO</section><br>";
                            break;
                        default:
                            break;
                    }  
                
                ?>
            <input type="submit" value="Zaloguj">
        </form>
        <hr> 
        <button onclick="register()">Zarejestruj</button>
    </main>
</body>
<script>
    function register()
    {
        location.replace("register.php")
    }
</script>
</html>