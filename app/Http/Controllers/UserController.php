<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $model;
    public function __construct(User $model){
        $this->model = $model;
    }
    function createNewUser(Request $request)
    {
        Log::info("Creating user");
        //Rules
        $rules = $this -> buildRulesUsers();

        $validator = Validator::make($request -> all(), $rules);
        //Create model instance
        $user = new User();

        //Save & return
        return $this->checkIfInputIsValidUser($user, $validator);
    }
    function deleteAllUsers()
    {
        Log::info("Deleting all users");
        User::truncate();
        File::cleanDirectory(public_path('/uploads/avatars/'));
        return "All users were successfully deleted, new user object = ".User::all();
    }
    function buildRulesUsers()
    {

        return ["name" =>  "required|string|min:1|max:10|unique:users",
                "password" =>  "required|string|min:3|max:15"];
    }
    function checkIfInputIsValidUser($user, $validator)
    {
        
        if(!($validator-> fails()))
            {
                $data = $validator->validate();

                $user -> name = $data['name'];
                $passwordEncrypted = password_hash($data['password'], PASSWORD_DEFAULT);
                $user -> password = $passwordEncrypted;

                $_SESSION["loggedIn"] = true;
                $_SESSION["username"] = $data["name"];
                $user->loggedIn = true;
                $user -> save();

                $this->createFolder($user["name"]);

                header("Location: ../profile");
                exit();
                return $user;
            }
            //Returns the errors and statuscode 422
            //$statuscode = 422;
            //return response()->json(["errors" => $validator->errors()], $statuscode);

            Log::warning("Validation input error");
            $_SESSION["registered"] = true;
            header("Location: ../register");
            exit();
            return response()->json(["errors" => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    function getUser($userName)
    {
        Log::info("Getting user with name");

        $users = User::all();

        foreach ($users as $user) {
            if($user->name == $userName)
            {
                return $user->name;
            }
        }
        Log::info("Did not find a user with the name $userName");
        return null;
    }

    public function allUsersCheckingIndex(){

        $data = $this->model->all();

        return view("index", ["users" => $data]);
    }

    public function allUsersCheckingRegister(){

        $data = $this->model->all();

        return view("register", ["users" => $data]);
    }

    public function getUserCheckingLanding(){
        

        $user = User::where("name", $_SESSION["username"])->first();
        
        return view("landing", ["user" => $user]);
    }
    public function getUserCheckingProfile(){
        

        if(isset($_SESSION["username"]))
        {
            $user = User::where("name", $_SESSION["username"])->first();
            setcookie("ICanOnlyShowYouTheDoor", "dHJ5IGFnYWluIFlXNWtJR0ZuWVdsdWJtNXViaUJrU0VvMVNVYzVkVnBUUW5OWlYwWjZaRWhTTUVsSVVuQmlWMVpzV2xOQ1dsWXlVbTlYVm1SelpGZEtkRTVZVm1saFZVcHpWbTV3Y21WR1RsWmFSM1JyWWxaS1JWVlhOVU5oTVVwSVQxYzFXazFxUVRGWlZtUktaV3hXZFdORk1XbGlSV3QzVjJ0V1JrOVdRbEpRVkRBOQ==", time()+3600);
        }
        else
        {
            return redirect()->intended('/');
        }
        return view("profile", ["user" => $user]);
    }

    public function getUserChecking($name){
        $data = $this->model->where('name', $name)->first();
        Log::info($data);
        return view("checking", ["user" => $data]);
    }

    public function createFolder($name){
        $path = public_path()."/uploads/avatars/$name/";
        File::makeDirectory($path, 0755, true, true);

        $user = User::where("name", $name)->first();
        File::copy(public_path('default.jpg'), public_path('/uploads/avatars/'.$name.'/'.$user->avatar));

        return Log::info("Successfully created folder");
    }

    public function completedChallenge1(Request $request)
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
    public function completedChallenge2(Request $request)
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
    public function completedChallenge3(Request $request)
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
    public function completedChallenge4(Request $request)
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
    public function completedChallenge5()
    {
        

        $user = User::where("name", $_SESSION["username"])->first();

        $user->challenge5 = true;
        $user->save();
        return redirect()->intended('landing');
    }

    public function hintChallenge5()
    {
        

        $user = User::where("name", $_SESSION["username"])->first();

        return view("hintchallenge5", ["user" => $user]);
    }

    public function resetChallengesUser()
    {
        

        $user = User::where("name", $_SESSION["username"])->first();

        $user->challenge1 = false;
        $user->challenge2 = false;
        $user->challenge3 = false;
        $user->challenge4 = false;
        $user->challenge5 = false;

        $user->save();

        return redirect()->intended('landing');
    }

    function toggleDisableUser($user)
    {
        

        $user = User::where("name", $user)->first();

        $user->disabled =! $user->disabled;
        $user->save();

        return redirect()->intended('admin');

    }

    function logOffUsers()
    {
        
        $user = User::where("name", $_SESSION["username"])->first();

        $user->loggedIn = false;
        $_SESSION["loggedIn"] = false;

        $user->save();
        return redirect()->intended('/');
    }

    function getUserCheckingAdmin()
    {
        
        if(isset($_SESSION["username"]))
        {
            if($_SESSION["username"] != "")
            {
                $user = User::where("name", $_SESSION["username"])->first();

                if($user->admin)
                {
                    $users = User::all();
                    return view("admin", $users);
                }
                else
                {
                    return view("message", ["message" => "404 Not Authorized"]);
                }
            }
            else
            {
                return redirect()->intended('/');
            }
        }
        else
        {
            return redirect()->intended('/');
        }

    }

    function getUserChallenge1()
    {
        

        $user = User::where("name", $_SESSION["username"])->first();

        return view("challenge1", ["user" => $user]);
    }
    function getUserChallenge2()
    {
        

        $user = User::where("name", $_SESSION["username"])->first();

        return view("challenge2", ["user" => $user]);
    }
    function getUserChallenge3()
    {
        

        setcookie("Flag", "Th3M4tr1x-MyN4m315Morph3u5", time()+3600);

        $user = User::where("name", $_SESSION["username"])->first();

        return view("challenge3", ["user" => $user]);
    }
    function getUserChallenge4()
    {
        

        $user = User::where("name", $_SESSION["username"])->first();

        return view("challenge4", ["user" => $user]);
    }
    function getUserChallenge5()
    {
        

        $user = User::where("name", $_SESSION["username"])->first();

        return view("challenge5", ["user" => $user]);
    }


}
