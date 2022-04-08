<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$query_args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => $atts['per_page'],
    'paged'               => $atts['paged'],
    'orderby'             => $atts['orderby'],
    'order'               => $atts['order'],
    'meta_query'          => WC()->query->get_meta_query(),
    'tax_query'           => array(
        array(
            'taxonomy' => strstr( $atts['attribute'], 'pa_' ) ? sanitize_title( $atts['attribute'] ) : 'pa_' . sanitize_title( $atts['attribute'] ),
            'terms'    => array_map( 'sanitize_title', explode( ',', $atts['filter'] ) ),
            'field'    => 'slug'
        )
    )
);

LaStudio_Shortcodes_Helper::getLoopProducts($query_args, $atts, $this->getShortcode());