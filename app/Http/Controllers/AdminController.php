<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminController extends Controller
{
    public function login(){
        if(auth()->guard("admin")->check()) {
            return redirect()->route("admin.customers");
        }
        return view("admin.login");
    }

    public function loginPost(Request $request){
        if (Auth::guard("admin")->attempt(["email"  => $request->get("email"), "password" => $request->get("password")], true)){
            return redirect()->route("admin.customers");
        }
        return redirect()->back()->with(['error' => "Invalid email/password"]);
    }

    public function customers(){
        return view("admin.customer");
    }

    public function logout(){
        Auth::guard("admin")->logout();
        return redirect()->route("admin.login");
    }

    public function get_customers(Request $request){

        $draw = $request->get("draw");
        $limit = $request->get("length");
        $offset = $request->get("start");
        $search = $request->get("search")["value"] ?? null;
        
        $query = User::query();

        $total_records = $query->count();
        $data = $query->with("vcards")->where(function($query) use($search){
            if(!is_null($search)){
                $query->where("name", "LIkE", "%$search%");
            }
        })->skip($offset)
        ->take($limit)
        ->get();

        $total_filtered = count($data);


        $new_data = [];
        foreach ($data as $key => $value) {
            $temp  = [];
            array_push($temp, $value->id);
            array_push($temp, $value->name);
            array_push($temp, $value->username);
            array_push($temp, $value->email);
            array_push($temp, $value->singleVcard()->business ?? null);
            array_push($temp, $value->singleVcard()->phone ?? null);
            array_push($temp, $value->singleVcard()->address ?? null);
            array_push($temp, $value->singleVcard()->site_1 ?? null);
            array_push($temp, $value->singleVcard()->site_2 ?? null);
            array_push($temp, $value->singleVcard()->site_3 ?? null);
            array_push($temp, $value->total_visit);
            array_push($temp, $value->singleVcard()->updated_at ?? null);

            array_push($new_data, $temp);
        }


        $response["draw"] = $draw;
        $response["recordsTotal"] = $total_records;
        $response["recordsFiltered"] = $total_filtered;
        $response["data"] = $new_data;

        return $response;

        // {
        //     "draw": ,
        //     "recordsTotal": 57,
        //     "recordsFiltered": 57,
        //     "data": [
        //       [
        //         "Charde",
        //         "Marshall",
        //         "Regional Director",
        //         "San Francisco",
        //         "16th Oct 08",
        //         "$470,600"
        //       ],
        //     ]
        // };
    }

    // public function register(){
    //     return Admin::insert([
    //         "email" => 'admin@gmail.com',
    //         "password"  => Hash::make("12345678")
    //     ]);
    // }

}
