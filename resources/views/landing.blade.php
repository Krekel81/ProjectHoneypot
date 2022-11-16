<!DOCTYPE html>
<?php session_start();
if(!($_SESSION["loggedIn"]))
{
    header("Location: index");
    exit();
}
    ?>
<html id="landingPage" lang="en">
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
    <script src="assets/js/redirect.js"></script>
</head>
<body>
<!-- partial:index.partial.html -->
<canvas id="canv" width="500" height="200"></canvas>
<!-- partial -->

<script src="assets/js/script.js"></script>

<main>
    <div id="landings">
        <div id="landing1">
            <ul id="challengeList">
                <li><button>Challenge 1</button></li>
                <li><button>Challenge 2</button></li>
                <li><button>Challenge 3</button></li>
                <li><button>Challenge 4</button></li>
                <li><button>Challenge 5</button></li>
            </ul>
        </div>
        <div id="landing2">
            <div id="landingDiv">
                <h2>Welcome {<?php echo $_SESSION["username"]; ?>}</h2>
                <div id="landingDivContent2">
                    <div id="avatarDiv">
                        <img id="avatar" src="assets/images/hacker.png" alt="" srcset="">
                    </div>
                    <label for="files">Select Image</label>
                    <input id="files" style="visibility:hidden;" type="file">
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
