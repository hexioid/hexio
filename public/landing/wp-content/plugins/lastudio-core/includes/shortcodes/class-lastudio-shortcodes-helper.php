<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class LaStudio_Shortcodes_Helper{

    public function __construct(){

    }

    public static function remove_js_autop($content, $autop = false){
        if ( $autop ) {
            $content = preg_replace( '/<\/?p\>/', "\n", $content );
            $content = preg_replace( '/<p[^>]*><\\/p[^>]*>/', "", $content );
            $content = wpautop( $content . "\n" );
        }
        return do_shortcode( shortcode_unautop( $content ) );
    }

    public static function fieldIconType($dependency = array(), $emptyIcon = false){
        return array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library', 'la-studio' ),
                'value' => array(
                    __( 'Font Awesome', 'la-studio' ) => 'fontawesome',
                    __( 'Open Iconic', 'la-studio' ) => 'openiconic',
                    __( 'Typicons', 'la-studio' ) => 'typicons',
                    __( 'Entypo', 'la-studio' ) => 'entypo',
                    __( 'Linecons', 'la-studio' ) => 'linecons',
                    __( 'Mono Social', 'la-studio' ) => 'monosocial',
                    __( 'LaStudio Icon Outline', 'la-studio' ) => 'la_icon_outline',
                    __( 'Nucleo Glyph', 'la-studio' ) => 'nucleo_glyph',
                    __( 'Custom Image', 'la-studio') => 'custom',
                ),
                'param_name' => 'icon_type',
                'description' => __( 'Select icon library.', 'la-studio' ),
                'dependency' => $dependency
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'la-studio' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-info-circle',
                'settings' => array(
                    'emptyIcon' => $emptyIcon,
                    'iconsPerPage' => 30,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'fontawesome',
                )
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'la-studio' ),
                'param_name' => 'icon_openiconic',
                'settings' => array(
                    'emptyIcon' => $emptyIcon,
                    'type' => 'openiconic',
                    'iconsPerPage' => 30,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'openiconic',
                )
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'la-studio' ),
                'param_name' => 'icon_typicons',
                'settings' => array(
                    'emptyIcon' => $emptyIcon,
                    'type' => 'typicons',
                    'iconsPerPage' => 30,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'typicons',
                )
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'la-studio' ),
                'param_name' => 'icon_entypo',
                'settings' => array(
                    'emptyIcon' => $emptyIcon,
                    'type' => 'entypo',
                    'iconsPerPage' => 30,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'entypo',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'la-studio' ),
                'param_name' => 'icon_linecons',
                'settings' => array(
                    'emptyIcon' => $emptyIcon,
                    'type' => 'linecons',
                    'iconsPerPage' => 30,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'linecons',
                )
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'la-studio' ),
                'param_name' => 'icon_monosocial',
                'value' => 'vc-mono vc-mono-fivehundredpx',
                'settings' => array(
                    'emptyIcon' => $emptyIcon,
                    'type' => 'monosocial',
                    'iconsPerPage' => 30,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'monosocial',
                )
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'la-studio' ),
                'param_name' => 'icon_la_icon_outline',
                'value' => 'la-icon design-2_image',
                'settings' => array(
                    'emptyIcon' => $emptyIcon,
                    'type' => 'la_icon_outline',
                    'iconsPerPage' => 30,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'la_icon_outline',
                )
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'la-studio' ),
                'param_name' => 'icon_nucleo_glyph',
                'value' => 'nc-icon-glyph nature_bear',
                'settings' => array(
                    'emptyIcon' => $emptyIcon,
                    'type' => 'nucleo_glyph',
                    'iconsPerPage' => 30,
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'nucleo_glyph',
                )
            ),
            array(
                'type' => 'attach_image',
                'heading' => __('Upload the custom image icon', 'la-studio'),
                'param_name' => "icon_image_id",
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'custom',
                ),
            )
        );
    }

    public static function fieldColumn($options = array()){
        return array_merge(array(
            'type' 			=> 'la_column',
            'heading' 		=> __('Column', 'la-studio'),
            'param_name' 	=> 'column',
            'unit'			=> '',
            'media'			=> array(
                'xlg'	=> 1,
                'lg'	=> 1,
                'md'	=> 1,
                'sm'	=> 1,
                'xs'	=> 1,
                'mb'	=> 1
            )
        ), $options);
    }

    public static function fieldImageSize($options = array()){
        return array_merge(
            array(
                'type' 			=> 'textfield',
                'heading' 		=> __('Image size', 'la-studio'),
                'param_name' 	=> 'img_size',
                'value'			=> 'thumbnail',
                'description' 	=> __('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'la-studio'),
            ),
            $options
        );
    }

    public static function fieldCssAnimation($options = array()){
        return array_merge(
            array(
                'type' => 'animation_style',
                'heading' => __( 'CSS Animation', 'la-studio' ),
                'param_name' => 'css_animation',
                'value' => 'none',
                'settings' => array(
                    'type' => array(
                        'in',
                        'other',
                    ),
                ),
                'description' => __( 'Select initial loading animation for element.', 'la-studio' ),
            ),
            $options
        );
    }

    public static function fieldExtraClass($options = array()){
        return array_merge(
            array(
                'type' 			=> 'textfield',
                'heading' 		=> __('Extra Class name', 'la-studio'),
                'param_name' 	=> 'el_class',
                'description' 	=> __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'la-studio')
            ),
            $options
        );
    }

    public static function fieldCssClass($options = array()){
        return array_merge(
            array(
                'type' 			=> 'css_editor',
                'heading' 		=> __('CSS box', 'la-studio'),
                'param_name' 	=> 'css',
                'group' 		=> __('Design Options', 'la-studio')
            ),
            $options
        );
    }

    public static function fieldCarousel($dependency = array()){
        $group = __('Slider Settings', 'la-studio');
        return array(
            array(
                'type' 			=> 'la_number',
                'heading' 		=> __('Slide Scrolling Speed', 'la-studio'),
                'param_name' 	=> 'scroll_speed',
                'value' 		=> 1000,
                'min' 			=> 100,
                'suffix' 		=> __('Milliseconds', 'la-studio'),
                'description' 	=> __('Slide transition duration (in milliseconds)', 'la-studio'),
                'group' 		=> $group,
                'dependency' 	=> $dependency
            ),
            array(
                'type' 			=> 'checkbox',
                'heading' 		=> __('Advanced settings', 'la-studio'),
                'param_name' 	=> 'advanced_opts',
                'value' 		=> array(
                    __('Enable infinite scroll', 'la-studio') . '<br/>' => 'loop',
                    __('Enable dots', 'la-studio') . '<br/>' 			=> 'dot',
                    __('Enable navigation', 'la-studio') . '<br/>' 		=> 'nav',
                    __('Enable autoplay','la-studio') . '<br/>' 		=> 'autoplay',
                    __('Enable Variable Width', 'la-studio') . '<br/>'  => 'variable_width',
                    __('Enable Center Mode', 'la-studio') . '<br/>'     => 'center_mode'
                ),
                'group' 		=> $group,
                'dependency' 	=> $dependency

            ),
            array(
                'type' 			=> 'la_number',
                'heading' 		=> __('AutoPlay Speed', 'la-studio'),
                'param_name'	=> 'autoplay_speed',
                'value' 		=> 3000,
                'min' 			=> 100,
                'suffix' 		=> 'ms',
                'description' 	=> __('Autoplay Speed in milliseconds', 'la-studio'),
                'group' 		=> $group,
                'dependency' 	=> array(
                    'element'	=> 'advanced_opts',
                    'value'		=> 'autoplay'
                )
            ),
            array(
                'type' 			=> 'textfield',
                'heading' 		=> __( 'Custom Navigation Carousel Element', 'la-studio' ),
                'param_name' 	=> 'custom_nav',
                'description' 	=> "Ex: jQuery('.{class_name}') or jQuery(#{id_name})",
                'group' 		=> $group,
                'dependency' 	=> array(
                    'element'	=> 'advanced_opts',
                    'value'		=> 'nav'
                )
            )
        );
    }

    public static function getColumnFromShortcodeAtts( $atts ){
        $array = array(
            'xlg'	=> 1,
            'lg' 	=> 1,
            'md' 	=> 1,
            'sm' 	=> 1,
            'xs' 	=> 1,
            'mb' 	=> 1
        );
        $atts = explode(';',$atts);
        if(!empty($atts)){
            foreach($atts as $val){
                $val = explode(':',$val);
                if(isset($val[0]) && isset($val[1])){
                    if(isset($array[$val[0]])){
                        $array[$val[0]] = absint($val[1]);
                    }
                }
            }
        }
        return $array;
    }

    public static function fieldTitleGFont( $name = 'title', $title = 'Title',  $options = array() ){
        $group = __('Typography', 'la-studio');
        $array = array();
        $array[] = array(
            'type' 			=> 'la_heading',
            'param_name' 	=> $name . '__typography',
            'text' 			=> $title . __(' settings', 'la-studio'),
            'group' 		=> $group
        );
        $array[] = array(
            'type' => 'checkbox',
            'heading' => __( 'Use google fonts family?', 'la-studio' ),
            'param_name' => 'use_gfont_' . $name,
            'value' => array( __( 'Yes', 'la-studio' ) => 'yes' ),
            'description' => __( 'Use font family from the theme.', 'la-studio' ),
            'group' 		=> $group
        );
        $array[] = array(
            'type' 			=> 'google_fonts',
            'param_name' 	=> $name . '_font',
            'dependency' 	=> array(
                'element' => 'use_gfont_' . $name,
                'value' => 'yes',
            ),
            'group' 		=> $group
        );
        $array[] = array(
            'type' 			=> 'la_column',
            'heading' 		=> __('Font size', 'la-studio'),
            'param_name' 	=> $name . '_fz',
            'unit' 			=> 'px',
            'media' => array(
                'xlg'	=> '',
                'lg'    => '',
                'md'    => '',
                'sm'    => '',
                'xs'	=> '',
                'mb'	=> ''
            ),
            'group' 		=> $group
        );
        $array[] = array(
            'type' 			=> 'la_column',
            'heading' 		=> __('Line Height', 'la-studio'),
            'param_name' 	=> $name . '_lh',
            'unit' 			=> 'px',
            'media' => array(
                'xlg'	=> '',
                'lg'    => '',
                'md'    => '',
                'sm'    => '',
                'xs'	=> '',
                'mb'	=> ''
            ),
            'group' 		=> $group
        );
        $array[] = array(
            'type' 			=> 'colorpicker',
            'param_name' 	=> $name . '_color',
            'heading' 		=> __('Color', 'la-studio'),
            'group' 		=> $group
        );
        return array_merge( $array, $options);
    }

    public static function getResponsiveMediaCss( $args = array() ){
        $content = '';
        if(!empty($args) && !empty($args['target']) && !empty($args['media_sizes'])){
            $content .=  " data-unit-target='".esc_attr($args['target'])."' ";
            $content .=  " data-responsive-json-new='".esc_attr(json_encode($args['media_sizes']))."' ";
        }
        return $content;
    }

    public static function renderResponsiveMediaCss(&$css = array(), $args = array()){

        if(!empty($args) && !empty($args['target']) && !empty($args['media_sizes'])){
            $target = $args['target'];
            foreach( $args['media_sizes'] as $css_attribute => $items ){
                $media_sizes =  explode(';', $items);
                if(!empty($media_sizes)){
                    foreach($media_sizes as $value ){
                        $tmp = explode(':', $value);
                        if(!empty($tmp[1])){
                            if(!isset($css[$tmp[0]])){
                                $css[$tmp[0]] = '';
                            }
                            $css[$tmp[0]] .= $target . '{' . $css_attribute . ':'. $tmp[1] .'}';
                        }
                    }
                }
            }
        }
        return $css;
    }

    public static function renderResponsiveMediaStyleTags( $custom_css = array() ){
        $output = '';
        if(function_exists('vc_is_inline') && vc_is_inline() && !empty($custom_css)){
            foreach($custom_css as $media => $value){
                switch($media){
                    case 'lg':
                        $output .= $value;
                        break;
                    case 'xlg':
                        $output .= '@media (min-width: 1824px){'.$value.'}';
                        break;
                    case 'md':
                        $output .= '@media (max-width: 1199px){'.$value.'}';
                        break;
                    case 'sm':
                        $output .= '@media (max-width: 991px){'.$value.'}';
                        break;
                    case 'xs':
                        $output .= '@media (max-width: 767px){'.$value.'}';
                        break;
                    case 'mb':
                        $output .= '@media (max-width: 479px){'.$value.'}';
                        break;
                }
            }
        }
        if(!empty($output)){
            echo '<style type="text/css">'.$output.'</style>';
        }
    }

    public static function parseGoogleFontAtts( $value ){
        $fields = array();
        $styles = array();
        $settings = get_option( 'wpb_js_google_fonts_subsets' );
        if ( is_array( $settings ) && ! empty( $settings ) ) {
            $subsets = '&subset=' . implode( ',', $settings );
        } else {
            $subsets = '';
        }
        $value = vc_parse_multi_attribute($value);
        if(isset($value['font_family']) && isset($value['font_style'])){
            $google_fonts_family = explode( ':', $value['font_family'] );
            $styles[] = 'font-family:' . $google_fonts_family[0];
            $google_fonts_styles = explode( ':', $value['font_style'] );
            $styles[] = 'font-weight:' . $google_fonts_styles[1];
            $styles[] = 'font-style:' . $google_fonts_styles[2];
            $fields['font_url'] = '//fonts.googleapis.com/css?family=' . rawurlencode($value['font_family']) . $subsets;
            $fields['font_family'] = vc_build_safe_css_class($value['font_family']);

            $fields['style'] = implode(';',$styles);
        }
        return $fields;
    }

    public static function getImageSizeFormString($size, $default = 'thumbnail'){
        if(empty($size)){
            return $default;
        }
        $ignore = array(
            'thumbnail',
            'thumb',
            'medium',
            'large',
            'full'
        );
        if(false !== strpos($size, 'la_')){
            return $size;
        }
        $_wp_additional_image_sizes = wp_get_additional_image_sizes();
        if(is_string($size) && (in_array($size, $ignore) || (!empty($_wp_additional_image_sizes[$size]) && is_array($_wp_additional_image_sizes[$size]) ))){
            return $size;
        }
        else{
            preg_match_all( '/\d+/', $size, $thumb_matches );
            if ( isset( $thumb_matches[0] ) ) {
                $thumb_size = array();
                if ( count( $thumb_matches[0] ) > 1 ) {
                    $thumb_size[] = $thumb_matches[0][0]; // width
                    $thumb_size[] = $thumb_matches[0][1]; // height
                } elseif ( count( $thumb_matches[0] ) > 0 && count( $thumb_matches[0] ) < 2 ) {
                    $thumb_size[] = $thumb_matches[0][0]; // width
                    $thumb_size[] = 0; //$thumb_matches[0][0]; // height
                } else {
                    $thumb_size = $default;
                }
            }else{
                $thumb_size = $default;
            }
            return $thumb_size;
        }
    }

    public static function getSliderConfigs($default = array()){
        $configs = array_merge($configs = array(
            'infinite' => false,
            'xlg' => 1,
            'lg' => 1,
            'md' => 1,
            'sm' => 1,
            'xs' => 1,
            'mb' => 1,
            'dots' => false,
            'autoplay' => false,
            'arrows' => false,
            'speed' => 1000,
            'autoplaySpeed' => 3000,
            'custom_nav' => '',
            'centerMode' => false,
            'variableWidth' => false
        ), $default);
        $slider_config = array(
            'infinite' => $configs['infinite'],
            'dots' => $configs['dots'],
            'slidesToShow' => $configs['xlg'],
            'slidesToScroll' => $configs['xlg'],
            'autoplay' => $configs['autoplay'],
            'arrows' => $configs['arrows'],
            'speed' => $configs['speed'],
            'autoplaySpeed' => $configs['autoplaySpeed'],
            'centerMode' => $configs['centerMode'],
            'variableWidth' => $configs['variableWidth'],
            'responsive' => array(
                array(
                    'breakpoint' => 1824,
                    'settings' => array(
                        'slidesToShow' => $configs['lg'],
                        'slidesToScroll' => $configs['lg']
                    )
                ),
                array(
                    'breakpoint' => 1200,
                    'settings' => array(
                        'slidesToShow' => $configs['md'],
                        'slidesToScroll' => $configs['md']
                    )
                ),
                array(
                    'breakpoint' => 992,
                    'settings' => array(
                        'slidesToShow' => $configs['sm'],
                        'slidesToScroll' => $configs['sm']
                    )
                ),
                array(
                    'breakpoint' => 768,
                    'settings' => array(
                        'slidesToShow' => $configs['xs'],
                        'slidesToScroll' => $configs['xs']
                    )
                ),
                array(
                    'breakpoint' => 480,
                    'settings' => array(
                        'slidesToShow' => $configs['mb'],
                        'slidesToScroll' => $configs['mb']
                    )
                )
            )
        );
        if(isset($configs['custom_nav']) && !empty($configs['custom_nav'])){
            $slider_config['appendArrows'] = 'jQuery("'.esc_attr($configs['custom_nav']).'")';
        }
        return json_encode($slider_config);
    }

    public static function getLoadingIcon(){
        return '<div class="la-shortcode-loading"><div class="content"><div class="la-loader spinner3"><div class="dot1"></div><div class="dot2"></div><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div></div>';
    }

    public static function getExtraClass( $el_class ) {
        $output = '';
        if ( '' !== $el_class ) {
            $output = ' ' . str_replace( '.', '', $el_class );
        }

        return $output;
    }

    public static function getLoopProducts($query_args, $atts, $loop_name){

        $globalVar      = apply_filters('LaStudio/global_loop_variable', 'lastudio_loop');
        $globalVarTmp   = (isset($GLOBALS[$globalVar]) ? $GLOBALS[$globalVar] : '');
        $globalParams   = array();

        $unique_id      = uniqid($loop_name . '_');
        $css_class      = 'woocommerce' . self::getExtraClass($atts['el_class']);
        $columns        = self::getColumnFromShortcodeAtts(isset($atts['columns']) ? $atts['columns'] : '');
        $layout         = isset($atts['layout']) ? $atts['layout'] : 'grid';
        $style          = $atts[$atts['layout'] . '_style'];

        $loopCssClass 	= array();
        $carousel_configs = $disable_alt_image = $image_size = false;
        if(isset($atts['enable_custom_image_size']) && $atts['enable_custom_image_size'] == 'yes'){
            $image_size = true;
        }
        if(isset($atts['disable_alt_image']) && $atts['disable_alt_image'] == 'yes'){
            $disable_alt_image = true;
        }
        if($layout == 'grid'){
            if(isset($atts['enable_carousel']) && $atts['enable_carousel'] == 'yes'){
                $advanced_opts = array();
                if(isset($atts['advanced_opts'])){
                    $advanced_opts = explode(",", $atts['advanced_opts']);
                }
                $carousel_configs= array_merge($columns,array(
                    'infinite' => in_array('loop', $advanced_opts) ? true : false,
                    'dots' => in_array('dot', $advanced_opts) ? true : false,
                    'autoplay' => in_array('autoplay', $advanced_opts) ? true : false,
                    'arrows' => in_array('nav', $advanced_opts) ? true : false,
                    'centerMode' => in_array('center_mode', $advanced_opts) ? true : false,
                    'variableWidth' => in_array('variable_width', $advanced_opts) ? true : false,
                    'speed' => $atts['scroll_speed'],
                    'autoplaySpeed' => $atts['autoplay_speed'],
                    'custom_nav' => $atts['custom_nav']
                ));
                $loopCssClass[] = 'la-slick-slider';
            }
        }
        $globalParams['loop_id'] = $unique_id;
        $globalParams['loop_layout'] = $layout;
        $globalParams['loop_style'] = $style;
        if($image_size){
            $globalParams['image_size'] = LaStudio_Shortcodes_Helper::getImageSizeFormString($atts['img_size']);
        }
        if($disable_alt_image){
            $globalParams['disable_alt_image'] = true;
        }
        $GLOBALS[$globalVar] = $globalParams;


        $loopCssClass[] = 'products';
        $loopCssClass[] = 'products-' . $layout;
        $loopCssClass[] = 'products-' . $layout . '-' . $style;
        $loopCssClass[] = 'grid-items';

        if($layout != 'list'){
            foreach( $columns as $screen => $value ){
                $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
            }
        }

        $products = new WP_Query(apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts, $loop_name ));

        $GLOBALS[$globalVar] = $globalParams;

        $loop_tpl = array();
        $loop_tpl[] = "woocommerce/content-product-{$layout}-{$style}.php";
        $loop_tpl[] = "woocommerce/content-product-{$layout}.php";
        $loop_tpl[] = "woocommerce/content-product.php";

        ob_start();

        if($products->have_posts()){

            do_action('LaStudio/shortcodes/before_loop', 'woo_shortcode', $loop_name, $atts);

            printf('<div class="row"><div class="col-xs-12"><ul class="%s"%s>',
                esc_attr(implode(' ', $loopCssClass)),
                $carousel_configs ? '  data-slider_config="'.esc_attr(self::getSliderConfigs($carousel_configs)).'"' : ''
            );

            while( $products->have_posts() ){
                $products->the_post();
                locate_template($loop_tpl, true, false);
            }

            printf('</ul></div></div>');

            do_action('LaStudio/shortcodes/after_loop', 'woo_shortcode', $loop_name, $atts);

        }

        if($products->max_num_pages > 1 && isset($atts['enable_loadmore']) && $atts['enable_loadmore'] == 'yes'){
            echo sprintf(
                '<div class="elm-loadmore-ajax" data-query-settings="%s" data-request="%s" data-paged="%s" data-max-page="%s" data-container="#%s ul.products" data-item-class=".product_item">%s<a href="#">%s</a></div>',
                esc_attr( json_encode( array(
                    'tag' => $loop_name,
                    'atts' => $atts
                ) ) ),
                esc_url( admin_url( 'admin-ajax.php', 'relative' ) ),
                esc_attr($atts['paged']),
                esc_attr($products->max_num_pages),
                esc_attr($unique_id),
                LaStudio_Shortcodes_Helper::getLoadingIcon(),
                esc_html($atts['load_more_text'])
            );
        }

        $GLOBALS[$globalVar] = $globalVarTmp;
        wp_reset_postdata();
        $output = ob_get_clean();

        printf('<div id="%s" class="%s">%s</div>',
            esc_attr($unique_id),
            esc_attr($css_class),
            $output
        );

    }

}