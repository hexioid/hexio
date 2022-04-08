<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if(!class_exists('Precise_WooCommerce')) {

    class Precise_WooCommerce{

        public static $shop_page_id = -1;

        public function __construct(){

            if(!class_exists('WooCommerce')) return;

            self::$shop_page_id = wc_get_page_id('shop');

            add_filter('woocommerce_register_post_type_product', array( $this, 'woocommerce_register_post_type_product') );

            add_filter('precise/get_site_layout', array( $this, 'set_site_layout') );

            add_filter('precise/filter/sidebar_primary_name', array( $this, 'set_sidebar_for_shop'), 20 );
            add_filter('precise/setting/get_setting_by_context', array( $this, 'override_setting_by_context'), 20, 3);

            add_action('init', array( $this, 'set_cookie_default' ), 2 );
            add_action('init', array( $this, 'custom_handling_empty_cart' ), 1 );

            add_filter('body_class', array( $this, 'add_body_class' ), 999 );
            add_filter('woocommerce_add_to_cart_fragments', array( $this, 'modify_ajax_cart_fragments'));

            /**
             * In Plugin
             */
            add_filter('woocommerce_show_page_title', '__return_false');
            add_action('init', array( $this, 'disable_plugin_hooks'));

            add_filter('woocommerce_placeholder_img_src', array( $this, 'change_placeholder') );

            add_action('la_threesixty_before_get_image_array', array( $this, 'add_script_resize_image_in_360') );
            add_action('la_threesixty_after_get_image_array', array( $this, 'remove_script_resize_image_in_360') );

            /**
             * In Loop
             */


            /** FOR CATALOG */
            add_filter('subcategory_archive_thumbnail_size', array( $this, 'modify_product_thumbnail_size') );
            add_action('woocommerce_before_subcategory_title', create_function('', ' echo "<div class=\"cat-img\">";'), 9);
            add_action('woocommerce_before_subcategory_title', array( $this, 'add_script_resize_image_in_loop' ), 9 );
            add_action('woocommerce_before_subcategory_title', array( $this, 'add_shop_now_to_catalog'), 10);
            add_action('woocommerce_before_subcategory_title', array( $this, 'remove_script_resize_image_in_loop' ), 11 );
            add_action('woocommerce_before_subcategory_title', create_function('', ' echo "<span class=\"item--overlay\"></span></div>";'), 11);
            add_action('woocommerce_shop_loop_subcategory_title', create_function('', ' echo "<div class=\"cat-information\">";'), 1);
            add_action('woocommerce_shop_loop_subcategory_title', array( $this, 'add_desc_to_catalog'), 11);
            add_action('woocommerce_shop_loop_subcategory_title', array( $this, 'add_shop_now_to_catalog'), 15);
            add_action('woocommerce_shop_loop_subcategory_title', create_function('', ' echo "</div>";'), 20);


            /** END FOR CATALOG */

            remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
            remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

            remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
            remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

            add_filter('single_product_archive_thumbnail_size', array( $this, 'modify_product_thumbnail_size') );

            add_filter('loop_shop_per_page', array($this,'change_per_page_default'));

            add_action('woocommerce_before_shop_loop', array( $this, 'render_toolbar') );

            add_action('product_cat_class', array( $this, 'add_class_to_product_category_item' ), 10, 3 );
            add_filter('post_class', array( $this, 'add_class_to_product_loop'), 30, 3 );

            add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 1 );
            add_action('woocommerce_before_shop_loop_item_title', array( $this, 'add_script_resize_image_in_loop' ), 1 );
            add_action('woocommerce_before_shop_loop_item_title', array( $this, 'add_badge_stock_into_loop' ), 10 );
            add_action('woocommerce_before_shop_loop_item_title', array( $this, 'add_second_thumbnail_to_loop' ), 15 );
            add_action('woocommerce_before_shop_loop_item_title', create_function('', ' echo "<div class=\"item--overlay\"></div>";'), 20 );
            add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 30 );
            add_action('woocommerce_before_shop_loop_item_title', array( $this, 'remove_script_resize_image_in_loop' ), 35 );

            add_action('woocommerce_shop_loop_item_title', array( $this, 'add_category_in_product_listing' ), 5 );
            add_action('woocommerce_shop_loop_item_title', array( $this, 'shop_loop_item_title' ), 10 );


            add_action('woocommerce_after_shop_loop_item_title', array($this, 'render_attribute_in_list'), 11);
            add_action('woocommerce_after_shop_loop_item_title', array( $this, 'shop_loop_item_excerpt' ), 15 );

            add_action('precise/action/shop_loop_item_action_top', array( $this, 'add_wishlist_btn' ), 5 );
            add_action('precise/action/shop_loop_item_action_top', array( $this, 'add_compare_btn' ), 6 );
            add_action('precise/action/shop_loop_item_action_top', create_function('', ' echo "<div class=\"wrap-addto\">";'), 10 );
            add_action('precise/action/shop_loop_item_action_top', array( $this, 'add_quick_view_btn' ), 15 );
            add_action('precise/action/shop_loop_item_action_top', 'woocommerce_template_loop_add_to_cart', 20 );
            add_action('precise/action/shop_loop_item_action_top', create_function('', 'echo "</div>";'), 30 );
            add_action('precise/action/shop_loop_item_action_top', array( $this, 'add_count_up_timer_in_product_listing' ), 40 );

            add_action('precise/action/shop_loop_item_action', create_function('', ' echo "<div class=\"wrap-addto\">";'), 5 );
            add_action('precise/action/shop_loop_item_action', 'woocommerce_template_loop_add_to_cart', 10 );
            add_action('precise/action/shop_loop_item_action', array( $this, 'add_wishlist_btn' ), 15 );
            add_action('precise/action/shop_loop_item_action', array( $this, 'add_compare_btn' ), 20 );
            add_action('precise/action/shop_loop_item_action', create_function('', 'echo "</div>";'), 25 );

            /**
             * Product Page
             */
            add_action('wp_head', array($this, 'check_condition_show_upsell_crosssel'));
            add_action('woocommerce_before_single_product_summary', array( $this, 'add_count_up_timer_to_single' ), 30);

            add_action('woocommerce_single_product_summary', array( $this, 'add_stock_into_single' ), 9);

            add_action('woocommerce_single_product_summary', array( $this, 'add_wishlist_btn' ), 45);
            add_action('woocommerce_single_product_summary', array( $this, 'add_compare_btn' ), 45);


            add_action('woocommerce_share', array( $this, 'woocommerce_share' ));

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
            add_action('woocommerce_single_product_summary', create_function('', ' echo "<div class=\"clearfix\"></div>";'), 50);
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 50);


            add_filter('woocommerce_product_description_heading', '__return_empty_string');
            add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');

            add_filter('woocommerce_product_tabs', array( $this, 'add_custom_tab'));

            if( Precise()->settings->get('product_single_hide_product_title', 'no') == 'yes'){
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
            }

            add_filter('template_include', array( $this, 'load_quickview_template'), 20 );

            /**
             * Cart Page
             */

            add_action('wp', array( $this, 'set_recent_product_category_link' ) );

            add_action('woocommerce_cart_collaterals', array( $this, 'add_shipping_calculator_form_into_cart') , 5);
            add_action('woocommerce_cart_collaterals', array( $this, 'add_coupon_form_into_cart') , 6);
            remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10);

            if(Precise()->settings->get('crosssell_products', 'off') == 'on'){
                add_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 30);
            }

            add_action('woocommerce_cart_actions', array( $this, 'add_more_button_to_cart_from'));
            add_action('woocommerce_before_shipping_calculator', array( $this, 'woocommerce_before_shipping_calculator'), 99 );
            add_action('woocommerce_after_shipping_calculator', array( $this, 'woocommerce_after_shipping_calculator'), 1 );
            /**
             * Checkout
             */


            /**
             * Catalog Mode
             */

            if( Precise()->settings->get('catalog_mode', 'off') == 'on'){
                // In Loop
                remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
                add_filter( 'woocommerce_loop_add_to_cart_link', '__return_empty_string', 10 );
                // In Single
                remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
                // In Page
                add_action( 'wp', array( $this, 'set_page_when_active_catalog_mode' ) );

                if( Precise()->settings->get('catalog_mode_price', 'off') == 'on'){
                    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
                    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
                    add_filter('woocommerce_catalog_orderby', array( $this, 'remove_sortby_price_in_toolbar_when_active_catalog' ));
                    add_filter('woocommerce_default_catalog_orderby_options', array( $this, 'remove_sortby_price_in_toolbar_when_active_catalog' ));
                }
            }

            /**
             * Other
             */
            if(class_exists('YITH_WC_Social_Login_Frontend')){
                $yith_wc_login = YITH_WC_Social_Login_Frontend::get_instance();
                remove_action('woocommerce_login_form', array($yith_wc_login, 'social_buttons'), 10);
                add_action('woocommerce_login_form_end', array($yith_wc_login, 'social_buttons'), 10);
            }

            /** VC Vendors */

            remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
            remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

            remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


            add_action( 'woocommerce_before_main_content', array( $this, 'wrapper_start' ), 10 );
            add_action( 'woocommerce_after_main_content', array( $this, 'wrapper_end' ), 10 );

            if(class_exists('WC_Vendors')){
                // Add sold by to product loop before add to cart
                if ( WC_Vendors::$pv_options->get_option( 'sold_by' ) ) {
                    remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
                    add_action( 'woocommerce_shop_loop_item_title', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 10 );
                }
            }
        }

        public function add_body_class($classes){

            return $classes;
        }

        public function set_site_layout($layout){
            if(is_checkout() || is_cart()){
                $layout = 'col-1c';
            }
            if (!is_user_logged_in() && is_account_page()) {
                $layout = 'col-1c';
            }
            return $layout;
        }

        public function set_sidebar_for_shop( $sidebar ){

            $context = (array) Precise()->get_current_context();

            if( in_array( 'is_woocommerce', $context ) ){

                if(in_array( 'is_archive', $context ) ){

                    $sidebar = Precise()->settings->get('shop_sidebar', $sidebar);

                    if(Precise()->settings->get('shop_global_sidebar', false)){
                        /*
                         * Return global sidebar if option will be enable
                         * We don't need more checking in context
                         */
                        return $sidebar;
                    }

                    if(in_array( 'is_shop', $context)){
                        if( $single_sidebar = Precise()->settings->get_post_meta( Precise()->get_page_id(), 'sidebar') && !empty($single_sidebar) ){
                            $sidebar = $single_sidebar;
                        }
                    }
                    if(in_array( 'is_product_taxonomy', $context)){
                        if( $tax_sidebar = Precise()->settings->get_term_meta( get_queried_object_id(), 'sidebar') && !empty($tax_sidebar) ){
                            $sidebar = $tax_sidebar;
                        }
                    }
                }

                elseif(in_array('is_product', $context)){
                    $sidebar = Precise()->settings->get('products_sidebar', $sidebar);

                    if(Precise()->settings->get('products_global_sidebar', false)){
                        /*
                         * Return global sidebar if option will be enable
                         * We don't need more checking in context
                         */
                        return $sidebar;
                    }
                    if( $single_sidebar = Precise()->settings->get_post_meta( get_the_ID(), 'sidebar') && !empty($single_sidebar) ){
                        $sidebar = $single_sidebar;
                    }
                }
            }

            return $sidebar;
        }

        public function custom_handling_empty_cart(){
            if (isset($_REQUEST['clear-cart'])) {
                global $woocommerce;
                $woocommerce->cart->empty_cart();
            }
        }

        public function woocommerce_register_post_type_product( $args ){

            if( self::$shop_page_id > 0 ){
                $args['labels']['archive_title'] = get_the_title(self::$shop_page_id);
            }
            return $args;
        }

        public function change_placeholder($src){
            return esc_url( get_template_directory_uri() . '/assets/images/wc-placeholder.png' );
        }

        /*
         * Loop
         */

        public function render_toolbar(){
            wc_get_template( 'loop/toolbar.php' );
        }

        public function add_class_to_product_category_item( $classes, $class, $category ){
            $classes[] = 'grid-item';
            return $classes;
        }

        public function add_shop_now_to_catalog(){

        }

        public function add_desc_to_catalog( $category ){

        }

        public function add_class_to_product_loop($classes, $class, $post_id){
            if ( ! $post_id || 'product' !== get_post_type( $post_id ) ) {
                return $classes;
            }

            global $precise_loop;
            $product = wc_get_product( $post_id );

            if ( $product ) {

                $show_image = false;
                if( 'on' == Precise()->settings->get('woocommerce_enable_crossfade_effect') ){
                    $show_image = true;
                }
                if(isset($precise_loop['disable_alt_image']) && true == $precise_loop['disable_alt_image']){
                    $show_image = false;
                }
                if($show_image && (($galleries = $product->get_gallery_image_ids()) && !empty($galleries[0]))){

                    if(!empty($precise_loop['loop_layout']) && !empty($precise_loop['loop_style']) && $precise_loop['loop_layout'] == 'list' && $precise_loop['loop_style'] == 'special'){

                    }else{
                        $classes[] = 'thumb-has-effect';
                    }
                }else{
                    $classes[] = 'thumb-no-effect';
                }
                $classes[] = 'prod-rating-' . esc_attr(Precise()->settings->get('woocommerce_show_rating_on_catalog', 'off'));
            }

            return $classes;
        }

        public function add_script_resize_image_in_loop(){
            global $precise_loop;
            if(!empty($precise_loop['image_size'])) {
                Precise()->images->before_resize();
            }
        }

        public function remove_script_resize_image_in_loop(){
            global $precise_loop;
            if(!empty($precise_loop['image_size'])) {
                Precise()->images->after_resize();
            }
        }

        public function modify_product_thumbnail_size($size){
            global $precise_loop;
            if(!empty($precise_loop['image_size'])){
                return $precise_loop['image_size'];
            }
            return $size;
        }

        public function add_second_thumbnail_to_loop(){
            global $precise_loop, $product;
            $show_image = false;
            if( 'on' == Precise()->settings->get('woocommerce_enable_crossfade_effect') ){
                $show_image = true;
            }
            if(isset($precise_loop['disable_alt_image']) && true == $precise_loop['disable_alt_image']){
                $show_image = false;
            }
            if(!empty($precise_loop['loop_layout']) && !empty($precise_loop['loop_style']) && $precise_loop['loop_layout'] == 'list' && $precise_loop['loop_style'] == 'special'){
                $show_image = false;
            }
            if($show_image){
                $ids = $product->get_gallery_image_ids();
                if(!empty($ids) && isset($ids[0])){
                    echo wp_get_attachment_image( $ids[0], apply_filters( 'single_product_archive_thumbnail_size', 'shop_catalog' ) ,false , array('class'=>'wp-alt-image'));
                }
            }
        }

        public static function add_multi_thumbnail_to_loop(){
            global $product;
            if(($galleries = $product->get_gallery_image_ids()) && !empty($galleries)){
                $i = 0;
                echo '<div class="thumb-multi">';
                foreach($galleries as $gallery){
                    $i++;
                    ?>
                    <a href="<?php the_permalink()?>"><span class="thumb-multi-item" style="background-image: url(<?php echo wp_get_attachment_image_url($gallery, apply_filters( 'single_product_archive_thumbnail_size', 'shop_catalog' )); ?>)"></span></a>
                    <?php
                    if($i == 2){
                        break;
                    }
                }
                echo  '</div>';
            }
        }

        public function add_badge_stock_into_loop(){
            global $product;
            $availability = $product->get_availability();
            if(!empty($availability['class']) && $availability['class'] == 'out-of-stock' && !empty($availability['availability'])){
                printf('<span class="new-badge badge-out-of-stock">%s</span>', esc_html($availability['availability']));
            }
        }

        public function add_quick_view_btn(){
            if( 'on' == Precise()->settings->get('woocommerce_show_quickview_btn', 'off') ){
                global $product;
                printf(
                    '<a class="%s" href="%s" data-href="%s" title="%s">%s</a>',
                    'quickview button la-quickview-button',
                    esc_url(get_the_permalink($product->get_id())),
                    esc_url(add_query_arg('product_quickview', $product->get_id(), get_the_permalink($product->get_id()))),
                    esc_attr_x('Quick Shop', 'front-view', 'precise'),
                    esc_attr_x('Quick Shop', 'front-view', 'precise')
                );
            }
        }

        public function add_compare_btn(){
            global $yith_woocompare, $product;
            if (!empty($yith_woocompare->obj) && Precise()->settings->get('woocommerce_show_compare_btn', 'off') == 'on') {

                $action_add = 'yith-woocompare-add-product';

                $css_class = 'add_compare button';

                if( $yith_woocompare->obj instanceof YITH_Woocompare_Frontend ){
                    $action_add = $yith_woocompare->obj->action_add;
                    if(!empty($yith_woocompare->obj->products_list) && in_array($product->get_id(), $yith_woocompare->obj->products_list)){
                        $css_class .= ' added';
                    }
                }
                $url_args = array('action' => $action_add, 'id' => $product->get_id());
                $url = apply_filters('yith_woocompare_add_product_url', wp_nonce_url(add_query_arg($url_args), $action_add));

                printf(
                    '<a class="%s" href="%s" title="%s" rel="nofollow" data-product_title="%s" data-product_id="%s">%s</a>',
                    esc_attr($css_class),
                    esc_url($url),
                    esc_attr_x('Add to Compare','front-view', 'precise'),
                    esc_attr($product->get_title()),
                    esc_attr($product->get_id()),
                    esc_attr_x('Add to Compare','front-view', 'precise')
                );
            }
        }

        public function add_wishlist_btn(){

            if (function_exists('YITH_WCWL') && Precise()->settings->get('woocommerce_show_wishlist_btn', 'off') == 'on') {
                global $product;
                $default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists(array('is_default' => true)) : false;
                if (!empty($default_wishlists)) {
                    $default_wishlist = $default_wishlists[0]['ID'];
                } else {
                    $default_wishlist = false;
                }

                if (YITH_WCWL()->is_product_in_wishlist($product->get_id(), $default_wishlist)) {
                    $text = esc_html_x('View Wishlist', 'front-view', 'precise');
                    $class = 'add_wishlist button added';
                    $url = YITH_WCWL()->get_wishlist_url('');
                } else {
                    $text = esc_html_x('Add to Wishlist', 'front-view', 'precise');
                    $class = 'add_wishlist button';
                    $url = add_query_arg('add_to_wishlist', $product->get_id(), YITH_WCWL()->get_wishlist_url(''));
                }

                printf(
                    '<a class="%s" href="%s" title="%s" rel="nofollow" data-product_title="%s" data-product_id="%s">%s</a>',
                    esc_attr($class),
                    esc_url($url),
                    esc_attr($text),
                    esc_attr($product->get_title()),
                    esc_attr($product->get_id()),
                    esc_attr($text)
                );
            }
        }

        public function add_count_up_timer_in_product_listing(){
            global $product;
            $sale_price_dates_to = $product->get_date_on_sale_to() && ( $date = $product->get_date_on_sale_to()->getOffsetTimestamp() ) ? date( 'Y/m/d H:i:s', $date ) : '';
            if(!empty($sale_price_dates_to)){
                echo do_shortcode('[la_countdown countdown_opts="sday,shr,smin,ssec" datetime="'. $sale_price_dates_to .'"]');
            }
        }

        public function add_category_in_product_listing(){
            global $product;
            add_filter('get_the_terms', 'precise_exclude_demo_term_in_category');
            echo wc_get_product_category_list($product->get_id(),'<span>, </span>', '<div class="product_item--category-link">', '</div>');
            remove_filter('get_the_terms', 'precise_exclude_demo_term_in_category');
        }

        public function shop_loop_item_title(){
            the_title( sprintf( '<h2 class="product_item--title"><a href="%s">', esc_url( get_the_permalink() ) ), '</a></h2>' );
        }

        public function render_attribute_in_list(){
            if(class_exists('LaStudio_Swatch')){
                global $product;
                LaStudio_Swatch::render_attribute_in_product_list_loop($product);
            }
        }

        public function shop_loop_item_excerpt(){
            echo '<div class="item--excerpt">';
            the_excerpt();
            echo '</div>';
        }

        public function change_per_page_default($cols){
            $per_page_array = apply_filters('precise/filter/product_per_page_array', Precise()->settings->get('product_per_page_allow', '9,15,30'));
            $per_page = apply_filters('precise/filter/product_per_page', Precise()->settings->get('product_per_page_default', 9));
            $per_page_array = explode(',', $per_page_array);
            $per_page_array = array_map('trim', $per_page_array);
            $per_page_array = array_map('absint', $per_page_array);
            asort($per_page_array);
            if (count($per_page_array) > 0 && ( in_array($per_page, $per_page_array) || count($per_page_array) == 1 ) ) {
                $cols = $per_page;
            }
            return $cols;
        }

        public function set_cookie_default(){
            if (isset($_GET['per_page']) && $per_page = $_GET['per_page']) {
                add_filter('precise/filter/product_per_page', array( $this, 'get_parameter_per_page'));
            }
        }

        public function get_parameter_per_page($per_page) {
            if (isset($_GET['per_page']) && ($_per_page = $_GET['per_page'])) {
                $per_page = $_per_page;
            }
            return $per_page;
        }

        /*
         * Single
         */

        public function add_count_up_timer_to_single(){
            if(!isset($_GET['product_quickview']) && Precise()->settings->get('show_product_countdown')){
                global $product;
                $sale_price_dates_to = $product->get_date_on_sale_to() && ( $date = $product->get_date_on_sale_to()->getOffsetTimestamp() ) ? date( 'Y/m/d H:i:s', $date ) : '';
                if(!empty($sale_price_dates_to)){
                    echo do_shortcode('[la_countdown countdown_opts="sday,shr,smin,ssec" datetime="'. $sale_price_dates_to .'"]');
                }
            }
        }

        public function check_condition_show_upsell_crosssel(){
            if ( Precise()->settings->get('related_products', 'off') != 'on' ) {
                remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
            }
            if ( Precise()->settings->get('upsell_products', 'off') != 'on' ) {
                remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
            }
        }

        public function add_custom_tab($tabs){
            if ( Precise()->settings->get('woo_enable_custom_tab', 'off') == 'on' ) {
                $tabs['custom_tab'] = array(
                    'title' => Precise()->settings->get('woo_custom_tab_title', esc_html_x('Custom Tab', 'front-view', 'precise')),
                    'priority' => 20,
                    'callback' => array( $this, 'get_custom_tab_content')
                );
            }
            return $tabs;
        }

        public function get_custom_tab_content(){
            echo Precise_Helper::remove_js_autop( Precise()->settings->get('woo_custom_tab_content', ''), true);
        }

        public function add_stock_into_single(){
            global $product;
            echo wc_get_stock_html( $product );
        }

        /*
         * Cart
         */

        public function modify_ajax_cart_fragments( $fragments ){
            $fragments['span.la-cart-count'] = sprintf('<span class="component-target-badget la-cart-count">%s</span>', WC()->cart->get_cart_contents_count());
            $text = '<span class="la-cart-text">'. esc_html_x('%s items','front-view', 'precise') .'</span>';
            $fragments['span.la-cart-text'] = sprintf($text, WC()->cart->get_cart_contents_count());
            $fragments['span.la-cart-total-price'] = sprintf('<span class="la-cart-total-price">%s</span>', WC()->cart->get_cart_total());
            return $fragments;
        }

        public function add_shipping_calculator_form_into_cart(){
            woocommerce_shipping_calculator();
        }

        public function add_coupon_form_into_cart(){
            if ( wc_coupons_enabled() ) : ?>
                <div class="la-coupon-form">
                    <h2><?php echo esc_html_x('Coupon Code', 'front-view', 'precise') ?></h2>
                    <p><?php echo esc_html_x('Enter your coupon code if you have one.','front-view', 'precise')?></p>
                    <div class="la-coupon">
                        <p class="form-row form-row-wide">
                            <input type="text" class="input-text" id="coupon_code_ref" value="" placeholder="<?php echo esc_attr_x( 'Enter your coupon code..', 'front-view', 'precise' ); ?>" />
                        </p>
                        <button type="button" class="button" id="coupon_btn_ref"><?php echo esc_html_x( 'Apply coupon', 'front-view', 'precise' ); ?></button>
                    </div>
                </div>
            <?php endif;
        }

        public function add_more_button_to_cart_from(){
            $category_recent_link = get_transient( 'la_recent_product_category_link' );
            ?>
            <input type="submit" class="button btn-clear-cart" name="clear-cart" value="<?php echo esc_attr_x('Clear Cart', 'front-view', 'precise');?>">
            <a href="<?php echo esc_url(!empty($category_recent_link) ? $category_recent_link : wc_get_page_permalink('shop')) ?>" class="btn"><?php echo esc_html_x('Continue Shopping', 'front-view', 'precise'); ?></a>
<?php
        }

        public function set_recent_product_category_link(){
            if(is_shop()){
                delete_transient( 'la_recent_product_category_link' );
                set_transient( 'la_recent_product_category_link', wc_get_page_permalink('shop') , 60*60*12 );
            }
            else if(is_product_taxonomy()){
                delete_transient( 'la_recent_product_category_link' );
                set_transient( 'la_recent_product_category_link', get_term_link(get_queried_object()), 60*60*12 );
            }
        }

        /*
         * Checkout
         */


        /*
         * Catalog Mode
         */
        public function set_page_when_active_catalog_mode(){
            wp_reset_postdata();
            if (is_cart() || is_checkout()) {
                wp_redirect(wc_get_page_permalink('shop'));
                exit;
            }
        }

        public function remove_sortby_price_in_toolbar_when_active_catalog( $array ){
            if( isset($array['price']) ){
                unset( $array['price'] );
            }
            if( isset($array['price-desc']) ){
                unset( $array['price-desc'] );
            }
            return $array;
        }

        /*
         * Other
         */

        public function disable_plugin_hooks() {
            global $yith_woocompare;
            if(function_exists('YITH_WCWL_Init')){
                $yith_wcwl_obj = YITH_WCWL_Init();
                remove_action('wp_head', array($yith_wcwl_obj, 'add_button'));
            }
            if( !empty($yith_woocompare->obj) && ($yith_woocompare->obj instanceof YITH_Woocompare_Frontend ) ){
                remove_action('woocommerce_single_product_summary', array($yith_woocompare->obj, 'add_compare_link'), 35);
                remove_action('woocommerce_after_shop_loop_item', array($yith_woocompare->obj, 'add_compare_link'), 20);
            }
        }

        /**
         * @Todo We need check override setting from shop global
         */
        public function override_setting_by_context( $value, $key, $context ){
            if(!in_array('is_woocommerce', $context)){
                return $value;
            }
            /*
             * The first, we need check page title bar
             */
            $value = $this->override_page_title_bar_setting( $value, $key, $context );
            return $value;
        }

        private function override_page_title_bar_setting( $value, $key, $context ){

            if(!in_array('is_product_taxonomy', $context) && !in_array('is_product', $context) && !in_array('is_shop', $context)){
                return $value;
            }

            $array_key_allow = array(
                'page_title_bar_style',
                'page_title_bar_layout',
                'page_title_bar_background',
                'page_title_bar_heading_color',
                'page_title_bar_text_color',
                'page_title_bar_link_color',
                'page_title_bar_link_hover_color',
                'page_title_bar_spacing',
                'page_title_bar_spacing_tablet',
                'page_title_bar_spacing_mobile'
            );
            $arr2 = array(
                'page_title_bar_background',
                'page_title_bar_heading_color',
                'page_title_bar_text_color',
                'page_title_bar_link_color',
                'page_title_bar_link_hover_color',
                'page_title_bar_spacing',
                'page_title_bar_spacing_tablet',
                'page_title_bar_spacing_mobile'
            );

            if( !in_array($key, $array_key_allow) ){
                return $value;
            }

            $func = 'get_post_meta';
            $current_id = get_queried_object_id();

            if(in_array('is_product_taxonomy', $context)){
                $func = 'get_term_meta';
            }

            if(in_array('is_shop', $context)){
                $current_id = self::$shop_page_id;
            }

            if ( $key == 'page_title_bar_layout') {
                $new_value = Precise()->settings->$func($current_id, $key);

                if($new_value && $new_value != 'inherit'){
                    return $new_value;
                }
            }

            if( Precise()->settings->$func($current_id, 'page_title_bar_style') == 'yes' && in_array($key, $arr2)){
                return $value;
            }

            $enable_override = Precise()->settings->get('woo_override_page_title_bar', 'off');
            if($enable_override == 'on'){
                $new_key = 'woo_' . $key;
                return Precise()->settings->get($new_key, $value);
            }

            return $value;
        }


        public function add_script_resize_image_in_360(){
            Precise()->images->before_resize();
        }

        public function remove_script_resize_image_in_360(){
            Precise()->images->after_resize();
        }

        public function woocommerce_share(){
            echo '<div class="clearfix"></div>';
            if(Precise()->settings->get('product_sharing') == 'on'){
                $post_link = get_permalink();
                $post_title = get_the_title();
                $image = '';
                if(has_post_thumbnail()){
                    $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                }
                echo '<div class="product-share-box">';
                precise_social_sharing($post_link,$post_title,$image);
                echo '</div>';
            }
        }

        public function load_quickview_template( $template ){
            if(is_singular('product') && isset($_GET['product_quickview'])){
                $file     = locate_template( array(
                    'woocommerce/content-single-quickview.php'
                ) );
                if($file){
                    return $file;
                }
            }
            return $template;
        }

        /**
         * VC Vendors
         */

        public function wrapper_start(){
            do_action( 'precise/action/before_render_main' );
            echo '<div id="main" class="site-main">';
                echo '<div class="container">';
                    echo '<div class="row">';
                        echo '<main id="site-content" class="'. esc_attr(Precise()->layout->get_main_content_css_class('col-xs-12 site-content')) .'">';
                            echo '<div class="site-content-inner">';
                                do_action( 'precise/action/before_render_main_inner' );
                                echo '<div class="page-content">';
        }

        public function wrapper_end(){
                                echo '</div><!--- ./page-content --->';
                                do_action( 'precise/action/after_render_main_inner' );
                            echo '</div><!--- ./site-content-inner --->';
                        echo '</main><!--- ./site-content --->';
                    get_sidebar();
                echo '</div><!--- ./row --->';
                echo '</div><!--- ./container --->';
            echo '</div><!--- ./site-main --->';
            do_action( 'precise/action/after_render_main' );
        }

        public function woocommerce_before_shipping_calculator(){
            printf(
                '<div class="la-shipping-form"><h2>%s</h2><p>%s</p>',
                esc_html_x('Calculate Shipping', 'front-view', 'precise'),
                esc_html_x('Estimate your shipping fee *', 'front-view', 'precise')
            );
        }

        public function woocommerce_after_shipping_calculator(){
            echo '</div>';
        }
    }
}