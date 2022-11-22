<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;

class ChallengeController extends Controller {

    function imageGlassesCheck(Request $request) {
        $password = $request -> input($key);

        if ($password = "GeorgeClooney") {
            // Kan iemand hier de DB gerelateerde content toevoegen

            return redirect() -> route("c1");
        }
        echo "<p class='challengeFailed'>Challenge 1 failed, try again</p>";
    }

    function cookieChallenge3() {
        if ($id == c3) {
            Cookie::queue("Password", "MyNameIsMorpheus");
        }
    }
    
}
