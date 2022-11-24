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
<html id="index" lang="en">
<head>
    <meta charset="UTF-8">
    <title>Honeypot - Group 23</title>
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
    <form method="get">
        <fieldset>
            <div>
                <label for="name">NAME</label>
                <input type="name" name="name" id="name" maxlength="10" required>
                <label for="password">PASSWORD</label>
                <input type="password" name="password" id="password" minlength="3" maxlength="15" required>
            </div>
            <button>LOGIN</button>
            <span><a href="register">No account yet? Register here</a></span>
        </fieldset>
    </form>

    <?php

        if(isset($_GET["name"]) && isset($_GET["password"]))
        {
            foreach ($users as $user) {
                $username = $user->name;
                $password = $user->password;
                if($_GET["name"] == $username)
                {
                    if(password_verify($_GET["password"], $password))
                    {
                        if($user->disabled)
                        {
                            echo "<p style='color:red;'>Your account is disabled!</p>";
                            exit();
                        }
                        echo "<p style='color:green;'>You are logged in</p>";
                        $_SESSION["username"] = $username;
                        $_SESSION["loggedIn"] = true;
                        $user->loggedIn = true;
                        $user->save();
                        header("Location: landing");
                        exit();
                    }
                    else {
                        echo "<p style='color:red;'>Your password is invalid</p>";
                        exit();
                    }
                }
            }
            echo "<p style='color:red;'>This account does not exist</p>";
        }

    ?>
</main>
</body>
<!-- https://www.ultimatequizquestions.com/matrix-quiz/ -->
</html>
