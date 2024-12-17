<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karty</title>
    <link rel="shortcut icon" href="test2.svg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="icons/favicon.svg" type="image/x-icon">
</head>
<body>
    <main>
        <div class="login">
            <form action="register_script.php" method="post">
                <label for="Email">Email:</label><br>

                <?php
                    session_start();
                    if(isset($_SESSION["E"]))
                        echo "<input type='email' name='Email' id='Email' value='{$_SESSION["E"]}'><br>";
                    else
                        echo '<input type="email" name="Email" id="Email"><br>';

                    if(isset($_SESSION["error1"]))
                        switch ($_SESSION["error1"]){
                            case 1:
                                echo "<section>WYPEŁNIJ TO POLE!</section><br>";
                                break;
                            case 2:
                                echo "<section>WPISZ EMAIL!</section><br>";
                                break;
                            case 3:
                                echo "<section>TAKI EMAIL JEST ZAJĘTY</section><br>";
                                break;
                            default:
                                break;
                        }
                ?>

                <label for="Login">Login:</label><br>
                
                <?php
                    if(isset($_SESSION["E"]))
                        echo "<input type='text' name='Login' id='Login' value='{$_SESSION["L"]}'><br>";
                    else
                        echo '<input type="text" name="Login" id="Login"><br>';

                    if(isset($_SESSION["error2"]))
                        switch ($_SESSION["error2"]){
                            case 1:
                                echo "<section>WYPEŁNIJ TO POLE!</section><br>";
                                break;
                            case 2:
                                echo "<section>LOGIN MA ZAWIERAĆ 8 ZNAKÓW</section><br>";
                                break;
                            case 3:
                                echo "<section>TAKI LOGIN JEST ZAJĘTY</section><br>";
                                break;
                            default:
                                break;
                        }
                ?>

                <label for="Password">Hasło:</label><br>
                <input type="password" name="Password" id="Password"><br>
                <?php

                    if(isset($_SESSION["error3"]))
                        switch ($_SESSION["error3"]){
                            case 1:
                                echo "<section>WYPEŁNIJ TO POLE!</section><br>";
                                break;
                            case 2:
                                echo "<section>HASŁO JEST ZA SŁABE</section><br>";
                                break;
                            default:
                                break;
                        }
                ?>

                <label for="Password_r">Powtrz Hasło:</label><br>
                <input type="password" name="Password_r" id="Password_r" minlength="1"><br>
                <?php
                    if(isset($_SESSION["error4"]))
                        switch ($_SESSION["error4"]){
                            case 1:
                                echo "<section>WYPEŁNIJ TO POLE!</section><br>";
                                break;
                            case 2:
                                echo "<section>HASŁO SĄ RÓŻNE</section><br>";
                                break;
                            default:
                                break;
                        }
                ?>

                <input type="submit" value="Zarejestruj">
            </form>
            <hr>
            <button onclick="login()">Zaloguj</button>
        </div>
    </main>
    <?php
        session_unset();
    ?>
</body>
<script>
    function login()
    {
        location.replace("index.php")
    }
</script>
</html>