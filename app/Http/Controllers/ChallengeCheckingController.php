<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChallengeCheckingController extends Controller
{
    public function completedChallenge1(Request $request)
    {
        session_start();
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($request->input == "M0rph3u5{R3m3mb3r,_411_1m_0ff3r1ng_1s_th3_truth._Noth1ng_m0r3.}")
            {
                $user->challenge1 = true;
                $user->save();
                return redirect()->intended('landing');
            }
            $_SESSION["challenge"] = "failed";
            return redirect()->intended('challenge1');    
        }
        else return $this->isNotAuthorized();
    }
    public function completedChallenge2(Request $request)
    {
        session_start();
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($request->input == "N30{Y0u_3v3r_h4v3_th4t_f33l1ng_wh3r3_y0u_4r3_n0t_sur3_1f_y0u_4r3_4w4k3_0r_st1ll_dr34m1ng?}")
            {
                $user->challenge2 = true;
                $user->save();
                return redirect()->intended('landing');
            }
            $_SESSION["challenge"] = "failed";
            return redirect()->intended('challenge2');
        }
        else return $this->isNotAuthorized();
    }
    public function completedChallenge3(Request $request)
    {
        session_start();
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($request->input == "Th3M4tr1x-MyN4m315Morph3u5")
            {
                $user->challenge3 = true;
                $user->save();
                return redirect()->intended('landing');
            }
            $_SESSION["challenge"] = "failed";
            return redirect()->intended('challenge3');
        }
        else return $this->isNotAuthorized();
    }
    public function completedChallenge4(Request $request)
    {
        session_start();
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($request->input == "select * from pills where color='red' OR 1=1")
            {
                $user->challenge4 = true;
                $user->save();
                return redirect()->intended('landing');
            }
            $_SESSION["challenge"] = "failed";
            return redirect()->intended('challenge4');
        }
        else return $this->isNotAuthorized();
    }
    public function completedChallenge5()
    {
        session_start();
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            $user->challenge5 = true;
            $user->save();
            return redirect()->intended('landing');
        }
        else return $this->isNotAuthorized();
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
}
