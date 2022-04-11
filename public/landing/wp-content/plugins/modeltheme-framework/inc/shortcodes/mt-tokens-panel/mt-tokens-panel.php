<?php

require_once(__DIR__.'/../vc-shortcodes.inc.arrays.php');


/**

||-> Shortcode: Tokens Panel

*/
function modeltheme_panel2_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'panel_title'                   => '', 
            'panel_content'                 => '',
            'color_bottom_border'           => '', 
            'background_panel'              => '',
            'color_body_text'               => '',
            'color_title_text'              => '',
            'background_title_holder'       => '',
            'animation'     	              => ''
        ), $params ) );

    $uniqid = 'unique'.uniqid();

    $html = '';
    $html .= '<style>';
      $html .= '.panel2.'.$uniqid.':hover { border-bottom:5px solid '.$color_bottom_border.' !important;}';
    $html .= '</style>';

        $html .='<div class="panel2 '.$uniqid.' wow '.$animation.'" style="border-bottom:2px solid'.$color_bottom_border.';background:'.$background_panel.'">';
            $html .='<div class="panel-heading2">';
                $html .='<h3 class="panel-title2" style="color:'.$color_title_text.';background:'.$background_title_holder.';">'.esc_attr($panel_title).'</h3>';
            $html .='</div>';
            $html .='<div class="panel-body2" style="color:'.$color_body_text.'">'.wp_kses_post($panel_content).'</div>';
        $html .='</div>';

    return $html;
    
}

add_shortcode('panel2', 'modeltheme_panel2_shortcode');





/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

	vc_map( 
		array(
		"name" => esc_attr__("MT - Tokens Panel", 'modeltheme'),
		"base" => "panel2",
		"category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
		"icon" => "smartowl_shortcode",
		"params" => array(
			array(
				"group" => "Options",
				"type"         => "textfield",
				"holder"       => "div",
				"class"        => "",
				"param_name"   => "panel_title",
				"heading"      => esc_attr__("Panel title", 'modeltheme'),
				"value"        => esc_attr__("Panel title", 'modeltheme'),
				"description"  => ""
			),
			array(
				"group" => "Options",
				"type"         => "textarea_html",
				"holder"       => "div",
				"class"        => "",
				"param_name"   => "panel_content",
				"heading"      => esc_attr__("Panel content", 'modeltheme'),
				"value"        => esc_attr__("Panel content", 'modeltheme'),
				"description"  => ""
			),
			array(
            "group" => "Styling",
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_attr__( "Color bottom border", 'modeltheme' ),
            "param_name" => "color_bottom_border",
            "value" => "", 
      ),
      array(
            "group" => "Styling",
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_attr__( "Background color panel", 'modeltheme' ),
            "param_name" => "background_panel",
            "value" => "", 
      ),
      array(
            "group" => "Styling",
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_attr__( "Color body text", 'modeltheme' ),
            "param_name" => "color_body_text",
            "value" => "", 
      ),
      array(
            "group" => "Styling",
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_attr__( "Color title text", 'modeltheme' ),
            "param_name" => "color_title_text",
            "value" => "", 
      ),
      array(
            "group" => "Styling",
            "type" => "colorpicker",
            "class" => "",
            "heading" => esc_attr__( "Background title holder", 'modeltheme' ),
            "param_name" => "background_title_holder",
            "value" => "", 
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
	));
}