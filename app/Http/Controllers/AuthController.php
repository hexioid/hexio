<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    
    public function create(){
        return view("user.register");
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'username' => 'required|alpha_num|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|between:8,20',
            'telephone' => 'required|numeric',
            'g-recaptcha-response' => 'recaptcha',
        ]);
        try {
            $user = new User;
            $user->name = $request->get("name");
            $user->username = $request->get("username");
            $user->email = $request->get("email");
            $user->password = Hash::make($request->get("password"));
            $user->phone = $request->get("telephone");
    
            $user->save();

            if (Auth::attempt(["email"  => $request->get("email"), "password" => $request->get("password")], true)){
                return redirect("page/link");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function login(){
        return view("user.login");
    }

    public function login_post(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if (Auth::attempt(["email"  => $request->get("email"), "password" => $request->get("password")], $request->has("remember") ? true : false)){
            return redirect("page/link");
        }

        if (Auth::attempt(["username"  => $request->get("email"), "password" => $request->get("password")], $request->has("remember") ? true : false)){
            return redirect("page/link");
        }
        
        return redirect()->back()->with(['error' => "Invalid email/password"]);

        try {
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect("page/login");
    }

    public function change_password(Request $request){
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|between:8,20',
            'confirm_new_password' => 'required|string|between:8,20',
        ]);

        try {

            if($request->get("new_password") != $request->get("confirm_new_password")){
                return redirect()->back()->with(['error' => "New password doesn't match"]);
            }
    
            $user = User::findOrFail(Auth::user()->id);

            if(Hash::check($request->get("current_password"), $user->password)){
                $user->password = Hash::make($request->get("new_password"));
                $user->save();
                return redirect("page/profile")->with(['success' => "Success change password"]);
            }
            return redirect()->back()->with(['error' => "Wrong password"]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

}
