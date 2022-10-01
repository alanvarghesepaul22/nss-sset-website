<?php
session_start();
include('../includes/connect.php');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $select_user_query = "SELECT * FROM user_details WHERE user_id='$id'";
    $sql_select_user_exec = mysqli_query($con, $select_user_query);
    $fetchData = mysqli_fetch_assoc($sql_select_user_exec);
    $user_email = $fetchData['user_email'];

    $delete_user_query = "DELETE from user_details WHERE user_id='$id'";
    $sql_user_exec = mysqli_query($con, $delete_user_query);

    if ($sql_user_exec) {
        $delete_donor_query = "DELETE from donor_details WHERE donor_email='$user_email'";
        $sql_donor_exec = mysqli_query($con, $delete_donor_query);

        $delete_donation_query = "DELETE from donation_details WHERE dona_email='$user_email'";
        $sql_donation_exec = mysqli_query($con, $delete_donation_query);

        $_SESSION['status'] = "User Deleted!";
        $_SESSION['status-mode'] = "alert-success";
        header('location:users_manage.php');
        exit(0);
    } else {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status-mode'] = "alert-danger";
        header('location:users_manage.php');
        exit(0);
    }
} else {
    header('location:../user_area/common_user_func/error404.php');
}
