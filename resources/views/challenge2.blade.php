<!DOCTYPE html>
<html id="landingChallenge" lang="en">
<head>
    <meta charset="UTF-8">
    <title>Honeypot - Group 23</title>
    <!-- Our Css -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/screen.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="https://fonts.cdnfonts.com/css/matrix" rel="stylesheet">
    <!-- Our Scripts -->
    <script src="assets/js/run.js"></script>
</head>
<body>
<!-- partial:index.partial.html -->
<canvas id="canv" width="500" height="200"></canvas>
<!-- partial -->

<script src="assets/js/script.js"></script>

<main id="c2">
    <div id="landings">
        <div class="landingChallenge">
            <h1>Challenge 2</h1>
            <div id="landingChallengeContent">
                <div id="question">
                    <p>Morpheus likes to quote quotes, find the right one he would say right now</p>
                    <form action="api/challenge2">
                    <input type="text" name="input">
                        <!-- Y2hlY2sgZm9yIEhhenoxNQ== | gK+GXSeG3Apd3KJbuoQx3KJ13mQx3lPr+dJs+8LWu=3c+=idu=eG3ApxqKJ1EKNxu=JSqKJ1+8w1XgNSudfb+Spx3dft+SpGqFPd34lsElPeqK+xEglMwdPP -->
                        <button>Submit</button>
                    </form>
                </div>
                <img src="assets/images/the_matrix1.jpg" alt="">
                <?php
                if(isset($_SESSION["challenge"]))
                {
                    if($_SESSION["challenge"] == "failed")
                    {
                        echo "<p class='challengeFailed'>Challenge 2 failed, try again</p>";
                        $_SESSION["challenge"] = "attempt";
                    }
                }
                ?>
            </div>
            <form action="landing">
                <button id="goBack">Go back</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>
