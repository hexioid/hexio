<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if(!function_exists('la_get_base_shop_url')){
    function la_get_base_shop_url( $with_post_type_archive = true ){
        $link = '';
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        }
        elseif( is_tax( get_object_taxonomies( 'product' ) ) ){
            $link = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        }
        else{
            if($with_post_type_archive){
                $link = get_post_type_archive_link( 'product' );
            }
            else{
                if(function_exists('dokan')){
                    $current_url = add_query_arg(null, null);
                    $current_url = remove_query_arg(array('page', 'paged', 'mode_view', 'la_doing_ajax'), $current_url);
                    $link = preg_replace('/\/page\/\d+/', '', $current_url);
                }
            }
        }
        return $link;
    }
}

if ( !function_exists( 'la_log' ) ) {
    function la_log($log){
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}

/**
 *
 * Add framework element
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'la_fw_add_element' ) ) {
    function la_fw_add_element( $field = array(), $value = '', $unique = '' ) {

        $output     = '';
        $depend     = '';
        $sub        = ( isset( $field['sub'] ) ) ? 'sub-': '';
        $unique     = ( isset( $unique ) ) ? $unique : '';
        $class      = 'LaStudio_Framework_Field_' . strtolower($field['type']);
        $wrap_class = ( isset( $field['wrap_class'] ) ) ? ' ' . $field['wrap_class'] : '';
        $el_class   = ( isset( $field['title'] ) ) ? sanitize_title( $field['title'] ) : 'no-title';
        $hidden     = '';
        $is_pseudo  = ( isset( $field['pseudo'] ) ) ? ' la-pseudo-field' : '';

        if ( isset( $field['dependency'] ) ) {
            $hidden  = ' hidden';
            $depend .= ' data-'. $sub .'controller="'. $field['dependency'][0] .'"';
            $depend .= ' data-'. $sub .'condition="'. $field['dependency'][1] .'"';
            $depend .= ' data-'. $sub .'value="'. $field['dependency'][2] .'"';
        }

        $output .= '<div class="la-element la-element-'. $el_class .' la-field-'. $field['type'] . $is_pseudo . $wrap_class . $hidden .'"'. $depend .'>';

        if( isset( $field['title'] ) ) {
            $field_desc = ( isset( $field['desc'] ) ) ? '<p class="la-text-desc">'. $field['desc'] .'</p>' : '';
            $output .= '<div class="la-title"><h4>' . $field['title'] . '</h4>'. $field_desc .'</div>';
        }

        $output .= ( isset( $field['title'] ) ) ? '<div class="la-fieldset">' : '';

        $value   = ( !isset( $value ) && isset( $field['default'] ) ) ? $field['default'] : $value;
        $value   = ( isset( $field['value'] ) ) ? $field['value'] : $value;

        if( class_exists( $class ) ) {
            ob_start();
            $element = new $class( $field, $value, $unique );
            $element->output();
            $output .= ob_get_clean();
        } else {
            $output .= '<p>'. __( 'This field class is not available!', 'la-studio' ) .'</p>';
        }

        $output .= ( isset( $field['title'] ) ) ? '</div>' : '';
        $output .= '<div class="clear"></div>';
        $output .= '</div>';

        return $output;

    }
}

/**
 *
 * Array search key & value
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'la_array_search' ) ) {
    function la_array_search( $array, $key, $value ) {

        $results = array();

        if ( is_array( $array ) ) {
            if ( isset( $array[$key] ) && $array[$key] == $value ) {
                $results[] = $array;
            }

            foreach ( $array as $sub_array ) {
                $results = array_merge( $results, la_array_search( $sub_array, $key, $value ) );
            }

        }

        return $results;

    }
}

/**
 *
 * Get google font from json file
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'la_get_google_fonts' ) ) {
    function la_get_google_fonts() {
        $cache = wp_cache_get('google_font', 'la_studio');
        if(empty($cache)){
            $file = LaStudio_Plugin::$plugin_dir_path . 'assets/fonts/google-fonts.json';
            if(file_exists($file)){
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $tmp = $wp_filesystem->get_contents( $file );
                if( !is_wp_error( $tmp ) ) {
                    $tmp = json_decode( $tmp, false);
                    wp_cache_set('google_font', maybe_serialize($tmp), 'la_studio');
                    return $tmp;
                }
            }
        }
        if(empty($cache)){
            return array();
        }
        return maybe_unserialize( $cache );
    }
}

/**
 *
 * Get icon fonts from json file
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'la_get_icon_fonts' ) ) {
    function la_get_icon_fonts( ) {
        $cache = wp_cache_get('icon_fonts', 'la_studio');
        if(empty($cache)){

            $jsons = apply_filters( 'lastudio/filter/framework/field/icon/json', array(
                LaStudio_Plugin::$plugin_dir_path . 'assets/fonts/font-awesome.json'
            ) );

            if(!empty($jsons)){
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $cache_tmp = array();
                foreach ( $jsons as $path ) {
                    $file_data = $wp_filesystem->get_contents( $path );
                    if( !is_wp_error( $file_data ) ) {
                        $cache_tmp[] = json_decode( $file_data, false);
                    }
                }
                wp_cache_set('icon_fonts', maybe_serialize( $cache_tmp ), 'la_studio');

                return $cache_tmp;
            }
        }

        if(empty($cache)){
            return array();
        }

        return maybe_unserialize( $cache );

    }
}

/**
 *
 * Getting POST Var
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'la_get_var' ) ) {
    function la_get_var( $var, $default = '' ) {

        if( isset( $_POST[$var] ) ) {
            return $_POST[$var];
        }

        if( isset( $_GET[$var] ) ) {
            return $_GET[$var];
        }

        return $default;

    }
}

/**
 *
 * Getting POST Vars
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'la_get_vars' ) ) {
    function la_get_vars( $var, $depth, $default = '' ) {

        if( isset( $_POST[$var][$depth] ) ) {
            return $_POST[$var][$depth];
        }

        if( isset( $_GET[$var][$depth] ) ) {
            return $_GET[$var][$depth];
        }

        return $default;

    }
}

if(!function_exists('la_convert_option_to_customize')){
    function la_convert_option_to_customize( $options ){
        $panels = array();
        foreach ( $options as $section ) {
            if( empty($section['sections']) && empty($section['fields']) ) {
                continue;
            }

            $panel = array(
                'name' => (isset($section['name']) ? $section['name'] : uniqid() ),
                'title' => (isset($section['title2']) ? $section['title2'] : $section['title'] ),
                'description' => (isset($section['description']) ? $section['description'] : '' )
            );

            if(!empty( $section['sections'])){
                $sub_panel = array();
                foreach( $section['sections'] as $sub_section ){
                    if(!empty($sub_section['fields'])){
                        $sub_panel2 = array(
                            'name' => (isset($sub_section['name']) ? $sub_section['name'] : uniqid() ),
                            'title' => $sub_section['title'],
                            'description' => (isset($sub_section['description']) ? $sub_section['description'] : '' )
                        );
                        $fields = array();
                        foreach($sub_section['fields'] as $field ){
                            $fields[] = la_convert_field_option_to_customize( $field );
                        }
                        $sub_panel2['settings'] = $fields;
                        $sub_panel[] = $sub_panel2;
                    }
                }
                $panel['sections'] = $sub_panel;
                $panels[] = $panel;
            }
            elseif(!empty( $section['fields'])){
                $fields = array();

                foreach( $section['fields'] as $field ) {
                    $fields[] = la_convert_field_option_to_customize( $field );
                }
                $panel['settings'] = $fields;
                $panels[] = $panel;
            }
        }
        return $panels;
    }
}

if(!function_exists('la_convert_field_option_to_customize')){
    function la_convert_field_option_to_customize( $field ) {
        $backup_field = $field;
        if(isset($backup_field['id'])){
            $field_id = $backup_field['id'];
            unset($backup_field['id']);
        }else{
            $field_id = uniqid();
        }
        if(isset($backup_field['type']) && 'wp_editor' === $backup_field['type']){
            $backup_field['type'] = 'textarea';
        }
        $tmp = array(
            'name'      => $field_id,
            'control'   => array(
                'type'    => 'la_field',
                'options' => $backup_field
            )
        );
        if(isset($backup_field['default'])){
            $tmp['default'] = $backup_field['default'];
            unset($backup_field['default']);
        }
        return $tmp;
    }
}


if(!function_exists('hex2rgbUltParallax')) {
    function hex2rgbUltParallax($hex, $opacity) {
        $hex = str_replace("#", "", $hex);
        if (preg_match("/^([a-f0-9]{3}|[a-f0-9]{6})$/i",$hex)):
            if(strlen($hex) == 3) { // three letters code
                $r = hexdec(substr($hex,0,1).substr($hex,0,1));
                $g = hexdec(substr($hex,1,1).substr($hex,1,1));
                $b = hexdec(substr($hex,2,1).substr($hex,2,1));
            } else { // six letters coode
                $r = hexdec(substr($hex,0,2));
                $g = hexdec(substr($hex,2,2));
                $b = hexdec(substr($hex,4,2));
            }
            return 'rgba('.implode(",", array($r, $g, $b)).','.$opacity.')';
        else:
            return "";
        endif;
    }
}
if(!function_exists('rgbaToHexUltimate')) {
    function rgbaToHexUltimate($r, $g, $b) {
        $hex = "#";
        $hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
        $hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
        $hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
        return $hex;
    }
}


if ( ! function_exists( 'la_fw_override_shortcodes' ) ) {
    function la_fw_override_shortcodes( $item_space, $item_animation ) {
        global $shortcode_tags, $_shortcode_tags;
        // Let's make a back-up of the shortcodes
        $_shortcode_tags = $shortcode_tags;
        // Add any shortcode tags that we shouldn't touch here
        $disabled_tags = array( '' );
        foreach ( $shortcode_tags as $tag => $cb ) {
            if ( in_array( $tag, $disabled_tags ) ) {
                continue;
            }
            // Overwrite the callback function
            $shortcode_tags[ $tag ]            = 'la_fw_wrap_shortcode_in_div';
            $_shortcode_tags["item_animation"] = $item_animation;
        }
    }
}
// Wrap the output of a shortcode in a div with class "ult-item-wrap"
// The original callback is called from the $_shortcode_tags array
if ( ! function_exists( 'la_fw_wrap_shortcode_in_div' ) ) {
    function la_fw_wrap_shortcode_in_div( $attr, $content = null, $tag ) {
        global $_shortcode_tags;

        return '<div class="la-item-wrap" data-animation="animated ' . esc_attr($_shortcode_tags["item_animation"]) . '">' . call_user_func( $_shortcode_tags[ $tag ], $attr, $content, $tag ) . '</div>';
    }
}
if ( ! function_exists( 'la_fw_restore_shortcodes' ) ) {
    function la_fw_restore_shortcodes() {
        global $shortcode_tags, $_shortcode_tags;
        // Restore the original callbacks
        if ( isset( $_shortcode_tags ) ) {
            $shortcode_tags = $_shortcode_tags;
        }
    }
}

if(!function_exists('la_pagespeed_detected')){
    function la_pagespeed_detected() {
        return (
            isset($_SERVER['HTTP_USER_AGENT'])
            && preg_match('/GTmetrix|Page Speed/i', $_SERVER['HTTP_USER_AGENT'])
        );
    }
}