<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

if ( empty($atts['category']) ) {
    return;
}

// Default ordering args
$ordering_args = WC()->query->get_catalog_ordering_args( $atts['orderby'], $atts['order'] );
$meta_query    = WC()->query->get_meta_query();
$query_args    = array(
    'post_type'				=> 'product',
    'post_status' 			=> 'publish',
    'ignore_sticky_posts'	=> 1,
    'orderby' 				=> $ordering_args['orderby'],
    'order' 				=> $ordering_args['order'],
    'posts_per_page' 		=> $atts['per_page'],
    'paged'                 => $atts['paged'],
    'meta_query' 			=> $meta_query,
    'tax_query' 			=> array(
        array(
            'taxonomy' 		=> 'product_cat',
            'terms' 		=> array_map( 'sanitize_title', explode( ',', $atts['category'] ) ),
            'field' 		=> 'slug',
            'operator' 		=> $atts['operator']
        )
    )
);

if ( isset( $ordering_args['meta_key'] ) ) {
    $query_args['meta_key'] = $ordering_args['meta_key'];
}

LaStudio_Shortcodes_Helper::getLoopProducts($query_args, $atts, $this->getShortcode());

// Remove ordering query arguments
WC()->query->remove_ordering_args();