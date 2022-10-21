<?php
session_start();
include('../includes/connect.php');

if (!isset($_SESSION["user_email"])) {
  // when user is not logged in you cant search a donor
  // so redirecting to login page
  header('location:findaDonor_login_redirect.php');
}

if (isset($_SESSION["user_email"])) {
  $select_query = "SELECT * from donor_details";
  $result = mysqli_query($con, $select_query);
  $rows_count = mysqli_num_rows($result);

  $select_query_donation_details = "SELECT * from donation_details";
  $result_donation_details = mysqli_query($con, $select_query_donation_details);
  $rows_count_donation_details = mysqli_num_rows($result_donation_details);
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <meta charset="utf-8" />
  <title>Search for Donor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/style_signup.css" />
  <link rel="stylesheet" href="../css/fullbs5.css" />
  <link rel="stylesheet" href="../css/donor_search.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</head>

<body>
  <!-- NavBar -->
  <?php
  include('common_user_func/user_navbar.php');
  ?>

  <!-- searchbar -->
  <h3 class="mt-3 mx-3">
    <center>Search for donors here</center>
  </h3>

  <div class="container">
    <div class="row align-items-start mt-3 ">
      <div class="col">
        <label class="">Blood Group</label>
        <form action="" method="get">
          <select class="form-select" id="fetchBG" name="fetchBG">
            <option value="" disabled="" selected="">Select</option>
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
        </form>
      </div>

      <div class="col">
        <label class="">Distirct/Zone</label>
        <form action="" method="get">
          <select class="form-select" id="fetchZone" name="fetchZone">
            <option value="" disabled="" selected="">Select</option>
            <option value="Ernakulam">Ernakulam</option>
            <option value="Thrissur">Thrissur</option>
          </select>
        </form>
      </div>

      <div class="col">
        <label class="">Category</label>
        <form action="" method="get">
          <select class="form-select" id="fetchCateg" name="fetchCateg">
            <option value="" disabled="" selected="">Select</option>
            <option value="Nss Volunteer">Nss Volunteer</option>
            <option value="Student">Student</option>
            <option value="College Staff">College Staff</option>
            <option value="Other">Other</option>
          </select>
        </form>
      </div>

      <div class="mt-3 filter-btn">
        <button type="button" id="filter-btn" class="btn btn-dark btn-sm filt-btn"><i class="bi bi-funnel"></i> Filter</button>
      </div>

      <h6 class="mt-2">
        <center>--------------OR--------------</center>
      </h6>

      <div class="col searchbar">
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
    <?php
    $si_no = 1;
    ?>
    <div class="bgclass"> 
    <?php
    while ($fetchData = mysqli_fetch_assoc($result)) : ?>
      
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
              if ($rows_count_donation_details == 0) {
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
    </div>
  <?php } ?>

  <!-- footer -->
  <?php
  include('common_user_func/user_footer.php');
  ?>

</body>

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

    if (document.body.classList.contains("dark-theme")) {
      icon.src = "../images/sun.png";
    } else {
      icon.src = "../images/moon.png";
    }
  };

  let GetTheme = JSON.parse(localStorage.getItem("PageTheme"));
  console.log(GetTheme);

  if (GetTheme === "DARK") {
    document.body.classList = "dark-theme";
    icon.src = "../images/sun.png";
  }
</script>

<!-- jquery script for searchbar  -->
<script>
  $(document).ready(function() {
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#tab").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>

<!-- jquery for blood group dropdown -->

<script>
  $(document).ready(function() {
    $("#fetchBG").on('change', function() {
      var value1 = $(this).val();
      $.ajax({
        url: "external_php/dd_fetch.php",
        type: "POST",
        data: 'request1=' + value1,
        success: function(data) {
          $(".bgclass").html(data);
        }
      });
    });
  });
</script>

<!-- jquery for Zone/District dropdown -->

<script>
  $(document).ready(function() {
    $("#fetchZone").on('change', function() {
      var value2 = $(this).val();
      $.ajax({
        url: "external_php/dd_fetch.php",
        type: "POST",
        data: 'request2=' + value2,
        success: function(data) {
          $(".bgclass").html(data);
        }
      });
    });
  });
</script>

<!-- jquery for Zone/District dropdown -->

<script>
  $(document).ready(function() {
    $("#fetchCateg").on('change', function() {
      var value3 = $(this).val();
      $.ajax({
        url: "external_php/dd_fetch.php",
        type: "POST",
        data: 'request3=' + value3,
        success: function(data) {
          $(".bgclass").html(data);
        }
      });
    });
  });
</script>

<!-- filter button -->
<script>
  $(document).ready(function() {
    $("#filter-btn").click(function() {
      var fetchBG = $("#fetchBG").val();
      var fetchZone = $("#fetchZone").val();
      var fetchCateg = $("#fetchCateg").val();
      $.post("external_php/dd_fetch.php", {
          fetchBG: fetchBG,
          fetchZone: fetchZone,
          fetchCateg: fetchCateg
        },
        function(data, status) {
          if (data == "success") {
            $(".bgclass").html(data);
          } else {
            $(".bgclass").html(data);
          }
        });
    });
  });
</script>


</html>