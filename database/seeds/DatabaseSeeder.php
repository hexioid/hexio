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
                "placeholder"    => "62821xxxxxxxx",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "https://youtube.com/",
                "type"  => "Youtube",
                "icon"    => "fa-brands fa-youtube",
                "placeholder"    => "channel",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => null,
                "type"  => "Website",
                "icon"    => "fa-solid fa-globe",
                "placeholder"    => "https://",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => null,
                "type"  => "Online Store",
                "icon"    => "fa-solid fa-store",
                "placeholder"    => "https://",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => null,
                "type"  => "Line",
                "icon"    => "fa-brands fa-line",
                "placeholder"    => "https://",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "tel:",
                "type"  => "Nomor Handphone",
                "icon"    => "fa-solid fa-mobile-screen-button",
                "placeholder"    => "62821xxxxxxxx",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "https://www.linkedin.com/",
                "type"  => "Linkedin",
                "icon"    => "fa-brands fa-linkedin",
                "placeholder"    => "username",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => null,
                "type"  => "Maps",
                "icon"    => "fa-solid fa-location-dot",
                "placeholder"    => "https://",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "mailto:",
                "type"  => "Email",
                "icon"    => "fa-solid fa-envelope",
                "placeholder"    => "email@xxx.xxx",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "https://telegram.me/",
                "type"  => "Telegram",
                "icon"    => "fa-solid fa-paper-plane",
                "placeholder"    => "username",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => "tel:",
                "type"  => "Nomor Telepon",
                "icon"    => "fa-solid fa-phone",
                "placeholder"    => "62821xxxxxxxx",
                "created_at"    => $current_time
            ],
            [
                "prefix"    => null,
                "type"  => "Lainnya",
                "icon"    => "fa-solid fa-link",
                "placeholder"    => "https://",
                "created_at"    => $current_time
            ],
        ]);
    }
}
