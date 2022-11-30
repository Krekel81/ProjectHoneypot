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
            return redirect()->route('register', ["message"=>"User is already registered!"])->with(["message"=>"User is already registered!"]);
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
        if(isset($_SESSION["username"]))
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($user && $user->loggedIn && !($user->disabled))
            {
                return redirect()->intended('profile');
            }
        }
        $_SESSION["username"] = "";

        $data = $this->model->all();

        return view("index", ["users" => $data]);
    }

    public function allUsersCheckingRegister(){

        if(isset($_SESSION["username"]))
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($user && $user->loggedIn && !($user->disabled))
            {
                return redirect()->intended('profile');
            }
            
        }
        $_SESSION["username"] = "";

        $data = $this->model->all();

        return view("register", ["users" => $data]);
    }

    public function getUserCheckingLanding(){

        if(isset($_SESSION["username"]))
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($user)
            {
                if($user->disabled) return redirect()->route('/', ["message"=>"Your account is disabled!"]);
                if(!($user->loggedIn)) return redirect()->route('/', ["message"=>"You are not logged in!"]);

                return view("landing", ["user" => $user]);
            }
            else
            {
                return redirect()->route('/', ["message"=>"You are not logged in!"]);
            }
        }

        return redirect()->route('/', ["message"=>"You are not logged in!"]);
        
    }
    public function getUserCheckingProfile(){
        if(isset($_SESSION["username"]))
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($user)
            {
                if($user->disabled) return redirect()->route('/', ["message"=>"Your account is disabled!"]);
                if(!($user->loggedIn)) return redirect()->route('/', ["message"=>"You are not logged in!"]);
                setcookie("ICanOnlyShowYouTheDoor", "dHJ5IGFnYWluIFlXNWtJR0ZuWVdsdWJtNXViaUJrU0VvMVNVYzVkVnBUUW5OWlYwWjZaRWhTTUVsSVVuQmlWMVpzV2xOQ1dsWXlVbTlYVm1SelpGZEtkRTVZVm1saFZVcHpWbTV3Y21WR1RsWmFSM1JyWWxaS1JWVlhOVU5oTVVwSVQxYzFXazFxUVRGWlZtUktaV3hXZFdORk1XbGlSV3QzVjJ0V1JrOVdRbEpRVkRBOQ==", time()+3600);
                return view("profile", ["user" => $user]);
            }
            else
            {
                return redirect()->route('/', ["message"=>"You are not logged in!"]);
            }
        }
        return redirect()->route('/', ["message"=>"You are not logged in!"]);
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

    


    public function resetChallengesUser()
    {
        if(isset($_SESSION["username"]))
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($user)
            {
                if($user->disabled) return redirect()->route('/', ["message"=>"Your account is disabled!"]);
                if(!($user->loggedIn)) return redirect()->route('/', ["message"=>"You are not logged in!"]);
                
                $user->challenge1 = false;
                $user->challenge2 = false;
                $user->challenge3 = false;
                $user->challenge4 = false;
                $user->challenge5 = false;
        
                $user->save();
        
                return redirect()->intended('landing');
            }
            else
            {
                return redirect()->route('/', ["message"=>"You are not logged in!"]);
            }
        }
        return redirect()->route('/', ["message"=>"You are not logged in!"]);

       
    }

    function toggleDisableUser($user)
    {
        
        session_start();
        $user = User::where("name", $user)->first();

        $user->disabled =! $user->disabled;
        $user->save();

        return redirect()->intended('admin');

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
