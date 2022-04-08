<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_demo_05(){
    return array(
        array(
            'key' => 'logo',
            'value' => 651
        ),
        array(
            'key' => 'logo_2x',
            'value' => 652
        ),
        array(
            'key' => 'logo_transparency',
            'value' => 653
        ),
        array(
            'key' => 'logo_transparency_2x',
            'value' => 654
        ),

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
            'value' => 1
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

        /** COLOR  */
    );
}