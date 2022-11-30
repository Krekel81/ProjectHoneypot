<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ViewController extends Controller
{
    function getUserChallenge1()
    {
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            return view("challenge1", ["user" => $user]);
        }
        else
        {
            return $this->isNotAuthorized();
        }
    }
    
    function getUserChallenge2()
    {
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            return view("challenge2", ["user" => $user]);
        }
        else
        {
            return $this->isNotAuthorized();
        }
    }
    function getUserChallenge3()
    {
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            setcookie("Flag", "Th3M4tr1x-MyN4m315Morph3u5", time()+3600);
            return view("challenge3", ["user" => $user]);
        }
        else
        {
            return $this->isNotAuthorized();
        }
    }
    function getUserChallenge4()
    {
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            return view("challenge4", ["user" => $user]);
        }
        else
        {
            return $this->isNotAuthorized();
        }
    }
    function getUserChallenge5()
    {
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            return view("challenge5", ["user" => $user]);
        }
        else
        {
            return $this->isNotAuthorized();
        }
    }
    public function hintChallenge5()
    {
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            return view("hintchallenge5", ["user" => $user]);
        }
        else
        {
            return $this->isNotAuthorized();
        }
    }
    function isNotAuthorized()
    {
        if(isset($_SESSION["username"]))
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($user)
            {
                if($user->disabled) return redirect()->route('/', ["message"=>"Your account is disabled!"]);
                if(!($user->loggedIn)) return redirect()->route('/', ["message"=>"You are not logged in!"]);
                return false;
            }
            else
            {
                return redirect()->route('/', ["message"=>"You are not logged in!"]);
            }
        }
        return redirect()->route('/', ["message"=>"You are not logged in!"]);
    }
    public function helloworld()
    {
        return "<h1>Hello World!</h1>";
    }
}
