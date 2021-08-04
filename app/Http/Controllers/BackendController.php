<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    function backend(){
        return view('backend.dashboard');
    }
}
