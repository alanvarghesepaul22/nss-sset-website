<?php
include('./includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <meta charset="utf-8" />
  <title>BloodWay Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>

  <!-- NavBar -->
  <?php
  include('common_func/navbar.php');
  ?>

  <!-- contact us form -->
  <div class="container-contact">
    <div class="content-contact">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Vidya Nagar, Palissery, Karukutty,</div>
          <div class="text-two">Ernakulam - 683 576</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+91 8547309440</div>
          <div class="text-two">+91 9946290608</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">nsssset182@gmail.com</div>
          <div class="text-two">sset@scmsgroup.org</div>
        </div>
      </div>

      <div class="right-side">
        <div class="topic-text">Send us a message</div>
        <p class="topic-subtext">
          We're here to help and answer any questions you might have.<br />If
          any, you can send us a message from here. <br />
          We look forward to hear from you.
        </p>
        <form id="submit-form" action="">
          <div class="input-box-contact">
            <input type="text" name="name" placeholder="Enter your name" required />
          </div>
          <div class="input-box-contact">
            <input type="email" name="email" placeholder="Enter your email" required />
          </div>
          <div class="input-box-contact message-box">
            <textarea name="message" id="" cols="30" rows="15" placeholder="Type your message here"></textarea>
          </div>
          <div class="button-contact">
            <input type="submit" value="Send Now" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- contact card -->
  <div class="container-cc">
    <div class="heading-cc">
      <h2>More Contacts</h2>
    </div>
    <div class="row-cc">
      <div class="card-cc">
        <div class="card-header">
          <img class="card-img" src="images/Sujay K pic.jpg" alt="Mr.Sujay K" />
        </div>
        <div class="card-body">
          <h1 class="card-title">Mr. Sujay K</h1>
          <p class="card-text">
            <strong> Programme Officer</strong>
          <p> NSS Unit No: 182, SSET </p>
          <div class="more">
            <p> Assistant Professor <br> Automobile Engineering Dept. <br><strong> Mob no:</strong>+91 8547309440 <br><strong> Email:</strong> sujay@scmsgroup.org</p>
          </div>
          <!-- </p> -->
          </p>
          <button class="btn-cc">Read more</button>
        </div>
      </div>
      <div class="card-cc">
        <div class="card-header">
          <img class="card-img" src="images/Rakesh A pic.jpg" alt="Mr. Rakesh A" />
        </div>
        <div class="card-body">
          <h1 class="card-title">Mr. Rakesh A</h1>
          <p class="card-text">
            <strong> Programme Officer</strong>
          <p> NSS Unit No: 584, SSET
          <div class="more">
            <p class="cont-person-detail"> Assistant Professor <br> Automobile Engineering Dept. <br><b> Mob no:</b>+91 9946290608 <br><b>Email:</b> rakesh@scmsgroup.org</p>
          </div>
          </p>
          </p>
          <button class="btn-cc">Read more</button>
        </div>
      </div>
      <div class="card-cc">
        <div class="card-header">
          <img class="card-img" src="images/Vinay P Mony pic.jpg" alt="Mr. Rakesh A" />
        </div>
        <div class="card-body">
          <h1 class="card-title">Mr. Vinay P Mony</h1>
          <p class="card-text">
            <strong> Thrissur Region Coordinator</strong>
          <p> NSS Unit, SSET
          <div class="more">
            <p> Volunteer/Student <br> Mechanical Engineering Dept. <br><b> Mob no:</b>+91 8078435549 <br><b>Email:</b> vinaymony1234@gmail.com</p>
          </div>
          </p>
          </p>
          <button class="btn-cc">Read more</button>
        </div>
      </div>
      <div class="card-cc">
        <div class="card-header">
          <img class="card-img" src="images/anoop francis pic.png" alt="Mr. Rakesh A" />
        </div>
        <div class="card-body">
          <h1 class="card-title">Mr. Anoop Francis</h1>
          <p class="card-text">
            <strong>Ernakulam Region Coordinator</strong>
          <p> NSS Unit, SSET
          <div class="more">
            <p> Volunteer/Student <br> Computer Science Engineering Dept. <br><b> Mob no:</b>+91 6282407722 <br> <b>Email: </b>anoopsunil05@gmail.com</p>
          </div>
          </p>
          </p>
          <button class="btn-cc">Read more</button>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->

  <?php
  include('common_func/footer.php');
  ?>

  <script src="js/readMore.js"></script>
  <script src="js/script.js"></script>
  <script src="js/dark_theme.js"></script>
</body>

</html>