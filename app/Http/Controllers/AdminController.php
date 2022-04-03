<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Vcard;
use App\LinkType;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminController extends Controller
{
    public function login(){
        if(auth()->guard("admin")->check()) {
            return redirect()->route("admin.vcards");
        }
        return view("admin.login");
    }

    public function loginPost(Request $request){
        if (Auth::guard("admin")->attempt(["email"  => $request->get("email"), "password" => $request->get("password")], true)){
            return redirect()->route("admin.vcards");
        }
        return redirect()->back()->with(['error' => "Invalid email/password"]);
    }

    public function vcards(){
        $data = User::whereDoesntHave("vcards")->get();
        return view("admin.vcards")->with([
            "customers" => $data
        ]);
    }

    public function logout(){
        Auth::guard("admin")->logout();
        return redirect()->route("admin.login");
    }

    public function get_vcards(Request $request){

        $draw = $request->get("draw");
        $limit = $request->get("length");
        $offset = $request->get("start");
        $search = $request->get("search")["value"] ?? null;
        
        $query = User::query();
        $query = $query->with("vcards")
                    ->whereHas("vcards");
        $total_records = $query->count();
        $query = $query->where(function($query) use($search){
                if(!is_null($search)){
                    $query->where("name", "LIkE", "%$search%");
                }
            });

        $total_filtered = count($query->get());

        $data = $query->skip($offset)
        ->take($limit)
        ->get();

        // return response()->json($data->userasd);

        $new_data = [];
        foreach ($data as $key => $value) {
            $temp  = [];
            array_push($temp, $value->singleVcard()->id);
            array_push($temp, $value->username);
            array_push($temp, $value->singleVcard()->name);
            array_push($temp, $value->singleVcard()->business ?? null);
            array_push($temp, $value->singleVcard()->phone_1 ?? null);
            array_push($temp, $value->singleVcard()->phone_2 ?? null);
            array_push($temp, $value->singleVcard()->phone_3 ?? null);
            array_push($temp, $value->singleVcard()->address ?? null);
            array_push($temp, $value->singleVcard()->site_1 ?? null);
            array_push($temp, $value->singleVcard()->site_2 ?? null);
            array_push($temp, $value->singleVcard()->site_3 ?? null);
            array_push($temp, $value->singleVcard()->total_clicked);
            array_push($temp, null);

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

    public function register(){
        return Admin::insert([
            'name'  => "abi firmandhani",
            "email" => 'admin@gmail.com',
            "password"  => Hash::make("12345678")
        ]);
    }

    public function delete_vcard($id){
        $data = Vcard::find($id);

        if(is_null($data)){
            return redirect()->route("admin.customers")->with(['error' => "user not found"]);
        }
        $data->delete();
        return redirect()->back()->with(['success' => "Success"]);
    }

    public function editVcard(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'business' => 'nullable|string',
            'phone_1' => 'required|numeric',
            'phone_2' => 'nullable|numeric',
            'phone_3' => 'nullable|numeric',
            'address' => 'nullable|string',
            'site_1' => 'nullable|string',
            'site_2' => 'nullable|string',
            'site_3' => 'nullable|string',
        ]);
        $id = $request->id;
        $data = Vcard::find($id);
        if(is_null($data)){
            return redirect()->route("admin.customers")->with(['error' => "Data not found"]);
        }

        $data->name = $request->name;
        $data->business = $request->business;
        $data->phone_1 = $request->phone_1;
        $data->phone_2 = $request->phone_2;
        $data->phone_3 = $request->phone_3;
        $data->address = $request->address;
        $data->site_1 = $request->site_1;
        $data->site_2 = $request->site_2;
        $data->site_3 = $request->site_3;
        $data->save();

        return redirect()->back()->with(['success' => "Success"]);
    }

    public function createVcard(Request $request){
        $validatedData = $request->validate([
            'user_id'   => 'required|string',
            'name' => 'required|string',
            'business' => 'nullable|string',
            'phone_1' => 'required|numeric',
            'phone_2' => 'nullable|numeric',
            'phone_3' => 'nullable|numeric',
            'address' => 'nullable|string',
            'site_1' => 'nullable|string',
            'site_2' => 'nullable|string',
            'site_3' => 'nullable|string',
        ]);

        $user = User::find($request->user_id);
        if(is_null($user)){
            return redirect()->route("admin.customers")->with(['error' => "User not found"]);
        }

        $data = new Vcard;
        $data->user_id = $user->id;
        $data->name = $request->name;
        $data->business = $request->business;
        $data->phone_1 = $request->phone_1;
        $data->phone_2 = $request->phone_2;
        $data->phone_3 = $request->phone_3;
        $data->address = $request->address;
        $data->site_1 = $request->site_1;
        $data->site_2 = $request->site_2;
        $data->site_3 = $request->site_3;
        $data->save();

        return redirect()->back()->with(['success' => "Success"]);
    }

    
    public function traffics(){
        return view("admin.traffic");
    }

    public function get_traffics(Request $request){

        $draw = $request->get("draw");
        $limit = $request->get("length");
        $offset = $request->get("start");
        $search = $request->get("search")["value"] ?? null;
        
        $query = User::query();

        $total_records = $query->count();
        $query = $query->where(function($query) use($search){
                if(!is_null($search)){
                    $query->where("name", "LIkE", "%$search%");
                }
            });

        $total_filtered = count($query->get());
        $data = $query->skip($offset)
        ->take($limit)
        ->get();

        $new_data = [];
        foreach ($data as $key => $value) {
            $temp  = [];
            array_push($temp, $value->id);
            array_push($temp, $value->username);
            array_push($temp, $value->total_visit);
            array_push($temp, $value->singleVcard()->total_clicked ?? 0);

            array_push($new_data, $temp);
        }


        $response["draw"] = $draw;
        $response["recordsTotal"] = $total_records;
        $response["recordsFiltered"] = $total_filtered;
        $response["data"] = $new_data;

        return $response;
    }

    public function customers(){
        return view("admin.customers");
    }

    public function get_customers(Request $request){

        $draw = $request->get("draw");
        $limit = $request->get("length");
        $offset = $request->get("start");
        $search = $request->get("search")["value"] ?? null;
        
        $query = User::query();

        $total_records = $query->count();
        $query = $query->where(function($query) use($search){
                if(!is_null($search)){
                    $query->where("name", "LIkE", "%$search%");
                }
            });

        $total_filtered = count($query->get());
        $data = $query->skip($offset)
                    ->take($limit)
                    ->get();

        $new_data = [];
        foreach ($data as $key => $value) {
            $temp  = [];
            array_push($temp, $value->id);
            array_push($temp, $value->username);
            array_push($temp, $value->name);
            array_push($temp, $value->email);
            array_push($temp, $value->phone);
            array_push($temp, $value->address);
            array_push($temp, null);

            array_push($new_data, $temp);
        }


        $response["draw"] = $draw;
        $response["recordsTotal"] = $total_records;
        $response["recordsFiltered"] = $total_filtered;
        $response["data"] = $new_data;

        return $response;
    }

    public function delete_customer($id){
        $data = User::find($id);

        if(is_null($data)){
            return redirect()->route("admin.customers")->with(['error' => "user not found"]);
        }
        $data->delete();
        return redirect()->back()->with(['success' => "Success"]);
    }

    public function createCustomer(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'username' => 'required|alpha_num|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|between:8,20',
            'telephone' => 'required|numeric',
        ]);
        try {
            $user = new User;
            $user->name = $request->get("name");
            $user->username = $request->get("username");
            $user->email = $request->get("email");
            $user->password = Hash::make($request->get("password"));
            $user->phone = $request->get("telephone");
            $user->address = $request->get("address");
            $user->bio = $request->get("bio");
    
            $user->save();
            return redirect()->back()->with(['success' => "Success"]);

        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => "Error"]);
        }
    }

    public function editCustomer(Request $request){
        $id = $request->id;
        $data = User::find($id);

        if(is_null($data)){
            return redirect()->route("admin.customers")->with(['error' => "Data not found"]);
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'username' => 'required|alpha_num|unique:users,username,' . $data->id,
            'email' => 'required|email|unique:users,email,' . $data->id,
            'password' => 'nullable|string|between:8,20',
            'telephone' => 'required|numeric',
        ]);

        $data->name = $request->get("name");
        $data->username = $request->get("username");
        $data->email = $request->get("email");
        $password = $request->get("password");
        if(isset($password)){
            $data->password = Hash::make($request->get("password"));
        }
        $data->phone = $request->get("telephone");
        $data->address = $request->get("address");
    
        $data->save();
        return redirect()->back()->with(['success' => "Success"]);
    }
    
    public function social(){
        $link_type = LinkType::all();
        return view("admin.social")->with([
            "data"  => $link_type
        ]);
    }

    public function get_social(Request $request){

        $draw = $request->get("draw");
        $limit = $request->get("length");
        $offset = $request->get("start");
        $search = $request->get("search")["value"] ?? null;
        
        $query = User::query();

        $total_records = $query->count();
        $query = $query->with(['linkTypes', 'contents'])
            ->where(function($query) use($search){
                if(!is_null($search)){
                    $query->where("name", "LIkE", "%$search%");
                }
            });

        $total_filtered = count($query->get());
        $data = $query->skip($offset)
                ->take($limit)
                ->get();

        $link_type = LinkType::all();

        $new_data = [];
        foreach ($data as $key => $value) {
            $temp  = [];
            array_push($temp, $value->id);
            array_push($temp, $value->username);
            
            foreach ($link_type as $real_link) {
                $tempTotal = 0;
                foreach ($value->linkTypes as $link_type) {
                    if($link_type->id == $real_link->id){
                        $tempTotal += $link_type->pivot->total_clicked; 
                    }
                }

                $detail_link = '';
                foreach ($value->contents as $exmp) {
                    if($exmp->link_type_id == $real_link->id ){
                       $detail_link .= '<tr><td>'.$exmp->id.'</td><td>'.($exmp->text ?? '-').'</td><td>'.$exmp->total_clicked.'</td></tr>';
                    }
                }

                if($tempTotal > 0){
                    $tempTotal = ' 
                        <div class="row mx-0">
                            <span class=""> '.$tempTotal.' </span>
                            <button class="px-3 float-right ml-auto btn btn-xs btn-dark" data-toggle="modal" data-target="#exampleModal-'.$value->id.'-'.$real_link->id.'"><i class="fa-solid fa-info"></i></button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-'.$value->id.'-'.$real_link->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Link</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table  class="table table-striped  table-bordered" >
                                    <thead>
                                        <tr>
                                        <th>ID</th>
                                        <th>Link Name</th>
                                        <th>Total Clicked</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    '.$detail_link.'
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>';
                }else{
                    $tempTotal = '<div class="row mx-0">
                        <span class=""> '.$tempTotal.' </span>
                    </div>';
                }
                array_push($temp, $tempTotal);
            }

            array_push($new_data, $temp);
        }


        $response["draw"] = $draw;
        $response["recordsTotal"] = $total_records;
        $response["recordsFiltered"] = $total_filtered;
        $response["data"] = $new_data;

        return $response;
    }

}
