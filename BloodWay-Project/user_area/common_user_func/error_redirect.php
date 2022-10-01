<?php
session_start();

if (!isset($_SESSION["user_email"])) {
    header('location:error404.php');
}

?>

