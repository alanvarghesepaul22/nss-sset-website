<?php
include('./includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <meta charset="utf-8" />
  <title>BloodWay Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/style_signup.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>

  <!-- NavBar -->
  <?php
  include('common_func/navbar.php');
  ?>

  <!-- about us  -->
  <div class="section-abt">
    <div class="container-abt">
      <div class="content-section-abt">
        <div class="title-abt">
          <h1>About Us</h1>
        </div>
        <div class="content-abt">
          <h3>BloodWay E-Blood Bank Website</h3>
          <p>An initiative under the NSS Community of SCMS School of Engineering and Technology, Ernakulam.
            By motivating donors, we help people around Kerala who are in need of blood donors and platelet donors.
          </p>
          <div class="button-abt">
            <a href="https://www.scmsgroup.org/sset/nss">Read More</a>
          </div>
        </div>
        <div class="social-abt">
          <a href=""><i class="fab fa-facebook-f"></i></a>
          <a href=""><i class="fab fa-twitter"></i></a>
          <a href=""><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <div class="image-section-abt">
        <img class="img1-abt" src="images/logotransparent.png">
        <img class="img2-abt" src="images/nss logo.png">
      </div>
    </div>
  </div>

  <!-- footer -->

  <?php
  include('common_func/footer.php');
  ?>

</body>
<script src="js/dark_theme.js"></script>

</html>