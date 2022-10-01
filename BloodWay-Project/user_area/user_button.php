<?php
if (!isset($_SESSION["user_email"])) {
    header('location:common_user_func/error404.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/user_button.css">
    <link rel="stylesheet" href="../css/modal_bs_custom.css" />
    <link rel="stylesheet" href="../css/popup_modal.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="dropdown">
        <button class="dropbtn"><i class="bi bi-person-circle"></i> <?php
                                                                    echo  $_SESSION['user_name'];
                                                                    ?></button>
    </div>


    <div class="dropdown1">
        <button class="dropbtn1"><i class="bi bi-caret-down"></i></button>

        <div class="dropdown-content1" style="right:0;">

            <a href="donor_details.php">Donor Details</a>
            <a href="user_profile.php">My Profile</a>
            <a href="#logoutModal" class="trigger-btn" data-toggle="modal">Logout</a>
        </div>
    </div>


    <!-- Logout modal -->
    <div id="logoutModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">

                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to Logout?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="user_logout.php" class="butn-a-redir"><button type="button" class="btn btn-danger">Logout</button></a>
                </div>
            </div>
        </div>
    </div>


    <!-- hidden in desktop view and visible in mobile view -->

    <div class="dropdown-resp">
        <button class="dropbtn-resp"><i class="bi bi-person-circle"></i> <?php
                                                                            echo  $_SESSION['user_name'];
                                                                            ?></button>
    </div>


    <div class="dropdown1-resp">
        <button class="dropbtn1-resp"><i class="bi bi-caret-up"></i></button>

        <div class="dropdown-content1-resp">

            <a href="donor_details.php">Donor Details</a>
            <a href="user_profile.php">My Profile</a>
            <a href="#logoutModal" class="trigger-btn" data-toggle="modal">Logout</a>

        </div>
    </div>
</body>

</html>