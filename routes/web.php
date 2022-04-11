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
    return redirect()->to("https://hexio.id/landing/");
});

Route::get("/{username}", "UserController@profile_user");

Route::group([
    "prefix"    => "page"
], function(){
    Route::get("/register", "AuthController@create");
    Route::get("download_vcard/{id}", "UserController@downloadVcard");
    Route::post("/register", "AuthController@store");
    Route::get("/login", "AuthController@login")->name("login");
    Route::post("/login", "AuthController@login_post");
    Route::get("open_link/{id}", "UserController@openLink");
    Route::get("/forget-password", function(){
        return view("user.forget_password");
    });
    Route::post("/forget", "AuthController@forget_password");
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
    Route::get("download_vcard_preview", "UserController@downloadVcardPreview");
    Route::get("/preview", "UserController@preview");
});




Route::group([
    "prefix"    => "admin"
], function(){

    Route::get('login', 'AdminController@login')->name('admin.login');
    Route::post('login', 'AdminController@loginPost')->name('admin.login.post');
    Route::get('logout', 'AdminController@logout')->name('admin.logout');
    Route::get("register", 'AdminController@register');

    Route::group([
        "middleware"    => "admin"
    ], function(){
        // Vcard
        Route::get("vcards", "AdminController@vcards")->name("admin.vcards");
        Route::get("get_vcards", "AdminController@get_vcards")->name("admin.get_vcards");
        Route::get("vcard/{id}/delete", "AdminController@delete_vcard")->name("admin.delete_vcard");
        Route::post("vcard/edit", "AdminController@editVcard")->name("admin.edit_vcard");
        Route::post("vcard/create", "AdminController@createVcard")->name("admin.create_vcard");


        // Traffic
        Route::get("traffics", "AdminController@traffics")->name("admin.traffics");
        Route::get("get_traffics", "AdminController@get_traffics")->name("admin.get_traffics");

        // Customers
        Route::get("customers", "AdminController@customers")->name("admin.customers");
        Route::get("get_customers", "AdminController@get_customers")->name("admin.get_customers");
        Route::get("customer/{id}/delete", "AdminController@delete_customer")->name("admin.delete_customer");
        Route::post("customer/edit", "AdminController@editCustomer")->name("admin.edit_customer");
        Route::post("customer/create", "AdminController@createCustomer")->name("admin.create_customer");

        // Social Media
        Route::get("social", "AdminController@social")->name("admin.social");
        Route::get("get_social", "AdminController@get_social")->name("admin.get_social");

        Route::get("export-customers", "AdminController@exportCustomers")->name("admin.export-customers");
        Route::get("export-vcards", "AdminController@exportVcards")->name("admin.export-vcards");
        Route::get("export-traffics", "AdminController@exportTraffics")->name("admin.export-traffics");
        Route::get("export-social-media", "AdminController@exportSocialMedia")->name("admin.export-social-media");

    });
});









