"use strict";

document.addEventListener("DOMContentLoaded", checkIfUserHasBeenLoggedOut);

function checkIfUserHasBeenLoggedOut()
{
    window.onbeforeunload = function(event) {
        fetch('api/users/logOff', {
            method: 'GET',
            headers: {'Content-Type': 'application/json'}
        });
     };
}
