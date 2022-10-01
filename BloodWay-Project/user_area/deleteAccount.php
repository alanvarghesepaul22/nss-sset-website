<?php
session_start();
include('../includes/connect.php');
if (!isset($_SESSION["user_email"])) {
    header('location:common_user_func/error404.php');
}
$user_email = $_SESSION['user_email'];

if (isset($_SESSION['user_email'])) {
    if (isset($_POST['deleteAcc'])) {
        $delete_query_donor = "delete from donor_details where  donor_email='$user_email'";
        $result_donor = mysqli_query($con, $delete_query_donor);

        $delete_query_donation = "DELETE from donation_details WHERE dona_email='$user_email'";
        $result_donation = mysqli_query($con, $delete_query_donation);

        $delete_query_user = "DELETE from user_details WHERE user_email='$user_email'";
        $result_user = mysqli_query($con, $delete_query_user);


        if ($result_donor && $result_donation && $result_user) {

            session_unset();
            session_destroy();

            header('location:../index.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account?</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/deleteAccount.css">
</head>
<style>

</style>

<body>
    <h6><i class="zz" id="icon"></i></h6>
    <form action="#" method="post">
        <div class="card mt-5">
            <div class="card-header">
                <h2>Delete Account?</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">Are you sure you want to continue?</h5>
                <p class="card-text">If you delete your account, you will permanently lose your profile, donor related details and other important informations.</p>
                <a href="user_profile.php" class="btn btn-secondary ml-3">No, Go back</a>
                <button type="submit" href="#" class="btn btn-danger ml-4" name="deleteAcc">Yes, Delete My Account</button>
            </div>
        </div>
    </form>
</body>

<!-- dark theme -->
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