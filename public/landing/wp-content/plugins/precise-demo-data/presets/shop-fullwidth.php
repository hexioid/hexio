<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_shop_fullwidth(){
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
            'key' => 'active_shop_filter',
            'value' => 'on'
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
            'value' => '<header><div class="page-title h3">Shop FullWidth</div></header>'
        )

        /**
         * Colors
         */

    );
}