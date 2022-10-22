<?php
session_start();
include('../includes/connect.php');
$_SESSION['admin_username'];
$_SESSION['admin_email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery</title>
</head>

<body>
    <?php
    include('common_includes/admin_navbar.php');
    ?>
    <div class="galleryContainer">
        <div class="galleryHeading">
            <h2 class="titleGallery">Update Gallery</h2>
            <h3 class="titleGallery">Add images to the gallery</h3>
        </div>

        <div class="galleryBody">
            <form action="#" method="post">
                <label for="">Give an appropriate title for the event in the image</label>
                <input type="text" placeholder="Enter title" class="input-form">
                <label for="">Give the date of the event </label>
                <input type="date" placeholder="Enter date" class="input-form">
                <label for="">Give an album name</label>
                <input type="text" placeholder="Album name" class="input-form">
                <label for="">Choose the image to upload (.png, .jpg, .jpeg)</label>
                <input type="file" accept="image/x-png,image/jpg,image/jpeg" class="input-form file-input">
                <input type="submit" value="Update" class="input-form btn-updt" />
            </form>
        </div>
    </div>
</body>

<script src="../js/dark_theme.js"></script>

</html>