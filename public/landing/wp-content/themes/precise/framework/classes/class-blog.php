<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Precise_Blog {

    public function __construct(){

        add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 100 );
        add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );

        add_filter('precise/setting/get_setting_by_context', array( $this, 'override_setting_by_context'), 20, 3);

    }

    public function excerpt_more( ){
        return '&hellip;';
    }

    public function excerpt_length( $length ) {

        // Normal blog posts excerpt length.
        if ( ! is_null( Precise()->settings->get( 'blog_excerpt_length' ) ) ) {
            $length = Precise()->settings->get( 'blog_excerpt_length' );
        }

        return $length;

    }

    public function override_setting_by_context( $value, $key, $context ){
        if($key == 'page_title_bar_layout'){
            if(is_singular('post')){
                $from_single_setting = Precise()->settings->get('page_title_bar_layout_post_single_global', 'off');
                $_from_current_setting = Precise()->settings->get_post_meta( get_queried_object_id(), $key );
                if($from_single_setting == 'off' && $_from_current_setting == 'inherit' ){
                    return 'hide';
                }
            }
            if(in_array('is_home', $context) || in_array('is_category', $context) || in_array('is_tag', $context)){
                $from_blog_setting = Precise()->settings->get('page_title_bar_layout_blog_global', 'off');
                $fn = 'get_term_meta';
                if(in_array('is_home', $context)){
                    $fn = 'get_post_meta';
                }
                $_from_current_setting = Precise()->settings->$fn( get_queried_object_id(), $key );
                if($from_blog_setting == 'off' && $_from_current_setting == 'inherit'){
                    return 'hide';
                }
            }
        }
        return $value;
    }

}