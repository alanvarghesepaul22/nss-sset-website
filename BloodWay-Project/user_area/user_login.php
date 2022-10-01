<?php
session_start();
include('../includes/connect.php');
if (isset($_SESSION["user_email"])) {
    header('location:common_user_func/error404.php');
}
$error = null;

//SQL_QUERY 

if (isset($_POST['user_login'])) {
    $user_email = $con->real_escape_string($_POST['user_email']);
    $user_password = $con->real_escape_string($_POST['user_password']);

    $select_query = "Select * from user_details where user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count != 0) {
        $fetch = $result->fetch_assoc();
        $fetch_pass = $fetch['user_password'];
        $verified = $fetch['verified'];
        $user_username = $fetch['user_name'];
        if (password_verify($user_password, $fetch_pass)) {
            if ($verified == 1) {
                $_SESSION['user_name'] = $user_username;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_password'] = $user_password;
                header('location: ../index.php');
            } else {
                $error = "This Account has not yet verified.";
            }
        } else {
            $error = "Incorrect username or password!";
        }
    } else {
        $error = "User does not exist";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signin to Account</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/style_signup.css">
    <link rel="stylesheet" href="../css/user_login.css">
</head>
<?php
if ($error != null) {
?>
    <style>
        .alert {
            display: block;
        }
    </style>
<?php
}
?>


<body>
    <!-- NavBar -->
    <?php
    include('common_user_func/user_navbar.php');
    ?>

    <!-- login form -->
    <div class="sign-container">
        <div class="ripple-background">
            <div class="circle xxlarge shade1"></div>
            <div class="circle xlarge shade2"></div>
            <div class="circle large shade3"></div>
            <div class="circle mediun shade4"></div>
            <div class="circle small shade5"></div>
        </div>
        <div class="signup-form">
            <form action="" method="post">
                <h2 class="signin-title">Sign In</h2>
                <p>Please fill in this form to Sign in to your account!</p>
                <hr>

                <div class="alert alert-danger">
                    <center><?php echo $error ?></center>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-paper-plane"></i>
                            </span>
                        </div>

                        <input type="email" class="form-control" name="user_email" placeholder="Email Address" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control" name="user_password" placeholder="Password" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg" name="user_login">Sign In</button>
                </div>
                <div class="link forget-pass text-center" id="for_pass"><a href="forgot_password.php">Forgot password?</a></div>
                <div class="text-center"> Don't have an account? <a href="user_signup.php">SignUp here</a></div>
            </form>

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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</html>