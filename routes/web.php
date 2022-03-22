<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("page/login");
});

Route::get("/{username}", "UserController@profile_user");

Route::group([
    "prefix"    => "page"
], function(){
    Route::get("/register", "AuthController@create");
    Route::post("/register", "AuthController@store");
    Route::get("/login", "AuthController@login")->name("login");
    Route::post("/login", "AuthController@login_post");
    Route::get("open_link/{id}", "UserController@openLink");
    Route::get("/forget-password", function(){
        return view("user.forget_password");
    });
});



Route::group([
    "middleware"    => "auth",
    "prefix"        => "page"
], function(){
    Route::get("/logout", "AuthController@logout");
    Route::post("/change-password", "AuthController@change_password");

    // ==================================================================
    Route::get("/vcard", "UserController@vcard");
    Route::post("/vcard", "UserController@vcard_post");
    Route::get("/profile", "UserController@profile");
    Route::get("/change-password", "UserController@change_password");
    Route::get("/qrcode", "UserController@qrcode");
    Route::get('download-qr-cod', 'UserController@downloadQRCode');
    Route::get('setting', 'UserController@setting');
    Route::get('link', 'UserController@link');
    Route::post("update-profile", "UserController@update_profile");

    
    // ==========================================================
    Route::get("add_divider", "UserController@addDivider");

    
    // ==========================================================
    Route::get("add_text", "UserController@addText");
    Route::post("update_text/{id}", "UserController@update_text");
    Route::get("delete_item/{id}", "UserController@delete_item");

    
    // ==========================================================
    Route::get("add_link", "UserController@add_link");
    Route::post("update_link/{id}", "UserController@update_link");



    
    Route::post("update_order", "UserController@update_order");
    Route::get("download_vcard", "UserController@downloadVcard");
    Route::get("download_vcard_preview", "UserController@downloadVcardPreview");
    Route::get("/preview", "UserController@preview");
});

Route::group([
    "prefix"    => "admin"
], function(){
    Route::get("login", "AdminController@login");
    Route::get("dashboard", "AdminController@dashboard");
});









