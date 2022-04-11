<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_blog_right_sidebar(){
    return array(

        /**
         * Settings
         */

        array(
            'key' => 'layout_blog',
            'value' => 'col-2cr'
        ),
        array(
            'key' => 'blog_design',
            'value' => 'list_1'
        ),
        array(
            'key' => 'blog_masonry',
            'value' => 'off'
        ),
        array(
            'key' => 'blog_thumbnail_size',
            'value' => '870x410'
        ),
        array(
            'key' => 'blog_excerpt_length',
            'value' => '60'
        ),
        array(
            'key' => 'blog_pagination_type',
            'value' => 'pagination'
        ),

        /**
         * Filters
         */

        array(
            'filter_name' => 'precise/filter/page_title',
            'value' => '<header><div class="page-title h3">Blog Sidebr</div></header>'
        )

        /**
         * Colors
         */

    );
}