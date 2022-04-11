<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_demo_12(){
    return array(
        array(
            'key' => 'header_full_width',
            'value' => 'yes'
        ),
        array(
            'key' => 'header_transparency',
            'value' => 'yes'
        ),
        array(
            'key' => 'enable_header_top',
            'value' => 'hide'
        ),
        array(
            'key' => 'header_layout',
            'value' => 6
        ),


        array(
            'key' => 'main_full_width',
            'value' => 'yes'
        ),


        array(
            'filter_name' => 'precise/filter/footer_column_1',
            'value' => 'footer-small-logo-black'
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