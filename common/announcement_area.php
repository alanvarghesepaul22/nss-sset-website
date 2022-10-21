<?php
include('../BloodWay_PHP/includes/connect.php');

$select_query = "Select * from latest_news";
$result = mysqli_query($con, $select_query);
$rows_count = mysqli_num_rows($result);
?>
<style>
    * {
        padding: 0;
        margin: 0;
        text-decoration: none;
        list-style: none;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }


    .ann-content-body {
        max-height: 430px;
        background-color: rgb(13, 9, 51);
        overflow-y: scroll;
    }

    .ann-content-body::-webkit-scrollbar {
        display: none;
    }

    .ann-sect {
        width: 370px;
        height: 430px;
        background-color: rgb(13, 9, 51);
        float: right;
        margin-top: 20px;
        font-size: large;
        margin-right: 20px;
    }

    .ann-head {
        width: auto;
        height: 40px;
        padding-top: 8px;
        margin: 10px;
        /* From https://css.glass */
        background: rgba(255, 255, 255, 0.28);
        border-radius: 2px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(7.8px);
        -webkit-backdrop-filter: blur(7.8px);
        border: 1px solid rgba(255, 255, 255, 0.17);
    }

    .ann-head p {
        color: white;
        font-weight: 500;
        text-align: center;
    }

    .ann-content {
        margin: 10px;
        /* From https://css.glass */
        background: rgba(255, 255, 255, 0.28);
        border-radius: 2px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(7.8px);
        -webkit-backdrop-filter: blur(7.8px);
        border: 1px solid rgba(255, 255, 255, 0.17);
        display: flex;
    }

    .ann-date {
        background-color: white;
        color: rgb(13, 9, 51);
        width: 70px;
        padding: 10px;
        padding-top: 20px;
        text-align: center;
    }

    .ann-desc-matter {
        padding: 10px;
        font-size: 13px;
        color: white;
    }

    .ann-desc-title {
        padding: 5px;
        font-size: 13px;
        color: white;
        text-align: center;
        font-weight: 600;
    }

    .ann-desc-title {
        background-color: rgb(240, 59, 59);
        font-size: 15px;
    }

    .ann-date-day {
        font-weight: 700;
    }

    .ann-date-month {
        font-weight: 700;
    }
</style>
<div class="ann-sect">
    <div class="ann-head">
        <p>Latest News & Notifications</p>
    </div>
    <div class="ann-content-body">
        <?php
        while ($fetchData = mysqli_fetch_assoc($result)) : ?>
            <div class="ann-content">
                <div class="ann-date">
                    <p class="ann-date-month"><?php echo $fetchData['news_date'] . " " . $fetchData['news_month']; ?></p>
                </div>
                <div class="ann-desc">
                    <p class="ann-desc-title"><?php echo $fetchData['news_title']; ?></p>
                    <p class="ann-desc-matter"><?php echo $fetchData['news_desc']; ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</div>