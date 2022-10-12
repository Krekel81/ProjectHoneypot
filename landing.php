<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PittaConnaisseurs</title>
    <!-- Our Css -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/screen.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Our Scripts -->
    <script src="assets/js/run.js"></script>
    
</head>
<body>



<!-- partial:index.partial.html -->
<canvas id="canv" width="500" height="200"></canvas>
<!-- partial -->
  
<script src="assets/js/script.js"></script>



<header>
    <h1>Pitta Connaisseurs Honeypot</h1>
</header>
<main>
    <div id="landing">
        <p>Are these your credentials?</p>
        <?php 
        $email = $_GET["email"];
        $password = $_GET["password"];
        echo "<p>Email: $email<br>Password: $password</p>";
        ?>
    </div>
</main>
<footer>
    <p> &copy; Made by the PittaConnaisseurs<br>Tibo Krekelbergh, Luca Desmet and Jens Delorge</p>
</footer>
</body>
</html>