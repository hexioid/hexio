<?php

function cryptokn_woocommerce_shop_per_page( $cols ) {
  // Return the number of products you wanna show per page.
  $cols = 9;
  return $cols;
}
add_filter( 'loop_shop_per_page', 'cryptokn_woocommerce_shop_per_page', 20 );


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
function cryptokn_woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
?>
<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart','cryptokn' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'cryptokn' ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
<?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
} 
add_filter( 'woocommerce_add_to_cart_fragments', 'cryptokn_woocommerce_header_add_to_cart_fragment' );


// SINGLE PRODUCT
// Unhook functions
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Hook functions
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );


/* Custom functions for woocommerce */

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

function cryptokn_woocommerce_show_top_custom_block() {
    $args = array();
    global $product;
    global $cryptokn_redux;
    
    echo '<div class="thumbnail-and-details">';    
              
        wc_get_template( 'loop/sale-flash.php' );
        
        echo '<div class="hover-container">';
            echo '<div class="thumbnail-overlay"></div>';
            echo '<div class="hover-components">';

                echo '<div class="component add-to-cart">';
                    wc_get_template( 'loop/add-to-cart.php' , $args );
                echo '</div>';

                if (class_exists('YITH_WCWL')) {
                    echo '<div class="component wishlist">';
                        echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
                    echo '</div>';
                }

                if (class_exists('YITH_Woocompare')) {
                    echo '<div class="component compare">';
                        echo do_shortcode( '[yith_compare_button]' );
                    echo '</div>';
                }

                if (class_exists('YITH_WCQV')) {
                    if ($cryptokn_redux['is_quick_view_active'] == true) {
                        echo '<div class="component quick-view">';
                            echo '<a href="'. esc_url('#') .'" class="button yith-wcqv-button" data-product_id="' . yit_get_prop( $product, 'id', true ) . '">' . esc_html__('Quick View','cryptokn') . '</a>';
                        echo '</div>';
                    }
                }

            echo '</div>';
        echo '</div>';

        echo woocommerce_get_product_thumbnail();

        echo '<div class="details-review-container details-item">';
            wc_get_template( 'loop/rating.php' );
        echo '</div>';
    echo '</div>';

}
add_action( 'woocommerce_before_shop_loop_item_title', 'cryptokn_woocommerce_show_top_custom_block' );


function cryptokn_show_price_and_review() {
    echo '<div class="details-container">';
        echo '<div class="details-price-container details-item">';
            wc_get_template( 'loop/price.php' );
        echo '</div>';
    echo '</div>';
}
add_action( 'woocommerce_after_shop_loop_item_title', 'cryptokn_show_price_and_review' );


function cryptokn_woocommerce_get_sidebar() {
    global $cryptokn_redux;

    if ( is_shop() ) {
        $sidebar = $cryptokn_redux['cryptokn_shop_layout_sidebar'];
    }elseif ( is_product() ) {
        $sidebar = $cryptokn_redux['cryptokn_single_shop_sidebar'];
    }else{
        $sidebar = 'woocommerce';
    }

    dynamic_sidebar( $sidebar );

}
add_action ( 'woocommerce_sidebar', 'cryptokn_woocommerce_get_sidebar' );

add_filter( 'loop_shop_columns', 'cryptokn_wc_loop_shop_columns', 1, 10 );

/*
 * Return a new number of maximum columns for shop archives
 * @param int Original value
 * @return int New number of columns
 */
function cryptokn_wc_loop_shop_columns( $number_columns ) {
    global $cryptokn_redux;

    if ( $cryptokn_redux['cryptokn-shop-columns'] ) {
        return $cryptokn_redux['cryptokn-shop-columns'];
    }else{
        return 3;
    }
}

global $cryptokn_redux;
if ( isset($cryptokn_redux['cryptokn-enable-related-products']) && !$cryptokn_redux['cryptokn-enable-related-products'] ) {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}

add_filter( 'woocommerce_output_related_products_args', 'cryptokn_related_products_args' );
  function cryptokn_related_products_args( $args ) {
    global $cryptokn_redux;

    $args['posts_per_page'] = $cryptokn_redux['cryptokn-related-products-number'];
    $args['columns'] = 3;
    return $args;
}

if (class_exists('YITH_WCWL')) {
    function cryptokn_show_whislist_button_on_single() {
        echo '<div class="wishlist-container">';
            echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
        echo '</div>';
    }
    add_action( 'woocommerce_single_product_summary', 'cryptokn_show_whislist_button_on_single', 36 );
}
?>