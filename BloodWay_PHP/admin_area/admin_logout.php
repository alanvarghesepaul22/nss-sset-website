<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header('location:../user_area/common_user_func/error404.php');
} else {
    session_unset();
    session_destroy();
    header('location: admin_login.php');
}
