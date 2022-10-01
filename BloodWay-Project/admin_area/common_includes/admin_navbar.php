<?php

$_SESSION['admin_username'];
$_SESSION['admin_email'];
?>

<head>
    <link rel="stylesheet" href="../css/fullbs5.css">
    <link rel="stylesheet" href="../css/admin_index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<nav>
    <a href="admin_index.php" class="dashboard-title"> Admin Dashboard</a>
    <div class="admin_name">
        <p class="dark-btn"><i class="bi bi-brightness-high-fill" id="icon" data-toggle="tooltip" title="Dark Mode"></i></p>
        <h5 class="name"> <i class="bi bi-person-circle"></i> <?php echo $_SESSION['admin_username']; ?> </h5>
        <p> <a href="admin_logout.php" class="btn btn-dark logout_btn">Logout</a></p>
    </div>

</nav>