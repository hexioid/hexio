<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

/**
 * Handle enqueueing scrips.
 */
class Precise_Scripts
{

    /**
     * The class construction
     */
    public function __construct()
    {

        if (!is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) {
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 20);
            add_action('script_loader_tag', array($this, 'add_async'), 10, 2);
        }

        if (class_exists('WooCommerce')) {
            add_filter('woocommerce_enqueue_styles', array($this, 'remove_woo_scripts'));
        }

        add_action('wp_head', array( $this, 'add_meta_into_head'), 100 );
        add_action('precise/action/head', array( $this, 'get_custom_css_from_setting'));
        add_action('precise/action/head', array( $this, 'add_custom_header_js' ), 100 );
        add_action('precise/action/footer', array( $this, 'add_custom_footer_js' ), 100 );
    }

    /**
     * Takes care of enqueueing all our scripts.
     */
    public function enqueue_scripts()
    {

        $styleNeedRemove = array(
            'yith-woocompare-widget',
            'jquery-selectBox',
            'yith-wcwl-font-awesome',
            'woocomposer-front-slick',
            'jquery-colorbox'
        );
        $scriptNeedRemove = array(
            'woocomposer-slick'
        );

        foreach ($styleNeedRemove as $style) {
            if (wp_style_is($style, 'registered')) {
                wp_deregister_style($style);
            }
        }
        foreach ($scriptNeedRemove as $script) {
            if (wp_script_is($script, 'registered')) {
                wp_dequeue_script($script);
            }
        }
        $font_source = Precise()->settings->get('font_source', 1);
        switch ($font_source) {
            case '1':
                wp_enqueue_style('precise-google_fonts', $this->get_google_font_url(), array(), null);
                break;
            case '2':
                wp_enqueue_style('precise-font_google_code', $this->get_google_font_code_url(), array(), null);
                break;
            case '3':
                wp_enqueue_script('precise-font_typekit', $this->get_google_font_typekit_url(), array(), null);
                wp_add_inline_script( 'precise-font_typekit', 'try{ Typekit.load({ async: true });}catch(e){}' );
                break;
        }


        wp_enqueue_style('font-awesome', Precise::$template_dir_url . '/assets/css/font-awesome.min.css', array(), null);
        wp_enqueue_style('animate-css', Precise::$template_dir_url . '/assets/css/animate.min.css', array(), null);
        wp_enqueue_style('precise-theme', get_template_directory_uri() . '/style.css', array('font-awesome', 'animate-css'), null);


        /*
         * Scripts
         */
        if (!wp_script_is('js-cookie', 'registered')) {
            wp_register_script('js-cookie', Precise::$template_dir_url . '/assets/js/js-cookie/js.cookie.min.js', array('jquery'), '2.1.4', true);
        }
        if (!wp_script_is('imagesloaded', 'registered')) {
            wp_register_script('imagesloaded', Precise::$template_dir_url . '/assets/js/imagesloaded/imagesloaded.pkgd.min.js', array('jquery'), '4.1.1', true);
        }
        wp_register_script('precise-modernizr-custom', Precise::$template_dir_url . '/assets/js/modernizr/modernizr-custom.min.js', array('jquery'), '2.6.2', true);
        wp_register_script('precise-twitter-fetcher', Precise::$template_dir_url . '/assets/js/twitter-fetcher/twitterFetcher.min.js', array('jquery'), '17.0.0', true);
        wp_register_script('precise-lightcase', Precise::$template_dir_url . '/assets/js/lightcase/lightcase.min.js', array('jquery'), '2.4.0', true);
        wp_register_script('precise-infinite-scroll', Precise::$template_dir_url . '/assets/js/infinite-scroll/jquery.infinitescroll.min.js', array('jquery'), '2.1.0', true);
        wp_register_script('precise-isotope', Precise::$template_dir_url . '/assets/js/isotope/isotope.pkgd.min.js', array('jquery'), '3.0.4', true);
        wp_register_script('precise-isotope-packery', Precise::$template_dir_url . '/assets/js/isotope-packery/packery-mode.pkgd.min.js', array('precise-isotope'), '2.0.0', true);
        wp_register_script('precise-slick-slider', Precise::$template_dir_url . '/assets/js/slick-slider/slick.min.js', array('jquery'), '1.6.0', true);
        wp_register_script('precise-jquery-appear', Precise::$template_dir_url . '/assets/js/appear/jquery.appear.min.js', array('jquery'), '0.6.3', true);
        wp_register_script('precise-jquery-count-up', Precise::$template_dir_url . '/assets/js/count-up/countUp.min.js', array('jquery'), '1.8.5', true);
        wp_register_script('precise-jquery-count-down', Precise::$template_dir_url . '/assets/js/count-down/jquery.countdown.min.js', array('jquery'), '2.1.0', true);
        wp_register_script('precise-sticky-kit', Precise::$template_dir_url . '/assets/js/sticky-kit/sticky-kit.min.js', array('jquery'), '1.1.3', true);
        wp_register_script('precise-circle-progress', Precise::$template_dir_url . '/assets/js/circle-progress/circle-progress.min.js', array('jquery'), '1.2.2', true);
        wp_register_script('precise-dlmenu', Precise::$template_dir_url . '/assets/js/dlmenu/jquery.dlmenu.min.js', array('precise-modernizr-custom'), '1.0.1', true);

        $precise_js_require = array(
            'js-cookie',
            'imagesloaded',
            'precise-dlmenu',
            'precise-twitter-fetcher',
            'precise-lightcase',
            'precise-infinite-scroll',
            'precise-isotope-packery',
            'precise-slick-slider',
            'precise-jquery-appear',
            'precise-jquery-count-up',
            'precise-jquery-count-down',
            'precise-sticky-kit',
            'precise-circle-progress'
        );

        $fullpage_config = array();
        if (in_array('is_page', Precise()->get_current_context())) {
            $fp_metadata = Precise()->settings->get_post_meta(get_the_ID());

            if (Precise()->layout->get_site_layout() == 'col-1c' && (!empty($fp_metadata['enable_fp']) && $fp_metadata['enable_fp'] == 'yes')) {
                $fp_easing = !empty($fp_metadata['fp_easing']) ? $fp_metadata['fp_easing'] : 'css3_ease';
                $fp_scrolloverflow = !empty($fp_metadata['fp_scrolloverflow']) ? $fp_metadata['fp_scrolloverflow'] : 'no';
                $fullpage_js_require = array('jquery');
                if (substr($fp_easing, 0, 3) == 'js_') {
                    wp_register_script('precise-easings', Precise::$template_dir_url . '/assets/js/jquery.easings.min.js', array('jquery'), null, true);
                    $fullpage_js_require[] = 'precise-easings';
                }
                if ($fp_scrolloverflow == 'yes') {
                    wp_register_script('precise-scrolloverflow', Precise::$template_dir_url . '/assets/js/scrolloverflow.min.js', array('jquery'), null, true);
                    $fullpage_js_require[] = 'precise-scrolloverflow';
                }
                wp_register_script('precise-fullpage-parallax', Precise::$template_dir_url . '/assets/js/fullpage/jquery.fullpage.parallax.min.js', array('jquery'), null, true);
                $fullpage_js_require[] = 'precise-fullpage-parallax';

                wp_register_script('precise-fullpage', Precise::$template_dir_url . '/assets/js/fullpage/jquery.fullpage.extensions.min.js', $fullpage_js_require, null, true);
                $precise_js_require[] = 'precise-fullpage';

                $fullpage_config = $this->get_fullpage_config();
            }
        }
        if (wp_script_is('waypoints', 'registered')) {
            wp_enqueue_script('waypoints');
        }
        wp_enqueue_script('precise-theme', Precise::$template_dir_url . '/assets/js/theme.js', $precise_js_require, null, true);

        wp_localize_script('precise-theme', 'precise_configs', apply_filters('precise/filter/global_message_js', array(
            'compare' => array(
                'view' => esc_attr_x('View List Compare', 'front-view', 'precise'),
                'success' => esc_attr_x('has been added to comparison list.', 'front-view', 'precise'),
                'error' => esc_attr_x('An error occurred ,Please try again !', 'front-view', 'precise')
            ),
            'wishlist' => array(
                'view' => esc_attr_x('View List Wishlist', 'front-view', 'precise'),
                'success' => esc_attr_x('has been added to your wishlist.', 'front-view', 'precise'),
                'error' => esc_attr_x('An error occurred ,Please try again !', 'front-view', 'precise')
            ),
            'addcart' => array(
                'view' => esc_attr_x('View Cart', 'front-view', 'precise'),
                'success' => esc_attr_x('has been added to your cart', 'front-view', 'precise'),
                'error' => esc_attr_x('An error occurred ,Please try again !', 'front-view', 'precise')
            ),
            'global' => array(
                'error' => esc_attr_x('An error occurred ,Please try again !', 'front-view', 'precise'),
                'comment_author' => esc_attr_x('Please enter Name !', 'front-view', 'precise'),
                'comment_email' => esc_attr_x('Please enter Email Address !', 'front-view', 'precise'),
                'comment_rating' => esc_attr_x('Please select a rating !', 'front-view', 'precise'),
                'comment_content' => esc_attr_x('Please enter Comment !', 'front-view', 'precise'),
                'continue_shopping' => esc_attr_x('Continue Shopping', 'front-view', 'precise'),
            ),
            'instagram_token' => esc_attr(Precise()->settings->get('instagram_token')),
            'fullpage' => $fullpage_config,
            'product_single_design' => esc_attr(Precise()->settings->get('woocommerce_product_page_design', 1)),
            'text' => array(
                'backtext' => esc_attr_x('Back', 'front-view', 'precise')
            ),
            'popup' => array(
                'max_width' => esc_attr(Precise()->settings->get('popup_max_width', 790)),
                'max_height' => esc_attr(Precise()->settings->get('popup_max_height', 430))
            ),
            'js_path' => esc_attr(Precise::$template_dir_url . '/assets/js'),
            'support_touch' => (Precise()->settings->get('enable_one_time_click', 'no') == 'no' ? true : false),
            'mm_mb_effect' => esc_attr(Precise()->settings->get('mm_mb_effect', '2')),
            'ajax_url' => esc_attr(admin_url( 'admin-ajax.php', 'relative' ))
        )));

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        wp_add_inline_style('precise-theme', Precise_Helper::compress_text($this->dynamic_css(), true));
    }

    /**
     * Removes WooCommerce scripts.
     *
     * @access public
     * @since 1.0
     * @param array $scripts The WooCommerce scripts.
     * @return array
     */
    public function remove_woo_scripts($scripts)
    {

        if (isset($scripts['woocommerce-layout'])) {
            unset($scripts['woocommerce-layout']);
        }
        if (isset($scripts['woocommerce-smallscreen'])) {
            unset($scripts['woocommerce-smallscreen']);
        }
        if (isset($scripts['woocommerce-general'])) {
            unset($scripts['woocommerce-general']);
        }
        return $scripts;

    }

    private function dynamic_css()
    {
        ob_start();
        include Precise::$template_dir_path . '/framework/functions/additional_css.php';
        include Precise::$template_dir_path . '/framework/functions/dynamic_css.php';
        return ob_get_clean();
    }

    public function get_custom_css_from_setting(){
        if( $la_custom_css = Precise()->settings->get('la_custom_css') ){
            printf( '<%1$s id="precise-extra-custom-css" type="%3$s">%2$s</%1$s>', 'style', $la_custom_css, 'text/css' );
        }
    }

    /**
    * Add async to theme javascript file for performance
    *
    * @param string $tag The script tag.
    * @param string $handle The script handle.
    */

    public function add_async($tag, $handle)
    {
        return (in_array($handle, array('la-swatches', 'precise-theme'))) ? preg_replace('/(><\/[a-zA-Z][^0-9](.*)>)$/', ' async $1 ', $tag) : $tag;
    }

    protected function get_fullpage_config()
    {
        $config = array();
        $metadata = Precise()->settings->get_post_meta(get_the_ID());
        if (!empty($metadata['fp_navigation']) && $metadata['fp_navigation'] != 'off') {
            $config['navigation'] = true;
            $config['navigationPosition'] = esc_attr($metadata['fp_navigation']);
            $config['showActiveTooltip'] = (!empty($metadata['fp_showactivetooltip']) && $metadata['fp_showactivetooltip'] == 'yes') ? true : false;
        }
        if (!empty($metadata['fp_slidenavigation']) && $metadata['fp_slidenavigation'] != 'off') {
            $config['slidesNavigation'] = true;
            $config['slidesNavPosition'] = esc_attr($metadata['fp_slidenavigation']);
        }
        $config['controlArrows'] = (!empty($metadata['fp_controlarrows']) && $metadata['fp_controlarrows'] == 'yes') ? true : false;
        $config['lockAnchors'] = (!empty($metadata['fp_lockanchors']) && $metadata['fp_lockanchors'] == 'yes') ? true : false;
        $config['animateAnchor'] = (!empty($metadata['fp_animateanchor']) && $metadata['fp_animateanchor'] == 'yes') ? true : false;
        $config['keyboardScrolling'] = (!empty($metadata['fp_keyboardscrolling']) && $metadata['fp_keyboardscrolling'] == 'yes') ? true : false;
        $config['recordHistory'] = (!empty($metadata['fp_recordhistory']) && $metadata['fp_recordhistory'] == 'yes') ? true : false;

        $config['autoScrolling'] = (!empty($metadata['fp_autoscrolling']) && $metadata['fp_autoscrolling'] == 'yes') ? true : false;
        $config['fitToSection'] = (!empty($metadata['fp_fittosection']) && $metadata['fp_fittosection'] == 'yes') ? true : false;
        $config['fitToSectionDelay'] = (!empty($metadata['fp_fittosectiondelay'])) ? absint($metadata['fp_fittosectiondelay']) : 1000;

        $config['scrollBar'] = (!empty($metadata['fp_scrollbar']) && $metadata['fp_scrollbar'] == 'yes') ? true : false;
        $config['scrollOverflow'] = (!empty($metadata['fp_scrolloverflow']) && $metadata['fp_scrolloverflow'] == 'yes') ? true : false;
        if ($config['scrollOverflow']) {
            $config['scrollOverflowOptions'] = array(
                'scrollbars' => (!empty($metadata['fp_hidescrollbars']) && $metadata['fp_hidescrollbars'] == 'yes') ? true : false,
                'fadeScrollbars' => (!empty($metadata['fp_fadescrollbars']) && $metadata['fp_fadescrollbars'] == 'yes') ? true : false,
                'interactiveScrollbars' => (!empty($metadata['fp_interactivescrollbars']) && $metadata['fp_interactivescrollbars'] == 'yes') ? true : false
            );
        }
        if (!empty($metadata['fp_bigsectionsdestination']) && $metadata['fp_bigsectionsdestination'] != 'default') {
            $config['bigSectionsDestination'] = esc_attr($metadata['fp_bigsectionsdestination']);
        }

        if (!empty($metadata['fp_contvertical']) && $metadata['fp_contvertical'] == 'yes') {
            $config['continuousVertical'] = true;
            $config['loopBottom'] = false;
            $config['loopTop'] = false;
        } else {
            $config['continuousVertical'] = false;
            $config['loopBottom'] = (!empty($metadata['fp_loopbottom']) && $metadata['fp_loopbottom'] == 'yes') ? true : false;
            $config['loopTop'] = (!empty($metadata['fp_looptop']) && $metadata['fp_looptop'] == 'yes') ? true : false;
        }

        $config['loopHorizontal'] = (!empty($metadata['fp_loophorizontal']) && $metadata['fp_loophorizontal'] == 'yes') ? true : false;
        $config['scrollingSpeed'] = (!empty($metadata['fp_scrollingspeed'])) ? absint($metadata['fp_scrollingspeed']) : 700;

        $fp_easing = !empty($metadata['fp_easing']) ? $metadata['fp_easing'] : 'css3_ease';
        if (substr($fp_easing, 0, 5) == 'css3_') {
            $config['css3'] = true;
            $config['easing'] = "easeInOutCubic";
            $config['easingcss3'] = substr($fp_easing, 5, strlen($fp_easing));
        } else if (substr($fp_easing, 0, 3) == 'js_') {
            $config['css3'] = false;
            $config['easingcss3'] = "ease";
            $config['easing'] = substr($fp_easing, 3, strlen($fp_easing));
        }

        $config['verticalCentered'] = (!empty($metadata['fp_verticalcentered']) && $metadata['fp_verticalcentered'] == 'yes') ? true : false;
        $config['responsiveWidth'] = (!empty($metadata['fp_respwidth'])) ? absint($metadata['fp_respwidth']) : 0;
        $config['responsiveHeight'] = (!empty($metadata['fp_respheight'])) ? absint($metadata['fp_respheight']) : 0;

        $config['paddingTop'] = (!empty($metadata['fp_padding']['top'])) ? absint($metadata['fp_padding']['top']) . 'px' : '0px';
        $config['paddingBottom'] = (!empty($metadata['fp_padding']['bottom'])) ? absint($metadata['fp_padding']['bottom']) . 'px' : '0px';

        $fixedElements = (!empty($metadata['fp_fixedelements'])) ? esc_attr($metadata['fp_fixedelements']) : "";
        $fixedElements = array_filter(explode(',', $fixedElements));
        $fixedElements = array_merge(array('.la_fp_fixed_top', '.la_fp_fixed_bottom'), $fixedElements);

        $config['fixedElements'] = implode(',', $fixedElements);

        $parallax = false;
        if(!empty($metadata['fp_section_effect']) && $metadata['fp_section_effect'] != 'default'){
            $parallax = true;
        }

        $config['parallax'] = $parallax;
        $config['parallaxKey'] = "QU5ZXzlNZGNHRnlZV3hzWVhnPTFyRQ==";
        $config['parallaxOptions'] =  array(
            'percentage' => 50,
            'property' => 'translate',
            'type' => 'reveal'
        );
        return $config;
    }

    public function get_gfont_from_setting(){
        $array = array();
        $main_font = Precise()->settings->get('main_font');
        $secondary_font = Precise()->settings->get('secondary_font');
        $highlight_font = Precise()->settings->get('highlight_font');

        if(!empty($main_font['family'])){
            $array['body'] = $main_font['family'];
        }
        if(!empty($secondary_font['family'])){
            $array['heading'] = $secondary_font['family'];
        }
        if(!empty($highlight_font['family'])){
            $array['highlight'] = $highlight_font['family'];
        }
        return $array;
    }

    public function get_google_font_url(){

        $_tmp = array();

        $main_font = (array) Precise()->settings->get('main_font');
        $secondary_font = (array) Precise()->settings->get('secondary_font');
        $highlight_font = (array) Precise()->settings->get('highlight_font');

        if(!empty($main_font['family'])){
            if(!empty($main_font['variant'])){
                $_tmp[] = $main_font['family'] . ":" . implode(',', (array) $main_font['variant']);
            }else{
                $_tmp[] = $main_font['family'];
            }
        }

        if(!empty($secondary_font['family'])){
            if(!empty($secondary_font['variant'])){
                $_tmp[] = $secondary_font['family'] . ":" . implode(',', (array) $secondary_font['variant']);
            }else{
                $_tmp[] = $secondary_font['family'];
            }
        }

        if(!empty($highlight_font['family'])){
            if(!empty($highlight_font['variant'])){
                $_tmp[] = $highlight_font['family'] . ":" . implode(',', (array) $highlight_font['variant']);
            }else{
                $_tmp[] = $highlight_font['family'];
            }
        }

        if(empty($_tmp)){
            return '';
        }

        return esc_url( add_query_arg('family', implode( '%7C', $_tmp ),'//fonts.googleapis.com/css') );
    }

    public function get_google_font_code_url() {
        $fonts_url = '';
        $_font_code = Precise()->settings->get('font_google_code', '');
        if(!empty($_font_code)){
            $fonts_url = $_font_code;
        }
        return esc_url($fonts_url);
    }

    public function get_google_font_typekit_url(){
        $fonts_url = '';
        $_api_key = Precise()->settings->get('font_typekit_kit_id', '');
        if(!empty($_api_key)){
            $fonts_url =  '//use.typekit.net/' . preg_replace('/\s+/', '', $_api_key) . '.js';
        }
        return esc_url($fonts_url);
    }

    public function add_custom_header_js(){
        printf( '<%1$s %2$s>try{ %3$s }catch (ex){}</%1$s>', 'script', '', Precise()->settings->get('header_js') );
    }

    public function add_custom_footer_js(){
        printf( '<%1$s %2$s>try{ %3$s }catch (ex){}</%1$s>', 'script', '', Precise()->settings->get('footer_js') );
    }
    public function add_meta_into_head(){
        get_template_part('templates/head/meta');
    }
}