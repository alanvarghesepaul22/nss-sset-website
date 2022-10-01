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
    <!-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

    * {
        padding: 0;
        margin: 0;
        text-decoration: none;
        list-style: none;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    :root {
        --primary-color: #ffffff;
        --secondary-color: #1c1d25;
        --nav-element: rgb(35, 36, 53);
        --nav-element-hover: #1264e3;
        --navbar-shadow: rgb(206, 207, 207);
        --ham-menu-body-color: #c6e1f5;
        --leftside-text-cform: #49494e;
        --leftside-topic-cform: #000000;
        --rightside-topic-subtext-cform: #000000;
        --textfield-bg-cform: rgb(230, 229, 229);
        --ham-menu-button: rgb(18, 32, 48);
        --black-text: black;
        --white-text: white;
        --text-grayToWhite: #5d5d5d;
    }

    .dark-theme {
        transition: all 0.3s;
        --primary-color: rgb(21, 32, 43);
        --secondary-color: hsl(0, 0%, 100%);
        --nav-element: rgb(255, 255, 255);
        --nav-element-hover: #1264e3;
        --navbar-shadow: #1d1c1c;
        --ham-menu-body-color: #04243d;
        --leftside-text-cform: #ffffff;
        --leftside-topic-cform: #1264e3;
        --rightside-topic-subtext-cform: #ffffff;
        --textfield-bg-cform: rgb(16, 24, 32);
        --ham-menu-button: rgb(184, 201, 218);
        --black-text: white;
        --white-text: black;
        --text-grayToWhite: #3582f5;
    }

    /* contact us form */

    .container {
        margin-top: 30px;
    }

    .right-side .topic-text {
        font-size: 21px;
        font-weight: 600;
        color: var(--black-text);
    }

    .right-side .input-box-contact {
        height: 50px;
        width: 100%;
        margin: 12px 0;
    }

    .right-side .input-box-contact input,
    .right-side .input-box-contact textarea {
        height: 100%;
        width: 100%;
        border: none;
        color: var(--black-text);
        outline: none;
        font-size: 16px;
        background: var(--textfield-bg-cform);
        border-radius: 6px;
        padding: 0 15px;
        resize: none;
    }

    .right-side .message-box {
        min-height: 110px;
    }

    .right-side .input-box-contact textarea {
        padding-top: 6px;
    }

    .right-side .button-contact {
        display: inline-block;
        margin-top: 20px;
    }

    .button-contact input {
        color: #ffffff;
        font-size: 15px;
        outline: none;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        background: #265df2;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .button-contact :hover {
        background: #1940ac;
    }


    @media (max-width: 820px) {
        .content-contact .right-side {
            width: 100%;
            margin-left: 0;
        }
    }

    @media (max-width: 560px) {
        .content-contact {
            margin-left: 24px;
            margin-right: 24px;
        }
    }
</style>

<body>
    <!-- NavBar -->
    <?php
    include('common_includes/admin_navbar.php');
    ?>
    <!-- contact us form -->
    <div class="container">
        <div class="content-contact">
            <div class="right-side">
                <h2 class="topic-text">Update Latest News </h2>
                <form id="submit-form" action="">
                    <div class="input-box-contact">
                        <input type="text" name="news_title" placeholder="Enter title of the news" required />
                    </div>
                    <div class="input-box-contact">
                        <input type="date" name="news_date" required />
                    </div>
                    <div class="input-box-contact message-box">
                        <textarea name="news_desc" id="" cols="30" rows="15" placeholder="Type description of the news"></textarea>
                    </div>
                    <div class="button-contact">
                        <input type="submit" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<!-- dark theme -->
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

</html>