<?php
session_start();
include('../includes/connect.php');
$_SESSION['admin_username'];
$_SESSION['admin_email'];

if (!isset($_SESSION['admin_email'])) {
    header('location:../user_area/common_user_func/error404.php');
}

$select_query_user_details = "SELECT * from user_details";
$result_user_details = mysqli_query($con, $select_query_user_details);
$rows_count_user_details = mysqli_num_rows($result_user_details);

$select_query_donor_details = "SELECT * from donor_details";
$result_donor_details = mysqli_query($con, $select_query_donor_details);
$rows_count_donor_details = mysqli_num_rows($result_donor_details);

$select_query_donation_details = "SELECT * from donation_details";
$result_donation_details = mysqli_query($con, $select_query_donation_details);
$rows_count_donation_details = mysqli_num_rows($result_donation_details);
?>

<head>
    <link rel="stylesheet" href="../css/fullbs5.css">
    <link rel="stylesheet" href="../css/admin_index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>


<!-- NavBar -->

<?php
include('common_includes/admin_navbar.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-4 col-md-4 col-lg-2 mt-2">
            <div class="card cardInfo card1 bg-primary text-white count-card">
                <div class="card-body infoCardBody text-center count-card-body">
                    <h2 class="count-num"><strong><?php echo $rows_count_user_details; ?></strong></h2>
                    <p class="count-text">Users</p>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-4 col-lg-2 mt-2">
            <div class="card cardInfo card2 bg-warning text-white count-card">
                <div class="card-body infoCardBody text-center count-card-body">
                    <h2 class="count-num"><strong><?php echo $rows_count_donor_details; ?></strong></h2>
                    <p class="count-text">Donors</p>
                </div>
            </div>
        </div>
        <div class="col-4 col-md-4 col-lg-2 mt-2">
            <div class="card cardInfo card3 bg-success text-white count-card">
                <div class="card-body infoCardBody text-center count-card-body">
                    <h2 class="count-num"><strong><?php echo $rows_count_donation_details; ?></strong></h2>
                    <p class="count-text">Donations</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item tabmain tabactive">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Nss Website Manage</a>
        </li>
        <li class="nav-item tabmain tabnotactive">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">BloodWay Website Manage</a>
        </li>
    </ul>


    <div class="tab-content" id="myTabContent">
        <!-- Nss website management area -->
        <div class="tab-pane fade show active row" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row mt-3">
                <div class="col-12 col-md-6 col-lg-4 mt-2">
                    <div class="card cardInfo card1">
                        <div class="card-body infoCardBody">
                            <h5 class="card-title">Update Latest News</h5>
                            <p class="card-text">Add latest news into the notification panel.</p>
                            <a href="./latest_news_add.php" class="btn btn-sm btn-dark continue-btn">Click to continue <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mt-2">
                    <div class="card cardInfo card1">
                        <div class="card-body infoCardBody">
                            <h5 class="card-title">Event Details</h5>
                            <p class="card-text">Create & Manage all the events here.</p>
                            <a href="" class="btn btn-sm btn-dark continue-btn">Click to continue <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mt-2">
                    <div class="card cardInfo card2">
                        <div class="card-body infoCardBody">
                            <h5 class="card-title">Gallery Updation</h5>
                            <p class="card-text">Add, delete and manage gallery here.</p>
                            <a href="" class="btn btn-sm btn-dark continue-btn">Click to continue <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- bloodway website management area -->
        <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row mt-3">
                <div class="col-12 col-md-6 col-lg-4 mt-2">
                    <div class="card cardInfo card1">
                        <div class="card-body infoCardBody">
                            <h5 class="card-title">Add a Donor</h5>
                            <p class="card-text">Admin can add a new donor here.</p>
                            <a href="donor_add.php" class="btn btn-sm btn-dark continue-btn">Click to continue <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mt-2">
                    <div class="card cardInfo card1">
                        <div class="card-body infoCardBody">
                            <h5 class="card-title">User Details</h5>
                            <p class="card-text">Manage all the users here.</p>
                            <a href="users_manage.php" class="btn btn-sm btn-dark continue-btn">Click to continue <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mt-2">
                    <div class="card cardInfo card2">
                        <div class="card-body infoCardBody">
                            <h5 class="card-title">Donor Details</h5>
                            <p class="card-text">Manage all the donors here.</p>
                            <a href="donors_manage.php" class="btn btn-sm btn-dark continue-btn">Click to continue <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


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

    };

    let GetTheme = JSON.parse(localStorage.getItem("PageTheme"));
    console.log(GetTheme);

    if (GetTheme === "DARK") {
        document.body.classList = "dark-theme";
        icon.src = "../images/sun.png";
    }
</script>