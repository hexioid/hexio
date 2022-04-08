<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

// Add Toolbar Menus
function precise_add_custom_toolbar() {
    global $wp_admin_bar;

    $args = array(
        'id'     => 'la_bar',
        'title'  => sprintf('<span class="ab-icon"></span><span class="ab-label">%s</span>', __( 'Theme Options', 'la-studio' ) ),
        'href'   => admin_url('themes.php?page=theme_options')
    );
    $wp_admin_bar->add_menu( $args );

}
add_action( 'wp_before_admin_bar_render', 'precise_add_custom_toolbar', 999 );

add_filter('woocommerce_product_related_posts_relate_by_category', '__return_false');
add_filter('woocommerce_product_related_posts_relate_by_tag', '__return_false');
add_filter('woocommerce_product_related_posts_force_display', '__return_true');


add_filter('body_class', 'precise_preset_add_body_classes');

function precise_preset_add_body_classes( $class ){
    $class[] = 'isLaWebRoot';
    return $class;
}

add_filter( 'get_avatar_url', 'precise_preset_new_gravatar', 10, 3);
function precise_preset_new_gravatar ( $url, $id_or_email, $args ) {
    if ( is_object( $id_or_email ) && isset( $id_or_email->comment_author_email ) ) {
        if ( $id_or_email->comment_author_email == 'info1@localhost.com' ){
            return Precise::$template_dir_url . '/assets/images/avatar-1.jpg';
        }
        if ( $id_or_email->comment_author_email == 'info2@localhost.com' ){
            return Precise::$template_dir_url . '/assets/images/avatar-2.jpg';
        }
        if ( $id_or_email->comment_author_email == 'info3@localhost.com' ){
            return Precise::$template_dir_url . '/assets/images/avatar-3.jpg';
        }
        if ( $id_or_email->comment_author_email == 'blog1@localhost.com' ){
            return Precise::$template_dir_url . '/assets/images/blog-avatar-1.jpg';
        }
        if ( $id_or_email->comment_author_email == 'blog2@localhost.com' ){
            return Precise::$template_dir_url . '/assets/images/blog-avatar-2.jpg';
        }
        if ( $id_or_email->comment_author_email == 'blog3@localhost.com' ){
            return Precise::$template_dir_url . '/assets/images/blog-avatar-3.jpg';
        }
    }
    if ( $id_or_email == 'dpv.0990@gmail.com' || $id_or_email == 'info@la-studioweb.com' ){
        return Precise::$template_dir_url . '/assets/images/blog-avatar-1.jpg';
    }
    return $url;
}

add_action( 'pre_get_posts', 'precise_preset_change_blog_posts' );
function precise_preset_change_blog_posts( $query ){

    if( $query->is_home() && $query->is_main_query() && isset($_GET['la_preset']) ){
        if($_GET['la_preset'] == 'blog-masonry'){
            $query->set( 'posts_per_page', 11 );
        }
        if($_GET['la_preset'] == 'blog-classic'){
            $query->set( 'posts_per_page', 9 );
        }
        if($_GET['la_preset'] == 'blog-sidebar' || $_GET['la_preset'] == 'blog-right-sidebar'){
            $query->set( 'posts_per_page', 6 );
        }
    }
}

add_filter('precise/filter/blog/post_thumbnail', 'precise_preset_modify_thumbnail_for_blog_masonry', 10, 2);
function precise_preset_modify_thumbnail_for_blog_masonry( $size, $loop ){
    if(isset($_GET['la_preset']) && isset($loop['loop_index'])){
        if($_GET['la_preset'] == 'blog-02'){
            $idx = absint($loop['loop_index']);
            $ref = array(
                array(370,450),
                array(370,340),
                array(370,278),
                array(370,340),
                array(370,370),
                array(370,325),
                array(370,280),
                array(370,315),
                array(370,340),
                array(370,340),
                array(370,300),
                array(370,460)
            );
            if(isset($ref[$idx-1])){
                return $ref[$idx-1];
            }
        }
    }
    return $size;
}

add_filter('precise/filter/portfolio/post_thumbnail', 'precise_preset_modify_thumbnail_for_portfolio_masonry', 10, 2);
function precise_preset_modify_thumbnail_for_portfolio_masonry( $size, $loop ){
    if(isset($loop['loop_layout']) && isset($loop['loop_index']) && $loop['loop_layout'] == 'masonry' && $size == array(270,0)){
        if(isset($loop['column_type']) && $loop['column_type'] != 'custom'){
            $idx = absint($loop['loop_index']);
            $ref = array(
                array(270,320),
                array(270,440),
                array(270,305),
                array(270,450),
                array(270,320),
                array(270,440),
                array(270,305),
                array(270,450),
                array(270,320),
                array(270,440),
                array(270,305),
                array(270,450),
            );
            if(isset($ref[$idx-1])){
                return $ref[$idx-1];
            }
        }
    }
    return $size;
}

add_filter('single_product_archive_thumbnail_size', 'precise_preset_modify_thumbnail_for_shop_masonry', 99 );
function precise_preset_modify_thumbnail_for_shop_masonry( $size ){
    global $precise_loop, $woocommerce_loop;

    if(isset($_GET['la_preset']) && $_GET['la_preset'] == 'shop-masonry-1'){
        $idx = absint($woocommerce_loop['loop']) - 1;
        if($idx < 0){
            $idx = 0;
        }
        $ref = array(
            array(370,440),
            array(370,310),
            array(370,380),
            array(370,310),
            array(370,380),
            array(370,380),
            array(370,380),
            array(370,310),
            array(370,390),
            array(370,380),
            array(370,440),
            array(370,310)
        );
        if(isset($ref[$idx])){
            $precise_loop['image_size'] = $ref[$idx];
            return $ref[$idx];
        }
    }
    if(isset($_GET['la_preset']) && $_GET['la_preset'] == 'shop-masonry-2'){
        $idx = absint($woocommerce_loop['loop']) - 1;
        if($idx < 0){
            $idx = 0;
        }
        $ref = array(
            array(370,440),
            array(370,380),
            array(370,310),
            array(370,400),
            array(370,440),
            array(370,380),
            array(370,310),
            array(370,400),
            array(370,440),
            array(370,380),
            array(370,310),
            array(370,400),
            array(370,440),
            array(370,380),
            array(370,310),
            array(370,400)
        );
        if(isset($ref[$idx])){
            $precise_loop['image_size'] = $ref[$idx];
            return $ref[$idx];
        }
    }

    return $size;
}

add_filter('is_active_sidebar', 'precise_modify_single_custom_sidebar', 10, 2);
function precise_modify_single_custom_sidebar( $is_active_sidebar, $index ){
    if(isset($_GET['la_preset']) && $_GET['la_preset'] == 'shop-detail-02' && $index == 'la-p-s-block-1'){
        return false;
    }
    return $is_active_sidebar;
}

add_filter('woocommerce_output_related_products_args', 'precise_modify_woocommerce_output_related_products_args');
function precise_modify_woocommerce_output_related_products_args( $args ){
    if(isset($_GET['la_preset']) && $_GET['la_preset'] == 'shop-detail-02'){
        return array(
            'posts_per_page' 	=> 3,
            'columns' 			=> 3,
            'orderby'           => 'rand'
        );
    }
    return $args;
}