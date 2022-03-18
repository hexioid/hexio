<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminController extends Controller
{
    
    public function login(){
        return view("admin.login");
    }

    public function dashboard(){
        return view("admin.dashboard_template");
    }

}
