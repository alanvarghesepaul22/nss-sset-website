<!-- this php file is used as a common php file for accessing donor details table with full functions -->

<?php
session_start();
include('../includes/connect.php');
$donor_email = $_SESSION['user_email'];
$select_query = "Select * from donor_details where  donor_email='$donor_email'";
$result = mysqli_query($con, $select_query);
$fetch = $result->fetch_assoc();


$donor_name = $fetch['donor_name'];
$donor_zone = $fetch['donor_zone'];
$donor_group = $fetch['donor_bgrp'];
$donor_dob = $fetch['donor_dob'];
$donor_age = $fetch['donor_age'];
$donor_mobNum = $fetch['donor_mobNum'];
$donor_gender = $fetch['donor_gender'];
$donor_weight = $fetch['donor_weight'];
$donor_category = $fetch['donor_category'];


$_SESSION['donor_name'] = $donor_name;
$_SESSION['donor_zone'] = $donor_zone;
$_SESSION['donor_bgrp'] = $donor_group;
$_SESSION['donor_dob'] = $donor_dob;
$_SESSION['donor_age'] = $donor_age;
$_SESSION['donor_mobNum'] = $donor_mobNum;
$_SESSION['donor_gender'] = $donor_gender;
$_SESSION['donor_weight'] = $donor_weight;
$_SESSION['donor_category'] = $donor_category;


if (isset($_SESSION['donor_name'])) {
    $_SESSION['donor_name'];
    $_SESSION['donor_zone'];
    $_SESSION['donor_bgrp'];
    $_SESSION['donor_dob'];
    $_SESSION['donor_age'];
    $_SESSION['donor_mobNum'];
    $_SESSION['donor_gender'];
    $_SESSION['donor_weight'];
    $_SESSION['donor_category'];
}

?>