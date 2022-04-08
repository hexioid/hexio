<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_shop_masonry_2(){
    return array(

        /**
         * Settings
         */

        array(
            'key' => 'layout_archive_product',
            'value' => 'col-1c'
        ),
        array(
            'key' => 'main_full_width',
            'value' => 'yes'
        ),
        array(
            'key' => 'woocommerce_toggle_grid_list',
            'value' => 'off'
        ),

        array(
            'key'   => 'woocommerce_shop_masonry_columns',
            'value' => array(
                'xlg' => 4,
                'lg' => 4,
                'md' => 3,
                'sm' => 3,
                'xs' => 2,
                'mb' => 1
            )
        ),
        array(
            'key' => 'la_custom_css',
            'value' => '@media (min-width: 1400px){
	.enable-main-fullwidth .site-main > .container {
    	padding-left: 30px;
	    padding-right: 30px;
	}
}
@media (min-width: 1500px){
	.enable-main-fullwidth .site-main > .container {
    	padding-left: 80px;
	    padding-right: 80px;
	}
}'
        ),
        /**
         * Filters
         */

        array(
            'filter_name' => 'precise/filter/page_title',
            'value' => '<header><div class="page-title h3">Shop Masonry 02</div></header>'
        )

        /**
         * Colors
         */

    );
}