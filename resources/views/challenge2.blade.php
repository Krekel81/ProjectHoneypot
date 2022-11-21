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
    <title>Honeypot - Group 3</title>
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

<main>
    <div id="landings">
        <div class="landingChallenge">
            <h1>Challenge 2</h1>
            <div id="landingChallengeContent">
                <div id="question">
                    <p>Thomas Anderson is the real name of which character in The Matrix?</p>
                    <form action="api/challenge2">
                    <input type="text" name="input">
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
        </div>
    </div>
</main>
</body>
</html>
