<?php

defined( 'VCW_INDEX' ) or die( '' );

class VCW_Shortcodes
{

    public static function load()
    {
        add_action( 'wp_enqueue_scripts', array(get_class(), 'enqueueAssets') );

        add_filter('widget_text','do_shortcode');

        add_shortcode( 'vcw-price-label', array(get_class(), 'priceLabel'));
        add_shortcode( 'vcw-change-label', array(get_class(), 'changeLabel'));
        add_shortcode( 'vcw-change-big-label', array(get_class(), 'changeBigLabel'));
        add_shortcode( 'vcw-price-big-label', array(get_class(), 'priceBigLabel'));
        add_shortcode( 'vcw-converter', array(get_class(), 'converter'));
        add_shortcode( 'vcw-change-card', array(get_class(), 'changeCard'));
        add_shortcode( 'vcw-price-card', array(get_class(), 'priceCard'));
        add_shortcode( 'vcw-full-card', array(get_class(), 'fullCard'));
        add_shortcode( 'vcw-table', array(get_class(), 'table'));
        add_shortcode( 'vcw-small-table', array(get_class(), 'smallTable'));
    }

    public static function priceLabel($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbol' => 'BTC',
            'color' => 'white',
            'currency' => 'USD',
            'target' => null,
            'url' => null
        ), $attrs );

        return '<vcw-price-label unit-symbol="\''
            .$clean_attrs['symbol']
            .'\'" color-schema="\''
            .$clean_attrs['color']
            .'\'" currency="\''
            .$clean_attrs['currency']
            .'\'" target="\''
            .$clean_attrs['target']
            .'\'" url="\''
            .$clean_attrs['url']
            .'\'"></vcw-price-label>';
    }

    public static function priceCard($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbol' => 'BTC',
            'color' => 'white',
            'currency1' => 'USD',
            'currency2' => 'EUR',
            'currency3' => 'GBP',
            'target' => null,
            'url' => null
        ), $attrs );

        return '<vcw-price-card unit-symbol="\''
            .$clean_attrs['symbol']
            .'\'" color-schema="\''
            .$clean_attrs['color']
            .'\'" currency1="\''
            .$clean_attrs['currency1']
            .'\'" currency2="\''
            .$clean_attrs['currency2']
            .'\'" currency3="\''
            .$clean_attrs['currency3']
            .'\'" target="\''
            .$clean_attrs['target']
            .'\'" url="\''
            .$clean_attrs['url']
            .'\'"></vcw-price-card>';
    }

    public static function changeLabel($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbol' => 'BTC',
            'color' => 'white',
            'target' => '_blank',
            'url' => null
        ), $attrs );

        return '<vcw-change-label unit-symbol="\''
            .$clean_attrs['symbol']
            .'\'" color-schema="\''
            .$clean_attrs['color']
            .'\'" target="\''
            .$clean_attrs['target']
            .'\'" url="\''
            .$clean_attrs['url']
            .'\'"></vcw-change-label>';
    }

    public static function changeBigLabel($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbol' => 'BTC',
            'color' => 'white',
            'target' => '_blank',
            'url' => null
        ), $attrs );

        return '<vcw-change-big-label unit-symbol="\''
            .$clean_attrs['symbol']
            .'\'" color-schema="\''
            .$clean_attrs['color']
            .'\'" target="\''
            .$clean_attrs['target']
            .'\'" url="\''
            .$clean_attrs['url']
            .'\'"></vcw-change-big-label>';
    }

    public static function priceBigLabel($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbol' => 'BTC',
            'color' => 'white',
            'currency1' => 'USD',
            'currency2' => 'EUR',
            'currency3' => 'GBP',
            'target' => '_blank',
            'url' => null
        ), $attrs );

        return '<vcw-price-big-label unit-symbol="\''
            .$clean_attrs['symbol']
            .'\'" color-schema="\''
            .$clean_attrs['color']
            .'\'" currency1="\''
            .$clean_attrs['currency1']
            .'\'" currency2="\''
            .$clean_attrs['currency2']
            .'\'" currency3="\''
            .$clean_attrs['currency3']
            .'\'" target="\''
            .$clean_attrs['target']
            .'\'" url="\''
            .$clean_attrs['url']
            .'\'"></vcw-price-big-label>';
    }

    public static function changeCard($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbol' => 'BTC',
            'color' => 'white',
            'target' => '_blank',
            'url' => null
        ), $attrs );

        return '<vcw-change-card unit-symbol="\''
            .$clean_attrs['symbol']
            .'\'" color-schema="\''
            .$clean_attrs['color']
            .'\'" target="\''
            .$clean_attrs['target']
            .'\'" url="\''
            .$clean_attrs['url']
            .'\'"></vcw-change-card>';
    }

    public static function fullCard($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbol' => 'BTC',
            'color' => 'white',
            'currency1' => 'USD',
            'currency2' => 'EUR',
            'currency3' => 'GBP',
            'target' => '_blank',
            'url' => null
        ), $attrs );


        return '<vcw-full-card unit-symbol="\''
            .$clean_attrs['symbol']
            .'\'" color-schema="\''
            .$clean_attrs['color']
            .'\'" currency1="\''
            .$clean_attrs['currency1']
            .'\'" currency2="\''
            .$clean_attrs['currency2']
            .'\'" currency3="\''
            .$clean_attrs['currency3']
            .'\'" target="\''
            .$clean_attrs['target']
            .'\'" url="\''
            .$clean_attrs['url']
            .'\'"></vcw-full-card>';
    }

    public static function converter($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbol1' => 'BTC',
            'symbol2' => 'USD',
            'color' => 'white'
        ), $attrs );

        return '<vcw-converter color-schema="\''
            .$clean_attrs['color']
            .'\'" symbol1="\''
            .$clean_attrs['symbol1']
            .'\'" symbol2="\''
            .$clean_attrs['symbol2']
            .'\'"></vcw-converter>';
    }

    public static function table($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbols' => 'BTC,ETH,XRP,LTC,XMR',
            'color' => 'white',
            'currency' => 'USD'
        ), $attrs );

        return '<vcw-table symbol-list="\''
            .$clean_attrs['symbols']
            .'\'" color-schema="\''
            .$clean_attrs['color']
            .'\'" currency="\''
            .$clean_attrs['currency']
            .'\'"></vcw-table>';
    }

    public static function smallTable($attrs)
    {

        $clean_attrs = shortcode_atts( array(
            'symbols' => 'BTC,ETH,XRP,LTC,XMR',
            'color' => 'white',
            'currency' => 'USD'
        ), $attrs );

        return '<vcw-small-table symbol-list="\''
            .$clean_attrs['symbols']
            .'\'" color-schema="\''
            .$clean_attrs['color']
            .'\'" currency="\''
            .$clean_attrs['currency']
            .'\'"></vcw-small-table>';
    }

    public static function enqueueAssets()
    {
        wp_enqueue_script('jquery', '', array(), false, true);
        wp_enqueue_script('angularjs','https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js', array('jquery'), '1.5.6', true);
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');
        wp_enqueue_style('vcw-style', VCW_URL.'css/vcw.css', array('font-awesome'), '1.1');
        wp_enqueue_script('money-js','https://cdnjs.cloudflare.com/ajax/libs/money.js/0.2.0/money.min.js', array(), '0.2.0', true);
        wp_register_script('vcw-script', VCW_URL.'js/vcw.min.js', array('jquery','angularjs','money-js'), '1.1', true);
        wp_localize_script('vcw-script', 'VCWConstants', array(
            'urls' => array(
                'ajax' => VCW_AJAX_URL
            ),
            'data' => VCW_Data::$data
        ));
        wp_enqueue_script('vcw-script');

        wp_enqueue_script('vcw-loader', VCW_URL.'js/loader.js', array('vcw-script'), '1.1', true);

    }
}

VCW_Shortcodes::load();