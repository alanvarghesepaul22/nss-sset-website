<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/nss_navbar.css" />
    <link rel="stylesheet" href="css/nss_contact.css" />
</head>


<body>
    <!-- NavBar -->
    <?php
    include('common/nss_navbar.php');
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
                <div class="topic-text">Get in touch</div>
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



    <!-- footer -->
    <?php
    include('common/nss_footer.php');
    ?>

</body>

</html>