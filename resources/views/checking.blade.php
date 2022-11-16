<?php
    foreach ($users as $user) {
        $username = $user->name;
        $password = $user->password;

        if($_GET["name"] == $username && $_GET["password"] == $password)
        {
            echo "<p style='color:green;'>You are logged in</p>";
        }
        else {
            echo "<p style='color:red;'>Your credentials are invalid</p>";
        }
    }
?>
