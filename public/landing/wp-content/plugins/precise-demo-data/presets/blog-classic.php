<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

function la_precise_preset_blog_classic(){
    return array(

        /**
         * Settings
         */

        array(
            'key' => 'layout_blog',
            'value' => 'col-1c'
        ),
        array(
            'key' => 'blog_design',
            'value' => 'grid_4'
        ),
        array(
            'key' => 'blog_post_column',
            'value' => array(
                'xlg'   => '3',
                'lg'    => '3',
                'md'    => '3',
                'sm'    => '2',
                'xs'    => '2',
                'mb'    => '1'
            )
        ),
        array(
            'key' => 'blog_masonry',
            'value' => 'off'
        ),
        array(
            'key' => 'blog_thumbnail_size',
            'value' => '370x240'
        ),
        array(
            'key' => 'blog_excerpt_length',
            'value' => '15'
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
            'value' => '<header><div class="page-title h3">Blog Classic</div></header>'
        )

        /**
         * Colors
         */

    );
}