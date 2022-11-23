<?php

function lastSeenUser()
{
    $last_seen = $_SESSION['last_seen'];

    if (!$last_seen) {
    $last_seen = time();
    }

    if (time() - $last_seen > 10) { // Will execute if the time elapsed is over 10 seconds
    // Your code to execute if the user not active any more
    }
    else {
    // Show user as still active
    $_SESSION['last_seen'] = time(); // Update the last time checked
}
setInterval(lastSeenUser(), 1000);
}
function setInterval($f, $milliseconds)
{
       $seconds=(int)$milliseconds/1000;
       while(true)
       {
           $f();
           sleep($seconds);
       }
}
?>
