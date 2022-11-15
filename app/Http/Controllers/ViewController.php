<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    View::addExtension('html', 'php');
    public function showIndex()
    {
        return View::make('index');
    }
    public function helloworld()
    {
        return "<h1>Hello World!</h1>"
    }
}
