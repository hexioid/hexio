<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$meta_query = WC()->query->get_meta_query();

$query_args = array(
    'post_type'      => 'product',
    'posts_per_page' => 1,
    'no_found_rows'  => 1,
    'post_status'    => 'publish',
    'meta_query'     => $meta_query
);

if ( !empty($atts['sku']) ) {
    $query_args['meta_query'][] = array(
        'key' 		=> '_sku',
        'value' 	=> $atts['sku'],
        'compare' 	=> '='
    );
}

if ( !empty($atts['id'])) {
    $query_args['p'] = $atts['id'];
}

LaStudio_Shortcodes_Helper::getLoopProducts($query_args, $atts, $this->getShortcode());