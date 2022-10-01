<?php
session_start();
include('../includes/connect.php');
if (!isset($_SESSION["user_email"])) {
    header('location:common_user_func/error404.php');
}
$user_email = $_SESSION['user_email'];
if (isset($_SESSION['user_email'])) {
    $select_query = "Select * from user_details where  user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $fetch = mysqli_fetch_assoc($result);
    $username = $fetch['user_name'];
    $useremail = $fetch['user_email'];
}

if (isset($_SESSION["user_email"])) {
    $conf_email = $_SESSION['user_email'];
    $select_query_donor_details = "SELECT * from donor_details where donor_email='$conf_email'";
    $select_query_donation_details = "SELECT * from donation_details where dona_email='$conf_email'";
    $result_donor_details = mysqli_query($con, $select_query_donor_details);
    $result_donation_details = mysqli_query($con, $select_query_donation_details);
    $rows_count_donation_details = mysqli_num_rows($result_donation_details);
    $rows_count_donor_details = mysqli_num_rows($result_donor_details);
    $fetchData = mysqli_fetch_assoc($result_donor_details);
}

//SQL_QUERY 

if (isset($_POST['update-profile'])) {
    $profile_username = $_POST['username-profile'];

    //select query
    $select_query = "SELECT * from user_details where user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        // sanitzing data
        $profile_username = $con->real_escape_string($profile_username);

        //update query
        $update_query = "UPDATE user_details SET user_name ='$profile_username' WHERE user_email='$user_email' ";
        $sql_execute = mysqli_query($con, $update_query);
        if ($sql_execute) {
            $_SESSION['error'] = "Username updated Successfully";
            $_SESSION['error-mode'] = "alert-success";
            $_SESSION['user_name'] = $profile_username;
            header('location:user_profile.php');
            exit(0);
        } else {
            $_SESSION['error'] = "Something went wrong!";
            $_SESSION['error-mode'] = "alert-danger";
            header('location:user_profile.php');
            exit(0);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/modal_bs_custom.css" />
    <link rel="stylesheet" href="../css/popup_modal.css" />
    <link rel="stylesheet" href="../css/fullbs5.css">
    <link rel="stylesheet" href="../css/user_profile.css">
</head>

<body>
    <!-- NavBar -->
    <?php
    include('common_user_func/user_navbar.php');
    ?>

    <h2>
        <p class="Title-profile">My Profile</p>
    </h2>

    <!-- Validation alert block  -->
    <?php
    if (isset($_SESSION['error'])) { ?>
        <div class="alert <?php echo $_SESSION['error-mode']; ?>">
            <center>
                <?php
                echo $_SESSION['error'];
                ?>
            </center>
        </div>
    <?php
    }
    unset($_SESSION['error']);
    unset($_SESSION['error-mode']);
    ?>

    <div class="container col-lg-7 ">
        <div class="card cardContainer">
            <h5 class="cardTitle">Donor Profile</h5>
            <hr>
            <div class="Cardbody-flex">
                <?php
                if ($rows_count_donor_details > 0) {
                ?>
                    <div class="cardBody">
                        <p class="card-text"><strong>Name: </strong><?php echo $fetchData['donor_name']; ?> </p>
                        <p class="card-text"><strong>Blood Group: </strong><?php echo $fetchData['donor_bgrp']; ?></p>
                    </div>
                    <div class="status-btn">
                        <?php
                        $avail_status = $fetchData['avail_status'];
                        $remain_days = $fetchData['remDays'];
                        if ($rows_count_donation_details == 0) {
                            $avail_status = 1;
                            $remain_days = 0;
                        }
                        if ($avail_status == 1) {
                            echo  "<p class='btn btn-outline-success btn-ele2'>You can <br> donate blood<br> now!</p>";
                        } else {
                            echo  "<p class='btn btn-outline-warning btn-ele2'>Next donation in <br> <strong class='big-num'> $remain_days </strong> <br> days</p>";
                        }

                        if ($rows_count_donation_details == 0) {
                            echo  "<p class='btn btn-outline-danger btn-ele1'>Blood donated <br><strong class='big-num'> $rows_count_donation_details </strong> <br> times</p>";
                        } else {
                            echo  "<p class='btn btn-outline-info btn-ele1'>Blood donated <br><strong class='big-num'> $rows_count_donation_details </strong> <br> times</p>";
                        }
                        ?>
                    </div>
                    <div class="linktoDonDet">
                        <p>All other details can be viewed in detail on <a href="./donor_details.php" id="donDet-aTag">Donor Details</a> section</p>
                    </div>
                <?php
                } else {
                ?>
                    <div class="cardBody">
                        <h6 class="card-text mx-3">
                            No Donor Profile Found!
                        </h6>
                        <div class="linktoDonDet">
                            <p>You can register a donor here <a href="./reg_form.php" id="donDet-aTag">Be A Donor</a></p>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>

        </div>
    </div>


    <div class="allcontainer mb-5">
        <!-- signup form -->
        <div class="form-group containform">
            <form class="px-5" action="#" method="POST">
                <div class="mb-3 ">
                    <label for="InputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="InputUsername" name="username-profile" value="<?php echo $username; ?>" required>

                </div>
                <div class="mb-3 ">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $useremail; ?>" readonly>
                </div>
                <button type="submit" class="btn btn-dark" name="update-profile">Update</button>
            </form>
        </div>

        <!-- sidebar -->
        <div class="sidebar">
            <ul id="sidebar-ul">
                <li class="sidebar-li"><a class="sidebar-list" href="changePass.php">Change Password</a></li>
                <li class="sidebar-li"><a class="sidebar-list" href="deleteAccount.php">Delete Account</a></li>
                <li class="sidebar-li"><a class="sidebar-list trigger-btn" href="#logoutModal" data-toggle="modal">Logout</a></li>
            </ul>
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

</html>