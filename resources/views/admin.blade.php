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
                            <th>Id</th>
                            <th>Username</th>
                            <th>Active</th>
                            <th>LoggedIn</th>
                            <th>Chall1</th>
                            <th>Chall2</th>
                            <th>Chall3</th>
                            <th>Chall4</th>
                            <th>Chall5</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <form method="" name="disabled">
                        @foreach ($users->sortBy('last_active_at',SORT_REGULAR, true) as $user)

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            @if(now()->timestamp - $user->last_active_at->timestamp == 0)
                            <td>Online</td>
                            @elseif(now()->timestamp - $user->last_active_at->timestamp < 60)
                            <td>{{ now()->timestamp - $user->last_active_at->timestamp }} seconds ago</td>
                            @elseif(now()->timestamp - $user->last_active_at->timestamp >= 60 && now()->timestamp - $user->last_active_at->timestamp < 120)
                            <td>{{ floor((now()->timestamp - $user->last_active_at->timestamp) / 60)}} minute ago</td>
                            @elseif(now()->timestamp - $user->last_active_at->timestamp >= 120 && now()->timestamp - $user->last_active_at->timestamp <= 3600)
                            <td>{{ floor((now()->timestamp - $user->last_active_at->timestamp) / 60)}} minutes ago</td>
                            @elseif(now()->timestamp - $user->last_active_at->timestamp >= 3600 && now()->timestamp - $user->last_active_at->timestamp < 7200)
                            <td>{{ floor((now()->timestamp - $user->last_active_at->timestamp) / 3600)}} hour ago</td>
                            @elseif(now()->timestamp - $user->last_active_at->timestamp >= 7200 && now()->timestamp - $user->last_active_at->timestamp < 86400)
                            <td>{{ floor((now()->timestamp - $user->last_active_at->timestamp) / 3600)}} hours ago</td>
                            @elseif(now()->timestamp - $user->last_active_at->timestamp >= 86400 && now()->timestamp - $user->last_active_at->timestamp < 172800)
                            <td>{{ floor((now()->timestamp - $user->last_active_at->timestamp) / 86400)}} day ago</td>
                            @elseif(now()->timestamp - $user->last_active_at->timestamp >= 172800)
                            <td>{{ floor((now()->timestamp - $user->last_active_at->timestamp) / 86400)}} days ago</td> 

                            @endif
                            <td style="display: flex;width: 12rem;flex-direction: row;align-items: center;justify-content: space-around;"><?php echo $user->loggedIn ? "<p>Yes</p>" : "<p style='color:red;'>No</p>"; ?>@if(!($user->admin))<?php echo $user->loggedIn ? "<input style='width: 5rem;' type='submit' name='$user->name' value='Logout' class='disableButtonAdminLoggedIn' name='login' />" : ""; ?>@endif</td>
                            <td><?php echo $user->challenge1 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>
                            <td><?php echo $user->challenge2 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>
                            <td><?php echo $user->challenge3 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>
                            <td><?php echo $user->challenge4 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>
                            <td><?php echo $user->challenge5 ? "<p>✅</p>" : "<p style='color:red;'>❌</p>"; ?></td>

                            <td style="display: flex;width: 12rem;flex-direction: row;align-items: center;justify-content: space-around;"><?php echo $user->disabled ? "<p style='color:red;'>Disabled</p>" : "<p>Active</p>"; ?>@if(!($user->admin))<input style="width: 5rem;" type="submit" name="{{ $user->name }}" value="<?php echo $user->disabled ? "Enable" : "Disable"; ?>" class="<?php echo $user->disabled ? "enableButtonAdmin" : "disableButtonAdmin"; ?>" name="disable" />@endif</td>
                            <td>@if(!$user->admin)<button style="width:1px;margin:0;padding:0" name="{{ $user->name }}" value="Delete"><img onclick="" id="bin" src="assets/images/bin.png" name="{{ $user->name }}" value='Delete' alt=""></button>@endif</td>
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
                                if($value == "Logout")
                                {
                                    $post[$key] = $value;
                                    header("Location: api/toggleLogUser/$key");
                                    exit();
                                }
                                if($value == "Delete")
                                {
                                    $post[$key] = $value;
                                    header("Location: api/deleteUser/$key");
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
