<!DOCTYPE html>
<html id="admin" lang="en">
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
                        <thead class="adminTableHeader">
                        <tr>
                            <th>Username</th>
                            <th>LoggedIn</th>
                            <th>Challenge1</th>
                            <th>Challenge2</th>
                            <th>Challenge3</th>
                            <th>Challenge4</th>
                            <th>Challenge5</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        <form method="" name="disabled">
                        @foreach ($users as $user)

                        <tr>
                            <td>{{ $user->name }}</td>
                            <td style="display: flex;width: 12rem;flex-direction: row;align-items: center;justify-content: space-around;"><?php echo $user->loggedIn ? "<p>Yes</p>" : "<p style='color:red;'>No</p>"; ?>@if(!($user->admin))<input style="width: 5rem;" type="submit" name="{{ $user->name }}" value="<?php echo $user->loggedIn ? "Logout" : "Login"; ?>" class="<?php echo $user->loggedIn ? "disableButtonAdminLoggedIn" : ""; ?>" name="login" />@endif</td>
                            <td><?php echo $user->challenge1 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>
                            <td><?php echo $user->challenge2 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>
                            <td><?php echo $user->challenge3 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>
                            <td><?php echo $user->challenge4 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>
                            <td><?php echo $user->challenge5 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>

                            <td style="display: flex;width: 12rem;flex-direction: row;align-items: center;justify-content: space-around;"><?php echo $user->disabled ? "<p style='color:red;'>Disabled</p>" : "<p>Active</p>"; ?>@if(!($user->admin))<input style="width: 5rem;" type="submit" name="{{ $user->name }}" value="<?php echo $user->disabled ? "Enable" : "Disable"; ?>" class="<?php echo $user->disabled ? "enableButtonAdmin" : "disableButtonAdmin"; ?>" name="disable" />@endif</td>
                        </tr>

                        @endforeach
                        </form>

                        </tbody>
                        <?php
                            foreach($_GET as $key=>$value)
                            {
                                if($value == "Disable" || $value == "Enable")
                                {
                                    $post[$key] = $value;
                                    header("Location: api/toggleDisableUser/$key");
                                    exit();
                                }
                                if($value == "Login" || $value == "Logout")
                                {
                                    $post[$key] = $value;
                                    header("Location: api/toggleLogUser/$key");
                                    exit();
                                }
                            }
                    
                        ?>
                    </div>

                    </table>

            </div>
            <form action="landing">
                <button id="go">Go back</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>
