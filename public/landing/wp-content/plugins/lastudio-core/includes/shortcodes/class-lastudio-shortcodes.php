<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class LaStudio_Shortcodes{

    public static $shortcode_path;

    public static $instance = null;

    private $_shortcodes = array(
        'la_btn',
        'la_icon_boxes',
        'la_heading',
        'la_team_member',
        'la_stats_counter',
        'la_testimonial',
        'la_show_posts',
        'la_show_portfolios',
        'la_portfolio_masonry',
        'la_maps',
        'la_social_link',
        'la_banner',
        'la_block',
        'la_countdown',
        'la_timeline',
        'la_timeline_item',
        'la_pricing_table',
        'la_divider',
        'la_icon_list',
        'la_icon_list_item',
        'la_instagram_feed',
        'la_carousel',
        'la_hotspot',
        'la_image_with_hotspots'
    );

    private $_woo_shortcodes = array(
        'product',
        'products',
        'recent_products',
        'featured_products',
        'product_category',
        'product_categories',
        'sale_products',
        'best_selling_products',
        'top_rated_products',
        'product_attribute'
    );

    public static function register() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {

        self::$shortcode_path = plugin_dir_path(__FILE__);

        add_shortcode('la_dropcap', array( $this, 'add_dropcap') );
        add_shortcode('la_quote', array( $this, 'add_quote_shortcode') );
        add_shortcode('la_text', array( $this, 'add_text_shortcode') );
        add_shortcode('wp_nav_menu', array( $this, 'add_navmenu') );

        add_action( 'woocommerce_loaded', array( $this, 'add_woocommerce_shortcodes' ), 11 );
        add_action( 'woocommerce_loaded', array( $this, 'remove_old_woocommerce_shortcode'), 11 );

        add_action( 'vc_after_init', array( $this, 'init_shortcodes' ) );

        add_action( 'wp_ajax_get_shortcode_loader_by_ajax', array( $this, 'get_shortcode_loader_by_ajax' ) );
        add_action( 'wp_ajax_nopriv_get_shortcode_loader_by_ajax', array( $this, 'get_shortcode_loader_by_ajax' ) );

        add_filter( 'widget_text', 'do_shortcode' );
        add_filter( 'the_excerpt', 'do_shortcode');

        if(has_filter('widget_text_content', 'wpautop')){
            remove_filter( 'widget_text_content', 'wpautop');
        }

        add_filter( 'the_content', array( $this, 'formatting' ) );

        LaStudio_Shortcodes_Row::register();
        LaStudio_Shortcodes_Parallax_Row::register();
        LaStudio_Shortcodes_Autocomplete_Filters::register();

    }

    public function init_shortcodes(){

        foreach ($this->_shortcodes as $shortcode) {
            $config_file = self::$shortcode_path . 'configs/' . $shortcode . '.php';
            if(file_exists( $config_file ) ) {
                vc_lean_map( $shortcode, null, $config_file );
            }
        }
        if(class_exists('WooCommerce')){
            foreach ($this->_woo_shortcodes as $shortcode) {
                $config_file = plugin_dir_path(__FILE__) . 'configs/' . $shortcode . '.php';
                if(file_exists( $config_file)){
                    vc_lean_map( $shortcode, null, $config_file );
                }
            }
        }
        LaStudio_Shortcodes_Param::register();
        add_filter('vc_edit_form_fields_after_render', array( $this, 'add_js_to_edit_vc_form') );
    }

    public function formatting($content) {
        $shortcodes = array_merge($this->_shortcodes, $this->_woo_shortcodes, array('la_dropcap', 'la_quote', 'la_text'));
        $block = join("|", $shortcodes);
        $content = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]", $content);
        $content = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]", $content);
        return $content;
    }

    public function get_shortcode_loader_by_ajax() {
        $tag = isset($_REQUEST['tag']) ? $_REQUEST['tag'] : '';
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : '';
        if( !empty($tag) && !empty($data) ) {
            if(function_exists('visual_composer')){
                $shortcode_fishbone = visual_composer()->getShortCode( $tag );
                if ( is_object( $shortcode_fishbone ) ) {
                    $vc_grid = $shortcode_fishbone->shortcodeClass();
                    WPBMap::addAllMappedShortcodes();
                    if (method_exists( $vc_grid, 'renderAjax' ) ) {
                        echo $vc_grid->renderAjax( $data );
                    }
                }
            }
        }
        die();
    }

    public function add_dropcap( $atts, $content = null){
        $style = $color = '';
        extract(shortcode_atts(array(
            'style' => 1,
            'color' => '',
        ), $atts));

        ob_start();

        ?><span class="la-dropcap style-<?php echo esc_attr($style);?>" style="color:<?php echo esc_attr($color); ?>"><?php echo wp_strip_all_tags($content, true); ?></span><?php

        return ob_get_clean();
    }

    public function add_quote_shortcode( $atts, $content = null ){
        $output = $style = $author = $link = '';
        extract(shortcode_atts(array(
            'style' => 1,
            'author' => '',
            'link'  => ''
        ), $atts));

        if(empty($content)){
            return '';
        }
        $output .= '<blockquote class="la-blockquote style-'.esc_attr($style).'"';
        if(!empty($link)){
            $output .= ' cite="'.esc_url($link).'"';
        }
        $output .= '>';

        $output .= LaStudio_Shortcodes_Helper::remove_js_autop($content, true);

        if(!empty($author)){
            $output .= '<footer>';
            if(!empty($link)){
                $output .= '<cite><a href="'.esc_url($link).'">';
            }
            $output .= esc_html($author);
            if(!empty($link)){
                $output .= '</a></cite>';
            }
            $output .= '</footer>';
        }
        $output .= '</blockquote>';
        return $output;
    }

    public function add_text_shortcode( $atts, $content = null){
        $output = $color = $font_size = $line_height = $el_class = '';

        extract(shortcode_atts(array(
            'color' => '',
            'font_size' => '',
            'line_height' => '',
            'el_class'  => ''
        ), $atts));
        $la_fix_css = array();
        $adv_atts = '';

        if(empty($content)){
            return $output;
        }
        $unique_id = uniqid('la_text_');
        if(!empty($color)){
            $adv_atts = 'style="color:';
            $adv_atts .= esc_attr($color);
            $adv_atts .= '"';
        }
        if(!empty($font_size) || !empty($line_height)){
            $adv_atts .= LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
                'target' => '#'. $unique_id ,
                'media_sizes' => array(
                    'font-size' => $font_size,
                    'line-height' => $line_height
                )
            ));
        }
        $output = '<div id="'.$unique_id.'" class="la-text la-unit-responsive'. LaStudio_Shortcodes_Helper::getExtraClass($el_class) .'"'. $adv_atts .'>';
        $output .= $content;
        $output .= '</div>';
        return $output;
    }

    public function add_js_to_edit_vc_form(){
        echo '<script type="text/javascript">';
        if(!empty($_POST['tag']) && $_POST['tag'] == 'vc_section'){
            echo 'LaVCAdminEditForm("vc_section");';
        }
        if(!empty($_POST['tag']) && $_POST['tag'] == 'vc_row' && !empty($_POST['parent_tag']) && $_POST['parent_tag'] == 'vc_section'){
            echo 'LaVCAdminEditForm("vc_row");';
        }
        if(!empty($_POST['tag']) && $_POST['tag'] == 'la_image_with_hotspots'){
            echo 'LaVCAdminEditForm("la_image_with_hotspots");';
        }
        echo '</script>';
    }

    public function add_navmenu( $atts, $content = null){
        $menu_id = $container_class = '';
        extract(shortcode_atts(array(
            'menu_id' => '',
            'container_class' => '',
        ), $atts));
        if(!is_nav_menu( $menu_id)){
            return '';
        }
        ob_start();
        wp_nav_menu(array(
            'menu' => $menu_id,
            'container_class' => $container_class
        ));
        return ob_get_clean();
    }

    /*
     * For WooCommerce
     */
    public function add_woocommerce_shortcodes(){
        foreach ($this->_woo_shortcodes as $shortcode) {
            add_filter( "{$shortcode}_shortcode_tag", array( $this, 'modify_woocommerce_shortcodes' ) );
        }
    }
    
    public function modify_woocommerce_shortcodes( $shortcode ){
        return "{$shortcode}_deprecated";
    }

    public function remove_old_woocommerce_shortcode(){
        foreach ($this->_woo_shortcodes as $shortcode) {
            remove_shortcode( "{$shortcode}_deprecated" );
        }
    }

}