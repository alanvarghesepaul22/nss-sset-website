<?php
session_start();
include('./includes/connect.php');
?>

<header>
    <nav>

        <a id="logo-a-tag" href="index.php">
            <img id="logo-home" src="images/logotransparent.png" alt="" />
        </a>
        <div class="nav-drkbtn-ul">

            <img src="images/moon.png" id="icon" alt="dark mode" data-toggle="tooltip" title="Dark Mode" />
            <input type="checkbox" id="check" />
            <label for="check" class="checkbtn">
                <i id="ham-menu-icon" class="fas fa-bars"></i>
            </label>
            <ul class="nav-ul">
                <li><a class="nav-item" href="index.php">Home</a></li>
                <li><a class="nav-item" href="user_area/reg_form.php">Be A Donor</a></li>
                <li><a class="nav-item" href="user_area/findADonor.php">Find A Donor</a></li>

                <li>
                    <a class="nav-item" href="#">More <i class="fas fa-caret-down"></i></a>
                    <ul>
                        <li><a class="nav-item" href="contact_us.php">Contact</a></li>
                        <li><a class="nav-item" href="aboutUs.php">About Us</a></li>
                    </ul>
                </li>
                <?php
                if (!isset($_SESSION['user_name'])) {
                    echo  "<li><a href='user_area/user_login.php'>Login</a></li>";
                } else {
                    // logout button
                    include('user_button_home.php');
                }
                ?>
            </ul>

        </div>

    </nav>
</header>

<script src="./js/activeMenu.js"></script>