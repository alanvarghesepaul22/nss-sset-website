<?php
include('../includes/connect.php');
$error = "";
if (isset($_GET['vkey'])) {
    $vkey = $_GET['vkey'];
    $select_query_verify = "SELECT * from user_details where vkey='$vkey'";
    $select_result_verify = mysqli_query($con, $select_query_verify);
    $rows_count_verify = mysqli_num_rows($select_result_verify);
}else{
    header('location:common_user_func/error404.php');
}

if (isset($_POST['recover_submit'])) {
    $user_password = $_POST['user_password'];
    $user_password = $con->real_escape_string($user_password);
    $conf_user_password = $_POST['conf_user_password'];
    $conf_user_password = $con->real_escape_string($conf_user_password);

    if ($rows_count_verify) {
        if ($user_password == $conf_user_password) {

            $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE user_details SET user_password ='$hash_password' WHERE vkey='$vkey'";
            $sql_execute = mysqli_query($con, $update_query);
            if ($sql_execute) {
                header('location:user_login.php');
            }
        } else {
            $error = "Passwords do not match!";
            exit(0);
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
    <title>Reset Password </title>
    <link rel="stylesheet" href="../css/reset_pass.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
    <div class="form-gap"></div>
    <h6 id="icon"></h6>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                    <div class="alert alert-danger">
                                        <center><?php echo $error ?></center>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-lock"></i></span>
                                            <input id="password" name="user_password" placeholder="New password" class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"> <i class="fa fa-lock"></i></span>
                                            <input id="password" name="conf_user_password" placeholder="Re-enter new password" class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover_submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
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