<?php
session_start(); 
if (isset($_POST['monster'])) {
    $_SESSION['monster'] = $_POST['monster'];
    echo "sended";
}
?>