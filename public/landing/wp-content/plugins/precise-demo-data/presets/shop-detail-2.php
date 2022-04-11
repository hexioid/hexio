<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_shop_detail_2(){
    return array(

        /**
         * Settings
         */
        array(
            'key' => 'woocommerce_product_page_design',
            'value' => 2
        ),
        array(
            'key' => 'woo_enable_custom_tab',
            'value' => 'off'
        ),
        /**
         * Filters
         */

        array(
            'filter_name' => 'precise/filter/page_title',
            'value' => '<header><div class="page-title h3">Product Style 02</div></header>'
        )

        /**
         * Colors
         */

    );
}