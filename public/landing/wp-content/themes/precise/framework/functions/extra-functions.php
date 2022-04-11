<?php if ( ! defined( 'ABSPATH' ) ) { die; }

add_filter('LaStudio/global_loop_variable', 'precise_set_loop_variable');
if(!function_exists('precise_set_loop_variable')){
    function precise_set_loop_variable( $var = ''){
        return 'precise_loop';
    }
}

add_filter('lastudio/google_map_api', 'precise_add_googlemap_api');
if(!function_exists('precise_add_googlemap_api')){
    function precise_add_googlemap_api( $key = '' ){
        return Precise()->settings->get('google_key', $key);
    }
}

add_filter('precise/filter/page_title', 'precise_override_page_title_bar_title');
if(!function_exists('precise_override_page_title_bar_title')){
    function precise_override_page_title_bar_title( $title ){

        $_tmp = '<header><div class="page-title h2">%s</div></header>';

        $context = (array) Precise()->get_current_context();

        if(in_array('is_singular', $context)){
            $custom_title = Precise()->settings->get_post_meta( get_queried_object_id(), 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($_tmp, $custom_title);
            }
        }

        if(in_array('is_tax', $context) || in_array('is_category', $context) || in_array('is_tag', $context)){
            $custom_title = Precise()->settings->get_term_meta( get_queried_object_id(), 'page_title_custom');
            if(!empty( $custom_title) ){
                return sprintf($_tmp, $custom_title);
            }
        }

        return $title;
    }
}

add_action( 'pre_get_posts', 'precise_set_posts_per_page_for_portfolio_cpt' );
if(!function_exists('precise_set_posts_per_page_for_portfolio_cpt')){
    function precise_set_posts_per_page_for_portfolio_cpt( $query ) {
        if ( !is_admin() && $query->is_main_query() ) {
            if( is_post_type_archive( 'la_portfolio' ) || is_tax(get_object_taxonomies( 'la_portfolio' ))){
                $pf_per_page = (int) Precise()->settings->get('portfolio_per_page', 9);
                $query->set( 'posts_per_page', $pf_per_page );
            }
        }
    }
}

add_filter('yith_wc_social_login_icon', 'precise_override_yith_wc_social_login_icon', 10, 3);
if(!function_exists('precise_override_yith_wc_social_login_icon')){
    function precise_override_yith_wc_social_login_icon($social, $key, $args){
        if(!is_admin()){
            $social = sprintf(
                '<a class="%s" href="%s">%s</a>',
                'social_login ywsl-' . esc_attr($key) . ' social_login-' . esc_attr($key),
                $args['url'],
                isset( $args['value']['label'] ) ? $args['value']['label'] : $args['value']
            );
        }
        return $social;
    }
}

add_action('wp', 'precise_hook_maintenance');
if(!function_exists('precise_hook_maintenance')){
    function precise_hook_maintenance(){
        wp_reset_postdata();
        $enable_private = Precise()->settings->get('enable_maintenance', 'no');
        if($enable_private == 'yes'){
            if(!is_user_logged_in()){
                $page_id = Precise()->settings->get('maintenance_page');
                if(empty($page_id)){
                    wp_redirect(wp_login_url());
                    exit;
                }
                else{
                    $page_id = absint($page_id);
                    if(!is_page($page_id)){
                        wp_redirect(get_permalink($page_id));
                        exit;
                    }
                }
            }
        }
    }
}

add_filter('widget_archives_args', 'precise_modify_widget_archives_args');
if(!function_exists('precise_modify_widget_archives_args')){
    function precise_modify_widget_archives_args( $args ){
        if(isset($args['show_post_count'])){
            unset($args['show_post_count']);
        }
        return $args;
    }
}

remove_action('template_redirect', 'redirect_canonical');
add_filter('woocommerce_redirect_single_search_result', '__return_false');


add_filter('precise/filter/breadcrumbs/items', 'precise_theme_setup_breadcrumbs_for_dokan', 10, 2);
if(!function_exists('precise_theme_setup_breadcrumbs_for_dokan')){
    function precise_theme_setup_breadcrumbs_for_dokan( $items, $args ){
        if (  function_exists('dokan_is_store_page') && dokan_is_store_page() ) {

            $custom_store_url = dokan_get_option( 'custom_store_url', 'dokan_general', 'store' );

            $author      = get_query_var( $custom_store_url );
            $seller_info = get_user_by( 'slug', $author );

            $items[] = sprintf(
                '<div class="la-breadcrumb-item"><a href="%4$s" class="%2$s" rel="tag" title="%3$s">%1$s</a></div>',
                esc_attr(ucwords($custom_store_url)),
                'la-breadcrumb-item-link',
                esc_attr(ucwords($custom_store_url)),
                esc_url(site_url() .'/'.$custom_store_url)
            );
            $items[] = sprintf(
                '<div class="la-breadcrumb-item"><span class="%2$s">%1$s</span></div>',
                esc_attr($seller_info->data->display_name),
                'la-breadcrumb-item-link'
            );
        }

        return $items;
    }
}


add_filter('precise/filter/show_page_title', 'precise_filter_show_page_title', 10, 1 );
add_filter('precise/filter/show_breadcrumbs', 'precise_filter_show_breadcrumbs', 10, 1 );

if(!function_exists('precise_filter_show_page_title')){
    function precise_filter_show_page_title( $show ){
        $context = Precise()->get_current_context();
        if( in_array( 'is_product', $context ) && Precise()->settings->get('product_single_hide_page_title', 'no') == 'yes' ){
            return false;
        }
        return $show;
    }
}

if(!function_exists('precise_filter_show_breadcrumbs')){
    function precise_filter_show_breadcrumbs( $show ){
        $context = Precise()->get_current_context();
        if( in_array( 'is_product', $context ) && Precise()->settings->get('product_single_hide_breadcrumb', 'no') == 'yes'){
            return false;
        }
        return $show;
    }
}


add_filter('LaStudio/swatches/args/show_option_none', 'precise_woo_variable_modify_show_option_none', 10, 1);
if(!function_exists('precise_woo_variable_modify_show_option_none')){
    function precise_woo_variable_modify_show_option_none( $text ){
        return esc_html_x( 'Choose an option', 'front-view', 'precise' );
    }
}


/**
 * This function allow get property of `woocommerce_loop` inside the loop
 * @since 1.3
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */

if(!function_exists('precise_get_wc_loop_prop')){
    function precise_get_wc_loop_prop( $prop, $default = ''){
        return isset( $GLOBALS['woocommerce_loop'], $GLOBALS['woocommerce_loop'][ $prop ] ) ? $GLOBALS['woocommerce_loop'][ $prop ] : $default;
    }
}

/**
 * This function allow set property of `woocommerce_loop`
 * @since 1.3
 * @param string $prop Prop to set.
 * @param string $value Value to set.
 */

if(!function_exists('precise_set_wc_loop_prop')){
    function precise_set_wc_loop_prop( $prop, $value = ''){
        if(isset($GLOBALS['woocommerce_loop'])){
            $GLOBALS['woocommerce_loop'][ $prop ] = $value;
        }
    }
}

/**
 * This function allow get property of `precise_loop` inside the loop
 * @since 1.3
 * @param string $prop Prop to get.
 * @param string $default Default if the prop does not exist.
 * @return mixed
 */

if(!function_exists('precise_get_theme_loop_prop')){
    function precise_get_theme_loop_prop( $prop, $default = ''){
        return isset( $GLOBALS['precise_loop'], $GLOBALS['precise_loop'][ $prop ] ) ? $GLOBALS['precise_loop'][ $prop ] : $default;
    }
}

remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );