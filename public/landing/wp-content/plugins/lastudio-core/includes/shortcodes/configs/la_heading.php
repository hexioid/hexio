<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if ( !class_exists( 'WPBakeryShortCode_la_heading' ) ) {
    class WPBakeryShortCode_la_heading extends LaStudio_Shortcodes_Abstract{

    }
}

$shortcode_params = array(
    array(
        'type' => 'textfield',
        'heading' => __('Heading', 'la-studio'),
        'param_name' => 'title',
        'admin_label' => true,
    ),
    array(
        'type' => 'textarea_html',
        'heading' => __('Sub Heading(Optional)', 'la-studio'),
        'param_name' => 'content'
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Heading tag','la-studio'),
        'param_name' => 'tag',
        'value' => array(
            __('Default','la-studio') => 'h2',
            __('H1','la-studio') => 'h1',
            __('H3','la-studio') => 'h3',
            __('H4','la-studio') => 'h4',
            __('H5','la-studio') => 'h5',
            __('H6','la-studio') => 'h6',
            __('DIV','la-studio') => 'div',
            __('p','la-studio') => 'p',
        ),
        'default' => 'h2',
        'description' => __('Default is H2', 'la-studio'),
    ),
    array(
        'type'  => 'dropdown',
        'heading' => __('Alignment','la-studio'),
        'param_name'    => 'alignment',
        'value' => array(
            __('Center','la-studio')	    =>	'center',
            __('Left','la-studio')	    =>	'left',
            __('Right','la-studio')	    =>	'right',
            __('Inline','la-studio')	    =>	'inline'
        ),
        'default' => 'left',
    ),
    array(
        'type'  => 'dropdown',
        'heading' => __('Separator','la-studio'),
        'param_name'    => 'spacer',
        'value' => array(
            __('No Separator','la-studio')	=>	'none',
            __('Line','la-studio')	        =>	'line',
        ),
        'default' => 'none',
        'dependency' => array(
            'element'   => 'alignment',
            'value'     => array('center', 'left', 'right' )
        )
    ),
    array(
        'type'  => 'dropdown',
        'heading' => __('Separator Position','la-studio'),
        'param_name'    => 'spacer_position',
        'value' => array(
            __('Top','la-studio')	                        =>	'top',
            __('Between Heading & Subheading','la-studio')  =>	'middle',
            __('Bottom','la-studio')	                    =>	'bottom',
            __('Title between separator','la-studio')	    =>	'separator',
        ),
        'default' => 'top',
        'dependency' => array(
            'element'   => 'spacer',
            'value'     => 'line'
        )
    ),
    array(
        'type'      => 'dropdown',
        'heading'   => __('Line Style', 'la-studio'),
        'param_name'    => 'line_style',
        'value'         => array(
            __('Solid', 'la-studio') => 'solid',
            __('Dashed', 'la-studio') => 'dashed',
            __('Dotted', 'la-studio') => 'dotted',
            __('Double', 'la-studio') => 'double'
        ),
        'default' => 'solid',
        'dependency' => array(
            'element'   => 'spacer',
            'value'     => 'line'
        )
    ),
    array(
        'type' 			=> 'la_column',
        'heading' 		=> __('Line Width', 'la-studio'),
        'param_name' 	=> 'line_width',
        'unit'			=> 'px',
        'media'			=> array(
            'xlg'	=> '',
            'lg'	=> '',
            'md'	=> '',
            'sm'	=> '',
            'xs'	=> '',
            'mb'	=> ''
        ),
        'dependency' => array(
            'element'   => 'spacer',
            'value'     => 'line'
        )
    ),
    array(
        'type' => 'la_number',
        'heading' => __('Line Height', 'la-studio'),
        'param_name' => 'line_height',
        'value' => 1,
        'min' => 1,
        'suffix' => 'px',
        'dependency' => array(
            'element'   => 'spacer',
            'value'     => 'line'
        )
    ),
    array(
        'type' => 'colorpicker',
        'heading' => __('Line Color', 'la-studio'),
        'param_name' => 'line_color',
        'dependency' => array(
            'element'   => 'spacer',
            'value'     => 'line'
        )
    ),
    LaStudio_Shortcodes_Helper::fieldCssAnimation(),
    LaStudio_Shortcodes_Helper::fieldExtraClass(),
    LaStudio_Shortcodes_Helper::fieldExtraClass(array(
        'heading' 		=> __('Extra Class for heading', 'la-studio'),
        'param_name' 	=> 'title_class',
    )),
    LaStudio_Shortcodes_Helper::fieldExtraClass(array(
        'heading' 		=> __('Extra Class for subheading', 'la-studio'),
        'param_name' 	=> 'subtitle_class',
    )),
    LaStudio_Shortcodes_Helper::fieldExtraClass(array(
        'heading' 		=> __('Extra Class for Line', 'la-studio'),
        'param_name' 	=> 'line_class',
        'dependency' => array(
            'element'   => 'spacer',
            'value'     => 'line'
        )
    ))
);

$title_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont();
$desc_google_font_param = LaStudio_Shortcodes_Helper::fieldTitleGFont('subtitle', __('Subheading', 'la-studio'));

$shortcode_params = array_merge( $shortcode_params, $title_google_font_param, $desc_google_font_param, array(LaStudio_Shortcodes_Helper::fieldCssClass()));

return apply_filters(
    'LaStudio/shortcodes/configs',
    array(
        'name'			=> __('La Heading', 'la-studio'),
        'base'			=> 'la_heading',
        'icon'          => 'la-wpb-icon fa fa-font la_heading',
        'category'  	=> __('La Studio', 'la-studio'),
        'description' 	=> __('Awesome heading styles.','la-studio'),
        'params' 		=> $shortcode_params
    ),
    'la_heading'
);