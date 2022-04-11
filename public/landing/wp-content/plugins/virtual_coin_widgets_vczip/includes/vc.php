<?php

defined( 'VCW_INDEX' ) or die( '' );

class VCW_VisualComposer
{
    static $colors;
    static $targets;
    static $icon_url;
    static $text_domain = 'vcw-text';
    static $all_symbols = array();
    static $all_currencies = array();
    static $fields = array();

    static public function load()
    {
        add_action( 'vc_before_init', array(get_class(), 'initForVC' ) );
    }

    static protected function prepare()
    {

        self::$icon_url = VCW_URL.'assets/icons/icon.png';

        self::$colors = array(
            __('Red', self::$text_domain) => 'red',
            __('Pink', self::$text_domain) => 'pink',
            __('Purple', self::$text_domain) => 'purple',
            __('Deep Purple', self::$text_domain) => 'deep_purple',
            __('Indigo', self::$text_domain) => 'indigo',
            __('Blue', self::$text_domain) => 'blue',
            __('Light Blue', self::$text_domain) => 'light_blue',
            __('Cyan', self::$text_domain) => 'cyan',
            __('Teal', self::$text_domain) => 'teal',
            __('Green', self::$text_domain) => 'green',
            __('Light Green', self::$text_domain) => 'light_green',
            __('Lime', self::$text_domain) => 'lime',
            __('Yellow', self::$text_domain) => 'yellow',
            __('Amber', self::$text_domain) => 'amber',
            __('Orange', self::$text_domain) => 'orange',
            __('Deep Orange', self::$text_domain) => 'deep_orange',
            __('Brown', self::$text_domain) => 'brown',
            __('Grey', self::$text_domain) => 'grey',
            __('Blue Grey', self::$text_domain) => 'blue_grey',
            __('Black', self::$text_domain) => 'black',
            __('White', self::$text_domain) => 'white'
        );

        self::$targets = array(
            __('New Tab', self::$text_domain) => '_blank',
            __('Same Tab', self::$text_domain) => '_self',
        );

        if(is_array(VCW_Data::$data['cmc'])){
            foreach (VCW_Data::$data['cmc'] as $crypto){
                self::$all_symbols[$crypto['name']] = $crypto['symbol'];
            }
        }

        self::$all_currencies = VCW_Data::$data['currencies'];


        self::$fields = array(
            'color' => array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Color', self::$text_domain),
                'param_name' => 'color',
                'value' => self::$colors,
                'description' => __('Choose a display color', self::$text_domain),
                'std' => 'white'
            ),
            'symbol' => array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Symbol', self::$text_domain),
                'param_name' => 'symbol',
                'value' => self::$all_symbols,
                'description' => __('Symbol of cryptocurrency', self::$text_domain),
                'std' => 'BTC'
            ),
            'symbol_1' => array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Symbol #1', self::$text_domain),
                'param_name' => 'symbol1',
                'value' => self::$all_currencies,
                'description' => __('Symbol of default currency #1', self::$text_domain),
                'std' => 'BTC'
            ),
            'symbol_2' => array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Symbol #2', self::$text_domain),
                'param_name' => 'symbol2',
                'value' => self::$all_currencies,
                'description' => __('Symbol of default currency #2', self::$text_domain),
                'std' => 'ETH'
            ),
            'symbol_list' => array(
                'type' => 'textfield',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Symbols', self::$text_domain),
                'param_name' => 'symbols',
                'value' => 'BTC,ETH,XRP,LTC,XMR',
                'description' => __('Cryptocurrencies symbols (Comma separated)', self::$text_domain),
                'std' => 'BTC,ETH,XRP,LTC,XMR'
            ),
            'currency' => array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Price Currency', self::$text_domain),
                'param_name' => 'currency',
                'value' => self::$all_currencies,
                'description' => __('Choose a price currency', self::$text_domain),
                'std' => 'USD'
            ),
            'currency_1' => array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Price Currency #1', self::$text_domain),
                'param_name' => 'currency1',
                'value' => self::$all_currencies,
                'description' => __('Choose a price currency #1', self::$text_domain),
                'std' => 'USD'
            ),
            'currency_2' => array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Price Currency #2', self::$text_domain),
                'param_name' => 'currency2',
                'value' => self::$all_currencies,
                'description' => __('Choose a price currency #2', self::$text_domain),
                'std' => 'EUR'
            ),
            'currency_3' => array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Price Currency #3', self::$text_domain),
                'param_name' => 'currency3',
                'value' => self::$all_currencies,
                'description' => __('Choose a price currency #3', self::$text_domain),
                'std' => 'GBP'
            ),
            'url' => array(
                'type' => 'textfield',
                'holder' => 'div',
                'class' => '',
                'heading' => __('URL', self::$text_domain),
                'param_name' => 'url',
                'value' => '',
                'description' => __('Choose the redirection URL (Leave empty for disable)', self::$text_domain),
                'std' => ''
            ),
            'target' => array(
                'type' => 'dropdown',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Target', self::$text_domain),
                'param_name' => 'target',
                'value' => array(
                    __('New Tab', self::$text_domain) => '_blank',
                    __('Same Tab', self::$text_domain) => '_self',
                ),
                'description' => __('Choose the redirection behaviour', self::$text_domain),
                'std' => '_blank'
            )
        );


    }

    static public function showVcNotice()
    {
        $plugin_data = get_plugin_data(VCW_INDEX);
        echo '<div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="https://goo.gl/hOLa2K" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
    }

    static public function initForVC()
    {

        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            add_action('admin_notices', array(get_class(), 'showVcNotice' ));
            return;
        }

        self::prepare();

        if(function_exists('vc_map')){
            self::mapChangeLabel();
            self::mapChangeBigLabel();
            self::mapChangeCard();
            self::mapPriceLabel();
            self::mapPriceBigLabel();
            self::mapPriceCard();
            self::mapFullCard();
            self::mapConverter();
            self::mapTable();
            self::mapSmallTable();
        }

    }

    static public function mapChangeLabel()
    {
        vc_map( array(
            'name' => __('VCW Change Label', self::$text_domain),
            'description' => __('1h percentage change', self::$text_domain),
            'base' => 'vcw-change-label',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['symbol'],
                self::$fields['url'],
                self::$fields['target']
            )
        ) );
    }

    static public function mapChangeBigLabel()
    {
        vc_map( array(
            'name' => __('VCW Change Big Label', self::$text_domain),
            'description' => __('1h percentage change', self::$text_domain),
            'base' => 'vcw-change-big-label',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['symbol'],
                self::$fields['url'],
                self::$fields['target']
            )
        ) );
    }

    static public function mapChangeCard()
    {
        vc_map( array(
            'name' => __('VCW Change Card', self::$text_domain),
            'description' => __('1h, 24h & 7d percentage changes', self::$text_domain),
            'base' => 'vcw-change-card',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['symbol'],
                self::$fields['url'],
                self::$fields['target']
            )
        ) );
    }

    static public function mapPriceLabel()
    {
        vc_map( array(
            'name' => __('VCW Price Label', self::$text_domain),
            'description' => __('Show current price', self::$text_domain),
            'base' => 'vcw-price-label',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['symbol'],
                self::$fields['currency'],
                self::$fields['url'],
                self::$fields['target']
            )
        ) );
    }

    static public function mapPriceBigLabel()
    {
        vc_map( array(
            'name' => __('VCW Price Big Label', self::$text_domain),
            'description' => __('Show current price', self::$text_domain),
            'base' => 'vcw-price-big-label',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['symbol'],
                self::$fields['currency_1'],
                self::$fields['currency_2'],
                self::$fields['currency_3'],
                self::$fields['url'],
                self::$fields['target']
            )
        ) );
    }

    static public function mapPriceCard()
    {
        vc_map( array(
            'name' => __('VCW Price Card', self::$text_domain),
            'description' => __('Show current price', self::$text_domain),
            'base' => 'vcw-price-card',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['symbol'],
                self::$fields['currency_1'],
                self::$fields['currency_2'],
                self::$fields['currency_3'],
                self::$fields['url'],
                self::$fields['target']
            )
        ) );
    }

    static public function mapFullCard()
    {
        vc_map( array(
            'name' => __('VCW Full Card', self::$text_domain),
            'description' => __('Show current price and 1h, 24h & 7d changes', self::$text_domain),
            'base' => 'vcw-full-card',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['symbol'],
                self::$fields['currency_1'],
                self::$fields['currency_2'],
                self::$fields['currency_3'],
                self::$fields['url'],
                self::$fields['target']
            )
        ) );
    }

    static public function mapConverter()
    {
        vc_map( array(
            'name' => __('VCW Converter', self::$text_domain),
            'description' => __('Currency converter', self::$text_domain),
            'base' => 'vcw-converter',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['symbol_1'],
                self::$fields['symbol_2']
            )
        ) );
    }

    static public function mapTable()
    {
        vc_map( array(
            'name' => __('VCW Table', self::$text_domain),
            'description' => __('Display multiple currencies', self::$text_domain),
            'base' => 'vcw-table',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['currency'],
                self::$fields['symbol_list']
            )
        ) );
    }

    static public function mapSmallTable()
    {
        vc_map( array(
            'name' => __('VCW Small Table', self::$text_domain),
            'description' => __('Display multiple currencies', self::$text_domain),
            'base' => 'vcw-small-table',
            'class' => '',
            'controls' => 'full',
            'icon' => self::$icon_url,
            'category' => __('Virtual Coin Widgets', self::$text_domain),
            'params' => array(
                self::$fields['color'],
                self::$fields['currency'],
                self::$fields['symbol_list']
            )
        ) );
    }

}

VCW_VisualComposer::load();