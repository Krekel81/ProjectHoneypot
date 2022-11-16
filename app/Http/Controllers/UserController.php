<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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

        //Fill in specific Users columns
        
        $user -> name = $request -> input("name");
        $user -> password = $request -> input("password");
        


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

        return ["name" =>  "required|string|min:1|max:50|unique:all",
                "password" =>  "required|string|min:1|max:50"];
    }
    function checkIfInputIsValidUser($user, $validator)
    {
        if(!($validator-> fails()))
            { 
                $data = $validator->validate();

                $user -> name = $data['name'];
                $password -> password = $data['password'];

                $user -> save();
                return $user;
            }
            //Returns the errors and statuscode 422
            //$statuscode = 422;
            //return response()->json(["errors" => $validator->errors()], $statuscode);
            Log::warning("Validation input error");
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
}
