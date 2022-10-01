<?php
session_start();
include('../includes/connect.php');
if (isset($_SESSION["user_email"])) {
    header('location:common_user_func/error404.php');
}
$error = null;

//SQL_QUERY 

if (isset($_POST['user_signup'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password = $con->real_escape_string($user_password);
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $conf_user_password = $con->real_escape_string($conf_user_password);

    //select query

    $select_query = "Select * from user_details where  user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    if ($rows_count > 0) {
        $error = "Email you entered already exist!";
    } else if ($user_password != $conf_user_password) {
        $error = "Passwords do not match!";
    } else {
        // sanitzing data
        $user_username = $con->real_escape_string($user_username);
        $user_email = $con->real_escape_string($user_email);
        
        // verification key generating

        $vkey = password_hash($user_username, PASSWORD_DEFAULT);

        //insert query

        $insert_query = "insert into user_details (user_name,user_email,user_password,vkey) values ('$user_username','$user_email','$hash_password','$vkey')";
        $sql_execute = mysqli_query($con, $insert_query);

        // account verification email sending

        $to = $user_email;
        $subject = "BloodWay Account Verification";
        $message = "<a href='http://localhost/user_area/email_verify.php?vkey=$vkey'>Verify Account</a>";
        $headers = "From: bloodwaynss@gmail.com  \r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "<script>alert('Email sent succesfully to $to')</script>";
            $_SESSION['flag']=true; //this session is set for viewing thankyou page if this is false 
            //then thankyoupage will redirect to error404 page
            header('location: thankyou_page.php');
        } else {
            echo "<script>alert('Failed to send email!')</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_signup.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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


    <!-- signup form -->

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
                <h2>Sign Up</h2>
                <p>Please fill in this form to create an account!</p>
                <hr>
                <div class="alert alert-danger">
                    <center><?php echo $error ?></center>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fa fa-user"></span>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="user_username" placeholder="Username" required="required">
                    </div>
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
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                                <i class="fa fa-check"></i>
                            </span>
                        </div>
                        <input type="password" class="form-control" name="conf_user_password" placeholder="Confirm Password" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg" name="user_signup">Sign Up</button>
                </div>
                <div class="text-center"> Already have an account? <a href="user_login.php">Login here</a></div>
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

</html>