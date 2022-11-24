<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["loggedIn"]))
{
    /*
    if($_SESSION["loggedIn"])
    {
        header("Location: landing");
        exit();
    }
    */
}
if(isset($_SESSION["username"])) $_SESSION["username"] = "";
else $_SESSION["username"] = "";
$_SESSION["loggedIn"] = false;
?>
<html lang="en" id="register">
<head>
    <meta charset="UTF-8">
    <title>Honeypot - Group 3</title>
    <!-- Our Css -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/screen.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Our Scripts -->
    <script src="assets/js/run.js"></script>

</head>
<body>



<!-- partial:index.partial.html -->
<canvas id="canv" width="500" height="200"></canvas>
<!-- partial -->

<script src="assets/js/script.js"></script>



<header>
    <h1>The Matrix</h1>
</header>
<main>
    <form method="post" action="/api/user">
        <fieldset>
            <div>
                <label for="name">NAME</label>
                <input type="name" maxlength="10" name="name" id="name" required>
                <label for="password">PASSWORD</label>
                <input type="password" name="password" id="password" minlength="3" maxlength="15" required>
            </div>
            <button name="REGISTER" id="REGISTER">REGISTER</button>
            <span><a href="/">Already have an account? Login here</a></span>
        </fieldset>
    </form>
    <?php
        if(isset($_SESSION["registered"]))
        {
            if($_SESSION["registered"])
            {
                echo "<p style='color:red;'>User already registered!</p>";
                $_SESSION["registered"] = false;
            }
        }
        ?>
</main>

<footer>
    <p> &copy; Made by Tibo Krekelbergh, Luca Desmet and Jens Delorge</p>
</footer>
</body>
</html>
