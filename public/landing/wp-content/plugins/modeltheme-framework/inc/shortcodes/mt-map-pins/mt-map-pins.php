<?php 

require_once(__DIR__.'/../vc-shortcodes.inc.arrays.php');

/**
||-> Shortcode: Map pins
*/
function mt_shortcode_map_pins($params,  $content = NULL) {
    extract( shortcode_atts( 
        array(
            'el_class'              => '',
            'item_image_map'        => '',
        ), $params ) );


    $html = '';
        
    $html .= '
    <div class="map-shortcode">
        <div class="bitwallet-product bitwallet-container">
            <div class="bitwallet-product-wrapper">';
                $img = wp_get_attachment_image_src($item_image_map, 'full'); 
                if (isset($item_image_map)) {
                    $html .= '<img class="menu_item_image" src="'.$img[0].'" alt="" />';
                }
                $html .= '<ul>';
                    $html .= do_shortcode($content);
                    $html .= '
                </ul>
            </div>
        </div>
    </div>';
    return $html;
}
add_shortcode('mt_map_pins', 'mt_shortcode_map_pins');


/**
||-> Shortcode: Map Single Point
*/
function mt_shortcode_map_pins_items($params, $content = NULL) {
    extract( shortcode_atts( 
        array(
            'item_title'           => '',
            'item_content'         => '',
            'item_image'           => '',
            'coordinates_x'        => '',
            'coordinates_y'        => '',
            'el_class_pin'         => '',
        ), $params ) );


    $html = '';
    $html .= '<li class="bitwallet-single-point" style="top:'.$coordinates_x.';right:'.$coordinates_y.';">';

        $html .= '<a class="bitwallet-img-replace" href="#0">More</a>';

        if($el_class_pin) {
            $class_pin = $el_class_pin;
        } else {
            $class_pin = 'bottom';
        }

        $html .= '<div class="bitwallet-more-info bitwallet-'.$class_pin.'">';

            $img = wp_get_attachment_image_src($item_image, 'full'); 
            if (isset($item_image)) {
                $html .= '<img class="menu_item_image" src="'.$img[0].'" alt="" />';
            }
            $html .= '<h3 class="menu_item_title">'.$item_title.'</h3>';
            $html .= '<p class="menu_item_content">'.$item_content.'</p>';
            $html .= '<a href="#0" class="bitwallet-close-info bitwallet-img-replace">Close</a>';

        $html .= '</div>';
    
    $html .= '</li>';

    return $html;
}
add_shortcode('mt_map_pins_item', 'mt_shortcode_map_pins_items');

/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map( array(
        "name" => esc_attr__("MT - Map Pins", 'modeltheme'),
        "base" => "mt_map_pins",
        "as_parent" => array('only' => 'mt_map_pins_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "show_settings_on_create" => true,
        "icon" => "smartowl_shortcode",
        "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
        "is_container" => true,
        "params" => array(
            // add params same as with any other content element

            array(
                "type"          => "attach_image",
                "heading"       => esc_attr__( "Background", 'modeltheme' ),
                "param_name"    => "item_image_map",
                "description"   => ""
            ),

            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "modeltheme"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme")
            ),

        ),
        "js_view" => 'VcColumnView'
    ) );
    vc_map( array(
        "name" => esc_attr__("Map Single Point", 'modeltheme'),
        "base" => "mt_map_pins_item",
        "content_element" => true,
        "as_child" => array('only' => 'mt_map_pins'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            array(
                "group"        => "General Options",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "item_title",
                "heading"      => esc_attr__("Title", 'modeltheme'),
                "description"  => esc_attr__("Enter title for current menu item(Eg: Italian Pizza)", 'modeltheme'),
            ),
            array(
                "group"        => "General Options",
                "type"         => "textarea",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "item_content",
                "heading"      => esc_attr__("Description", 'modeltheme'),
                "description"  => esc_attr__("Enter title for current menu item(Eg: 30x30cm with cheese, onion rings, olives and tomatoes)", 'modeltheme'),
            ),
            array(
                "group"         => "General Options",
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "",
                "heading"       => esc_attr__( "Thumbnail", 'modeltheme' ),
                "param_name"    => "item_image",
                "description"   => ""
            ),
            array(
                "group"        => "General Options",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "coordinates_x",
                "heading"      => esc_attr__("Coordinates on x axis", 'modeltheme'),
                "description"  => esc_attr__("Enter coordinates on x axis in percentange", 'modeltheme'),
            ),
            array(
                "group"        => "General Options",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "coordinates_y",
                "heading"      => esc_attr__("Coordinates on y axis", 'modeltheme'),
                "description"  => esc_attr__("Enter coordinates on y axis in percentange", 'modeltheme'),
            ),
            array(
                "group" => "Extra Options",
                "type" => "textfield",
                "heading" => __("Extra class name", "modeltheme"),
                "param_name" => "el_class_pin",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme")
            )
        )
    ) );


    //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Mt_map_pins extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Mt_map_pins_Item extends WPBakeryShortCode {
        }
    }

}
?>