<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Precise_Visual_Composer{

    public $category;

    public static $instance = null;

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct(){

        $this->category = esc_html_x( 'La Studio', 'admin-view', 'precise');

        if(!class_exists('Vc_Manager')) return false;

        add_action( 'vc_before_init', array( $this, 'vcBeforeInit') );
        add_action( 'vc_after_init', array( $this, 'vcAfterInit') );
        add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG , array( $this, 'customFilterTags' ), 10, 3 );
        add_filter('vc_tta_container_classes', array( $this, 'modifyTtaTabsClasses'), 10, 2 );

    }

    public function vcBeforeInit(){
        vc_automapper()->setDisabled( true );
        vc_manager()->disableUpdater( true );
        vc_manager()->setIsAsTheme( true );
        if(class_exists( 'WooCommerce' )){
            remove_action( 'wp_enqueue_scripts', 'vc_woocommerce_add_to_cart_script' );
        }
        add_filter('vc_map_get_param_defaults', array( $this, 'modifyCssAnimationValue' ), 10, 2);
    }

    public function vcAfterInit(){
        $this->overrideVcSection();
        //$this->overrideMessage();
        $this->overrideProgressBar();
        $this->overridePieChart();
        $this->overrideTtaAccordion();
        $this->overrideTtaTabs();
        $this->overrideTtaTour();
        $this->overrideTtaSection();

        if( function_exists('vc_set_default_editor_post_types') ){
            $list = array(
                'page',
                'post',
                'la_block',
                'la_portfolio'
            );
            vc_set_default_editor_post_types( $list );
        }
    }

    public function modifyCssAnimationValue($value, $param){
        if( 'css_animation' ==  $param['param_name'] && 'none' == $value){
            $value = '';
        }
        return $value;
    }

    public function customFilterTags($css_classes, $shortcode_name, $atts){
        if ( $shortcode_name == 'vc_progress_bar' ){
            if( isset($atts['display_type']) ){
                $css_classes .= ' vc_progress_bar_' . esc_attr($atts['display_type']);
            }
        }
        if ( $shortcode_name == 'vc_tta_tabs' || $shortcode_name == 'vc_tta_accordion' || $shortcode_name == 'vc_tta_tour' ){
            if( isset($atts['style']) && strpos($atts['style'], 'la-') !== false ){
                $css_classes = preg_replace('/ vc_tta-(o|shape|spacing|gap|color)[0-9a-zA-Z\_\-]+/','',$css_classes);
                if($shortcode_name == 'vc_tta_tabs'){
                    $css_classes .= ' vc_tta-o-no-fill';
                    $css_classes = str_replace('vc_tta-style-','tabs-',$css_classes);
                    $css_classes = str_replace('vc_general ','',$css_classes);
                }
                if($shortcode_name == 'vc_tta_tour'){
                    $css_classes = str_replace('vc_tta-style-','tour-',$css_classes);
                    $css_classes = str_replace('vc_general ','',$css_classes);
                }
            }
        }
        if($shortcode_name == 'vc_btn'){
            if(!empty($atts['style']) && in_array($atts['style'], array('modern', 'outline', 'custom', 'outline-custom'))){
                if( false !== strpos( $css_classes, 'vc_btn3-container')){
                    $css_classes .= ' la-vc-btn';
                }
            }
        }

        if ( $shortcode_name == 'vc_row' ) {
            $css_classes .= ' la_fp_slide la_fp_child_section';
        }

        return $css_classes;
    }

    public function overrideMessage(){
        $shortcode_name = 'vc_message';

        $shortcode_object = vc_get_shortcode($shortcode_name);
        $shortcode_params = $shortcode_object['params'];
        
        $icon_type = self::getParamIndex($shortcode_params,'icon_type');
        
        if($icon_type !== -1){
            $shortcode_params[$icon_type]['value'][esc_html_x( 'None', 'admin-view', 'precise' )] = 'none';
        }

        vc_map_update($shortcode_name , array(
            'category' => $this->category,
            'params' => $shortcode_params
        ));
    }

    public function overrideProgressBar(){
        vc_map_update( 'vc_progress_bar', array(
            'category' => $this->category
        ));
    }

    public function overridePieChart(){
        $shortcode_tag = 'vc_pie';
        $shortcode_object = vc_get_shortcode($shortcode_tag);
        $shortcode_params = $shortcode_object['params'];

        $shortcode_params = array(
            array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'value' => array(
                    esc_html_x( 'Style 01', 'admin-view', 'precise' ) => '1',
                    esc_html_x( 'Style 02', 'admin-view', 'precise' ) => '2',
                ),
                'default'   => '1',
                'heading' => esc_html_x( 'Style', 'admin-view', 'precise' ),
                'description' => esc_html_x( 'Select display style.', 'admin-view', 'precise' )
            )
        ) + $shortcode_params ;

        vc_map_update( $shortcode_tag , array(
            'category' => $this->category,
            'params'   => $shortcode_params
        ));
    }

    public function overrideTtaAccordion(){
        vc_map_update('vc_tta_accordion' , array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html_x( 'Precise 01', 'admin-view', 'precise' ) => 'la-1',
                        esc_html_x( 'Precise 02', 'admin-view', 'precise' ) => 'la-2',
                        esc_html_x( 'Precise 03', 'admin-view', 'precise' ) => 'la-3',
                        esc_html_x( 'Classic', 'admin-view', 'precise' ) => 'classic',
                        esc_html_x( 'Modern', 'admin-view', 'precise' ) => 'modern',
                        esc_html_x( 'Flat', 'admin-view', 'precise' ) => 'flat',
                        esc_html_x( 'Outline', 'admin-view', 'precise' ) => 'outline',
                    ),
                    'heading' => esc_html_x( 'Style', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select accordion display style.', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'shape',
                    'value' => array(
                        esc_html_x( 'Rounded', 'admin-view', 'precise' ) => 'rounded',
                        esc_html_x( 'Square', 'admin-view', 'precise' ) => 'square',
                        esc_html_x( 'Round', 'admin-view', 'precise' ) => 'round',
                    ),
                    'heading' => esc_html_x( 'Shape', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select accordion shape.', 'admin-view', 'precise' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'color',
                    'value' => getVcShared( 'colors-dashed' ),
                    'std' => 'grey',
                    'heading' => esc_html_x( 'Color', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select accordion color.', 'admin-view', 'precise' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'no_fill',
                    'heading' => esc_html_x( 'Do not fill content area?', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Do not fill content area with color.', 'admin-view', 'precise' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'spacing',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'precise' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Spacing', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select accordion spacing.', 'admin-view', 'precise' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'gap',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'precise' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Gap', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select accordion gap.', 'admin-view', 'precise' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'c_align',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'precise' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'precise' ) => 'right',
                        esc_html_x( 'Center', 'admin-view', 'precise' ) => 'center',
                    ),
                    'heading' => esc_html_x( 'Alignment', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select accordion section title alignment.', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'autoplay',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'precise' ) => 'none',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '10' => '10',
                        '20' => '20',
                        '30' => '30',
                        '40' => '40',
                        '50' => '50',
                        '60' => '60',
                    ),
                    'std' => 'none',
                    'heading' => esc_html_x( 'Autoplay', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select auto rotate for accordion in seconds (Note: disabled by default).', 'admin-view', 'precise' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'collapsible_all',
                    'heading' => esc_html_x( 'Allow collapse all?', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Allow collapse all accordion sections.', 'admin-view', 'precise' ),
                ),
                // Control Icons
                array(
                    'type' => 'dropdown',
                    'param_name' => 'c_icon',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'precise' ) => '',
                        esc_html_x( 'Chevron', 'admin-view', 'precise' ) => 'chevron',
                        esc_html_x( 'Plus', 'admin-view', 'precise' ) => 'plus',
                        esc_html_x( 'Triangle', 'admin-view', 'precise' ) => 'triangle',
                    ),
                    'std' => 'plus',
                    'heading' => esc_html_x( 'Icon', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select accordion navigation icon.', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'c_position',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'precise' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'precise' ) => 'right',
                    ),
                    'dependency' => array(
                        'element' => 'c_icon',
                        'not_empty' => true,
                    ),
                    'heading' => esc_html_x( 'Position', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select accordion navigation icon position.', 'admin-view', 'precise' ),
                ),
                // Control Icons END
                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html_x( 'Active section', 'admin-view', 'precise' ),
                    'value' => 1,
                    'description' => esc_html_x( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html_x( 'Extra class name', 'admin-view', 'precise' ),
                    'param_name' => 'el_class',
                    'description' => esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'admin-view', 'precise' ),
                ),
            )
        ));
    }

    public function overrideTtaTabs(){
        vc_map_update( 'vc_tta_tabs', array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'title',
                    'heading' => _x( 'Widget title', 'admin-view', 'precise' ),
                    'description' => _x( 'Enter text used as widget title (Note: located above content element).', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html_x( 'Precise 01', 'admin-view', 'precise' ) => 'la-1',
                        esc_html_x( 'Precise 02', 'admin-view', 'precise' ) => 'la-2',
                        esc_html_x( 'Precise 03', 'admin-view', 'precise' ) => 'la-3',
                        esc_html_x( 'Precise 04', 'admin-view', 'precise' ) => 'la-4',
                        esc_html_x( 'Precise 05', 'admin-view', 'precise' ) => 'la-5',
                        esc_html_x( 'Classic', 'admin-view', 'precise' ) => 'classic',
                        esc_html_x( 'Modern', 'admin-view', 'precise' ) => 'modern',
                        esc_html_x( 'Flat', 'admin-view', 'precise' ) => 'flat',
                        esc_html_x( 'Outline', 'admin-view', 'precise' ) => 'outline',
                    ),
                    'heading' => esc_html_x( 'Style', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tabs display style.', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'shape',
                    'value' => array(
                        esc_html_x( 'Rounded', 'admin-view', 'precise' ) => 'rounded',
                        esc_html_x( 'Square', 'admin-view', 'precise' ) => 'square',
                        esc_html_x( 'Round', 'admin-view', 'precise' ) => 'round',
                    ),
                    'heading' => esc_html_x( 'Shape', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tabs shape.', 'admin-view', 'precise' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'color',
                    'heading' => esc_html_x( 'Color', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tabs color.', 'admin-view', 'precise' ),
                    'value' => getVcShared( 'colors-dashed' ),
                    'std' => 'grey',
                    'param_holder_class' => 'vc_colored-dropdown',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),

                array(
                    'type' => 'checkbox',
                    'param_name' => 'no_fill_content_area',
                    'heading' => esc_html_x( 'Do not fill content area?', 'admin-view', 'precise' ),
                    'std' => 'true',
                    'description' => esc_html_x( 'Do not fill content area with color.', 'admin-view', 'precise' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'spacing',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'precise' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Spacing', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tabs spacing.', 'admin-view', 'precise' ),
                    'std' => '',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'gap',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'precise' ) => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html_x( 'Gap', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tabs gap.', 'admin-view', 'precise' ),
                    'std' => '',
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'tab_position',
                    'value' => array(
                        esc_html_x( 'Top', 'admin-view', 'precise' ) => 'top',
                        esc_html_x( 'Bottom', 'admin-view', 'precise' ) => 'bottom',
                    ),
                    'heading' => esc_html_x( 'Position', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tabs navigation position.', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'alignment',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'precise' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'precise' ) => 'right',
                        esc_html_x( 'Center', 'admin-view', 'precise' ) => 'center',
                    ),
                    'heading' => esc_html_x( 'Alignment', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tabs section title alignment.', 'admin-view', 'precise' ),
                    'std' => 'center',
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'autoplay',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'precise' ) => 'none',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '10' => '10',
                        '20' => '20',
                        '30' => '30',
                        '40' => '40',
                        '50' => '50',
                        '60' => '60',
                    ),
                    'std' => 'none',
                    'heading' => esc_html_x( 'Autoplay', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select auto rotate for tabs in seconds (Note: disabled by default).', 'admin-view', 'precise' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html_x( 'Active section', 'admin-view', 'precise' ),
                    'value' => 1,
                    'description' => esc_html_x( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_style',
                    'value' => array(
                        esc_html_x( 'None', 'admin-view', 'precise' ) => '',
                        esc_html_x( 'Square Dots', 'admin-view', 'precise' ) => 'outline-square',
                        esc_html_x( 'Radio Dots', 'admin-view', 'precise' ) => 'outline-round',
                        esc_html_x( 'Point Dots', 'admin-view', 'precise' ) => 'flat-round',
                        esc_html_x( 'Fill Square Dots', 'admin-view', 'precise' ) => 'flat-square',
                        esc_html_x( 'Rounded Fill Square Dots', 'admin-view', 'precise' ) => 'flat-rounded',
                    ),
                    'heading' => esc_html_x( 'Pagination style', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select pagination style.', 'admin-view', 'precise' ),
                    'dependency' => array(
                        'element' => 'style',
                        'value' => array('classic','modern','flat','outline')
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_color',
                    'value' => getVcShared( 'colors-dashed' ),
                    'heading' => esc_html_x( 'Pagination color', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select pagination color.', 'admin-view', 'precise' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'std' => 'grey',
                    'dependency' => array(
                        'element' => 'pagination_style',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html_x( 'Extra class name', 'admin-view', 'precise' ),
                    'param_name' => 'el_class',
                    'description' => esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html_x( 'CSS box', 'admin-view', 'precise' ),
                    'param_name' => 'css',
                    'group' => esc_html_x( 'Design Options', 'admin-view', 'precise' ),
                ),
            )
        ));
    }

    public function overrideTtaSection(){
        $shortcode_tag = 'vc_tta_section';
        $shortcode_object = vc_get_shortcode($shortcode_tag);
        $shortcode_params = $shortcode_object['params'];
        $i_type_idx = self::getParamIndex($shortcode_params,'i_type');
        $el_class_idx = self::getParamIndex($shortcode_params,'el_class');
        if($i_type_idx !== -1 && $el_class_idx !== -1){
            $el_class = $shortcode_params[$el_class_idx];
            $shortcode_params[$i_type_idx]['value'][esc_html_x('LaStudio Icon Outline', 'admin-view', 'precise')] = 'la_icon_outline';
            $shortcode_params[$el_class_idx] = array (
                'type' => 'iconpicker',
                'heading' => _x( 'Icon', 'admin-view', 'precise' ),
                'param_name' => 'i_icon_la_icon_outline',
                'value' => 'la-icon design-2_image',
                'settings' => array(
                    'emptyIcon' => false,
                    'type' => 'la_icon_outline',
                    'iconsPerPage' => 50,
                ),
                'dependency' => array(
                    'element' => 'i_type',
                    'value' => 'la_icon_outline',
                )
            );
            $shortcode_params[] = $el_class;
            vc_map_update($shortcode_tag , array(
                'params' => $shortcode_params
            ));
        }
    }

    public function modifyTtaTabsClasses($classes, $atts){
        if(isset($atts['style']) && strpos($atts['style'],'la-') !== false && isset($atts['alignment'])){
            $classes[] = 'vc_tta-' . $atts['style'];
            $classes[] = 'vc_tta-alignment-' . $atts['alignment'];
        }
        return $classes;
    }

    public function overrideTtaTour(){
        vc_map_update( 'vc_tta_tour', array(
            'category' => $this->category,
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html_x( 'Precise 01', 'admin-view', 'precise' ) => 'la-1',
                    ),
                    'heading' => esc_html_x( 'Style', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tabs display style.', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'tab_position',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'precise' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'precise' ) => 'right',
                    ),
                    'heading' => esc_html_x( 'Position', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tour navigation position.', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'alignment',
                    'value' => array(
                        esc_html_x( 'Left', 'admin-view', 'precise' ) => 'left',
                        esc_html_x( 'Right', 'admin-view', 'precise' ) => 'right',
                        esc_html_x( 'Center', 'admin-view', 'precise' ) => 'center',
                    ),
                    'heading' => esc_html_x( 'Alignment', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tabs section title alignment.', 'admin-view', 'precise' ),
                    'std' => 'center',
                ),
                array(
                    'type' => 'hidden',
                    'param_name' => 'autoplay',
                    'std' => 'none',
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'controls_size',
                    'value' => array(
                        esc_html_x( 'Auto', 'admin-view', 'precise' ) => '',
                        esc_html_x( 'Extra large', 'admin-view', 'precise' ) => 'xl',
                        esc_html_x( 'Large', 'admin-view', 'precise' ) => 'lg',
                        esc_html_x( 'Medium', 'admin-view', 'precise' ) => 'md',
                        esc_html_x( 'Small', 'admin-view', 'precise' ) => 'sm',
                        esc_html_x( 'Extra small', 'admin-view', 'precise' ) => 'xs',
                    ),
                    'heading' => esc_html_x( 'Navigation width', 'admin-view', 'precise' ),
                    'description' => esc_html_x( 'Select tour navigation width.', 'admin-view', 'precise' ),
                ),

                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html_x( 'Active section', 'admin-view', 'precise' ),
                    'value' => 1,
                    'description' => esc_html_x( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html_x( 'Extra class name', 'admin-view', 'precise' ),
                    'param_name' => 'el_class',
                    'description' => esc_html_x( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'admin-view', 'precise' ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html_x( 'CSS box', 'admin-view', 'precise' ),
                    'param_name' => 'css',
                    'group' => esc_html_x( 'Design Options', 'admin-view', 'precise' ),
                ),
            )
        ));
    }

    public function overrideVcSection(){
        vc_add_params('vc_section', array(
            array(
                'type' => 'dropdown',
                'heading' => _x('Section Behaviour', 'admin-view', 'precise'),
                'param_name' => 'fp_auto_height',
                'admin_label' => true,
                'value' => array(
                    _x('Full Height', 'admin-view', 'precise') => 'off',
                    _x('Auto Height', 'admin-view', 'precise') => 'on',
                    _x('Responsive Auto Height', 'admin-view', 'precise') => 'responsive',
                    _x('Top Fixed Header', 'admin-view', 'precise') => 'fixed_top',
                    _x('Bottom Fixed Footer', 'admin-view', 'precise') => 'fixed_bottom',
                ),
                'description' => _x('Select section row behaviour.', 'admin-view', 'precise'),
                'group' => esc_html_x('One Page Settings', 'admin-view', 'precise'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => _x('Anchor', 'admin-view', 'precise'),
                'param_name' => 'fp_anchor',
                'admin_label'   => true,
                'value' => '',
                'description' => _x('Enter an anchor (ID).', 'admin-view', 'precise'),
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'group' => esc_html_x('One Page Settings', 'admin-view', 'precise'),
            ),
            array(
                'type' => 'textfield',
                'class' => '',
                'heading' => _x('Tooltip', 'admin-view', 'precise'),
                'param_name' => 'fp_tooltip',
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'value' => '',
                'group' => esc_html_x('One Page Settings', 'admin-view', 'precise'),
            ),
            array(
                'type' => 'checkbox',
                'class' => '',
                'heading' => _x('Rows as Slides', 'admin-view', 'precise'),
                'param_name' => 'fp_column_slide',
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'value' => '',
                'group' => esc_html_x('One Page Settings', 'admin-view', 'precise'),
                'description' => _x('Enable if you want to show each row in this section as slides.', 'admin-view', 'precise'),
            ),
            array(
                'type' => 'checkbox',
                'class' => '',
                'heading' => _x('No Scrollbars', 'admin-view', 'precise'),
                'param_name' => 'fp_no_scrollbar',
                'dependency' => array('element' => 'fp_auto_height', 'value' => array('off', 'on', 'responsive')),
                'value' => '',
                'group' => esc_html_x('One Page Settings', 'admin-view', 'precise'),
                'description' => _x('Enable if scrolloverflow is enabled but you don\'t want to show scrollbars for this section.', 'admin-view', 'precise'),
            )
        ));
    }

    protected function arrayToObject($array) {
        if (!is_array($array)) {
            return $array;
        }
        $object = new stdClass();
        if (is_array($array) && count($array) > 0) {
            foreach ($array as $name=>$value) {
                $name = strtolower(trim($name));
                if (!empty($name)) {
                    $object->$name = $this->arrayToObject($value);
                }
            }
            return $object;
        }
        else {
            return false;
        }
    }

    public static function getParamIndex($array, $attr){
        foreach ($array as $index => $entry) {
            if ($entry['param_name'] == $attr) {
                return $index;
            }
        }
        return -1;
    }

}