<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Precise_Setting{

    public static $instance = null;

    public $args = array();

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        $this->args = array(
            'option_name'       => Precise::get_option_name(),
            'post_meta_name'    => Precise::get_original_option_name(),
            'term_meta_name'    => Precise::get_original_option_name()
        );
    }

    public function get_all() {
        return get_option( $this->args['option_name'], array() );
    }

    public function get( $key = '', $default = '' ){
        $opt_name = $this->args['option_name'];
        $option_value = get_option( $opt_name, array() );
        if(!empty($option_value[$key])){
            $value = $option_value[$key];
        }else{
            $value = $default;
        }
        return apply_filters("precise/setting/option/get_{$key}", $value);
    }

    public function get_post_meta( $object_id, $sub_key = '', $meta_key = '', $single = true ) {

        if (!is_numeric($object_id)) {
            return false;
        }
        if (empty($meta_key)) {
            $meta_key = $this->args['post_meta_name'];
        }

        $object_value = get_post_meta($object_id, $meta_key, $single);

        if(!empty($sub_key)){
            if( $single ) {
                if(isset($object_value[$sub_key])){
                    return apply_filters("precise/setting/post_metadata/get_{$sub_key}", $object_value[$sub_key]);
                }
                else{
                    return apply_filters("precise/setting/post_metadata/get_{$sub_key}", false);
                }
            }
            else{
                $tmp = array();
                if(!empty($object_value)){
                    foreach( $object_value as $k => $v ){
                        $tmp[] = (isset($v[$sub_key])) ? $v[$sub_key] : '';
                    }
                }
                return apply_filters("precise/setting/post_metadata/get_{$sub_key}", $tmp);
            }
        }
        else{
            return apply_filters("precise/setting/post_metadata/get_{$meta_key}", $object_value);
        }
    }

    public function get_term_meta( $object_id, $sub_key = '', $meta_key = '', $single = true ) {

        if (!is_numeric($object_id)) {
            return false;
        }
        if (empty($meta_key)) {
            $meta_key = $this->args['term_meta_name'];
        }

        $object_value = get_term_meta($object_id, $meta_key, $single);

        if(!empty($sub_key)){
            if( $single ) {
                if(isset($object_value[$sub_key])){
                    return apply_filters("precise/setting/term_metadata/get_{$sub_key}", $object_value[$sub_key]);
                }
                else{
                    return apply_filters("precise/setting/term_metadata/get_{$sub_key}", false);
                }
            }
            else{
                $tmp = array();
                if(!empty($object_value)){
                    foreach( $object_value as $k => $v ){
                        $tmp[] = (isset($v[$sub_key])) ? $v[$sub_key] : '';
                    }
                }
                return apply_filters("precise/setting/term_metadata/get_{$sub_key}", $tmp);
            }
        }
        else{
            return apply_filters("precise/setting/term_metadata/get_{$meta_key}", $object_value);
        }
    }

    public function get_setting_by_context( $key, $default = '', $context = array()){

        if(empty($key)){
            return $default;
        }

        if(empty($context)){
            $context = Precise()->get_current_context();
        }
        if(!is_array($context)){
            $context = (array) $context;
        }

        $value = $value_default = $this->get( $key, $default );

        if(in_array('is_home', $context)){
            $_value = $this->get("{$key}_blog");

            if(!empty($_value)){
                if(is_array($_value)){
                    if(Precise_Helper::is_not_empty_array_ref($_value)){
                        $value = $_value;
                    }
                }else{
                    if($_value !== 'inherit'){
                        $value = $_value;
                    }
                }
            }

        }

        if(in_array('is_home', $context) || in_array('is_front_page', $context)){
            $c_page_id = Precise()->get_page_id();
            if($c_page_id){
                $_value = $this->get_post_meta( $c_page_id, $key );
                if(!empty($_value)){
                    if(is_array($_value)){
                        if(Precise_Helper::is_not_empty_array_ref($_value)){
                            $value = $_value;
                        }
                    }else{
                        if($_value !== 'inherit'){
                            $value = $_value;
                        }
                    }
                }
            }

        }
        elseif(in_array('is_singular', $context)){
            $post_type = get_query_var('post_type') ? get_query_var('post_type') : 'post';
            $post_type = str_replace('la_', '', $post_type);

            /*
             * get {$key} is layout from blog
             */

            if(is_singular('post') && $key == 'layout'){
                $_value = $this->get('layout_blog');
                if(!empty($_value) && $_value !== 'inherit'){
                    $value = $_value;
                }
            }

            $_value = $this->get("{$key}_single_{$post_type}", $value_default );
            if(!empty($_value)){
                if(is_array($_value)){
                    if(Precise_Helper::is_not_empty_array_ref($_value)){
                        $value = $_value;
                    }
                }else{
                    if($_value !== 'inherit'){
                        $value = $_value;
                    }
                }
            }
            $_value = $this->get_post_meta( get_queried_object_id(), $key );

            if(!empty($_value)){
                if(is_array($_value)){
                    if(Precise_Helper::is_not_empty_array_ref($_value)){
                        $value = $_value;
                    }
                }else{
                    if($_value !== 'inherit'){
                        $value = $_value;
                    }
                }
            }

        }
        elseif(in_array('is_archive', $context)){

            if(in_array('is_shop', $context)){
                $_value = $this->get("{$key}_archive_product", $value_default);
                if(!empty($_value)){
                    if(is_array($_value)){
                        if(Precise_Helper::is_not_empty_array_ref($_value)){
                            $value = $_value;
                        }
                    }else{
                        if($_value !== 'inherit'){
                            $value = $_value;
                        }
                    }
                }
                if(Precise()->get_page_id()){
                    $_value = $this->get_post_meta( Precise()->get_page_id(), $key);
                    if(!empty($_value)){
                        if(is_array($_value)){
                            if(Precise_Helper::is_not_empty_array_ref($_value)){
                                $value = $_value;
                            }
                        }else{
                            if($_value !== 'inherit'){
                                $value = $_value;
                            }
                        }
                    }
                }
            }
            elseif(in_array('is_product_taxonomy', $context)){
                $_value = $this->get("{$key}_archive_product", $value_default);
                if(!empty($_value)){
                    if(is_array($_value)){
                        if(Precise_Helper::is_not_empty_array_ref($_value)){
                            $value = $_value;
                        }
                    }else{
                        if($_value !== 'inherit'){
                            $value = $_value;
                        }
                    }
                }
                $_value = $this->get_term_meta( get_queried_object_id(), $key);
                if(!empty($_value)){
                    if(is_array($_value)){
                        if(Precise_Helper::is_not_empty_array_ref($_value)){
                            $value = $_value;
                        }
                    }else{
                        if($_value !== 'inherit'){
                            $value = $_value;
                        }
                    }
                }
            }
            elseif(in_array('is_post_type_archive', $context) && is_post_type_archive('la_portfolio')){
                $_value = $this->get("{$key}_archive_portfolio", $value_default);
                if(!empty($_value)){
                    if(is_array($_value)){
                        if(Precise_Helper::is_not_empty_array_ref($_value)){
                            $value = $_value;
                        }
                    }else{
                        if($_value !== 'inherit'){
                            $value = $_value;
                        }
                    }
                }
            }
            elseif(in_array('is_tax', $context) && is_tax(get_object_taxonomies( 'la_portfolio' ))){
                $_value = $this->get("{$key}_archive_portfolio", $value_default);
                if(!empty($_value)){
                    if(is_array($_value)){
                        if(Precise_Helper::is_not_empty_array_ref($_value)){
                            $value = $_value;
                        }
                    }else{
                        if($_value !== 'inherit'){
                            $value = $_value;
                        }
                    }
                }
                $_value = $this->get_term_meta( get_queried_object_id(), $key);
                if(!empty($_value)){
                    if(is_array($_value)){
                        if(Precise_Helper::is_not_empty_array_ref($_value)){
                            $value = $_value;
                        }
                    }else{
                        if($_value !== 'inherit'){
                            $value = $_value;
                        }
                    }
                }
            }
            else{
                if($key == 'layout'){
                    if( is_tag() || is_category() ){
                        $_value = $this->get("layout_blog");
                        if(!empty($_value) && $_value !== 'inherit'){
                            $value = $_value;
                        }
                    }
                }
                else{
                    $_value = $this->get("{$key}_archive_post", $value_default);
                    if(!empty($_value)){
                        if(is_array($_value)){
                            if(Precise_Helper::is_not_empty_array_ref($_value)){
                                $value = $_value;
                            }
                        }else{
                            if($_value !== 'inherit'){
                                $value = $_value;
                            }
                        }
                    }
                }

                $_value = $this->get_term_meta( get_queried_object_id(), $key);
                if(!empty($_value)){
                    if(is_array($_value)){
                        if(Precise_Helper::is_not_empty_array_ref($_value)){
                            $value = $_value;
                        }
                    }else{
                        if($_value !== 'inherit'){
                            $value = $_value;
                        }
                    }
                }
            }
        }
        else{
            /*
             * For search & 404 page
             */
            $value = $value_default;
        }

        if($value === 'inherit'){
            $value = $default;
        }


        return apply_filters('precise/setting/get_setting_by_context', $value, $key, $context);
    }

}