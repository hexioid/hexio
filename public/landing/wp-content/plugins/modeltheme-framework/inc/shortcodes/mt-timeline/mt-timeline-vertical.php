<?php 

require_once(__DIR__.'/../vc-shortcodes.inc.arrays.php');

/**
||-> Shortcode:  Vertical Timeline 
*/
function mt_shortcode_timeline($params,  $content = NULL) {
    extract( shortcode_atts( 
        array(
            'el_class'              => ''
        ), $params ) );


    $html = '';
        
    $html .= '<section class="steps steps-area '.$el_class.'">';
            $html .= '<ul class="row timeline_vertical">';
                $html .= do_shortcode($content);
            $html .= '</ul>';
    $html .= '</section>';
    return $html;
}
add_shortcode('mt_timeline_short', 'mt_shortcode_timeline');






/**
||-> Shortcode: Child Shortcode v1
*/
function mt_shortcode_timeline_items($params, $content = NULL) {
    extract( shortcode_atts( 
        array(
            'animation'                                 => '',
            'timeline_item_title'                       => '',
            'timeline_item_title_color'                 => '',
            'timeline_item_content'                     => '',
            'timeline_item_content_color'               => '',
            'timeline_item_date'                        => '',
            'timeline_item_date_color'                  => ''
        ), $params ) );

    $html = '';
    $html .= '<li class="mt_shortcode_timeline_items timeline-box wow '.$animation.'">';
    
        $html .= '<h3 class="timeline-title" style="color:'.$timeline_item_title_color.';">'.$timeline_item_title.'</h3>';
        $html .= '<h3 class="timeline-date" style="color:'.$timeline_item_content_color.';">'.$timeline_item_date.'</h3>';
        $html .= '<p class="timeline-details" style="color:'.$timeline_item_date_color.';">'.$timeline_item_content.'</p>';
        

    $html .= '</li>';

    return $html;
}
add_shortcode('mt_timeline_short_item', 'mt_shortcode_timeline_items');

// $html .= '<h3 class="timeline_item_title">'.$timeline_item_title.'</h3>';
// $html .= '<p class="timeline_item_content">'.$timeline_item_content.'</p>';
// $html .= '<a href="'.$timeline_item_button_link.'" class="cd-read-more">'.$timeline_item_button_text.'</a>';
// $html .= '<p class="cd-date">'.$timeline_item_date.'</p>';



/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    //require_once('../vc-shortcodes.inc.arrays.php');

    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map( array(
        "name" => esc_attr__("MT -  Vertical Timeline", 'modeltheme'),
        "base" => "mt_timeline_short",
        "as_parent" => array('only' => 'mt_timeline_short_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => true,
        "icon" => "smartowl_shortcode",
        "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
        "is_container" => true,
        "params" => array(
            // add params same as with any other content element
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "modeltheme"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme")
            )
        ),
        "js_view" => 'VcColumnView'
    ) );






    vc_map( array(
        "name" => esc_attr__("Timeline Item", 'modeltheme'),
        "base" => "mt_timeline_short_item",
        "content_element" => true,
        "as_child" => array('only' => 'mt_timeline_short'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            array(
                "group"        => "General Options",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "timeline_item_title",
                "heading"      => esc_attr__("Single item timeline Title", 'modeltheme'),
                "description"  => esc_attr__("Enter title for current timeline item.", 'modeltheme'),
            ),
            array(
                "group"        => "General Options",
                "type"         => "textarea",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "timeline_item_content",
                "heading"      => esc_attr__("Single item timeline Description", 'modeltheme'),
                "description"  => esc_attr__("Enter the description for current timeline item.", 'modeltheme'),
            ),
            array(
                "group"        => "General Options",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "timeline_item_date",
                "heading"      => esc_attr__("Single item timeline Date", 'modeltheme'),
                "description"  => esc_attr__("Enter the date for current timeline item. Format example: 2017 November 15th", 'modeltheme'),
            ),
            array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Title color", 'modeltheme' ),
                  "param_name" => "timeline_item_title_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose the color for title.", 'modeltheme' )
            ),
            array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Description color", 'modeltheme' ),
                  "param_name" => "timeline_item_content_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose the color for description.", 'modeltheme' )
            ),
            array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Date color", 'modeltheme' ),
                  "param_name" => "timeline_item_date_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose the color for date.", 'modeltheme' )
            ),
            array(
              "group" => "Animation",
               "type" => "dropdown",
               "heading" => esc_attr__("Animation", 'modeltheme'),
               "param_name" => "animation",
               "std" => '',
               "holder" => "div",
               "class" => "",
               "description" => "",
               "value" => $animations_list
            )
        )
    ) );


    //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Mt_Timeline_Short extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Mt_Timeline_Short_Item extends WPBakeryShortCode {
        }
    }


}
?>