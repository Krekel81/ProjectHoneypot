<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function showIndex()
    {
        return view('index');
    }
    public function showRegister()
    {
        return view('register');
    }
    public function showLanding()
    {
        return view('landing');
    }
    public function showChallenge1()
    {
        return view('challenge1');
    }
    public function showChallenge2()
    {
        return view('challenge2');
    }
    public function showChallenge3()
    {
        return view('challenge3');
    }
    public function showChallenge4()
    {
        return view('challenge4');
    }
    public function showChallenge5()
    {
        return view('challenge5');
    }
    public function showAdmin()
    {
        return view('admin.admin');
    }
    public function helloworld()
    {
        return "<h1>Hello World!</h1>";
    }
}
