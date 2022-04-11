<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_shop_masonry_1(){
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
            'value' => 'no'
        ),
        array(
            'key' => 'woocommerce_toggle_grid_list',
            'value' => 'off'
        ),
        array(
            'key' => 'active_shop_masonry',
            'value' => 'on'
        ),
        array(
            'key'   => 'woocommerce_shop_masonry_columns',
            'value' => array(
                'xlg' => 3,
                'lg' => 3,
                'md' => 3,
                'sm' => 2,
                'xs' => 2,
                'mb' => 1
            )
        ),

        /**
         * Filters
         */

        array(
            'filter_name' => 'precise/filter/page_title',
            'value' => '<header><div class="page-title h3">Shop Masonry 01</div></header>'
        )

        /**
         * Colors
         */

    );
}