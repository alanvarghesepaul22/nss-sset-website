<?php
include('../includes/connect.php');
include('external_php/donor_session_create.php');
$sql_execute = null;
$donated_hospital = $donated_date = $donated_certificate = $temp_donated_certificate = "";
if (!isset($_SESSION["user_email"])) {
    header('location:common_user_func/error404.php');
}

if (!isset($_SESSION["donor_name"])) {
    header('location:donor_details_redirect.php');
}

if (isset($_SESSION["user_email"])) {
    $conf_email = $_SESSION['user_email'];
    $select_query = "Select * from donation_details where  dona_email='$conf_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
}

if (isset($_POST['donated_update'])) {
    $donated_hospital = test_input($_POST['donated_hospital']);
    $donated_date = test_input($_POST['donated_date']);

    $dateOfDonation = date($donated_date);
    $today = date("Y-m-d");

    if ($dateOfDonation > $today) {
        $_SESSION['status'] = "Given date is bigger than today's date";
        $_SESSION['status-mode'] = "alert-danger";
        header('location:donor_details.php');
        exit(0);
    } else {
        $image = $_FILES['donated_certificate'];
        $imgnam = $image['name'];
        $donated_hospital = $con->real_escape_string($donated_hospital);
        $donated_date = $con->real_escape_string($donated_date);

        if ($imgnam != null) {
            $donated_certificate = $_FILES['donated_certificate'];
            $imgname = $donated_certificate['name'];
            $imgtmpname = $donated_certificate['tmp_name'];

            $filenmesep = explode('.', $imgname);
            $fileext = strtolower(end($filenmesep));
            $extn = array('jpeg', 'jpg', 'png');
            if (in_array($fileext, $extn)) {
                $upload_img = "../user_area/dona_certif_imgs/" . $imgname;
                move_uploaded_file($imgtmpname, $upload_img);
                $insert_query = "insert into donation_details (dona_email,dona_hospName,dona_date,dona_certif) values ('$conf_email','$donated_hospital','$donated_date','$upload_img')";
                $sql_execute = mysqli_query($con, $insert_query);
            }
        } else {
            $upload_img = "";
            $insert_query = "insert into donation_details (dona_email,dona_hospName,dona_date,dona_certif) values ('$conf_email','$donated_hospital','$donated_date','$upload_img')";
            $sql_execute = mysqli_query($con, $insert_query);
        }

        if ($sql_execute) {

            // here date stored in donation details db is accessed and max date is retrieved. 
            $select_query = "SELECT * from donation_details where dona_email='$conf_email' and dona_date=(SELECT max(dona_date) from donation_details)";
            $result = mysqli_query($con, $select_query);
            $rows_count = mysqli_num_rows($result);
            $fetchdata = mysqli_fetch_array($result);
            if ($rows_count) {
                $max_date = $fetchdata['dona_date'];
                // this max date is used to calculate the remaining days by adding 90 days to the same.
                $latest_date = new DateTime($max_date);
                $latest_date = $latest_date->modify('+90 day');
                $todayDate = new DateTime('now');
                // taking current date and calculating difference with latest date.
                $diff = date_diff($todayDate, $latest_date);
                $remainDate = $diff->format("%a");
                // checking date-> if greater than 90 days then available to donate 
                // so set stastus variable to 1 else not available so set it 0.
                if ($remainDate > 90) {
                    $availStatus = 1;
                } else {
                    $availStatus = 0;
                }
                // updating donor details table with status varible set.
                $update_query = "UPDATE donor_details SET avail_status='$availStatus', remDays='$remainDate' WHERE  donor_email='$conf_email'";
                $update_sql_exec = mysqli_query($con, $update_query);
                // iff updating done then heading to donor detals.php
                if ($update_sql_exec) {
                    $_SESSION['status'] = "Details added successfully!";
                    $_SESSION['status-mode'] = "alert-success";
                    header('location:donor_details.php');
                    exit(0);
                }
            }
        } else {
            $_SESSION['status'] = "Something went wrong!";
            $_SESSION['status-mode'] = "alert-danger";
            header('location:donor_details.php');
            exit(0);
        }
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
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <meta charset="utf-8" />
    <title>Donor Details Section</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/alert_status.css" />
    <link rel="stylesheet" href="../css/alreadyDonor.css" />
    <link rel="stylesheet" href="../css/modal_bs_custom.css" />
    <link rel="stylesheet" href="../css/popup_modal.css" />
    <link rel="stylesheet" href="../css/donation_related_details.css">
    <link rel="stylesheet" href="../css/donor_details.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

    <!-- navbar -->
    <?php
    include('common_user_func/user_navbar.php');
    ?>

    <!-- Validation modal -->
   
    <?php
    include('../common_func/validation_alert_block.php');
    ?>
    <!-- Donor detals card -->

    <div class="container-redir">
        <div class="card-redir">
            <h3 class="head-redir">Donor Details</h3>
            <div class="content-redir">
                <i class="bt bi bi-file-earmark-person fa-5x"></i>

                <div class="h3-body-redir">
                    <div class="h3-body1-redir">
                        <h3 class="h3-redir">
                            Donor Name:
                            <p class="p-details">
                                <?php
                                echo  ucwords($_SESSION['donor_name']);
                                ?>
                            </p>

                        </h3>
                        <h3 class="h3-redir">
                            Blood Group:
                            <p class="p-details">
                                <?php
                                echo  $_SESSION['donor_bgrp'];
                                ?>
                            </p>

                        </h3>
                        <h3 class="h3-redir">
                            District/Zone:
                            <p class="p-details">
                                <?php
                                echo $_SESSION['donor_zone'];
                                ?>
                            </p>

                        </h3>
                    </div>


                    <div class="h3-body1-redir">
                        <h3 class="h3-redir">
                            Date of birth:
                            <p class="p-details">
                                <?php
                                echo  $_SESSION['donor_dob'];
                                ?>
                            </p>

                        </h3>
                        <h3 class="h3-redir">
                            Age:
                            <p class="p-details">
                                <?php
                                echo  $_SESSION['donor_age'];
                                ?>
                            </p>

                        </h3>
                        <h3 class="h3-redir">
                            weight:
                            <p class="p-details">
                                <?php
                                echo $_SESSION['donor_weight'];
                                ?>
                            </p>

                        </h3>
                    </div>

                    <div class="h3-body1-redir">
                        <h3 class="h3-redir">
                            Mobile number:
                            <p class="p-details">
                                <?php
                                echo  $_SESSION['donor_mobNum'];
                                ?>
                            </p>

                        </h3>
                        <h3 class="h3-redir">
                            Gender:
                            <p class="p-details">
                                <?php
                                echo  $_SESSION['donor_gender'];
                                ?>
                            </p>

                        </h3>
                        <h3 class="h3-redir">
                            Category:
                            <p class="p-details">
                                <?php
                                echo $_SESSION['donor_category'];
                                ?>
                            </p>

                        </h3>
                    </div>

                </div>

            </div>
            <div class="button-center-redir">
                <a href="./common_user_func/edit_donor_details.php" class="butn-a-redir"> <button class="butn-redir1"><i class="bi bi-pencil-square"></i> Edit</button></a>
                <a href="#deleteModal" class="trigger-btn butn-a-redir" data-toggle="modal"> <button class="butn-redir2"><i class="bi bi-trash3"></i> Delete</button></a>
            </div>
        </div>
    </div>

    <!-- delete modal for donor detaisl-->
    <?php
    include('common_user_func/delete_conf_modal.php');
    ?>


    <!-- Donoation related detals -->
    <div class="container-don-rel">
        <div class="card-don-rel">
            <h3 class="head-don-rel">Donation Related Details</h3>
            <div class="content-don-rel">
                <p class="sub-heading-don-rel">Update Your Latest Donation Details</p>
                <div class="h3-body-don-rel">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="input-box-reg">
                            <span class="details-reg">Hospital Name</span>
                            <input type="text" placeholder="Enter hospital name" name="donated_hospital" required>
                        </div>

                        <div class="input-box-reg">
                            <span class="details-reg">Donated Date</span>
                            <input type="date" placeholder="Choose date" name="donated_date" required>
                        </div>

                        <div class="input-box-reg">
                            <span class="details-reg">Certificate(Optional)</span>
                            <input type="file" class="file-input" placeholder="Browse image" name="donated_certificate" value="">
                        </div>


                        <div class="button-center-don-rel">
                            <a href="donor_details.php" class="butn-a-don-rel"> <button class="butn-don-rel1" name="donated_update"><i class="bi bi-pencil-square"></i> Update</button></a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <!-- Donation History -->
    <div class="container-don-rel">
        <div class="card-don-rel">
            <h3 class="head-don-rel">Donation History</h3>
            <div class="content-don-rel">
                <div class="h3-body-don-rel">
                    <?php

                    if ($rows_count < 1) { ?>
                        <h4 class="norecord-don-rel">No records found!</h4>
                    <?php
                    } else { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Hospital</th>
                                    <th>Certificate</th>
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($fetchData = mysqli_fetch_assoc($result)) : ?>

                                    <tr>
                                        <td><?php echo $fetchData['dona_date']; ?></td>
                                        <td> <?php echo $fetchData['dona_hospName']; ?></td>
                                        <td><a href='common_user_func\certif_show.php?certif=<?php echo $fetchData['dona_id']; ?>' target="_blank" class='butn-a-don-rel'> <button class='butn-don-rel1 fullscreen_toggle' name='view_certif'><i class='bi bi-arrows-fullscreen'></i> View Certificate</button></a></td>
                                        <td>
                                            <a href='common_user_func\edit_donation_details.php?edit=<?php echo $fetchData['dona_id']; ?>' class='butn-a-don-rel'><button class='butn-don-rel1 edit_toggle' name='donated_edit'><i class='bi bi-pencil-square'></i></button></a>
                                            <a href='common_user_func\delete_donation_details.php?delete=<?php echo $fetchData['dona_id']; ?>' class='butn-a-don-rel'><button class='butn-don-rel1 delete_toggle' name='donated_delete'><i class='bi bi-trash3'></i></button></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php } ?>


                </div>
            </div>

        </div>
    </div>

    <!-- footer -->
    <!-- <?php
            include('common_user_func/user_footer.php');
            ?> -->
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