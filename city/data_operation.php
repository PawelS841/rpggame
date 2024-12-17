<?php
session_start(); 
if (isset($_POST['resource'])) {
    $_SESSION['resource'] = $_POST['resource'];
    echo "sended";
}
?>