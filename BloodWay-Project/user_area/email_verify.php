<?php
session_start(); // for thankyou.php page
include('../includes/connect.php');
if (!isset($_SESSION["user_email"])) {
    header('location:common_user_func/error404.php');
}
$_SESSION['flag'] = false; //for thankyou.php page 
if (isset($_GET['vkey'])) {
    $vkey = $_GET['vkey'];

    $select_query_verify = "Select verified,vkey from user_details where verified = 0 and vkey='$vkey'";
    $select_result_verify = mysqli_query($con, $select_query_verify);
    $rows_count_verify = mysqli_num_rows($select_result_verify);

    if ($rows_count_verify == 1) {

        $update_query_verify = "Update user_details set verified = 1 where vkey='$vkey'";
        $update_result_verify = mysqli_query($con, $update_query_verify);

        if ($update_result_verify) {
            echo "Acoount has been verfied!. Login to continue.";
        } else {
            echo $con->error;
        }
    } else {
        echo "This Account is already verified or invalid.";
    }
} else {
    die("Something went wrong");
}
