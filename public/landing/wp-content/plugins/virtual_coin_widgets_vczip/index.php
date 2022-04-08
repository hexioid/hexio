<?php

/*
Plugin Name: Virtual Coin Widgets For Visual Composer
Plugin URI: https://codecanyon.net/user/runcoders/portfolio
Description: You need <strong>cryptocurrencies information</strong> displayed in your page? Here you have, in a mix of pretty <strong>widgets</strong> for <strong>700+ virtual currencies</strong>.
Version: 10
Tags: cryptocurrencies, virtual coin, bitcoin, ethereum, ripple, litecoin, dogecoin, market cap
Author: RunCoders
Author URI: https://codecanyon.net/user/runcoders
*/

defined( 'ABSPATH' ) or die( '' );

define('VCW_VERSION', '1.2');
define('VCW_URL', plugin_dir_url(__FILE__));
define('VCW_ROOT', plugin_dir_path(__FILE__));
define('VCW_INCLUDES', VCW_ROOT.'includes/');
define('VCW_INDEX', __FILE__);
define('VCW_AJAX_URL', admin_url( 'admin-ajax.php' ));



class VCW_Init
{

    public static function load()
    {
        require_once VCW_INCLUDES.'data.php';
        require_once VCW_INCLUDES.'shortcodes.php';
        require_once VCW_INCLUDES.'admin.php';
        require_once VCW_INCLUDES.'vc.php';
    }

}

VCW_Init::load();