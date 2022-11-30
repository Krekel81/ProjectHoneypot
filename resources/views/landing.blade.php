<!DOCTYPE html>
<html id="landingPage" lang="en">
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
    <script src="assets/js/checkIfLoggedOut.js"></script>
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
                <li><button>Challenge 1</button><?php echo $user->challenge1 ? "<p>Completed</p>" : "<p style='color:red;'>Not Completed</p>"; ?></li>
                <li><button>Challenge 2</button><?php echo $user->challenge2 ? "<p>Completed</p>" : "<p style='color:red;'>Not Completed</p>"; ?></li>
                <li><button>Challenge 3</button><?php echo $user->challenge3 ? "<p>Completed</p>" : "<p style='color:red;'>Not Completed</p>"; ?></li>
                <li><button>Challenge 4</button><?php echo $user->challenge4 ? "<p>Completed</p>" : "<p style='color:red;'>Not Completed</p>"; ?></li>
                <li><button>Challenge 5</button><?php echo $user->challenge5 ? "<p>Completed</p>" : "<p style='color:red;'>Not Completed</p>"; ?></li>
            </ul>
        </div>
        <div id="landing2">
            <div id="landingDiv">
                @if ($user == null)
                    <?php
                    $_SESSION["loggedIn"] = false;
                    header("Location: /");
                    exit();
                    ?>
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


                        <?php
                        if($user->admin)
                        {
                            echo "<form method=''><button name='admin'>Admin</button</form>";
                            if(isset($_GET['admin']))
                            {
                                header("Location: /admin");
                                exit();
                            }
                        }

                        ?>

                        <form>
                            <button name="btnLogout" id="btnLogout">Logout</button>
                        </form>

                        <?php
                        if(isset($_GET['btnLogout']))
                        {
                            echo "<p>Logout</p>";
                            $user->loggedIn = false;
                            $user->save();
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
