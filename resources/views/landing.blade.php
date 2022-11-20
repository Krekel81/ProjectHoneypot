<!DOCTYPE html>
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
                @if (Auth::user())
                    <li><a href="{{ url('/') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <h2>Welcome {<?php echo $user->name; ?>} </h2>
                    <div id="landingDivContent2">
                        <div id="avatarDiv">
                            <img id="avatar" src=<?php echo "/uploads/avatars/$user->name/$user->avatar"; ?> alt="" srcset="" class="avatar">
                        </div>

                        <form enctype="multipart/form-data" method="POST" action="/landing">
                            <input name="avatar" id="files" type="file" required />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button name="submit">Upload</button>
                        </form>

                        <form>
                            <button name="btnLogout" id="btnLogout">Logout</button>
                        </form>

                        <?php
                        if(isset($_GET['btnLogout']))
                        {
                            echo "<p>Logout</p>";
                            $_SESSION["loggedIn"] = false;
                            header("Location: /");
                            exit();
                        }
                        ?>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
</body>
</html>
