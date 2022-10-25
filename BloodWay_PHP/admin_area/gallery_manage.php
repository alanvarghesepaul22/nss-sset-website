<?php
session_start();
include('../includes/connect.php');

if (isset($_POST['imgSubmit'])) {
    $imgTitle = test_input($_POST['imgTitle']);
    $imgDate = test_input($_POST['imgDate']);
    $imgAlbum = test_input($_POST['imgAlbum']);

    $dateOfEvent = date($imgDate);
    $today = date("Y-m-d");

    if ($dateOfEvent > $today) {
        $_SESSION['status'] = "Given date is bigger than today's date";
        $_SESSION['status-mode'] = "alert-danger";
        header('location:gallery_manage.php');
        exit(0);
    } else {
        $image = $_FILES['imgFile'];
        $imgnam = $image['name'];
        $imgTitle = $con->real_escape_string($imgTitle);
        $imgDate = $con->real_escape_string($imgDate);

        if ($imgnam != null) {
            $imgFile = $_FILES['imgFile'];
            $imgname = $imgFile['name'];
            $imgtmpname = $imgFile['tmp_name'];

            $filenmesep = explode('.', $imgname);
            $fileext = strtolower(end($filenmesep));
            $extn = array('jpeg', 'jpg', 'png');
            if (in_array($fileext, $extn)) {
                $upload_img = "../admin_area/gallery_assets/" . $imgname;
                move_uploaded_file($imgtmpname, $upload_img);
                $insert_query = "insert into gallery (imgId,imgTitle,imgDate,imgAlbum,imgFile) values ('$imgId','$imgTitle','$imgDate','$imgAlbum','$upload_img')";
                $sql_execute = mysqli_query($con, $insert_query);
            }
        } else {
            $upload_img = "";
            $insert_query = "insert into gallery (imgId,imgTitle,imgDate,imgAlbum,imgFile) values ('$imgId','$imgTitle','$imgDate','$imgAlbum','$upload_img')";
            $sql_execute = mysqli_query($con, $insert_query);
        }

        if ($sql_execute) {
            $_SESSION['status'] = "Image uploaded successfully!";
            $_SESSION['status-mode'] = "alert-success";
            header('location:gallery_manage.php');
            exit(0);
        } else {
            $_SESSION['status'] = "Something went wrong!";
            $_SESSION['status-mode'] = "alert-danger";
            header('location:gallery_manage.php');
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
                <input type="text" placeholder="Enter title" class="input-form" name="imgTitle">
                <label for="">Give the date of the event </label>
                <input type="date" placeholder="Enter date" class="input-form" name="imgDate">
                <label for="">Give an album name</label>
                <input type="text" placeholder="Album name" class="input-form" name="imgAlbum">
                <label for="">Choose the image to upload (.png, .jpg, .jpeg)</label>
                <input type="file" class="input-form file-input" name="imgFile">
                <input type="submit" value="Update" class="input-form btn-updt" name="imgSubmit" />
            </form>
        </div>
    </div>
</body>

<script src="../js/dark_theme.js"></script>

</html>