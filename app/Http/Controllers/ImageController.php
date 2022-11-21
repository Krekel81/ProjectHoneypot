<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        session_start();
        if($request->hasFile('avatar'))
        {
            $user = User::where("name", $_SESSION["username"])->first();

            $avatar = $request->file('avatar');
            $filename = time().'.'.$avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/'.$user->name.'/'.$filename));

            //$avatar->move(public_path('/uploads/avatars/'.$user->name.'/'), $filename);

            $user->avatar = $filename;
            $user->save();


            return view('landing', array('user' => $user));
        }
    }
}
