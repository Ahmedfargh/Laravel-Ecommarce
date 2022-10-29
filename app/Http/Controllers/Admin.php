<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class Admin extends Controller
{
    //
    function login(Request $req){
        return view("index");
    }
}
