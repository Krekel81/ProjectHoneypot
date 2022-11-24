<?php
if(isset($_SESSION['loggedIn']))
{
    if(!($_SESSION["loggedIn"]) || $user->disabled)
    {
        header("Location: /");
        exit();
    }
}
else
{
    $_SESSION['loggedIn'] = false;
    header("Location: /");
    exit();
}
?>
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
    <script src="assets/js/uploadedfile.js"></script>
</head>
<body>
<!-- partial:index.partial.html -->
<canvas id="canv" width="500" height="200"></canvas>
<!-- partial -->

<script src="assets/js/script.js"></script>

<main id="c1">
    <div id="landings">
        <div class="landingChallenge">
            <h1>Challenge 1</h1>
            <div id="landingChallengeContent">
                <div id="question">
                    <p>Morpheus broke his important glasses.<br> He would like to have a new one made.</p>
                    <!-- TIP: You should really look at the details of the glasses -->
                    <form action="api/challenge1/">
                    <input type="text" name="input">
                        <button>Submit</button>
                    </form>
                </div>
                <img id="sunglasses" src="assets/images/sunglasses.png" alt="">
        <?php
        if(isset($_SESSION["challenge"]))
        {
            if($_SESSION["challenge"] == "failed")
            {
                echo "<p class='challengeFailed'>Challenge 1 failed, try again</p>";
                $_SESSION["challenge"] = "attempt";
            }
        }
        ?>
        </div>
        <form action="landing">
            <button id="go">Go back</button>
        </form>
        </div>
    </div>
</main>
</body>
</html>
