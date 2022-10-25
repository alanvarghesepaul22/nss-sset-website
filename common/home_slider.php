<head>
    <link rel="stylesheet" href="./css/home_slider.css">
</head>
<body>
    <div class="rowContainer">
        <div class="slider">
            <div class="myslide fade">
                <div class="txt">
                    <h1>Not me, But you</h1>
                    <p>Unity<br>Unity is the secret of social progress, and Service to society is the means to promote it...</p>
                </div>
                <img src="./assets/slide_pic1.png" class="image-slide" style="width: 100%; height: 100%;">
            </div>

            <div class="myslide fade">
                <div class="txt">
                    <h1>IMAGE 2</h1>
                    <p>Web Devoloper<br>Subscribe To My Channel For More Videos</p>
                </div>
                <img src="./assets/slide_pic2.png" class="image-slide" style="width: 100%; height: 100%;">
            </div>

            <div class="myslide fade">
                <div class="txt">
                    <h1>IMAGE 3</h1>
                    <p>Web Devoloper<br>Subscribe To My Channel For More Videos</p>
                </div>
                <img src="./assets/slide_pic3.png" class="image-slide" style="width: 100%; height: 100%;">
            </div>

            <div class="myslide fade">
                <div class="txt">
                    <h1>IMAGE 4</h1>
                    <p>Web Devoloper<br>Subscribe To My Channel For More Videos</p>
                </div>
                <img src="./assets/slide_pic2.png" class="image-slide" style="width: 100%; height: 100%;">
            </div>

            <div class="myslide fade">
                <div class="txt">
                    <h1>IMAGE 5</h1>
                    <p>Web Devoloper<br>Subscribe To My Channel For More Videos</p>
                </div>
                <img src="./assets/slide_pic1.png" class="image-slide" style="width: 100%; height: 100%;">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <div class="dotsbox" style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
                <span class="dot" onclick="currentSlide(5)"></span>
            </div>
        </div>

        <?php
        include('announcement_area.php');
        ?>
    </div>



</body>

<script src="./js/home_slider.js"></script>