<?php
/*
Plugin Name:    Precise Package Demo Data
Plugin URI:     http://la-studioweb.com/
Description:    This plugin use only for Precise Theme
Author:         LA Studio
Author URI:     http://la-studioweb.com/
Version:        1.0.0
Text Domain:    la-studio
*/

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Precise_Data_Demo_Plugin_Class{

    public static $plugin_dir_path = null;

    public static $plugin_dir_url = null;

    public static $instance = null;

    private $preset_allows = array();

    protected $demo_data = array();

    public static function get_instance() {
        if ( null === static::$instance ) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __construct( ) {

        self::$plugin_dir_path = plugin_dir_path(__FILE__);

        self::$plugin_dir_url = plugin_dir_url(__FILE__);

        include_once self::$plugin_dir_path . 'demodata.php';
        require_once self::$plugin_dir_path . 'importer.php';

        $this->_setup_demo_data();

        if( self::isLocal() ){
            $this->_load_other_hook();
        }

        if(class_exists('LaStudio_Importer')){
            new LaStudio_Importer('precise', $this->get_data_for_import_demo());
        }

        add_filter('precise/filter/demo_data', array( $this, 'get_data_for_import_demo') );

        add_action('wp', array( $this, 'init_override'), 99 );

        add_shortcode('la_select_demo', array( $this, 'render_select_demo_shortcodes') );

        add_action('init', array( $this, 'register_menu_import_demo'), 99 );

        add_action('LaStudio_Importer/copy_image', array( $this, 'copy_demo_image') );
    }

    public function init_override(){
        if(!is_admin()){
            $this->_override_settings();
        }
    }

    public function copy_demo_image(){
        if(file_exists(self::$plugin_dir_path . 'data/images.zip')){
            $theme_name = 'precise';
            $status = get_option($theme_name . '_was_copy_image');
            if(!$status){
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $destination = wp_upload_dir();
                $destination_path = $destination['basedir'];
                ob_start();
                $unzipfile = unzip_file( self::$plugin_dir_path . 'data/images.zip', $destination_path);
                ob_end_clean();
                if($unzipfile){
                    update_option( $theme_name . '_was_copy_image' , true );
                }
            }
        }
    }

    public function register_menu_import_demo(){
        if(class_exists('LaStudio_Plugin')){
            require_once self::$plugin_dir_path . 'panel.php';
        }
    }

    public function get_data_for_import_demo(){
        $demo = (array) $this->filter_demo_item_by_category('demo');
        return $demo;
    }

    private function _setup_demo_data(){

        $this->preset_allows = array(
            'demo-01',
            'demo-02',
            'demo-03',
            'demo-04',
            'demo-05',
            'demo-06',
            'demo-07',
            'demo-08',
            'demo-09',
            'demo-10',
            'demo-11',
            'demo-12',
            'demo-13',
            'blog-masonry',
            'blog-classic',
            'blog-sidebar',
            'blog-right-sidebar',
            'shop-sidebar',
            'shop-fullwidth',
            'shop-2-columns',
            'shop-3-columns',
            'shop-4-columns',
            'shop-masonry-1',
            'shop-masonry-2',
            'shop-detail-1',
            'shop-detail-2',
            'shop-detail-3'
        );

        $this->demo_data = precise_get_demo_array( self::$plugin_dir_url . 'previews/', self::$plugin_dir_path . 'data/' );

    }

    private function _get_preset_from_file( $preset = ''){

        if(!empty($preset)){
            $file = self::$plugin_dir_path . 'presets/' . $preset . '.php';
            if(file_exists($file)){
                include_once $file;
                return call_user_func( 'la_precise_preset_' . str_replace('-', '_', $preset) );
            }
            return false;
        }
        return false;
    }

    private function _load_data_from_preset( $preset ){
        $settings = $this->_get_preset_from_file( $preset );
        if(!empty($settings)){
            foreach ( $settings as $setting ) {
                if(isset($setting['filter_name'])){

                    if(!empty($setting['filter_func'])){
                        $filter_priority = isset($setting['filter_priority']) ? $setting['filter_priority'] : 10;
                        $filter_args = isset($setting['filter_args']) ? $setting['filter_args'] : 1;
//                        la_log(array(
//                            'filter_name' => $setting['filter_name'],
//                            'filter_func' => $setting['filter_func'],
//                            'filter_priority' => $filter_priority,
//                            'filter_args' => $filter_args,
//                        ));
                        add_filter($setting['filter_name'], $setting['filter_func'], $filter_priority, $filter_args );
                    }
                    else{
                        $new_filter_value = $setting['value'];
                        add_filter("{$setting['filter_name']}", function() use ( $new_filter_value ){
                            return $new_filter_value;
                        });
                    }

                }else{
                    $new_value = $setting['value'];
                    $keys = explode('|', $setting['key']);
                    foreach( $keys as $key ){
                        //la_log("precise/setting/option/get_{$setting['key']}");
                        add_filter("precise/setting/option/get_{$key}", function() use ( $new_value ){
                            return $new_value;
                        }, 11);
                    }
                }
            }
        }
    }
    
    private function _override_settings(){

        if(!empty($_GET['la_preset']) && in_array( $_GET['la_preset'], $this->preset_allows )){
            $this->_load_data_from_preset($_GET['la_preset']);
        }
        if(self::isLocal() && is_page()){
            $lists_preset = $this->get_demo_with_preset();
            if(!empty($lists_preset)){
                $current_page_name = get_queried_object()->post_name;
                if( array_key_exists( $current_page_name, $lists_preset ) ) {
                    $this->_load_data_from_preset($lists_preset[$current_page_name]);
                }
            }
        }
    }

    private function get_demo_with_preset(){
        $lists = array();
        $demo_data = (array) $this->demo_data;
        if(!empty($demo_data)){
            foreach($demo_data as $key => $demo){
                if(!empty($demo['demo_preset'])){
                    $lists[$key] = $demo['demo_preset'];
                }
            }
        }
        return $lists;
    }

    public static function isLocal(){
        $is_local = false;
        if (isset($_SERVER['X_FORWARDED_HOST']) && !empty($_SERVER['X_FORWARDED_HOST'])) {
            $hostname = $_SERVER['X_FORWARDED_HOST'];
        } else {
            $hostname = $_SERVER['HTTP_HOST'];
        }
        if (strpos($hostname, '.la-studioweb.com') !== false ) {
            $is_local = true;
        }
        return $is_local;
    }

    public function filter_demo_item_by_category( $category ){
        $demo_data = (array) $this->demo_data;
        $return = array();
        if(!empty($demo_data) && !empty($category)){
            foreach( $demo_data as $key => $demo ){
                if(!empty($demo['category']) && $demo['category'] == $category){
                    $return[$key] = $demo;
                }
            }
        }
        return $return;
    }

    public function render_select_demo_shortcodes($atts, $content){
        $category = '';
        extract(shortcode_atts(array(
            'category' => 'demo'
        ), $atts));
        ob_start();
        $demo_data = $this->filter_demo_item_by_category($category);
        if(!empty($demo_data)){
            echo '<div class="demo-grid grid-items lg-grid-3-items md-grid-3-items sm-grid-2-items xs-grid-1-items mb-grid-1-items">';
            $counter = 0;
            foreach ( $demo_data as $dm_id => $demo ){
                $counter++;
                $tmp = '<div id="demo-'.esc_attr($dm_id).'" class="demo-item grid-item"><div class="item-inner la-animation animated wpb_animate_when_almost_visible" data-animation-delay="%4$s" data-animation-class="fadeIn"><a target="_blank" href="%1$s"><img src="%2$s" alt="%3$s"/><span>launch demo</span></a><h2 class="h3">%3$s</h2></div></div>';
                echo sprintf($tmp, esc_url($demo['demo_url']), esc_url($demo['preview']), esc_html($demo['title']), $counter * 100 . 'ms');
                if($counter == 3){
                    $counter = 0;
                }
            }
            echo '</div>';
        }
        return ob_get_clean();
    }

    private function _load_other_hook(){
        include_once self::$plugin_dir_path . 'other-hook.php';
    }

}

add_action('plugins_loaded', array('Precise_Data_Demo_Plugin_Class','get_instance') );