<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_maps' ) ) {
    class WPBakeryShortCode_la_maps extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        "type" => "textfield",
        "heading" => __("Width (in %)", 'la-studio'),
        "param_name" => "width",
        "admin_label" => true,
        "value" => "100%",
        "group" => __("General Settings", 'la-studio')
    ),
    array(
        "type" => "textfield",
        "heading" => __("Height (in px)", 'la-studio'),
        "param_name" => "height",
        "admin_label" => true,
        "value" => "300px",
        "group" => __("General Settings", 'la-studio')
    ),
    array(
        "type" => "dropdown",
        "heading" => __("Map type", 'la-studio'),
        "param_name" => "map_type",
        "admin_label" => true,
        "value" => array(__("Roadmap", 'la-studio') => "ROADMAP", __("Satellite", 'la-studio') => "SATELLITE", __("Hybrid", 'la-studio') => "HYBRID", __("Terrain", 'la-studio') => "TERRAIN"),
        "group" => __("General Settings", 'la-studio')
    ),
    array(
        "type" => "textfield",
        "heading" => __("Latitude", 'la-studio'),
        "param_name" => "lat",
        "admin_label" => true,
        "value" => "21.027764",
        "description" => '<a href="http://www.latlong.net/" target="_blank">' . __('Here is a tool', 'la-studio') . '</a> ' . __('where you can find Latitude & Longitude of your location', 'la-studio'),
        "group" => __("General Settings", 'la-studio')
    ),
    array(
        "type" => "textfield",
        "heading" => __("Longitude", 'la-studio'),
        "param_name" => "lng",
        "admin_label" => true,
        "value" => "105.834160",
        "description" => '<a href="http://www.latlong.net/" target="_blank">' . __('Here is a tool', 'la-studio') . '</a> ' . __('where you can find Latitude & Longitude of your location', 'la-studio'),
        "group" => __("General Settings", 'la-studio')
    ),
    array(
        "type" => "dropdown",
        "heading" => __("Map Zoom", 'la-studio'),
        "param_name" => "zoom",
        "value" => array(
            __("12 - Default", 'la-studio') => 12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20
        ),
        "group" => __("General Settings", 'la-studio')
    ),
    array(
        "type" => "checkbox",
        "param_name" => "scrollwheel",
        "value" => array(
            __("Disable map zoom on mouse wheel scroll", 'la-studio') => "disable",
        ),
        "group" => __("General Settings", 'la-studio')
    ),
    array(
        "type" => "textarea_html",
        "heading" => __("Info Window Text", 'la-studio'),
        "param_name" => "content",
        "group" => __("Info Window", 'la-studio')
    ),

    array(
        'type' => 'checkbox',
        'heading' => __('Open on Marker Click', 'la-studio'),
        'param_name' => 'infowindow_open',
        'value' => array(__('Yes', 'la-studio') => 'yes'),
        'description' => __('Use font family from the theme.', 'la-studio'),
        "group" => __("Info Window", 'la-studio')
    ),

    array(
        "type" => "dropdown",
        "heading" => __("Marker/Point icon", 'la-studio'),
        "param_name" => "marker_icon",
        "value" => array(__("Use Google Default", 'la-studio') => "default", __("Use Plugin's Default", 'la-studio') => "default_self", __("Upload Custom", 'la-studio') => "custom"),
        "group" => __("Marker", 'la-studio')
    ),

    array(
        "type" => "attach_image",
        "heading" => __("Upload Image Icon", 'la-studio'),
        "param_name" => "icon_img",
        "description" => __("Upload the custom image icon.", 'la-studio'),
        "dependency" => array("element" => "marker_icon", "value" => array("custom")),
        "group" => __("Marker", 'la-studio')
    ),
    array(
        "type" => "textfield",
        "heading" => __("Icon Image Url", 'la-studio'),
        "param_name" => "icon_img_url",
        "dependency" => array("element" => "marker_icon", "value" => array("custom")),
        "group" => __("Marker", 'la-studio')
    ),
    array(
        "type" => "dropdown",
        "heading" => __("Street view control", 'la-studio'),
        "param_name" => "streetviewcontrol",
        "value" => array(__("Disable", 'la-studio') => "false", __("Enable", 'la-studio') => "true"),
        "group" => __("Advanced", 'la-studio')
    ),
    array(
        "type" => "dropdown",
        "heading" => __("Map type control", 'la-studio'),
        "param_name" => "maptypecontrol",
        "value" => array(__("Disable", 'la-studio') => "false", __("Enable", 'la-studio') => "true"),
        "group" => __("Advanced", 'la-studio')
    ),
    array(
        "type" => "dropdown",
        "heading" => __("Zoom control", 'la-studio'),
        "param_name" => "zoomcontrol",
        "value" => array(__("Disable", 'la-studio') => "false", __("Enable", 'la-studio') => "true"),
        "group" => __("Advanced", 'la-studio')
    ),
    array(
        "type" => "dropdown",
        "heading" => __("Zoom control size", 'la-studio'),
        "param_name" => "zoomcontrolsize",
        "value" => array(__("Small", 'la-studio') => "SMALL", __("Large", 'la-studio') => "LARGE"),
        "dependency" => array("element" => "zoomControl", "value" => array("true")),
        "group" => __("Advanced", 'la-studio')
    ),

    array(
        "type" => "dropdown",
        "heading" => __("Disable dragging on Mobile", 'la-studio'),
        "param_name" => "dragging",
        "value" => array(__("Enable", 'la-studio') => "true", __("Disable", 'la-studio') => "false"),
        "group" => __("Advanced", 'la-studio')
    ),
    array(
        "type" => "textarea_raw_html",
        "heading" => __("Google Styled Map JSON", 'la-studio'),
        "param_name" => "map_style",
        "description" => "<a target='_blank' href='https://snazzymaps.com/'>" . __("Click here", 'la-studio') . "</a> " . __("to get the style JSON code for styling your map.", 'la-studio'),
        "group" => __("Styling", 'la-studio'),
    ),
    LaStudio_Shortcodes_Helper::fieldExtraClass(array("group" => __("General Settings", 'la-studio'))),
    LaStudio_Shortcodes_Helper::fieldCssClass()
);

$shortcode_params = array_merge($shortcode_params);

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name' => __('La Google Maps', 'la-studio'),
        'base' => 'la_maps',
        'category' => __('La Studio', 'la-studio'),
        'icon'  => 'la_maps',
        'description' => __('Display Google Maps to indicate your location.', 'la-studio'),
        'params' => $shortcode_params
    ),
    'la_maps'
);