<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $model;
    public function __construct(User $model){
        $this->model = $model;
    }
    function getUsers()
    {
        Log::info("Retrieving users");
        return ["users" => User::all()];
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
        return "All users were successfully deleted, new user object = ".User::all();
    }
    function buildRulesUsers()
    {

        return ["name" =>  "required|string|min:1|max:50|unique:users",
                "password" =>  "required|string|min:1"];
    }
    function checkIfInputIsValidUser($user, $validator)
    {
        session_start();
        if(!($validator-> fails()))
            {
                $data = $validator->validate();

                $user -> name = $data['name'];
                $passwordEncrypted = password_hash($data['password'], PASSWORD_DEFAULT);
                $user -> password = $passwordEncrypted;

                $_SESSION["loggedIn"] = true;
                $_SESSION["username"] = $data["name"];

                //$this->createFolder($user['name']);

                $user -> save();



                header("Location: ../landing");
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

        $users = $this->getUsers();

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

    public function allUsersCheckingLanding(){

        $data = $this->model->all();

        return view("landing", ["users" => $data]);
    }

    public function getUserChecking($name){
        $data = $this->model->where('name', $name)->first();
        Log::info($data);
        return view("checking", ["user" => $data]);
    }

    public function createFolder($name){
        $path = public_path()."/assets/images/$name/";
        File::makeDirectory($path, $mode = 0755, true, true);
/*
        $path = "public/images/$name";

        Storage::makeDirectory($path, 0755, true);
*/
        return Log::info("Successfully created folder");

    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->save();



        $image = $request->image;
        Log::info($image, $request);
        return $image;
    }

    public function completedChallenge1(Request $request)
    {
        session_start();

        $user = User::where("name", $_SESSION["username"])->first();

        if($request->input == "1999")
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
        session_start();

        $user = User::where("name", $_SESSION["username"])->first();

        if($request->input == "neo" || $request->input == "Neo")
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
        session_start();

        $user = User::where("name", $_SESSION["username"])->first();

        if($request->input == "21")
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
        session_start();

        $user = User::where("name", $_SESSION["username"])->first();

        if($request->input == "telephone" || $request->input == "telephones" || $request->input == "Telephone" || $request->input == "Telephones")
        {
            $user->challenge4 = true;
            $user->save();
            return redirect()->intended('landing');
        }
        $_SESSION["challenge"] = "failed";
        return redirect()->intended('challenge4');
    }
    public function completedChallenge5(Request $request)
    {
        session_start();

        $user = User::where("name", $_SESSION["username"])->first();

        if($request->input == "Trinity" || $request->input == "trinity")
        {
            $user->challenge5 = true;
            $user->save();
            return redirect()->intended('landing');
        }
        $_SESSION["challenge"] = "failed";
        return redirect()->intended('challenge5');
    }


}
