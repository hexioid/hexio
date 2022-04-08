<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'la_fw_get_icons' ) ) {
    function la_fw_get_icons() {

        do_action( 'lastudio/action/framework/field/icon/before_add_icon' );

        $icons = la_get_icon_fonts();

        if( ! empty( $icons ) ) {

            foreach ( $icons as $icon_object ) {

                if( is_object( $icon_object ) ) {

                    echo ( count( $icons ) >= 2 ) ? '<h4 class="la-icon-title">'. $icon_object->name .'</h4>' : '';

                    foreach ( $icon_object->icons as $icon ) {
                        echo '<a class="la-icon-tooltip" data-la-icon="'. $icon .'" data-title="'. $icon .'"><span class="la-icon--selector la-selector"><i class="'. $icon .'"></i></span></a>';
                    }

                } else {
                    echo '<h4 class="la-icon-title">'. __( 'Error! Can not load json file.', 'la-studio' ) .'</h4>';
                }

            }

        }
        do_action( 'lastudio/action/framework/field/icon/add_icon' );
        do_action( 'lastudio/action/framework/field/icon/after_add_icon' );

        die();
    }
    add_action( 'wp_ajax_la-fw-get-icons', 'la_fw_get_icons' );
}

/**
 *
 * Set icons for wp dialog
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'la_fw_set_icons' ) ) {
    function la_fw_set_icons() {

        echo '<div id="la-icon-dialog" class="la-dialog" title="'. __( 'Add Icon', 'la-studio' ) .'">';
        echo '<div class="la-dialog-header la-text-center"><input type="text" placeholder="'. __( 'Search a Icon...', 'la-studio' ) .'" class="la-icon-search" /></div>';
        echo '<div class="la-dialog-load"><div class="la-icon-loading">'. __( 'Loading...', 'la-studio' ) .'</div></div>';
        echo '</div>';

    }
    add_action( 'admin_footer', 'la_fw_set_icons' );
    add_action( 'customize_controls_print_footer_scripts', 'la_fw_set_icons' );
}


if(!function_exists('la_fw_ajax_autocomplete')) {
    function la_fw_ajax_autocomplete() {

        if ( empty( $_GET['query_args'] ) || empty( $_GET['s'] ) ) {
            echo '<b>' . __('Query is empty ...', 'la-studio' ) . '</b>';
            die();
        }

        $out = array();
        ob_start();

        $query = new WP_Query( wp_parse_args( $_GET['query_args'], array( 's' => $_GET['s'] ) ) );
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                echo '<div data-id="' . get_the_ID() . '">' . get_the_title() . '</div>';
            }
        } else {
            echo '<b>' . __('Not found', 'la-studio' ) . '</b>';
        }

        echo ob_get_clean();
        wp_reset_postdata();
        die();
    }
    add_action( 'wp_ajax_la-fw-autocomplete', 'la_fw_ajax_autocomplete' );
}


/**
 *
 * Export options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'la_export_options' ) ) {
    function la_export_options() {
        $unique = isset($_REQUEST['unique']) ? $_REQUEST['unique'] : 'la_options';
        header('Content-Type: plain/text');
        header('Content-disposition: attachment; filename=backup-'.esc_attr($unique).'-'. gmdate( 'd-m-Y' ) .'.txt');
        header('Content-Transfer-Encoding: binary');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo json_encode(get_option($unique));
        die();
    }
    add_action( 'wp_ajax_la-export-options', 'la_export_options' );
}


if( !function_exists('la_add_script_to_compare') ){
    add_action('yith_woocompare_after_main_table', 'la_add_script_to_compare');
    function la_add_script_to_compare(){
        echo '<script type="text/javascript">var redirect_to_cart=true;</script>';
    }
}
if(!function_exists('la_add_script_to_quickview_product')){
    add_action('woocommerce_after_single_product', 'la_add_script_to_quickview_product');
    function la_add_script_to_quickview_product(){
        global $product;
        if (isset($_GET['product_quickview']) && is_product()) {
            if( $product->get_type() == 'variable' ) {
                wp_print_scripts('underscore');
                wc_get_template('single-product/add-to-cart/variation.php');
                ?>
                <script type="text/javascript">
                    /* <![CDATA[ */
                    var _wpUtilSettings = <?php echo json_encode(array(
                        'ajax' => array('url' => admin_url('admin-ajax.php', 'relative'))
                    ));?>;
                    var wc_add_to_cart_variation_params = <?php echo json_encode(array(
                        'i18n_no_matching_variations_text' => esc_attr__('Sorry, no products matched your selection. Please choose a different combination.', 'la-studio'),
                        'i18n_make_a_selection_text' => esc_attr__('Select product options before adding this product to your cart.', 'la-studio'),
                        'i18n_unavailable_text' => esc_attr__('Sorry, this product is unavailable. Please choose a different combination.', 'la-studio')
                    )); ?>;
                    /* ]]> */
                </script>
                <script type="text/javascript" src="<?php echo esc_url(includes_url('js/wp-util.min.js')) ?>"></script>
                <script type="text/javascript" src="<?php echo esc_url(WC()->plugin_url()) . '/assets/js/frontend/add-to-cart-variation.min.js' ?>"></script>
                <?php
            }else{
                ?>
                <script type="text/javascript">
                    /* <![CDATA[ */
                    var wc_single_product_params = <?php echo json_encode(array(
                        'i18n_required_rating_text' => esc_attr__( 'Please select a rating', 'la-studio' ),
                        'review_rating_required'    => get_option( 'woocommerce_review_rating_required' ),
                        'flexslider'                => apply_filters( 'woocommerce_single_product_carousel_options', array(
                            'rtl'            => is_rtl(),
                            'animation'      => 'slide',
                            'smoothHeight'   => false,
                            'directionNav'   => false,
                            'controlNav'     => 'thumbnails',
                            'slideshow'      => false,
                            'animationSpeed' => 500,
                            'animationLoop'  => false, // Breaks photoswipe pagination if true.
                        ) ),
                        'zoom_enabled'       => 0,
                        'photoswipe_enabled' => 0,
                        'flexslider_enabled' => 1,
                    ));?>;
                    /* ]]> */
                </script>
                <?php
            }
        }
    }
}