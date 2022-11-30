<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Intervention\Image\Size;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        if($request->hasFile('avatar'))
        {
            try
            {
                if((filesize($request->file('avatar'))/1024) > 2000) return view('message', array('message'=>"File is too big."));
                $user = User::where("name", $_SESSION["username"])->first();

                $avatar = $request->file('avatar');

                $filename = time().'.'.$avatar->getClientOriginalExtension();

                Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/'.$user->name.'/'.$filename));


                $user->avatar = $filename;
                $user->save();


                return view('landing', array('user' => $user));
            }
            catch (Exception $e) {
                return view('message', array('message'=>"You did not upload a valid image/avatar."));
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }
}
