<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("welcome");
    }

    public function signUp(){
        return view("sign-up");
    }

    public function dashboard(){
        return view("dashboard");
    }
}
