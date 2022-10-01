<?php
session_start();
include('../includes/connect.php');
if (!isset($_SESSION['admin_email'])) {
    header('location:../user_area/common_user_func/error404.php');
}
$rows_count = null;

// if (isset($_SESSION['admin_username'])) {
$select_query = "SELECT * from user_details";
$result = mysqli_query($con, $select_query);
$rows_count = mysqli_num_rows($result);
// }
?>

<head>
    <link rel="stylesheet" href="../css/fullbs5.css">
    <link rel="stylesheet" href="../css/donor_search.css" />
    <link rel="stylesheet" href="../css/donor_details.css" />
    <link rel="stylesheet" href="../css/alert_status.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<!-- NavBar -->

<?php
include('common_includes/admin_navbar.php');
?>

<?php
include('../common_func/validation_alert_block.php');
?>


<!-- searchbar -->
<h3 class="mt-3 mx-3 page-title">
    <center>Search for Users here</center>
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
                    <th scope="col" id="respon-head">ID</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>

            <tbody id="tab">
                <?php
                $si_no = 1;
                while ($fetchData = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <th id="respon-body" scope="row"><?php echo $si_no; ?></th>
                        <td><span class="respon-td-title">ID: </span> <?php echo $fetchData['user_id']; ?></td>
                        <td><span class="respon-td-title">Name: </span> <?php echo $fetchData['user_name']; ?></td>
                        <td><span class="respon-td-title">Email: </span> <?php echo $fetchData['user_email']; ?></td>
                        <td>
                            <span class="respon-td-title">Status: </span>
                            <?php
                            $verif_status = $fetchData['verified'];
                            if ($verif_status == 1) {
                                echo  "<a href='#' class='btn btn-success btn-sm avail-btn'><i class='bi bi-check-circle'></i> Verified</a>";
                            } else {
                                echo "<a href='#' class='btn btn-danger btn-sm notavail-btn'><i class='bi bi-x-circle'></i> Unverified</a>";
                            }
                            ?>
                        </td>
                        <td>
                            <span class="respon-td-title">Delete: </span>
                            <div>
                                <!-- <a href='edit_user.php?edit=<?php echo $fetchData['user_id']; ?>' class='butn-a-don-rel'><button class='butn-don-rel1 edit_toggle' name='donated_edit'><i class='bi bi-pencil-square'></i></button></a> -->
                                <a href='delete_users.php?delete=<?php echo $fetchData['user_id']; ?>' class='butn-a-don-rel'><button class='butn-don-rel1 delete_toggle' name='donated_delete'><i class='bi bi-trash3'></i></button></a>
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

    };

    let GetTheme = JSON.parse(localStorage.getItem("PageTheme"));
    console.log(GetTheme);

    if (GetTheme === "DARK") {
        document.body.classList = "dark-theme";
        icon.src = "../images/sun.png";
    }
</script>