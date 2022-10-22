<?php
session_start();
include('../includes/connect.php');

$select_query = "Select * from latest_news";
$result = mysqli_query($con, $select_query);
$rows_count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Latest News</title>
</head>

<body>
    <!-- NavBar -->
    <?php
    include('common_includes/admin_navbar.php');
    ?>
    <!-- contact us form -->

    <div class="galleryContainer">
        <div class="galleryHeading">
            <h2 class="titleGallery">Update Latest News</h2>
            <h3 class="titleGallery">Add latest news to the notification panel</h3>
        </div>

        <div class="galleryBody">
            <form action="#" method="post" id="submit-form">
                <label for="">News title</label>
                <input type="text" name="news_title"  class="input-form" placeholder="Enter title of the news" required>
                <label for="">Description & details</label>
                <textarea name="news_desc" id="" cols="30" rows="15" placeholder="Type description of the news" class="input-textarea"></textarea>
                <input type="submit" value="Update" class="btn-updt input-form" />
            </form>
        </div>
    </div>

</body>

<!-- dark theme -->
<script src="../js/dark_theme.js"></script>

</html>