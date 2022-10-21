<?php
include('../../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <meta charset="utf-8" />
    <title>Search for Donor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/fullbs5.css" />
    <link rel="stylesheet" href="../css/donor_search.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

</head>

<?php
if (isset($_POST['fetchZone'])) {
    if (isset($_POST['fetchBG']) && isset($_POST['fetchZone']) && isset($_POST['fetchCateg'])) {
        $request1 = $_POST['fetchBG'];
        $request2 = $_POST['fetchZone'];
        $request3 = $_POST['fetchCateg'];
        $query = "SELECT * 
        from donor_details 
        where donor_bgrp='$request1'and donor_zone='$request2'and donor_category='$request3'";
        $result = mysqli_query($con, $query);
        $rows_count = mysqli_num_rows($result);
?>
        <!-- table -->
        <?php
        if ($rows_count < 1) { ?>
            <h4 class="norecord-findon">
                <center>No records found!</center>
            </h4>
        <?php
        } else { ?>
            <?php
            $si_no = 1;
            while ($fetchData = mysqli_fetch_assoc($result)) :
                $dona_id = $fetchData['donor_id'];
                $select_query_dondet = "SELECT * from donation_details where dona_id='$dona_id'";
                $result_dondet = mysqli_query($con, $select_query_dondet);
                $rows_count_dondet = mysqli_num_rows($result_dondet);
            ?>
                <div class="tr" id="tab">
                    <div class="top-block">
                        <div class="tr-el si-el">
                            <div class="si-circle">
                                <p class="placehold">SI No</p>
                                <p class="value"><?php echo $si_no; ?></p>
                            </div>

                        </div>
                        <div class="tr-el name-el">
                            <p class="placehold">Full Name</p>
                            <p class="value"><?php echo $fetchData['donor_name']; ?></p>
                        </div>
                        <div class="tr-el bgrp-el">
                            <p class="placehold">Blood Group</p>
                            <p class="value"><?php echo $fetchData['donor_bgrp']; ?></p>
                        </div>
                    </div>

                    <div class="bott-block">
                        <div class="tr-el dist-el">
                            <p class="placehold">Distirct/Zone</p>
                            <p class="value"><?php echo $fetchData['donor_zone']; ?></p>
                        </div>
                        <div class="tr-el stat-el">
                            <p class="placehold">Status</p>
                            <?php
                            $avail_status = $fetchData['avail_status'];
                            $remain_days = $fetchData['remDays'];
                            if ($rows_count_dondet == 0) {
                                $avail_status = 1;
                                $remain_days = 0;
                            }
                            if ($avail_status == 1) {
                                echo  "<p class='btn btn-success btn-sm avail-btn'><i class='bi bi-check-circle'></i> Available</p>";
                            } else {
                                echo "<p class='btn btn-warning btn-sm notavail-btn'><i class='bi bi-hourglass-split'></i> in $remain_days days</p>";
                            }
                            ?>
                        </div>
                        <div class="tr-el contac-el">
                            <p class="placehold">Contact</p>
                            <a class="btn btn-primary btn-sm view-btn" data-bs-toggle="collapse" href="#<?php echo $fetchData['view_charid']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-eye-fill"></i> View</a>
                        </div>
                    </div>
                    <div class="collapse" id="<?php echo $fetchData['view_charid']; ?>">
                        <div class="tr-el collapser">
                            <div>
                                <p class="placehold">Mobile</p>
                                <p class="value"><?php echo $fetchData['donor_mobNum']; ?></p>
                            </div>
                            <div class="view-email">
                                <p class="placehold">Email</p>
                                <p class="value"><?php echo $fetchData['donor_email']; ?></p>
                            </div>

                        </div>
                    </div>
                </div>

            <?php $si_no++;
            endwhile; ?>
        <?php } ?>
<?php
    }
}
?>

<!-- For Blood group dropdown -->
<?php
if (isset($_POST['request1'])) {
    $request = $_POST['request1'];
    $query = "SELECT * from donor_details where donor_bgrp='$request'";
    $result = mysqli_query($con, $query);
    $rows_count = mysqli_num_rows($result);
?>
    <!-- table -->
    <?php
    if ($rows_count < 1) { ?>
        <h4 class="norecord-findon">
            <center>No records found!</center>
        </h4>
    <?php
    } else { ?>
        <?php
        $si_no = 1;
        while ($fetchData = mysqli_fetch_assoc($result)) :
            $dona_id = $fetchData['donor_id'];
            $select_query_dondet = "SELECT * from donation_details where dona_id='$dona_id'";
            $result_dondet = mysqli_query($con, $select_query_dondet);
            $rows_count_dondet = mysqli_num_rows($result_dondet);
        ?>
            <div class="tr" id="tab">
                <div class="top-block">
                    <div class="tr-el si-el">
                        <div class="si-circle">
                            <p class="placehold">SI No</p>
                            <p class="value"><?php echo $si_no; ?></p>
                        </div>

                    </div>
                    <div class="tr-el name-el">
                        <p class="placehold">Full Name</p>
                        <p class="value"><?php echo $fetchData['donor_name']; ?></p>
                    </div>
                    <div class="tr-el bgrp-el">
                        <p class="placehold">Blood Group</p>
                        <p class="value"><?php echo $fetchData['donor_bgrp']; ?></p>
                    </div>
                </div>

                <div class="bott-block">
                    <div class="tr-el dist-el">
                        <p class="placehold">Distirct/Zone</p>
                        <p class="value"><?php echo $fetchData['donor_zone']; ?></p>
                    </div>
                    <div class="tr-el stat-el">
                        <p class="placehold">Status</p>
                        <?php
                        $avail_status = $fetchData['avail_status'];
                        $remain_days = $fetchData['remDays'];
                        if ($rows_count_dondet == 0) {
                            $avail_status = 1;
                            $remain_days = 0;
                        }
                        if ($avail_status == 1) {
                            echo  "<p class='btn btn-success btn-sm avail-btn'><i class='bi bi-check-circle'></i> Available</p>";
                        } else {
                            echo "<p class='btn btn-warning btn-sm notavail-btn'><i class='bi bi-hourglass-split'></i> in $remain_days days</p>";
                        }
                        ?>
                    </div>
                    <div class="tr-el contac-el">
                        <p class="placehold">Contact</p>
                        <a class="btn btn-primary btn-sm view-btn" data-bs-toggle="collapse" href="#<?php echo $fetchData['view_charid']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-eye-fill"></i> View</a>
                    </div>
                </div>
                <div class="collapse" id="<?php echo $fetchData['view_charid']; ?>">
                    <div class="tr-el collapser">
                        <div>
                            <p class="placehold">Mobile</p>
                            <p class="value"><?php echo $fetchData['donor_mobNum']; ?></p>
                        </div>
                        <div class="view-email">
                            <p class="placehold">Email</p>
                            <p class="value"><?php echo $fetchData['donor_email']; ?></p>
                        </div>

                    </div>
                </div>
            </div>

        <?php $si_no++;
        endwhile; ?>
    <?php } ?>
<?php
}
?>

<!-- For Zone dropdown -->
<?php
if (isset($_POST['request2'])) {
    $request = $_POST['request2'];
    $query = "SELECT * from donor_details where donor_zone='$request'";
    $result = mysqli_query($con, $query);
    $rows_count = mysqli_num_rows($result);
?>
    <!-- table -->
    <?php
    if ($rows_count < 1) { ?>
        <h4 class="norecord-findon">
            <center>No records found!</center>
        </h4>
    <?php
    } else { ?>
        <?php
        $si_no = 1;
        while ($fetchData = mysqli_fetch_assoc($result)) :

            $dona_id = $fetchData['donor_id'];
            $select_query_dondet = "SELECT * from donation_details where dona_id='$dona_id'";
            $result_dondet = mysqli_query($con, $select_query_dondet);
            $rows_count_dondet = mysqli_num_rows($result_dondet);
        ?>
            <div class="tr" id="tab">
                <div class="top-block">
                    <div class="tr-el si-el">
                        <div class="si-circle">
                            <p class="placehold">SI No</p>
                            <p class="value"><?php echo $si_no; ?></p>
                        </div>

                    </div>
                    <div class="tr-el name-el">
                        <p class="placehold">Full Name</p>
                        <p class="value"><?php echo $fetchData['donor_name']; ?></p>
                    </div>
                    <div class="tr-el bgrp-el">
                        <p class="placehold">Blood Group</p>
                        <p class="value"><?php echo $fetchData['donor_bgrp']; ?></p>
                    </div>
                </div>

                <div class="bott-block">
                    <div class="tr-el dist-el">
                        <p class="placehold">Distirct/Zone</p>
                        <p class="value"><?php echo $fetchData['donor_zone']; ?></p>
                    </div>
                    <div class="tr-el stat-el">
                        <p class="placehold">Status</p>
                        <?php
                        $avail_status = $fetchData['avail_status'];
                        $remain_days = $fetchData['remDays'];
                        if ($rows_count_dondet == 0) {
                            $avail_status = 1;
                            $remain_days = 0;
                        }
                        if ($avail_status == 1) {
                            echo  "<p class='btn btn-success btn-sm avail-btn'><i class='bi bi-check-circle'></i> Available</p>";
                        } else {
                            echo "<p class='btn btn-warning btn-sm notavail-btn'><i class='bi bi-hourglass-split'></i> in $remain_days days</p>";
                        }
                        ?>
                    </div>
                    <div class="tr-el contac-el">
                        <p class="placehold">Contact</p>
                        <a class="btn btn-primary btn-sm view-btn" data-bs-toggle="collapse" href="#<?php echo $fetchData['view_charid']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-eye-fill"></i> View</a>
                    </div>
                </div>
                <div class="collapse" id="<?php echo $fetchData['view_charid']; ?>">
                    <div class="tr-el collapser">
                        <div>
                            <p class="placehold">Mobile</p>
                            <p class="value"><?php echo $fetchData['donor_mobNum']; ?></p>
                        </div>
                        <div class="view-email">
                            <p class="placehold">Email</p>
                            <p class="value"><?php echo $fetchData['donor_email']; ?></p>
                        </div>

                    </div>
                </div>
            </div>

        <?php $si_no++;
        endwhile; ?>
    <?php } ?>
<?php
}
?>

<!-- For Category dropdown -->
<?php
if (isset($_POST['request3'])) {
    $request = $_POST['request3'];
    $query = "SELECT * from donor_details where donor_category='$request'";
    $result = mysqli_query($con, $query);
    $rows_count = mysqli_num_rows($result);
?>
    <!-- table -->
    <?php
    if ($rows_count < 1) { ?>
        <h4 class="norecord-findon">
            <center>No records found!</center>
        </h4>
    <?php
    } else { ?>
        <?php
        $si_no = 1;
        while ($fetchData = mysqli_fetch_assoc($result)) :
            $dona_id = $fetchData['donor_id'];
            $select_query_dondet = "SELECT * from donation_details where dona_id='$dona_id'";
            $result_dondet = mysqli_query($con, $select_query_dondet);
            $rows_count_dondet = mysqli_num_rows($result_dondet);
        ?>
            <div class="tr" id="tab">
                <div class="top-block">
                    <div class="tr-el si-el">
                        <div class="si-circle">
                            <p class="placehold">SI No</p>
                            <p class="value"><?php echo $si_no; ?></p>
                        </div>

                    </div>
                    <div class="tr-el name-el">
                        <p class="placehold">Full Name</p>
                        <p class="value"><?php echo $fetchData['donor_name']; ?></p>
                    </div>
                    <div class="tr-el bgrp-el">
                        <p class="placehold">Blood Group</p>
                        <p class="value"><?php echo $fetchData['donor_bgrp']; ?></p>
                    </div>
                </div>

                <div class="bott-block">
                    <div class="tr-el dist-el">
                        <p class="placehold">Distirct/Zone</p>
                        <p class="value"><?php echo $fetchData['donor_zone']; ?></p>
                    </div>
                    <div class="tr-el stat-el">
                        <p class="placehold">Status</p>
                        <?php
                        $avail_status = $fetchData['avail_status'];
                        $remain_days = $fetchData['remDays'];
                        if ($rows_count_dondet == 0) {
                            $avail_status = 1;
                            $remain_days = 0;
                        }
                        if ($avail_status == 1) {
                            echo  "<p class='btn btn-success btn-sm avail-btn'><i class='bi bi-check-circle'></i> Available</p>";
                        } else {
                            echo "<p class='btn btn-warning btn-sm notavail-btn'><i class='bi bi-hourglass-split'></i> in $remain_days days</p>";
                        }
                        ?>
                    </div>
                    <div class="tr-el contac-el">
                        <p class="placehold">Contact</p>
                        <a class="btn btn-primary btn-sm view-btn" data-bs-toggle="collapse" href="#<?php echo $fetchData['view_charid']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-eye-fill"></i> View</a>
                    </div>
                </div>
                <div class="collapse" id="<?php echo $fetchData['view_charid']; ?>">
                    <div class="tr-el collapser">
                        <div>
                            <p class="placehold">Mobile</p>
                            <p class="value"><?php echo $fetchData['donor_mobNum']; ?></p>
                        </div>
                        <div class="view-email">
                            <p class="placehold">Email</p>
                            <p class="value"><?php echo $fetchData['donor_email']; ?></p>
                        </div>

                    </div>
                </div>
            </div>

        <?php $si_no++;
        endwhile; ?>
    <?php } ?>
<?php
}
?>