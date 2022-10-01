<!-- Validation alert block  -->
<?php
if (isset($_SESSION['status'])) { ?>
    <div class="alert <?php echo $_SESSION['status-mode']; ?>">
        <center>
            <?php
            echo $_SESSION['status'];
            ?>
        </center>
    </div>
<?php
}
unset($_SESSION['status']);
unset($_SESSION['status-mode']);
?>