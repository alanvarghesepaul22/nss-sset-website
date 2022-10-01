<?php
session_start();
include('../includes/connect.php');
if (!isset($_SESSION['admin_email'])) {
    header('location:../user_area/common_user_func/error404.php');
}
$donor_name = $donor_email = $donor_dob = $donor_age = $donor_mobnum = $donor_zone = "";
$donor_bgrp = $donor_weight = $donor_gender = $donor_category = "";
// $error = "";
$flag = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $donor_name = test_input($_POST['donor_name']);
    $donor_email = test_input($_POST['donor_email']);
    $donor_dob = test_input($_POST['donor_dob']);
    $age = getAge($donor_dob); //age from dob
    $donor_age = $age;
    $donor_mobnum = test_input($_POST['donor_mobnum']);
    $donor_zone = test_input($_POST['donor_zone']);
    $donor_bgrp = test_input($_POST['donor_bgrp']);
    $donor_weight = 60;
    $donor_gender = test_input($_POST['donor_gender']);
    $donor_category = test_input($_POST['donor_category']);


    //to make password from dob
    $parts = explode('-', $donor_dob);
    $day = $parts[2];
    $month = $parts[1];
    $year = $parts[0];
    $dob_pass = $day . $month . $year; // this variavble is hashed and inserted to db as password
    $hash_password = password_hash($dob_pass, PASSWORD_DEFAULT);

    $avail_status = 1; // available to donate now
    $remDays = 0; // 0 days ie.,no donation in last 90 days
    $verified = 1; // user is automatically verified no need of email verification

    $keylength = 18;
    $strg = "qwertyuioplaksjdhfgmznxbcv";
    $randStr = substr(str_shuffle($strg), 0, $keylength); // charid ,random string generation


    // input validation
    $donor_mobnu = strlen($_POST["donor_mobnum"]);
    $length = strlen($donor_mobnu);
    // name error
    if (!preg_match("/^[a-zA-Z-' ]*$/", $donor_name)) {
        $flag = false;
        $_SESSION['status'] = "Only alphabets and whitespace are allowed.";
        $_SESSION['status-mode'] = "alert-danger";
        header('location:donor_add.php');
        exit(0);
    } else if (!preg_match('/^[0-9]{10}+$/', $donor_mobnum)) {
        $flag = false;
        $_SESSION['status'] = "Invalid mobile number.";
        $_SESSION['status-mode'] = "alert-danger";
        header('location:donor_add.php');
        exit(0);
    } else if ($donor_age < 18 || $donor_age > 60) {
        $flag = false;
        $_SESSION['status'] = "Age must be between 18 and 60.";
        $_SESSION['status-mode'] = "alert-danger";
        header('location:donor_add.php');
        exit(0);
    } else {
        $flag = true;
    }

    if ($flag) {
        //select query

        $select_donor_query = "Select * from donor_details where  donor_email='$donor_email'";
        $result = mysqli_query($con, $select_donor_query);
        $rows_count = mysqli_num_rows($result);

        $select_user_query = "Select * from user_details where  user_email='$donor_email'";
        $result1 = mysqli_query($con, $select_user_query);
        $rows_count1 = mysqli_num_rows($result1);

        if ($rows_count > 0) {
            $_SESSION['status'] = "Donor with same email id already exist!";
            $_SESSION['status-mode'] = "alert-danger";
            header('location:donor_add.php');
            exit(0);
        } elseif ($rows_count1 > 0) {
            $_SESSION['status'] = "User with same email id already exist!";
            $_SESSION['status-mode'] = "alert-danger";
            header('location:donor_add.php');
            exit(0);
        } else {
            // sanitzing data
            $donor_name = $con->real_escape_string($donor_name);
            $donor_email = $con->real_escape_string($donor_email);
            $donor_dob = $con->real_escape_string($donor_dob);
            $donor_age = $con->real_escape_string($donor_age);
            $donor_zone = $con->real_escape_string($donor_zone);
            $donor_bgrp = $con->real_escape_string($donor_bgrp);
            $donor_weight = $con->real_escape_string($donor_weight);
            $donor_gender = $con->real_escape_string($donor_gender);
            $donor_category = $con->real_escape_string($donor_category);

            $vkey = password_hash($donor_name, PASSWORD_DEFAULT);
            //insert query

            $insert_donor_query = "insert into donor_details (donor_name,donor_email,donor_dob,donor_age,donor_mobNum,donor_zone,donor_bgrp,donor_gender,donor_weight,donor_category,avail_status,remDays,view_charid) values ('$donor_name','$donor_email','$donor_dob','$donor_age','$donor_mobnum','$donor_zone','$donor_bgrp','$donor_gender','$donor_weight','$donor_category','$avail_status','$remDays','$randStr')";
            $sql_execute = mysqli_query($con, $insert_donor_query);

            $insert_user_query = "insert into user_details (user_name,user_email,user_password,vkey,verified) values ('$donor_name','$donor_email','$hash_password','$vkey','$verified')";
            $sql_user_execute = mysqli_query($con, $insert_user_query);
            if ($sql_execute && $sql_user_execute) {
                $_SESSION['status'] = "Donor added successfully!";
                $_SESSION['status-mode'] = "alert-success";
                header('location:donor_add.php');
                exit(0);
            } else {
                $_SESSION['status'] = "Something went wrong! Try again.";
                $_SESSION['status-mode'] = "alert-danger";
                header('location:donor_add.php');
                exit(0);
            }
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getAge($dob)
{
    $bday = new DateTime($dob);
    $today = new DateTime(date('m.d.y'));
    if ($bday > $today) {
        return 0;
    }
    $diff = $today->diff($bday);
    return $diff->y;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <meta charset="utf-8" />
    <title>Add Donor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/donor_add.css" />
    <link rel="stylesheet" href="../css/alert_status.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>

    <!-- navbar -->
    <?php
    include('common_includes/admin_navbar.php');
    ?>

    <?php
    include('../common_func/validation_alert_block.php');
    ?>

    <!-- reg_form -->
    <div data-bs-spy="scroll" data-bs-target="#scrollcode" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
        <div class="container-reg" id="code">
            <div class="title">Add Donor</div>

            <div class="content-reg">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="user-details-reg">
                        <div class="input-box-reg">
                            <span class="details-reg">Full Name</span>
                            <input type="text" placeholder="Enter your name" name="donor_name" required>
                        </div>

                        <div class="input-box-reg">
                            <span class="details-reg">Email</span>
                            <input type="email" placeholder="Enter your email" name="donor_email" required>
                        </div>


                        <div class="input-box-reg">
                            <span class="details-reg">Phone Number</span>
                            <input type="text" placeholder="Enter your number" name="donor_mobnum" required>
                        </div>

                        <div class="input-box-reg">
                            <span class="details-reg">Date of Birth</span>
                            <input type="date" placeholder="Enter your DOB" name="donor_dob" required>
                        </div>

                        <div class="input-box-reg">
                            <span class="details-reg">District/Zone</span>
                            <select name="donor_zone" id="zone-dist" name="donor_zone" required>
                                <option value="" selected>Select</option>
                                <option value="Ernakulam">Ernakulam</option>
                                <option value="Thrissur">Thrissur</option>
                            </select>
                        </div>
                        <div class="input-box-reg">
                            <span class="details-reg">Blood Group</span>
                            <select name="donor_bgrp" id="blood-grp" required>
                                <option value="" selected>Select</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="Bombay blood group">Bombay blood group</option>
                            </select>
                        </div>


                        <div class="input-box-reg">
                            <span class="details-reg">Gender</span>
                            <select name="donor_gender" id="zone-dist" name="donor_zone" required>
                                <option value="" selected>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="input-box-reg">
                            <span class="details-reg">Category</span>
                            <select name="donor_category" id="don_cat" required>
                                <option value="" selected>Select</option>
                                <option value="Nss Volunteer">Nss Volunteer</option>
                                <option value="Student">Student</option>
                                <option value="College Staff">College Staff</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="button-reg">
                        <input type="submit" value="Add Donor" name="donor_reg">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<!-- dark theme js -->
<script>
    var icon = document.getElementById("icon");

    icon.onclick = function() {
        var SetTheme = document.body;

        SetTheme.classList.toggle("dark-theme");

        var theme;

        if (SetTheme.classList.contains("dark-theme")) {
            console.log("Dark mode");
            theme = "DARK";
        } else {
            console.log("Light mode");
            theme = "LIGHT";
        }

        localStorage.setItem("PageTheme", JSON.stringify(theme));

        if (document.body.classList.contains("dark-theme")) {
            icon.src = "../images/sun.png";
        } else {
            icon.src = "../images/moon.png";
        }
    };

    let GetTheme = JSON.parse(localStorage.getItem("PageTheme"));
    console.log(GetTheme);

    if (GetTheme === "DARK") {
        document.body.classList = "dark-theme";
        icon.src = "../images/sun.png";
    }
</script>

<script src="js/script.js"></script>