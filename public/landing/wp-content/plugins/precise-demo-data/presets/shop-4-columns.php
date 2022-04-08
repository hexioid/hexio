<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_shop_4_columns(){
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
            'key'   => 'woocommerce_shop_page_columns',
            'value' => array(
                'xlg' => 4,
                'lg' => 4,
                'md' => 3,
                'sm' => 3,
                'xs' => 2,
                'mb' => 1
            )
        ),

        /**
         * Filters
         */

        array(
            'filter_name' => 'precise/filter/page_title',
            'value' => '<header><div class="page-title h3">Shop 04 Columns</div></header>'
        )

        /**
         * Colors
         */

    );
}