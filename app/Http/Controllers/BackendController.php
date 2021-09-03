<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    function backend(){
        return view('backend.dashboard');
    }
}
