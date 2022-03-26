<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\User;
use App\Content;
use App\ContentType;
use App\LinkType;
use App\Vcard;
use Auth;
use Carbon\Carbon;
use JeroenDesloovere\VCard\VCard as VCard2;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function profile(){
        $id_user = Auth::user()->id;
        $user = User::findOrFail($id_user);
        $list_contents = Content::with(['contentType','linkType'])->where("id_user", $id_user)->orderBy('order_number')->get();
        return view("user.profile")->with([
            "data"   => $user,
            "list_contents"    => $list_contents,
        ]);
    }

    public function change_password(){
        return view("user.change_password");
    }

    public function qrcode(){
        $user = User::findOrFail(Auth::user()->id);
        return view("user.qrcode")->with(["data"    => $user]);
    }

    public function vcard(){
        $data = Vcard::where("user_id", Auth::user()->id)->first();
        return view("user.vcard")->with(["data" => $data]);
    }

    public function vcard_post(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'business' => 'nullable|string',
            'telephone' => 'required|numeric',
            'address' => 'nullable|string',
            'site_1' => 'nullable|string',
            'site_2' => 'nullable|string',
            'site_3' => 'nullable|string',
        ]);
        try {
            $id_user = Auth::user()->id;

            $vcard = Vcard::where("user_id", $id_user)->first();
            if($vcard == null){
                $vcard = new Vcard;
            }
            $vcard->user_id = Auth::user()->id;
            $vcard->name = $request->get("name");
            $vcard->business = $request->get("business");
            $vcard->phone = $request->get("telephone");
            $vcard->address = $request->get("address");
            $vcard->site_1 = $request->get("site_1");
            $vcard->site_2 = $request->get("site_2");
            $vcard->site_3 = $request->get("site_3");
            $vcard->save();

            return redirect()->back()->with(['success' => 'Success create vcard']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function downloadQRCode(){
        $qr_type = 'jpg';
        $imageName  = 'qr-code.svg';
        $headers    = array('Content-Type' => ['png','svg','eps']);
        $type       = $qr_type == 'jpg' || $qr_type == 'transparent' ? 'png' : $request->qr_type;
        $image      = \QrCode::format($type)
                     ->size(200)->errorCorrection('H')
                     ->generate('codingdriver');

        \Storage::disk('public')->put($imageName.'.svg', $image);

        // if ($qr_type == 'jpg') {
        //     $type = 'jpg';
        //     $image = imagecreatefrompng('storage/'.$imageName);
        //     imagejpeg($image, 'storage/'.$imageName, 100);
        //     imagedestroy($image);
        // }

        return response()->download('storage/'.$imageName, $imageName.'.'.$type, $headers)->deleteFileAfterSend();
    }

    public function setting(){
        $id_user = Auth::user()->id;
        $user = User::findOrFail($id_user);
        return view("user.setting")->with(["data"   => $user]);
    }

    public function link(){
        $id_user = Auth::user()->id;
        $list_content_types = ContentType::all();
        $list_link_types = LinkType::all();
        $list_contents = Content::with(['contentType','linkType'])->where("id_user", $id_user)->orderBy('order_number')->get();
        $user = User::findOrFail($id_user);

        // return $list_contents;
        return view("user.link")->with([
            "list_content_types"    => $list_content_types,
            "list_link_types"    => $list_link_types,
            "list_contents"    => $list_contents,
            "data"              => $user
        ]);
    }

    public function update_profile(Request $request){
        $user = User::findOrFail(Auth::user()->id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'username' =>  [
                'required',
                'alpha_num',
                Rule::unique('users')->ignore($user->id),
            ],
            'bio' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:5120',
        ]);

        $image_path = null;
        if($request->has("image") != null){
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('images'), $imageName);
            $image_path = '/images/'.$imageName;
        }

        $user->name = $request->get("name");
        $user->bio = $request->get("bio");
        $user->address = $request->get("address");
        $user->username = $request->get("username");
        $user->frame_color = $request->get("frame_color");
        $user->background_color = $request->get("background_color");
        $user->save_color = $request->get("save_color");
        $user->is_address_displayed = $request->get("is_address_displayed") != null ? 1 : 0;
        $user->is_username_displayed = $request->get("is_username_displayed") != null ? 1 : 0;

        if(!is_null($image_path)){
            $user->photo = $image_path;
        }
        $user->save();

        return redirect()->back()->with(['success' => 'Success update profile']);
    }

    public function addDivider(Request $request){
        $id_user = Auth::user()->id;
        $last_content = Content::where("id_user", $id_user)->orderBy("order_number", "DESC")->first();

        $order_number = $last_content == null ? 1 : $last_content->order_number + 1;

        $id = Content::insertGetId([
            "id_user"           => $id_user,
            "order_number"      => $order_number,
            "content_type_id"   => 2,
            "created_at"        => Carbon::now()
        ]);

        return response()->json([
            "status"    => true,
            "message"   => "success",
            "data"      => $id
        ]);
    }

    public function addText(Request $request){
        $id_user = Auth::user()->id;
        $last_content = Content::where("id_user", $id_user)->orderBy("order_number", "DESC")->first();

        $order_number = $last_content == null ? 1 : $last_content->order_number + 1;

        $id = Content::insertGetId([
            "id_user"           => $id_user,
            "order_number"      => $order_number,
            "content_type_id"   => 3,
            "created_at"        => Carbon::now()
        ]);

        return response()->json([
            "status"    => true,
            "message"   => "success",
            "data"      => $id
        ]);
    }

    public function update_text(Request $request, $id){
        $content = Content::find($id);
        $content->text = $request->get("text");
        $content->text_color = $request->get("text_color");
        $content->text_align = $request->get("text_align");

        $content->save();

        return response()->json([
            "status"    => true,
            "message"   => "success"
        ]);
    }

    public function delete_item($id){
        Content::where("id", $id)->delete();
        return response()->json([
            "status"    => true,
            "message"   => "success"
        ]);
    }

    public function add_link(Request $request){
        $id_user = Auth::user()->id;
        $last_content = Content::where("id_user", $id_user)->orderBy("order_number", "DESC")->first();

        $order_number = $last_content == null ? 1 : $last_content->order_number + 1;
        $linkType = LinkType::find(1);


        $id = Content::insertGetId([
            "id_user"           => $id_user,
            "order_number"      => $order_number,
            "content_type_id"   => 1,
            "link_type_id"      => $linkType->id,
            "is_icon_displayed" => 1,
            "created_at"        => Carbon::now()
        ]);

        return response()->json([
            "status"    => true,
            "message"   => "success",
            "data"      => $id
        ]);
    }

    public function update_link(Request $request, $id){

        $content = Content::find($id);
        $content->link_type_id = $request->get("link_type_id");
        $content->text = $request->get("text");
        $content->link = $request->get("link");
        $content->text_color = $request->get("text_color");
        $content->button_color = $request->get("button_color");
        $content->is_icon_displayed = $request->get("is_icon_displayed") == "true" ? 1 : 0;
        $content->is_content_displayed = $request->get("is_content_displayed") == "true" ? 1 : 0;

        $content->save();

        return response()->json([
            "status"    => true,
            "message"   => "success"
        ]);
    }

    public function update_order(Request $request){
        $lists = json_decode($request->lists);

        foreach ($lists as $index => $id) {
            $content = Content::find($id);
            $content->order_number = $index + 1;
            $content->save();
        }

        return response()->json([
            "status"    => true,
            "message"   => "success",
        ]);
    }

    function downloadVcard($id){

        $data = Vcard::where("user_id", $id)->first();

        if($data == null ){
            abort(404);
        }

        $data->total_clicked = $data->total_clicked + 1;
        $data->save();

        $vcard = new VCard2();
        $lastname = $data->name;
        $firstname = '';
        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

        // add work data
        $vcard->addCompany($data->business);
        $vcard->addPhoneNumber($data->phone);
        $vcard->addAddress(null, null, $data->address, null, null, null, null);
        $vcard->addURL($data->site_1." ".$data->site_2." ".$data->site_3);
        
        $response = new Response();
        $response->setContent($vcard->getOutput());
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/x-vcard');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $data->name . '.vcf"');
        $response->headers->set('Content-Length', mb_strlen($vcard->getOutput(), 'utf-8'));

        return $response;
    }

    function preview(){
        $id_user = Auth::user()->id;
        $user =User::findOrFail($id_user);

        $list_contents = Content::with(['contentType','linkType'])->where("id_user", $id_user)->orderBy('order_number')->get();
        return view("user.preview_profile")->with([
            "data"   => $user,
            "list_contents"    => $list_contents,
        ]);
    }

    function profile_user($username){
        $user =User::where("username", $username)->first();
        if($user == null){
            abort(404);
        }

        $user->total_visit = $user->total_visit + 1;
        $user->save();

        $list_contents = Content::with(['contentType','linkType'])->where("id_user", $user->id)->orderBy('order_number')->get();
        return view("user.preview_real_profile")->with([
            "data"   => $user,
            "list_contents"    => $list_contents,
        ]);
    }

    function openLink($id){
        $data = Content::findOrFail($id);

        $data->total_clicked = $data->total_clicked + 1;
        $data->save();

        $prefix = $data->linkType->prefix;
        $url = $prefix.$data->link;

        return redirect()->to($url);
    }

    function downloadVcardPreview(){

        $id_user = Auth::user()->id;

        $data = Vcard::where("user_id", $id_user)->first();

        if($data == null ){
            abort(404);
        }

        $vcard = new VCard2();
        $lastname = $data->name;
        $firstname = '';
        $additional = '';
        $prefix = '';
        $suffix = '';

        // add personal data
        $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

        // add work data
        $vcard->addCompany($data->business);
        $vcard->addPhoneNumber($data->phone);
        $vcard->addAddress(null, null, $data->address, null, null, null, null);
        $vcard->addURL($data->site_1." ".$data->site_2." ".$data->site_3);
        
        $response = new Response();
        $response->setContent($vcard->getOutput());
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/x-vcard');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $data->name . '.vcf"');
        $response->headers->set('Content-Length', mb_strlen($vcard->getOutput(), 'utf-8'));

        return $response;
    }
}
