<?php
session_start();
include('../includes/connect.php');
if (!isset($_SESSION['admin_email'])) {
    header('location:../user_area/common_user_func/error404.php');
}
$rows_count = null;

// if (isset($_SESSION['admin_username'])) {
$select_query = "SELECT * from donor_details";
$result = mysqli_query($con, $select_query);
$rows_count = mysqli_num_rows($result);
// }

$select_query_donation_details = "SELECT * from donation_details";
$result_donation_details = mysqli_query($con, $select_query_donation_details);
$rows_count_donation_details = mysqli_num_rows($result_donation_details);
?>

<head>
    <title>Manage Donor</title>

    <link rel="stylesheet" href="../css/donor_search.css" />
    <link rel="stylesheet" href="../css/donor_details.css" />
    <link rel="stylesheet" href="../css/fullbs5.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

</head>
<!-- NavBar -->

<?php
include('common_includes/admin_navbar.php');
?>

<!-- searchbar -->
<h3 class="mt-3 mx-3 page-title">
    <center>Search for Donors here</center>
</h3>

<div class="container">
    <div class="row align-items-start mt-3 ">

        <div class="col">
            <input id="search" type="text" class="form-control" placeholder="Search for Id, Name, Email...." data-tables="donors-list">
        </div>

    </div>
</div>

<!-- table -->
<?php
if ($rows_count < 1) { ?>
    <h4 class="norecord-findon">No records found!</h4>
<?php
} else { ?>
    <div class="container ">
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">SI No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Blood Group</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Status</th>
                    <th scope="col">Other Details</th>
                    <th scope="col">Edit/Delete</th>
                </tr>
            </thead>

            <tbody id="tab">
                <?php
                $si_no = 1;
                while ($fetchData = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td scope="row"><span class="respon-td-title">SI No: </span> <?php echo $si_no; ?></td>
                        <td><span class="respon-td-title">Name: </span> <?php echo $fetchData['donor_name']; ?></td>
                        <td><span class="respon-td-title">Blood Group: </span> <?php echo $fetchData['donor_bgrp']; ?></td>
                        <td><span class="respon-td-title">Gender: </span> <?php echo $fetchData['donor_gender']; ?></td>
                        <td>
                            <span class="respon-td-title">Status: </span>
                            <?php
                            $avail_status = $fetchData['avail_status'];
                            $remain_days = $fetchData['remDays'];
                            if ($rows_count_donation_details == 0) {
                                $avail_status = 1;
                                $remain_days = 0;
                            }
                            if ($avail_status == 1) {
                                echo  "<p class='btn btn-success btn-sm avail-btn'><i class='bi bi-check-circle'></i> Available Now</p>";
                            } else {
                                echo "<p class='btn btn-warning btn-sm notavail-btn'><i class='bi bi-hourglass-split'></i> in $remain_days days</p>";
                            }
                            ?>
                        </td>

                        <td>
                            <span class="respon-td-title">All Details </span>
                            <a class="btn btn-primary btn-sm view-btn" href="view_donor_details.php?view_id=<?php echo $fetchData['donor_id']; ?>" role="button"><i class="bi bi-eye-fill"></i> View</a>
                        </td>

                        <td>
                            <span class="respon-td-title">Delete/Edit: </span>
                            <div>
                                <a href='admin_edit_donor.php?edit=<?php echo $fetchData['donor_id']; ?>' class='butn-a-don-rel'><button class='butn-don-rel1 edit_toggle' name='donated_edit'><i class='bi bi-pencil-square'></i></button></a>
                                <a href='admin_delete_donor.php?delete=<?php echo $fetchData['donor_id']; ?>' class='butn-a-don-rel'><button class='butn-don-rel1 delete_toggle' name='donated_delete'><i class='bi bi-trash3'></i></button></a>
                            </div>

                        </td>


                    </tr>
                <?php $si_no++;
                endwhile; ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<!-- jquery script for searchbar  -->
<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tab tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<!-- Dark theme -->
<script src="../js/dark_theme.js"></script>