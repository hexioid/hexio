<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class LaStudio_Shortcodes_Parallax_Row{

    public static $instance = null;

    public static function register() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Hook into WordPress.
     *
     * @return	void
     * @since	1.0
     */
    private function __construct() {
        // Initialize as a Visual Composer addon.
        add_filter( 'init', array( $this, 'create_row_shortcodes' ), 999 );

        // Makes the plugin function accessible as a shortcode.
        add_shortcode( 'la_parallax_row', array( $this, 'create_shortcode' ) );
    }

    /**
     * Creates our shortcode settings in Visual Composer.
     *
     * @return	void
     * @since	1.0
     */
    public function create_row_shortcodes() {
        if ( ! function_exists( 'vc_map' ) ) {
            return;
        }
        vc_map( array(
            'name'          => __( 'Parallax Row Background', 'la-studio' ),
            'base'          => 'la_parallax_row',
            'icon'          => 'la_parallax_row',
            'description'   => __( 'Add a parallax bg to your row.', 'la-studio' ),
            'category'  	=> __('La Studio', 'la-studio'),
            'params'        => array(
                array(
                    'type' => 'attach_image',
                    'class' => '',
                    'heading' => __( 'Background Image', 'la-studio' ),
                    'param_name' => 'image',
                    'admin_label' => true,
                    'description' => __( 'Select your background image. <strong>Make sure that your image is of high resolution, we will resize the image to make it fit.</strong><br><strong>For optimal performance, try keeping your images close to 1600 x 900 pixels</strong>', 'la-studio' ),
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __( 'Background Image Parallax', 'la-studio' ),
                    'param_name' => 'direction',
                    'value' => array(
                        'Up' => 'up',
                        'Down' => 'down',
                        'Left' => 'left',
                        'Right' => 'right',
                        'Fixed' => 'fixed',
                    ),
                    'description' => __( "Choose the direction of your parallax. <strong>Note that browsers render fixed directions very slow since they aren't hardware accelerated.</strong>", 'la-studio' ),
                ),
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => __( 'Parallax Speed', 'la-studio' ),
                    'param_name' => 'speed',
                    'value' => '0.3',
                    'description' => __( 'The movement speed, value should be between 0.1 and 1.0. A lower number means slower scrolling speed.', 'la-studio' ),
                    'dependency' => array(
                        'element' => 'direction',
                        'value' => array( 'up', 'down', 'left', 'right' ),
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __( 'Background Style / Repeat', 'la-studio' ),
                    'param_name' => 'background_repeat',
                    'value' => array(
                        __( 'Cover Whole Row (covers the whole row)', 'la-studio' ) => '',
                        __( 'Repeating Image Pattern', 'la-studio' ) => 'repeat',
                    ),
                    'description' => __( 'Select whether the background image above should cover the whole row, or whether the image is a background seamless pattern.', 'la-studio' ),
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => __( 'Background Position / Alignment', 'la-studio' ),
                    'param_name' => 'background_position',
                    'value' => array(
                        __( 'Centered', 'la-studio' ) => '',
                        __( 'Left (only applies to up, down parallax or fixed)', 'la-studio' ) => 'left',
                        __( 'Right (only applies to up, down parallax or fixed)', 'la-studio' ) => 'right',
                        __( 'Top (only applies to left or right parallax)', 'la-studio' ) => 'top',
                        __( 'Bottom (only applies to left or right parallax)', 'la-studio' ) => 'bottom',
                    ),
                    'description' => __( 'The alignment of the background / parallax image. Note that this most likely will only be noticeable in smaller screens, if the row is large enough, the image will most likely be fully visible. Use this if you want to ensure that a certain area will always be visible in your parallax in smaller screens.', 'la-studio' ),
                ),
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => __( 'Opacity', 'la-studio' ),
                    'param_name'  => 'opacity',
                    'value' => '100',
                    'description' => __( 'You may set the opacity level for your parallax. You can add a background color to your row and add an opacity here to tint your parallax. <strong>Please choose an integer value between 1 and 100.</strong>', 'la-studio' ),
                ),
                array(
                    'type' => 'checkbox',
                    'class' => '',
                    'param_name' => 'enable_mobile',
                    'value' => array( __( 'Check this to enable the parallax effect in mobile devices', 'la-studio' ) => 'parallax-enable-mobile' ),
                    'description' => __( 'Parallax effects would most probably cause slowdowns when your site is viewed in mobile devices. If the device width is less than 980 pixels, then it is assumed that the site is being viewed in a mobile device.', 'la-studio' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Custom ID', 'la-studio' ),
                    'param_name' => 'id',
                    'value' => '',
                    'description' => __( 'Add a custom id for the element here. Only one ID can be defined.', 'la-studio' ),
                    'group' => __( 'Advanced', 'la-studio' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Parallax ID', 'la-studio' ),
                    'param_name' => 'prlx_id',
                    'value' => '',
                    'description' => __( 'Assign an ID for the actual parallax row here.', 'la-studio' ),
                    'group' => __( 'Advanced', 'la-studio' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Custom Class', 'la-studio' ),
                    'param_name' => 'class',
                    'value' => '',
                    'description' => __( 'Add a custom class name for the element here. If defining multiple classes, separate them by lines and define them like you would in HTML code.', 'la-studio' ),
                    'group' => __( 'Advanced', 'la-studio' ),
                ),
            ),
        ) );

    }


    /**
     * Shortcode logic.
     *
     * @param array  $atts - The attributes of the shortcode.
     * @param string $content - The content enclosed inside the shortcode if any.
     * @return string - The rendered html.
     * @since 1.0
     */
    public function create_shortcode( $atts, $content = null ) {
        $defaults = array(
            'image' => '',
            'direction' => 'up',
            'speed' => '0.3',
            'background_repeat' => '',
            'background_position' => '',
            'opacity' => '100',
            'enable_mobile' => '',
            'class' => '',
            'id' => '',
            'prlx_id' => '',
        );
        if ( empty( $atts ) ) {
            $atts = array();
        }
        $atts = array_merge( $defaults, $atts );
        $id = '';
        $class = '';

        if ( empty( $atts['image'] ) ) {
            return '';
        }

        wp_enqueue_script( 'lastudio-parallax-row' );

        // Jetpack issue, Photon is not giving us the image dimensions.
        // This snippet gets the dimensions for us.
        add_filter( 'jetpack_photon_override_image_downsize', '__return_true' );
        $image_info = wp_get_attachment_image_src( $atts['image'], 'full' );
        remove_filter( 'jetpack_photon_override_image_downsize', '__return_true' );

        $attachment_image = wp_get_attachment_image_src( $atts['image'], 'full' );
        if ( empty( $attachment_image ) ) {
            return '';
        }

        // See if classes and IDs are defined.
        if ( ! empty( $atts['class'] ) ) {
            $class = ' ' . esc_attr( $atts['class'] );
        } else {
            $class = '';
        }
        if ( ! empty( $atts['id'] ) ) {
            $id = "id='" . esc_attr( $atts['id'] ) . "' ";
        } else {
            $id = '';
        }

        $bg_image_width = $image_info[1];
        $bg_image_height = $image_info[2];
        $bg_image = $attachment_image[0];

        return  '<div ' . $id . "class='la_parallax_row" . $class . "' " .
        "data-bg-align='" . esc_attr( $atts['background_position'] ) . "' " .
        "data-direction='" . esc_attr( $atts['direction'] ) . "' " .
        "data-opacity='" . esc_attr( $atts['opacity'] ) . "' " .
        "data-velocity='" . esc_attr( (float) $atts['speed'] * -1 ) . "' " .
        "data-mobile-enabled='" . esc_attr( $atts['enable_mobile'] ) . "' " .
        "data-bg-height='" . esc_attr( $bg_image_height ) . "' " .
        "data-bg-width='" . esc_attr( $bg_image_width ) . "' " .
        "data-bg-image='" . esc_attr( $bg_image ) . "' " .
        "data-bg-repeat='" . esc_attr( empty( $atts['background_repeat'] ) ? 'false' : 'true' ) . "' " .
        "data-id='" . esc_attr( $atts['prlx_id'] ) . "' " .
        "style='display: none'></div>";
    }

}

if (class_exists('WPBakeryShortCode') && !class_exists( 'WPBakeryShortCode_la_parallax_row' ) ) {
    class WPBakeryShortCode_la_parallax_row extends WPBakeryShortCode{
        public function singleParamHtmlHolder( $param, $value ) {
            $output = '';
            // Compatibility fixes
            $old_names = array(
                'yellow_message',
                'blue_message',
                'green_message',
                'button_green',
                'button_grey',
                'button_yellow',
                'button_blue',
                'button_red',
                'button_orange',
            );
            $new_names = array(
                'alert-block',
                'alert-info',
                'alert-success',
                'btn-success',
                'btn',
                'btn-info',
                'btn-primary',
                'btn-danger',
                'btn-warning',
            );
            $value = str_ireplace( $old_names, $new_names, $value );

            $param_name = isset( $param['param_name'] ) ? $param['param_name'] : '';
            $type = isset( $param['type'] ) ? $param['type'] : '';
            $class = isset( $param['class'] ) ? $param['class'] : '';

            if ( 'attach_image' === $param['type'] && 'image' === $param_name ) {
                $output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
                $element_icon = $this->settings( 'icon' );
                $img = wpb_getImageBySize( array(
                    'attach_id' => (int) preg_replace( '/[^\d]/', '', $value ),
                    'thumb_size' => 'thumbnail',
                ) );
                $this->setSettings( 'logo', ( $img ? $img['thumbnail'] : '<img width="150" height="150" src="' . vc_asset_url( 'vc/blank.gif' ) . '" class="attachment-thumbnail vc_general vc_element-icon"  data-name="' . $param_name . '" alt="" title="" style="display: none;" />' ) . '<span class="no_image_image vc_element-icon' . ( ! empty( $element_icon ) ? ' ' . $element_icon : '' ) . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '" /><a href="#" class="column_edit_trigger' . ( $img && ! empty( $img['p_img_large'][0] ) ? ' image-exists' : '' ) . '">' . __( 'Add image', 'js_composer' ) . '</a>' );
                $output .= $this->outputTitleTrue( $this->settings['name'] );
            } elseif ( ! empty( $param['holder'] ) ) {
                if ( 'input' === $param['holder'] ) {
                    $output .= '<' . $param['holder'] . ' readonly="true" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '">';
                } elseif ( in_array( $param['holder'], array( 'img', 'iframe' ) ) ) {
                    $output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" src="' . $value . '">';
                } elseif ( 'hidden' !== $param['holder'] ) {
                    $output .= '<' . $param['holder'] . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '">' . $value . '</' . $param['holder'] . '>';
                }
            }

            if ( ! empty( $param['admin_label'] ) && true === $param['admin_label'] ) {
                $output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] . ( empty( $value ) ? ' hidden-label' : '' ) . '"><label>' . $param['heading'] . '</label>: ' . $value . '</span>';
            }

            return $output;
        }
        public function getImageSquareSize( $img_id, $img_size ) {
            if ( preg_match_all( '/(\d+)x(\d+)/', $img_size, $sizes ) ) {
                $exact_size = array(
                    'width' => isset( $sizes[1][0] ) ? $sizes[1][0] : '0',
                    'height' => isset( $sizes[2][0] ) ? $sizes[2][0] : '0',
                );
            } else {
                $image_downsize = image_downsize( $img_id, $img_size );
                $exact_size = array(
                    'width' => $image_downsize[1],
                    'height' => $image_downsize[2],
                );
            }
            $exact_size_int_w = (int) $exact_size['width'];
            $exact_size_int_h = (int) $exact_size['height'];
            if ( isset( $exact_size['width'] ) && $exact_size_int_w !== $exact_size_int_h ) {
                $img_size = $exact_size_int_w > $exact_size_int_h
                    ? $exact_size['height'] . 'x' . $exact_size['height']
                    : $exact_size['width'] . 'x' . $exact_size['width'];
            }

            return $img_size;
        }

        protected function outputTitle( $title ) {
            return '';
        }

        protected function outputTitleTrue( $title ) {
            return '<h4 class="wpb_element_title">' . $title . ' ' . $this->settings( 'logo' ) . '</h4>';
        }
    }
}