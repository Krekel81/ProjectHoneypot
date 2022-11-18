<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserDemoController extends Controller
{

    private $model;
    public function __construct(User $model){
        $this->model = $model;
    }

    public function all(){

        $data = $this->model->all();

        return view("web.users", ["users" => $data]);
    }

    public function get($id){
        $data = $this->model->where('id', $id)->first();

        return view("web.user", ["user" => $data]);
    }
    public function encrypt()
    {
        $data = $this->model->first();

        $passwordEncrypted = password_hash($data->password, PASSWORD_DEFAULT);

        $passwordDecrypted = password_verify("tibo", $data->password);


        if($passwordDecrypted) return view("web.password", ["password" => "SUCCESSFULLY"]);
        else return view("web.password", ["password" => "DISMISSED"]);

    }
}
