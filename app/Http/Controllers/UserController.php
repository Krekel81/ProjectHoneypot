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
    function buildRulesUsers()
    {

        return ["name" =>  "required|string|min:1|max:10|unique:users",
                "password" =>  "required|string|min:3|max:15"];
    }
    function checkIfInputIsValidUser($user, $validator)
    {
        session_start();
        if(!($validator-> fails()))
            {
                $data = $validator->validate();

                $user->name = $data['name'];
                $passwordEncrypted = password_hash($data['password'], PASSWORD_DEFAULT);
                $user->password = $passwordEncrypted;

                $_SESSION["username"] = $data["name"];
                $user->loggedIn = true;
                
                $user->save();

                $this->createFolder($user["name"]);

                return redirect()->intended('profile');
            }
            Log::warning("Validation input error");
            return redirect()->route('register', ["message"=>"User is already registered!"])->with(["message"=>"User is already registered!"]);
    }

    public function createFolder($name){
        $path = public_path()."/uploads/avatars/$name/";
        File::makeDirectory($path, 0755, true, true);

        $user = User::where("name", $name)->first();
        File::copy(public_path('default.jpg'), public_path('/uploads/avatars/'.$name.'/'.$user->avatar));

        return Log::info("Successfully created folder");
    }

    /*
    function deleteAllUsers()
    {
        //This is for api.php in folder routes
        //Route::delete('/user', [UserController::class, "deleteAllUsers"]);

        Log::info("Deleting all users");
        User::truncate();
        File::cleanDirectory(public_path('/uploads/avatars/'));
        return "All users were successfully deleted, new user object = ".User::all();
    }
    */

    public function resetChallengesUser()
    {
        if(!$this->isNotAuthorized())
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
        else return $this->isNotAuthorized();
    }


    public function allUsersCheckingIndex(){
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            return redirect()->intended('profile');
        }
        else
        {
            $_SESSION["username"] = "";
            $data = $this->model->all();
            return view("index", ["users" => $data]);
        }
    }

    public function allUsersCheckingRegister(){
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            return redirect()->intended('profile');
        }
        else
        {
            $_SESSION["username"] = "";
            $data = $this->model->all();
            return view("register", ["users" => $data]);
        }
    }

    public function getUserCheckingLanding(){
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            return view("landing", ["user" => $user]);
        }
        else return $this->isNotAuthorized();
    }
    
    public function getUserCheckingProfile(){
        $user = User::where("name", $_SESSION["username"])->first();
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            setcookie("ICanOnlyShowYouTheDoor", "dHJ5IGFnYWluIFlXNWtJR0ZuWVdsdWJtNXViaUJrU0VvMVNVYzVkVnBUUW5OWlYwWjZaRWhTTUVsSVVuQmlWMVpzV2xOQ1dsWXlVbTlYVm1SelpGZEtkRTVZVm1saFZVcHpWbTV3Y21WR1RsWmFSM1JyWWxaS1JWVlhOVU5oTVVwSVQxYzFXazFxUVRGWlZtUktaV3hXZFdORk1XbGlSV3QzVjJ0V1JrOVdRbEpRVkRBOQ==", time()+3600);
            return view("profile", ["user" => $user]);
        }
        else return $this->isNotAuthorized();
    }


    function getUserCheckingAdmin()
    {
        if(!$this->isNotAuthorized())
        {
            $user = User::where("name", $_SESSION["username"])->first();
            if($user->admin)
            {
                $users = User::all();
                return view("admin", ["users"=>$users]);
            }
            else
            {
                return view("message", ["message" => "401 Not Authorized"]);
            }
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
