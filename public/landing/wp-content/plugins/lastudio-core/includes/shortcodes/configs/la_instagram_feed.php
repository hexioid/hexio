<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_instagram_feed' ) ) {
    class WPBakeryShortCode_la_instagram_feed extends LaStudio_Shortcodes_Abstract{

    }
}




$shortcode_params = array(
    array(
        'type' => 'textarea',
        'heading' => __('Title', 'la-studio'),
        'param_name' => 'content'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Feed Type','la-studio'),
        'param_name' => 'feed_type',
        'value' => array(
            __('Images with a specific tag','la-studio') => 'tagged',
            __('Images from a location.','la-studio') => 'location',
            __('Images from a user','la-studio') => 'user'
        ),
        'admin_label' => true,
        'default' => 'user'
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Hashtag', 'la-studio'),
        'description' => __('Only Alphanumeric characters are allowed (a-z, A-Z, 0-9)', 'la-studio'),
        'param_name' => 'hashtag',
        'admin_label' => true
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Location ID', 'la-studio'),
        'description' => __('Unique id of a location to get', 'la-studio'),
        'param_name' => 'location_id'
    ),
    array(
        'type' => 'textfield',
        'heading' => __('User ID', 'la-studio'),
        'description' => __('Unique id of a user to get', 'la-studio'),
        'param_name' => 'user_id'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Sort By','la-studio'),
        'param_name' => 'sort_by',
        'admin_label' => true,
        'value' => array(
            __('Default','la-studio') => 'none',
            __('Newest to oldest','la-studio') => 'most-recent',
            __('Oldest to newest','la-studio') => 'least-recent',
            __('Highest # of likes to lowest.','la-studio') => 'most-liked',
            __('Lowest # likes to highest.','la-studio') => 'least-liked',
            __('Highest # of comments to lowest','la-studio') => 'most-commented',
            __('Lowest # of comments to highest.','la-studio') => 'least-commented',
            __('Random order','la-studio') => 'random',
        ),
        'default' => 'none'
    ),
    LaStudio_Shortcodes_Helper::fieldColumn(),

    array(
        'type'       => 'checkbox',
        'heading'    => __('Enable slider', 'la-studio' ),
        'param_name' => 'enable_carousel',
        'value'      => array( __( 'Yes', 'la-studio' ) => 'yes' )
    ),

    array(
        'type' => 'textfield',
        'heading' => __('Limit', 'la-studio'),
        'description' => __('Maximum number of Images to add. Max of 60', 'la-studio'),
        'param_name' => 'limit',
        'admin_label' => true,
        'value' => 5
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Image size','la-studio'),
        'param_name' => 'image_size',
        'value' => array(
            __('Thumbnail','la-studio') => 'thumbnail',
            __('Low Resolution','la-studio') => 'low_resolution',
            __('Standard Resolution','la-studio') => 'standard_resolution'
        ),
        'default' => 'thumbnail'
    ),
    LaStudio_Shortcodes_Helper::fieldExtraClass()
);

$carousel = LaStudio_Shortcodes_Helper::fieldCarousel(array(
    'element' => 'enable_carousel',
    'not_empty' => true
));

$shortcode_params = array_merge( $shortcode_params, $carousel);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('Instagram Feed', 'la-studio'),
        'base'			=> 'la_instagram_feed',
        'icon'          => 'la-wpb-icon la_instagram_feed',
        'category'  	=> __('La Studio', 'la-studio'),
        'description'   => __('Display Instagram photos from any non-private Instagram accounts', 'la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_instagram_feed'
);