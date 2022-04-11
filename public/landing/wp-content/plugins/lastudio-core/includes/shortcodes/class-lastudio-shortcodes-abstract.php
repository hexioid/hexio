<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class LaStudio_Shortcodes_Abstract extends WPBakeryShortCode{

    static $html_ajax_template, $_html_template;

    public $_template_folder = 'templates';

    protected function findShortcodeTemplate() {

        self::$html_ajax_template 	= plugin_dir_path(__FILE__) . $this->_template_folder . '/ajax_wrapper.php';
        self::$_html_template 		= plugin_dir_path(__FILE__) . $this->_template_folder . '/'. $this->getShortcode() .'.php';
        $_template = parent::findShortcodeTemplate();
        if($_template){
            return $_template;
        }else{
            if(isset($this->atts['enable_ajax_loader']) && !empty($this->atts['enable_ajax_loader'])){
                unset($this->atts['enable_ajax_loader']);
                return $this->setTemplate(self::$html_ajax_template);
            }else{
                return $this->setTemplate(self::$_html_template);
            }
        }
    }

    public function query($args){
        return new WP_Query($args);
    }

    public function renderAjax( $request_param ) {
        $shortcode_atts = isset($request_param['atts']) ? $request_param['atts'] : array();
        $content = isset($request_param['content']) ? $request_param['content'] : null;
        return $this->content($shortcode_atts,$content);
    }
}