<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_demo_11(){
    return array(

        array(
            'key' => 'header_full_width',
            'value' => 'no'
        ),
        array(
            'key' => 'header_transparency',
            'value' => 'no'
        ),
        array(
            'key' => 'enable_header_top',
            'value' => 'yes'
        ),
        array(
            'key' => 'header_layout',
            'value' => 5
        ),

        array(
            'key' => 'header_access_icon',
            'value' => array(
                array(
                    'type' => 'dropdown_menu',
                    'menu_id' => 47,
                    'icon' => 'fa fa-user-circle-o'
                ),
                array(
                    'type' => 'wishlist'
                ),
                array(
                    'type' => 'cart'
                )
            )
        ),

        array(
            'key' => 'header_top_elements',
            'value' => array (
                array (
                    'type' => 'text',
                    'icon' => 'fa fa-mobile-phone',
                    'text' => '+44. 54.343.54',
                    'menu_id' => '47'
                ),
                array (
                    'type' => 'link_text',
                    'icon' => 'fa fa-envelope-o',
                    'text' => 'info@la-studioweb.com',
                    'link' => 'maito:info@la-studioweb.com',
                    'el_class' => 'hidden-xs'
                ),
                array (
                    'type' => 'text',
                    'icon' => 'fa fa-clock-o',
                    'text' => 'Mon-Sat: 8am-9pm',
                    'el_class' => 'hidden-xs'
                ),
                array (
                    'type' => 'dropdown_menu',
                    'text' => 'LANGUAGE',
                    'menu_id' => '71',
                    'el_class' => 'item-menu-language'
                ),
                array (
                    'type' => 'dropdown_menu',
                    'text' => 'CURRENCY',
                    'menu_id' => '72',
                    'el_class' => 'item-menu-currenry'
                )
            )
        ),

        array(
            'key' => 'header_height',
            'value' => 120
        ),


        array(
            'key' => 'footer_layout',
            'value' => '5col32223'
        ),
        array(
            'key' => 'footer_full_width',
            'value' => 'yes'
        ),
        array(
            'key' => 'enable_footer_copyright',
            'value' => 'no'
        ),


        array(
            'filter_name' => 'precise/filter/footer_column_1',
            'value' => 'footer-logo-with-social'
        ),
        array(
            'filter_name' => 'precise/filter/footer_column_2',
            'value' => 'footer-useful-link'
        ),
        array(
            'filter_name' => 'precise/filter/footer_column_3',
            'value' => 'footer-company'
        ),
        array(
            'filter_name' => 'precise/filter/footer_column_4',
            'value' => 'footer-profile'
        ),
        array(
            'filter_name' => 'precise/filter/footer_column_5',
            'value' => 'footer-instagram'
        ),
        /** COLOR  */

        array(
            'key' => 'transparency_header_text_color|transparency_header_link_color|transparency_mm_lv_1_color|transparency_header_top_text_color|transparency_header_top_link_color',
            'value' => '#232324'
        ),

        array(
            'key' => 'la_custom_css',
            'value' => '.site-header__nav-primary {
    background-color: #000;
}'
        ),
        array(
            'key' => 'mm_lv_1_color',
            'value' => '#fff'
        )
    );
}