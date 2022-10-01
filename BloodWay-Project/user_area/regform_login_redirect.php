<?php
session_start();
include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8" />
    <title>Login to continue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/page_redirect_common.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>


<body>

    <!-- navbar -->
    <?php
    include('common_user_func/user_navbar.php');
    ?>


    <div class="container-redir">
        <div class="card-redir">
            <h2 class="head-redir">Login to Register !</h2>
            <h3 class="content-redir">You have to login to your account to register a donor.<br>If you are new here, Signup to continue</h3>
            <div class="button-center-redir">
                <a href="user_login.php" class="butn-a-redir"> <button class="butn-redir1"><i class="bi bi-box-arrow-in-right"> </i> Click to login</button></a>
                <a href="user_signup.php" class="butn-a-redir"> <button class="butn-redir2"><i class="bi bi-box-arrow-in-right"> </i> Click to signup</button></a>

            </div>

        </div>
    </div>



    <!-- footer -->

    <?php
    include('common_user_func/user_footer.php');
    ?>


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