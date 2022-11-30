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

<main style="
    display: flex;
    justify-content: center;
    align-items: center;
">
        <div id="landing2">
            <div id="landingDiv">
                <h2>Welcome {<?php echo $user->name; ?>} </h2>
                    <div id="landingDivContent2">
                        <div id="avatarDiv">
                            <img id="avatar" src=<?php echo "/uploads/avatars/$user->name/$user->avatar"; ?> alt="" srcset="" class="avatar">
                        </div>

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
            </div>
        </div>
    </div>
</main>
</body>
</html>
