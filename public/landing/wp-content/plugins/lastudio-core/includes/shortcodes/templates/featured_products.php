<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$meta_query  = WC()->query->get_meta_query();
$tax_query   = WC()->query->get_tax_query();
$tax_query[] = array(
    'taxonomy' => 'product_visibility',
    'field'    => 'name',
    'terms'    => 'featured',
    'operator' => 'IN',
);

if ( ! empty( $atts['category__in'] ) ) {
    $tax_query[] = array(
        array(
            'taxonomy' 		=> 'product_cat',
            'terms' 		=> explode( ',', $atts['category__in'] ),
            'field' 		=> 'term_id',
            'operator' 		=> $atts['operator']
        )
    );
}
else if ( ! empty( $atts['category'] ) ) {
    $tax_query[] = array(
        array(
            'taxonomy' 		=> 'product_cat',
            'terms'         => array_map( 'sanitize_title', explode( ',', $atts['category'] ) ),
            'field'         => 'slug',
            'operator' 		=> $atts['operator']
        )
    );
}

$query_args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => $atts['per_page'],
    'orderby'             => $atts['orderby'],
    'order'               => $atts['order'],
    'paged'               => $atts['paged'],
    'meta_query'          => $meta_query,
    'tax_query'           => $tax_query
);

LaStudio_Shortcodes_Helper::getLoopProducts($query_args, $atts, $this->getShortcode());