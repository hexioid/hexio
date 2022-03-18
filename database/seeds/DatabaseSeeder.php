<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\ContentType;
use App\Content;
use App\LinkType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $current_time = Carbon::now();
        ContentType::insert([
            [
                "type"  => "LINK",
                "created_at"    => $current_time
            ],
            [
                "type"  => "DIVIDER",
                "created_at"    => $current_time
            ],
            [
                "type"  => "TEXT",
                "created_at"    => $current_time
            ],
        ]);

        LinkType::insert([
            [
                "prefix"    => "https://instagram.com/",
                "type"  => "Instagram",
                "icon"    => "fa-brands fa-instagram",
                "placeholder"    => "username",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "https://twitter.com/",
                "type"  => "Twitter",
                "icon"    => "fa-brands fa-twitter",
                "placeholder"    => "username",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "https://facebook.com/",
                "type"  => "Facebook",
                "icon"    => "fa-brands fa-facebook-f",
                "placeholder"    => "username",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "https://wa.me/",
                "type"  => "Whatsapp",
                "icon"    => "fa-brands fa-whatsapp",
                "placeholder"    => "0821xxxxxxxx",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "https://youtube.com/",
                "type"  => "Youtube",
                "icon"    => "fa-brands fa-youtube",
                "placeholder"    => "channel/xxxxxx",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => null,
                "type"  => "Website",
                "icon"    => null,
                "placeholder"    => "https://",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => null,
                "type"  => "Online Store",
                "icon"    => null,
                "placeholder"    => "https://",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => null,
                "type"  => "Line",
                "icon"    => null,
                "placeholder"    => "https://",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "tel:",
                "type"  => "Nomor Handphone",
                "icon"    => null,
                "placeholder"    => "0821xxxxxxxx",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => null,
                "type"  => "Lainnya",
                "icon"    => null,
                "placeholder"    => "https://",
                "created_at"    => $current_time
            ],
        ]);
    }
}
