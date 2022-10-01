<?php
session_start();

// code to connect to the db
$con=mysqli_connect('localhost','root','','bloodwaybase');
if(!$con){
    die(mysqli_error(new $con));
}

// delet query
$donor_email = $_SESSION['user_email'];

$delete_query = "delete from donor_details where  donor_email='$donor_email'";
$result = mysqli_query($con,$delete_query);

$delete_query = "DELETE from donation_details WHERE dona_email='$donor_email'";
$sql_exec = mysqli_query($con, $delete_query);

unset( $_SESSION['donor_name']);
unset( $_SESSION['donor_zone']);
unset( $_SESSION['donor_bgrp']);
unset( $_SESSION['donor_dob']);
unset( $_SESSION['donor_age']);
unset( $_SESSION['donor_mobNum']);
unset( $_SESSION['donor_gender']);
unset( $_SESSION['donor_weight']);
unset( $_SESSION['donor_category']);


header('location:../donor_details_redirect.php')
?>