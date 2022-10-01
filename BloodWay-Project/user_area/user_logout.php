<?php
if (!isset($_SESSION["user_email"])) {
    header('location:common_user_func/error404.php');
}
?>
<?php
session_start();
session_unset();
session_destroy();
header('location: ../index.php');
?>
