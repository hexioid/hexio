<?php

/**
 * Precise Theme Function
 *
 */

add_action( 'after_setup_theme', 'precise_child_theme_setup' );
add_action( 'wp_enqueue_scripts', 'precise_child_enqueue_styles', 20);

if( !function_exists('precise_child_enqueue_styles') ) {
    function precise_child_enqueue_styles() {
        wp_enqueue_style( 'precise-child-style',
            get_stylesheet_directory_uri() . '/style.css',
            array( 'precise-theme' ),
            wp_get_theme()->get('Version')
        );
    }
}

if( !function_exists('precise_child_theme_setup') ) {
    function precise_child_theme_setup() {
        load_child_theme_textdomain( 'precise-child', get_stylesheet_directory() . '/languages' );
    }
}