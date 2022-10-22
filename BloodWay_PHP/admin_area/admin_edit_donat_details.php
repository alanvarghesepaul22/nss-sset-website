<?php
session_start();
include('../includes/connect.php');
$hospName = $date = $hospName = $upload_img = "";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $select_query = "SELECT * from donation_details where dona_id='$id'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    $fetch = mysqli_fetch_assoc($result);

    $donation_email = $fetch['dona_email'];

    $select_donor_query = "SELECT * from donor_details where donor_email='$donation_email'";
    $result_donor = mysqli_query($con, $select_donor_query);
    $fetchDonorData = mysqli_fetch_assoc($result_donor);

    $view_id = $fetchDonorData['donor_id'];


    $conf_email = $fetch['dona_email'];

    if ($rows_count == 1) {
        $hospName = $fetch['dona_hospName'];
        $date = $fetch['dona_date'];
        $certific = $fetch['dona_certif'];
        if (isset($_POST['donated_update'])) {
            $donated_hospital = test_input($_POST['donated_hospital']);
            $donated_date = test_input($_POST['donated_date']);

            $dateOfDonation = date($donated_date);
            $today = date("Y-m-d");

            if ($dateOfDonation > $today) {
                $_SESSION['status'] = "Given date is bigger than today's date";
                $_SESSION['status-mode'] = "alert-danger";
                header('location:admin_edit_donat_details.php?edit=' . $id);
                exit(0);
            } else {

                $donated_certificate = $_FILES['donated_certificate'];
                $imgname = $donated_certificate['name'];
                $imgtmpname = $donated_certificate['tmp_name'];

                $donated_hospital = $con->real_escape_string($donated_hospital);
                $donated_date = $con->real_escape_string($donated_date);

                $filenmesep = explode('.', $imgname);
                $fileext = strtolower(end($filenmesep));
                $extn = array('jpeg', 'jpg', 'png');
                if (in_array($fileext, $extn)) {
                    $upload_img = "../user_area/dona_certif_imgs/" . $imgname;
                    move_uploaded_file($imgtmpname, $upload_img);
                }
                $update_query = "UPDATE donation_details SET dona_hospName='$donated_hospital',dona_date='$donated_date',dona_certif='$upload_img' WHERE dona_id='$id' ";
                $sql_execute = mysqli_query($con, $update_query);

                if ($sql_execute) {

                    // here date stored in donation details db is accessed and max date is retrieved. 
                    $select_query = "SELECT * from donation_details where dona_email='$conf_email' and dona_date=(SELECT max(dona_date) from donation_details)";
                    $result = mysqli_query($con, $select_query);
                    $rows_count1 = mysqli_num_rows($result);
                    $fetchdata = mysqli_fetch_array($result);
                    if ($rows_count1) {
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
                        $donor_update_query = "UPDATE donor_details SET avail_status='$availStatus' , remDays='$remainDate' WHERE  donor_email='$conf_email'";
                        $update_sql_exec = mysqli_query($con, $donor_update_query);

                        if ($update_sql_exec) {
                            $_SESSION['status'] = "Details updated successfully!";
                            $_SESSION['status-mode'] = "alert-success";
                            header('location:view_donor_details.php?view_id=' . $view_id);
                            exit(0);
                        }
                    }
                } else {
                    $_SESSION['status'] = "Something Went Wrong!";
                    $_SESSION['status-mode'] = "alert-danger";
                    header('location:view_donor_details.php?view_id=' . $view_id);
                    exit(0);
                }
            }
        }
    }
} else {
    header('location:../user_area/common_user_func/error404.php');
}

?>

<head>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <meta charset="utf-8" />
    <title>BloodWay Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/alert_status.css" />
    <link rel="stylesheet" href="../css/donation_related_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Donoation related detals -->
    <div class="container-don-rel">

        <div class="card-don-rel">
            <i id="icon"></i>
            <?php
            include('../common_func/validation_alert_block.php');
            ?>
            <div class="content-don-rel">
            <h4 class="sect-title" >Update Donation Details</h4>
                <div class="h3-body-don-rel">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="input-box-reg">
                            <span class="details-reg">Hospital Name</span>
                            <input type="text" placeholder="Enter hospital name" name="donated_hospital" value="<?php echo $hospName ?>" required>
                        </div>

                        <div class="input-box-reg">
                            <span class="details-reg">Donated Date</span>
                            <input type="date" placeholder="Choose date" name="donated_date" value="<?php echo $date ?>" required>
                        </div>

                        <div class="input-box-reg">
                            <span class="details-reg">Certificate(Optional)</span>
                            <input type="file" class="file-input" name="donated_certificate" value="<?php echo $certific ?>">
                        </div>


                        <div class="button-center-don-rel">
                            <a href="#" class="butn-a-don-rel"> <button class="butn-don-rel1" name="donated_update"><i class="bi bi-pencil-square"></i> Update</button></a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</body>

<!-- dark theme js -->
<script src="../js/dark_theme.js"></script>

<script src="js/script.js"></script>