<!DOCTYPE html>
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
    <script src="assets/js/checkIfLoggedOut.js"></script>
</head>
<body>
<!-- partial:index.partial.html -->
<canvas id="canv" width="500" height="200"></canvas>
<!-- partial -->
<script src="assets/js/script.js"></script>

<main id="message">
    <h1>{{ $message }}</h1>
    <form action="/profile">
    <button type="submit">Go back</button>
    </form>
</main>
</body>
</html>
