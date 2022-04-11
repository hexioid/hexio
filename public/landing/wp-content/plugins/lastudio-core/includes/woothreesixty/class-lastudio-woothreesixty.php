<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

if(!class_exists('LaStudio_WooThreeSixty')){

    class LaStudio_WooThreeSixty{

        public static $instance = null;

        public static function get_instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        private function __construct(){

            add_action( 'woocommerce_product_write_panel_tabs', array($this, 'product_write_panel_tabs'), 99 );
            add_action( 'woocommerce_product_data_panels', array($this, 'product_data_panel_wrap'), 99 );
            add_action( 'woocommerce_process_product_meta', array($this, 'process_meta_box'), 1, 2 );

            add_action( 'edit_attachment', array( $this, 'woo_save_embed_video' ) );
            add_filter( 'attachment_fields_to_edit', array( $this, 'woo_embed_video' ), 20, 2);

            add_action( 'wp', array( $this, 'modify_product_output') );
        }

        public function product_write_panel_tabs() {
            ?>
            <li class="tab_la_threesixty"><a href="#tab_la_threesixty"><span><?php esc_html_e('360 Image Settings', 'la-studio') ?></span></a></li>
            <?php
        }

        public function product_data_panel_wrap() {
            global $post;
            $enable = get_post_meta( $post->ID, '_la_360_enable', true );
            ?>
            <div id="tab_la_threesixty" class="panel tab_la_threesixty woocommerce_options_panel wc-metaboxes-wrapper" style="display: none">
                <p class="form-field">
                    <label style="width: 100%;float: none;margin: 0;display: inline-block;">
                        <input type="checkbox" class="checkbox" name="_la_360_enable" id="_la_360_enable" value="yes" <?php checked($enable, 'yes') ?>/>
                        <span class="description"><?php esc_html_e('Replace Image with 360 Image', 'la-studio') ?></span>
                    </label>
                </p>
            </div>
            <?php
        }

        public function process_meta_box( $post_id, $post ) {
            $product = wc_get_product($post_id);
            $data = isset( $_POST['_la_360_enable'] ) ? $_POST['_la_360_enable'] : '';
            $product->update_meta_data('_la_360_enable', $data );
            $product->save_meta_data();
        }

        public function wp_enqueue_scripts(){
            wp_enqueue_script('lastudio-threesixty-init');
            wp_enqueue_style('lastudio-threesixty');
            wp_localize_script( 'lastudio-threesixty-init', 'la_threesixty_vars', $this->js_data_all() );
        }

        public function modify_product_output(){
            if(is_product()) {
                global $post;
                $enable = get_post_meta( $post->ID, '_la_360_enable', true );
                if($enable == 'yes') {
                    add_action('wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
                    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
                    add_action('woocommerce_before_single_product_summary', array($this, 'output_image'));
                    add_filter('post_class', array($this, 'append_post_class'));
                }
            }
        }

        public function output_image(){
            do_action( 'la_threesixty_before_image' );
            wc_get_template( 'single-product/product-360.php' );
            do_action( 'la_threesixty_after_image' );
        }

        public function append_post_class( $classes ) {
            $classes[] = 'la-360-product';
            return $classes;
        }

        public function js_data_all(){

            $images_array = json_encode( $this->js_data_images() );

            $navigation = true;
            // Responsiveness
            $responsive = apply_filters( 'la_threesixty_js_responsive', true );
            // Drag / Touch
            $drag = apply_filters( 'la_threesixty_js_drag', true );
            // Spin
            $spin = apply_filters( 'la_threesixty_js_spin', false );
            $speed     = apply_filters( 'la_threesixty_js_speed', 60 );
            $framerate = apply_filters( 'la_threesixty_js_framerate', $speed );
            $playspeed = apply_filters( 'la_threesixty_js_playspeed', 100 );

            // Image Sizes array
            $wp_get_additional_image_sizes = wp_get_additional_image_sizes();
            $image_size = isset($wp_get_additional_image_sizes['shop_single']) ? $wp_get_additional_image_sizes['shop_single'] : array( 'width' => 600, 'height' => 600);

            $width = $image_size['width'];
            $height = $image_size['height'];


            return array(
                'images'     => $images_array,
                'navigation' => $navigation,
                'responsive' => $responsive,
                'drag'       => $drag,
                'spin'       => $spin,
                'width'      => $width,
                'height'     => $height,
                'framerate'  => $framerate,
                'playspeed'  => $playspeed,
            );
        }

        public function js_data_images( $post_id = '' ) {
            $image_js_array = array();
            if ( $post_id ) {
                $id = $post_id;
            } else {
                global $post;
                $id = $post->ID;
            }

            $image_size = 'shop_single';


            $product = wc_get_product($id);
            $attachment_ids = $product->get_gallery_image_ids();
            if ( $attachment_ids ) {

                do_action('la_threesixty_before_get_image_array');

                foreach ( $attachment_ids as $attachment_id ) {
                    $image_src = wp_get_attachment_image_src( $attachment_id, $image_size );
                    $image_link = $image_src[0];
                    $image_js_array[] = $image_link;
                }

                do_action('la_threesixty_after_get_image_array');
            }
            return $image_js_array;
        }

        public function woo_save_embed_video( $attachment_id ) {
            if ( isset( $_REQUEST['attachments'][$attachment_id]['videolink'] ) ) {
                $videolink = $_REQUEST['attachments'][$attachment_id]['videolink'];
                update_post_meta( $attachment_id, 'videolink', $videolink );
            }
        }

        public function woo_embed_video( $form_fields, $attachment ) {

            $field_value = get_post_meta( $attachment->ID, 'videolink', true );

            $form_fields['videolink'] = array(
                'value' => $field_value ? $field_value : '',
                'input' => 'text',
                'label' => __( 'Video Link', 'la-studio' )
            );
            return $form_fields;
        }
    }
}