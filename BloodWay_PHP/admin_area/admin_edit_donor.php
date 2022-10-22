<?php
include('../includes/connect.php');
$donor_name = $donor_email = $donor_dob = $donor_age = $donor_mobnum = $donor_zone = "";
$donor_bgrp = $donor_weight = $donor_gender = $donor_category = "";
$flag = true;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select_query = "Select * from donor_details where  donor_id ='$id'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    $fetch = mysqli_fetch_array($result);

    $conf_email = $fetch['donor_email'];
    $name = $fetch['donor_name'];
    $name = $fetch['donor_name'];
    $dob = $fetch['donor_dob'];
    $mobn = $fetch['donor_mobNum'];
    $zone = $fetch['donor_zone'];
    $bgrp = $fetch['donor_bgrp'];
    $gen = $fetch['donor_gender'];
    $weit = $fetch['donor_weight'];
    $categ = $fetch['donor_category'];

    if (isset($_POST['donor_dob'])) {
        $donor_dob = test_input($_POST['donor_dob']);
        $age = getAge($donor_dob);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $donor_name = test_input($_POST['donor_name']);
        $donor_dob = test_input($_POST['donor_dob']);
        $donor_age = $age;
        $donor_mobnum = test_input($_POST['donor_mobnum']);
        $donor_zone = test_input($_POST['donor_zone']);
        $donor_bgrp = test_input($_POST['donor_bgrp']);
        $donor_weight = test_input($_POST['donor_weight']);
        $donor_gender = test_input($_POST['donor_gender']);
        $donor_category = test_input($_POST['donor_category']);

        // input validation
        $donor_mobnu = strlen($_POST["donor_mobnum"]);
        $length = strlen($donor_mobnu);
        // name error
        if (!preg_match("/^[a-zA-Z-' ]*$/", $donor_name)) {
            $flag = false;
            $_SESSION['status'] = "Only alphabets and whitespace are allowed.";
            $_SESSION['status-mode'] = "alert-danger";
            header('location:admin_edit_donor.php?edit=' . $id);
            exit(0);
        } else if (!preg_match('/^[0-9]{10}+$/', $donor_mobnum)) {
            $flag = false;
            $_SESSION['status'] = "Invalid mobile number.";
            $_SESSION['status-mode'] = "alert-danger";
            header('location:admin_edit_donor.php?edit=' . $id);
            exit(0);
        } else if ($donor_weight < 55) {
            $flag = false;
            $_SESSION['status'] = "Weight must be above 55kg";
            $_SESSION['status-mode'] = "alert-danger";
            header('location:admin_edit_donor.php?edit=' . $id);
            exit(0);
        } else if ($donor_age < 18 || $donor_age > 60) {
            $flag = false;
            $_SESSION['status'] = "Age must be between 18 and 60.";
            $_SESSION['status-mode'] = "alert-danger";
            header('location:admin_edit_donor.php?edit=' . $id);
            exit(0);
        } else {
            $flag = true;
        }

        if ($flag) {
            //select query
            $select_query = "SELECT * from donor_details where donor_email='$conf_email'";
            $result = mysqli_query($con, $select_query);
            $rows_count = mysqli_num_rows($result);

            if ($rows_count > 0) {
                // sanitzing data
                $donor_name = $con->real_escape_string($donor_name);
                $donor_dob = $con->real_escape_string($donor_dob);
                $donor_age = $con->real_escape_string($donor_age);
                $donor_zone = $con->real_escape_string($donor_zone);
                $donor_bgrp = $con->real_escape_string($donor_bgrp);
                $donor_weight = $con->real_escape_string($donor_weight);
                $donor_gender = $con->real_escape_string($donor_gender);
                $donor_category = $con->real_escape_string($donor_category);
                //insert query

                $update_query = "UPDATE donor_details SET donor_name='$donor_name', donor_dob='$donor_dob', donor_age='$donor_age', donor_mobNum='$donor_mobnum', donor_zone='$donor_zone', donor_bgrp='$donor_bgrp', donor_gender='$donor_gender', donor_weight='$donor_weight', donor_category='$donor_category' WHERE  donor_email ='$conf_email'";
                $sql_execute = mysqli_query($con, $update_query);
                if ($sql_execute) {
                    $_SESSION['status'] = "Details updated Successfully!";
                    $_SESSION['status-mode'] = "alert-success";
                    header('location:admin_edit_donor.php?edit=' . $id);
                    exit(0);
                } else {
                    $_SESSION['status'] = "Something went wrong!";
                    $_SESSION['status-mode'] = "alert-danger";
                    header('location:admin_edit_donor.php?edit=' . $id);
                    exit(0);
                }
            }
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

function getAge($dob)
{
    $bday = new DateTime($dob);
    $today = new DateTime(date('m.d.y'));
    if ($bday > $today) {
        return 0;
    }
    $diff = $today->diff($bday);
    return $diff->y;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/donation_related_details.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/edit_details.css" />
    <link rel="stylesheet" href="../css/alert_status.css" />
    <title>Document</title>
</head>

<body>

    <div class="container-don-rel">
        <div class="card-don-rel">
            <i class="bi" id="icon"></i>
            <div class="content-don-rel">
                <h4 class="sect-title">Update Donor Details</h4>

                <?php
                include('../common_func/validation_alert_block.php');
                ?>

                <div class="h3-body-don-rel">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="user-details-reg">
                            <div class="input-box-reg">
                                <span class="details-reg">Full Name</span>
                                <input type="text" placeholder="Enter your name" value="<?php echo $name ?>" name="donor_name" required>
                            </div>

                            <div class="input-box-reg">
                                <span class="details-reg">Phone Number</span>
                                <input type="text" placeholder="Enter your number" value="<?php echo $mobn ?>" name="donor_mobnum" required>
                            </div>

                            <div class="input-box-reg">
                                <span class="details-reg">Date of Birth</span>
                                <input type="date" value="<?php echo $dob ?>" name="donor_dob" required>
                            </div>

                            <div class="input-box-reg">
                                <span class="details-reg">District/Zone</span>
                                <select name="donor_zone" id="zone-dist" name="donor_zone" required>
                                    <option value="<?php echo $zone ?>" selected><?php echo $zone ?></option>
                                    <option value="Ernakulam">Ernakulam</option>
                                    <option value="Thrissur">Thrissur</option>
                                </select>
                            </div>
                            <div class="input-box-reg">
                                <span class="details-reg">Blood Group</span>
                                <select name="donor_bgrp" id="blood-grp" required>
                                    <option value="<?php echo $bgrp ?>" selected><?php echo $bgrp ?></option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="Bombay blood group">Bombay blood group</option>
                                </select>
                            </div>


                            <div class="input-box-reg">
                                <span class="details-reg">Gender</span>
                                <select name="donor_gender" id="zone-dist" name="donor_zone" required>
                                    <option value="<?php echo $gen ?>" selected><?php echo $gen ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="input-box-reg">
                                <span class="details-reg">Category</span>
                                <select name="donor_category" id="don_cat" required>
                                    <option value="<?php echo $categ ?>" selected><?php echo $categ ?></option>
                                    <option value="Nss Volunteer">Nss Volunteer</option>
                                    <option value="Student">Student</option>
                                    <option value="College Staff">College Staff</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="input-box-reg">
                                <span class="details-reg">Weight</span>
                                <input type="number" placeholder="Enter your weight" value="<?php echo $weit ?>" name="donor_weight" required>
                            </div>

                        </div>

                        <div class="button-reg">
                            <input type="submit" value="Update" name="donor_reg">
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

</body>
<script src="../js/dark_theme.js"></script>
<script src="js/script.js"></script>
</html>