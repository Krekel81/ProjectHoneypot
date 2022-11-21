<?php
if(isset($_SESSION['loggedIn']))
{
    if(!($_SESSION["loggedIn"]))
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
<html id="admin" lang="en">
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
        <div class="adminPanel">
            <h1>Admin panel | {<?php echo $_SESSION["username"]; ?>}</h1>
            <p></p>
            <div id="adminContent">
                <div id="adminTableUsersDiv">
                    <table id="adminTableUsers">
                        <tr>
                            <th>Username</th>
                            <th>Challenge1</th>
                            <th>Challenge2</th>
                            <th>Challenge3</th>
                            <th>Challenge4</th>
                            <th>Challenge5</th>
                        </tr>
                        @foreach ($users as $user)

                        <tr>
                            <td>{{ $user->name }}</td>
                            <td><?php echo $user->challenge2 ? "<p>C</p>" : "<p style='color:red;'>NC</p>"; ?></td>
                            <td><?php echo $user->challenge1 ? "<p>C</p>" : "<p style='color:red;'>NC</p>"; ?></td>
                            <td><?php echo $user->challenge3 ? "<p>C</p>" : "<p style='color:red;'>NC</p>"; ?></td>
                            <td><?php echo $user->challenge4 ? "<p>C</p>" : "<p style='color:red;'>NC</p>"; ?></td>
                            <td><?php echo $user->challenge5 ? "<p>C</p>" : "<p style='color:red;'>NC</p>"; ?></td>
                            <td><form method=""><button class="red" id="{{ $user->name }}" name="Disable">Disable</button></form></td>
                        </tr>
                        @endforeach
                        <?php
                        if(isset($_GET["Disable"]))
                        {
                            echo "User is disabled";
                        } ?>
                    </div>
                    </table>
            </div>
        </div>
    </div>
</main>
</body>
</html>
