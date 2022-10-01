<?php
session_start();
include('../includes/connect.php');
if (isset($_POST['forgot_submit'])) {
    $email_verify = test_input($_POST['user_email']);
    $select_query = "SELECT * from user_details where user_email='$email_verify'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    $fetchdata = mysqli_fetch_assoc($result);
    if ($rows_count == 1) {
        $vkey = $fetchdata['vkey'];
        $user_email = $fetchdata['user_email'];

        // account verification email sending
        $to = $user_email;
        $subject = "BloodWay Account Password Reset";
        $message = "<a href='http://localhost/user_area/reset_pass.php?vkey=$vkey'>Reset Password</a>";
        $headers = "From: bloodwaynss@gmail.com  \r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['flag2'] = true;
            header('location: forgot_password_redir.php');
        } else {
            $_SESSION['error'] = "Failed to send email!";
            header('location: forgot_password.php');
            exit(0);
        }
    } else {
        $_SESSION['error'] = "This email does not exist!";
        header('location: forgot_password.php');
        exit(0);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verfiy Email</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../css/forgot_password.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<?php
if (isset($_SESSION['error']) && $_SESSION['error'] != null) {
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

    <div class="return_div">
        <a href="user_login.php" class="return_link"><i class="bi bi-arrow-left"></i> Go back</a>
    </div>
    <div class="form-gap"></div>
    <h6 id="icon"></h6>
    <div class="container">
        <div class="text-center">
            <h3><i class="fa fa-lock fa-3x"></i></h3>
            <h2 class="text-center">Forgot Password?</h2>
            <p>You can reset your password here.</p>
            <div class="container form-container">
                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                    <!-- Validation alert block  -->
                    <?php
                    if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger">
                            <center><?php echo  $_SESSION['error'] ?></center>
                        </div>
                    <?php
                    }
                    unset($_SESSION['error']);
                    ?>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                            <input id="email" name="user_email" placeholder="Email Address" class="form-control" type="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input name="forgot_submit" class="btn btn-lg btn-primary btn-block btn-sm" value="CONTINUE" type="submit">
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

</html>