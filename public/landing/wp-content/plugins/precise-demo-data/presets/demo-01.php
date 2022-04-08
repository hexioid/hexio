<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_demo_01(){
    return array(
        array(
            'key' => 'header_full_width',
            'value' => 'yes'
        ),
        array(
            'key' => 'header_transparency',
            'value' => 'no'
        ),
        array(
            'key' => 'enable_header_top',
            'value' => 'hide'
        ),
        array(
            'key' => 'header_layout',
            'value' => 4
        ),

        array(
            'key' => 'header_access_icon',
            'value' => array(
                array(
                    'type' => 'search_1',
                    'el_class' => ''
                ),
                array(
                    'type' => 'cart',
                    'link' => '#',
                    'el_class' => ''
                )
            )
        ),

        array(
            'key' => 'footer_layout',
            'value' => '4col3333'
        ),
        array(
            'key' => 'footer_full_width',
            'value' => 'no'
        ),
        array(
            'key' => 'enable_footer_copyright',
            'value' => 'no'
        ),


        array(
            'filter_name' => 'precise/filter/footer_column_1',
            'value' => 'footer-small-logo-black'
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
        /** COLOR  */


        array(
            'key' => 'footer_background',
            'value' => array(
                'color' => '#fff'
            )
        ),
        array(
            'key' => 'footer_heading_color',
            'value' => '#232324'
        ),
        array(
            'key' => 'footer_text_color',
            'value' => '#8a8a8a'
        ),
        array(
            'key' => 'footer_link_color',
            'value' => '#8a8a8a'
        ),
        array(
            'key' => 'footer_link_hover_color',
            'value' => '#e9595e'
        )
    );
}