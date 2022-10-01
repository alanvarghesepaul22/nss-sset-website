<?php
session_start();

include('../../includes/connect.php');

$donat_date = $_SESSION['donated-date'];
$latest_date = new DateTime($donat_date);
$latest_date = $latest_date->modify('+90 day');
$todayDate = new DateTime('now');
$diff = date_diff($todayDate, $latest_date);
$activeDate= $diff->format("%a days");
echo $activeDate;
