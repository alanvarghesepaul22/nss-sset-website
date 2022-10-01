<?php
session_start();
include('../includes/connect.php');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $select_query = "SELECT * from donation_details where dona_id='$id'";
    $result_donation = mysqli_query($con, $select_query);
    $fetchDonatData = mysqli_fetch_assoc($result_donation);

    $conf_email = $fetchDonatData['dona_email'];

    $select_donor_query = "SELECT * from donor_details where donor_email='$conf_email'";
    $result_donor = mysqli_query($con, $select_donor_query);
    $fetchDonorData = mysqli_fetch_assoc($result_donor);

    $view_id = $fetchDonorData['donor_id'];

    $delete_query = "DELETE from donation_details WHERE dona_id='$id'";
    $sql_exec = mysqli_query($con, $delete_query);


    if ($sql_exec) {

        // here date stored in donation details db is accessed and max date is retrieved. 
        $select_query = "SELECT * from donation_details where dona_email='$conf_email' and dona_date=(SELECT max(dona_date) from donation_details)";
        $result = mysqli_query($con, $select_query);
        $rows_count = mysqli_num_rows($result);
        $fetchdata = mysqli_fetch_array($result);
        if ($rows_count >= 0) {
            $max_date = $fetchdata['dona_date'];
            // this max date is used to calculate the remaining days by adding 90 days to the same.
            $latest_date = new DateTime($max_date);
            $latest_date = $latest_date->modify('+90 day');
            $todayDate = new DateTime('now');
            // taking current date and calculating difference with latest date.
            $diff = date_diff($todayDate, $latest_date);
            $remainDate = $diff->format("%a");

            // checking date-> if greater than 90 days then available to donate 
            // so set stastus variable to 1 else not available so set it 0.
            if ($remainDate > 90) {
                $availStatus = 1;
            } else {
                $availStatus = 0;
            }
            // updating donor details table with status varible set.
            $update_query = "UPDATE donor_details SET avail_status='$availStatus' , remDays='$remainDate' WHERE  donor_email='$conf_email'";
            $update_sql_exec = mysqli_query($con, $update_query);
            if ($update_sql_exec) {
                $_SESSION['status'] = "Details deleted Successfully!";
                $_SESSION['status-mode'] = "alert-success";
                header('location:view_donor_details.php?view_id=' . $view_id);
                exit(0);
            }
        }
    } else {
        $_SESSION['status'] = "Something went wrong!";
        $_SESSION['status-mode'] = "alert-danger";
        header('location:view_donor_details.php?view_id=' . $view_id);
        exit(0);
    }
} else {
    header('location:../user_area/common_user_func/error404.php');
}
