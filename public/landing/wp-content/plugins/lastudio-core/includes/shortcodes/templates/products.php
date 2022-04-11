<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$query_args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'orderby'             => $atts['orderby'],
    'order'               => $atts['order'],
    'posts_per_page'      => -1,
    'paged'               => $atts['paged'],
    'meta_query'          => WC()->query->get_meta_query()
);

if ( ! empty( $atts['skus'] ) ) {
    $query_args['meta_query'][] = array(
        'key'     => '_sku',
        'value'   => array_map( 'trim', explode( ',', $atts['skus'] ) ),
        'compare' => 'IN'
    );
}

if ( ! empty( $atts['ids'] ) ) {
    $query_args['post__in'] = array_map( 'trim', explode( ',', $atts['ids'] ) );
}

LaStudio_Shortcodes_Helper::getLoopProducts($query_args, $atts, $this->getShortcode());