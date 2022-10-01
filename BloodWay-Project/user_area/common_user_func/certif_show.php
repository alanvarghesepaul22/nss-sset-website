<?php
include('../../includes/connect.php');
if (isset($_GET['certif'])) {
    $id = $_GET['certif'];
    $select_query = "Select * from donation_details where  dona_id='$id'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    $fetch = mysqli_fetch_assoc($result);
    if ($rows_count ==  1) {
        $certif_img = $fetch['dona_certif'];
    }
}else{
    header('location:error404.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Donoation Certificate</title>
    <style>
        :root {
            --dropdown-bg: #f9f9f9;
            --dropdown-text: black;
        }

        .dark-theme {
            --dropdown-bg: rgb(21, 32, 43);
            --dropdown-text: white;
        }

        body {
            padding: 200px;
            margin: 0;
            padding-top: 5px;
            padding-bottom: 15px;
            background-color: var(--dropdown-bg);
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
            width: 100%;
            height: auto;

        }

        .null-certifi-text {
            color: var(--dropdown-text);
            display: flex;
            justify-content: center;
            margin-top: 250px;
            font-size: 40px;
        }

        @media screen and (max-width: 1260px) {
            body {
                padding: 140px;
                padding-top: 5px;
                padding-bottom: 15px;
            }

            @media screen and (max-width: 990px) {
                body {
                    padding: 30px;
                    padding-top: 5px;
                    padding-bottom: 15px;
                }

                .null-certifi-text {
                    margin-top: 250px;
                    font-size: 25px;
                }

            }

            @media screen and (max-width: 540px) {
                body {
                    padding: 30px;
                    padding-top: 100px;
                    padding-bottom: 15px;
                }

                .null-certifi-text {
                    margin-top: 150px;
                    font-size: 25px;
                }
            }
        }
    </style>
</head>

<body>
    <h3><i class="zz" id="icon"></i></h3>
    <?php
    if ($certif_img != null) { ?>
        <img src="../<?php echo $certif_img ?>">
    <?php } else { ?>
        <h2 class="null-certifi-text">You have not uploaded any certificate!</h2>
    <?php } ?>
</body>

</html>

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

<script src="js/script.js"></script>