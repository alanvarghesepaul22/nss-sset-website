<?php
session_start();
include('../includes/connect.php');
if (!isset($_SESSION["user_email"])) {
    header('location:common_user_func/error404.php');
}
$user_email = $_SESSION['user_email'];

//SQL_QUERY 

if (isset($_POST['update-pass'])) {
    $oldPassword = $_POST['oldpass-profile'];
    // $hash_oldPassword = password_hash($oldPassword, PASSWORD_DEFAULT);
    $new_password = $_POST['pass-profile'];
    $conf_new_password = $_POST['conf-pass-profile'];


    //select query
    $select_query = "SELECT * from user_details where user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    $fetch = mysqli_fetch_assoc($result);
    $userpassword = $fetch['user_password'];

    if ($rows_count > 0) {

        if (password_verify($oldPassword, $userpassword)) {
            if ($new_password == $conf_new_password) {

                $hash_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                $conf_user_password = $con->real_escape_string($conf_user_password);
                //update query
                $update_query = "UPDATE user_details SET user_password ='$hash_new_password' WHERE user_email='$user_email' ";
                $sql_execute = mysqli_query($con, $update_query);
                if ($sql_execute) {
                    $_SESSION['error'] = "Password changed Successfully!";
                    $_SESSION['error-mode'] = "alert-success";
                    header('location:user_profile.php');
                    exit(0);
                } else {
                    $_SESSION['error'] = "Something went wrong!";
                    $_SESSION['error-mode'] = "alert-danger";
                    header('location:changePass.php');
                    exit(0);
                }
            } else {
                $_SESSION['error'] = "Passwords do not match!";
                $_SESSION['error-mode'] = "alert-danger";
                header('location:changePass.php');
                exit(0);
            }
        } else {
            $_SESSION['error'] = "Current password is wrong!";
            $_SESSION['error-mode'] = "alert-danger";
            header('location:changePass.php');
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
    <title>Change password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/fullbs5.css">
    <link rel="stylesheet" href="../css/changePass.css">
</head>

<body>

    <h2>
        <p class="Title-profile">Change Your Password</p>
    </h2>
    <h6><i class="zz" id="icon"></i></h6>

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

    <!-- Change Password form -->
    <div class="form-group containform">
        <form class="px-5" action="" method="POST">
            <div class="mb-3 ">
                <label for="InputOldPass" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="InputOldPass" aria-describedby="passHelp" name="oldpass-profile" placeholder="Enter your current password" required>
            </div>
            <div class="mb-3 ">
                <label for="InputPass1" class="form-label">New Password</label>
                <input type="password" class="form-control" id="InputPass1" aria-describedby="passHelp" name="pass-profile" placeholder="Enter your new password" required>
            </div>
            <div class="mb-3 ">
                <label for="InputPass2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="InputPass2" aria-describedby="passHelp" name="conf-pass-profile" placeholder="Confirm your new password" required>
            </div>
            <button type="submit" class="btn btn-dark mt-2" name="update-pass">Change Password</button>
        </form>
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