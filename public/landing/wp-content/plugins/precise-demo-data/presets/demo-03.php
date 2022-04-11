<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_demo_03(){
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


    );
}