<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    function toggleDisableUser($user)
    {
        session_start();
        if(!$this->isNotAuthorizedAdmin())
        {
            $user = User::where("name", $user)->first();

            $user->disabled =! $user->disabled;
            $user->save();

            return redirect()->intended('admin');
        }
        else return $this->isNotAuthorized();
    }

    function toggleLogUser($user)
    {
        session_start();
        if(!$this->isNotAuthorizedAdmin())
        {
            $user = User::where("name", $user)->first();

            $user->loggedIn =! $user->loggedIn;
            $user->save();

            return redirect()->intended('admin');
        }
        else return $this->isNotAuthorized();
    }

    function deleteUser($user)
    {
        session_start();
        if(!$this->isNotAuthorizedAdmin())
        {
            $user = User::where("name", $user)->first();

            $user->delete();
            Log::info("User $user->name has been deleted by Admin ".$_SESSION['username']);
            return redirect()->intended('admin');
        }
        else return $this->isNotAuthorized();
    }

    function isNotAuthorizedAdmin()
    {
        if(isset($_SESSION["username"]))
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($user)
            {
                if($user->disabled) return redirect()->route('/', ["message"=>"Your account is disabled!"]);
                if(!($user->loggedIn)) return redirect()->route('/', ["message"=>"You are not logged in!"]);
                if(!($user->admin)) return redirect()->route('/', ["message"=>"You are not an admin!"]);
                return false;
            }
            else
            {
                return redirect()->route('/', ["message"=>"You are not logged in!"]);
            }
        }
        return redirect()->route('/', ["message"=>"You are not logged in!"]);
    }
}
