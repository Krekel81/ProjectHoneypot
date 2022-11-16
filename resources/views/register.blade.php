<!DOCTYPE html>
<html lang="en">
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
    <form method="get" action="landing">
        <fieldset>
            <div>
                <label for="email">E-MAIL</label>
                <input type="email" name="email" id="email">
                <label for="password">PASSWORD</label>
                <input type="password" name="password" id="password" min="8">
            </div>
            <button>REGISTER</button>
            <span><a href="index">Already have an account? Login here</a></span>
        </fieldset>
    </form>
</main>
<footer>
    <p> &copy; Made by Tibo Krekelbergh, Luca Desmet and Jens Delorge</p>
</footer>
</body>
</html>
