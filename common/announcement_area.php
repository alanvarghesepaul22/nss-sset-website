<?php
include('common/connect.php');

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