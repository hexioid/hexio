<?php

require_once(__DIR__.'/../vc-shortcodes.inc.arrays.php');


/**

||-> Shortcode: Members Slider

*/

function mt_shortcode_members02($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                 => '',
            'number'                    => '',
            'navigation'                => 'false',
            'pagination'                => 'false',
            'autoPlay'                  => 'false',
            'heading_color'             => '',
            'text_color'                => '',
            'details_background'        => '',
            'border_color'              => '',
            'paginationSpeed'           => '700',
            'slideSpeed'                => '700',
            'number_desktop'            => '4',
            'number_tablets'            => '2',
            'number_mobile'             => '1'
        ), $params ) );


    $html = '';


    // CLASSES
    $class_slider = 'mt_slider_members_'.uniqid();

    $html .= '<script>
                jQuery(document).ready( function() {
                    jQuery(".'.$class_slider.'").owlCarousel({
                        navigation      : '.$navigation.', // Show next and prev buttons
                        pagination      : '.$pagination.',
                        autoPlay        : '.$autoPlay.',
                        slideSpeed      : '.$paginationSpeed.',
                        paginationSpeed : '.$slideSpeed.',
                        navigationText  : ["<i class=\"fa fa-chevron-circle-left\"></i>","<i class=\"fa fa-chevron-circle-right\"></i>"],
                        autoWidth: true,
                        itemsCustom : [
                            [0,     '.$number_mobile.'],
                            [450,   '.$number_mobile.'],
                            [600,   '.$number_desktop.'],
                            [700,   '.$number_tablets.'],
                            [1000,  '.$number_tablets.'],
                            [1200,  '.$number_desktop.'],
                            [1400,  '.$number_desktop.'],
                            [1600,  '.$number_desktop.']
                        ]
                    });
                    
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item:nth-child(2)").addClass("hover_class");
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item").hover(
                  function () {
                    jQuery(".'.$class_slider.' .owl-wrapper .owl-item").removeClass("hover_class");
                    jQuery(this).addClass("hover_class");
                  }
                );


                });
              </script>';
      
        $html .= '<div class="mt_members2 '.$class_slider.' owl-carousel row owl-theme animateIn wow '.$animation.'">';
        $args_members = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'member',
                'post_status'      => 'publish' 
                ); 
        $members = get_posts($args_members);
            foreach ($members as $member) {
                #metaboxes
                $metabox_member_position = get_post_meta( $member->ID, 'smartowl_member_position', true );
                $metabox_member_email = get_post_meta( $member->ID, 'smartowl_member_email', true );
                $metabox_member_phone = get_post_meta( $member->ID, 'smartowl_member_phone', true );
                $member_title = get_the_title( $member->ID );

                $testimonial_id = $member->ID;
                $content_post   = get_post($member);
                $content        = $content_post->post_content;
                $content = wpautop( $content_post->post_content );
                $content        = apply_filters('the_content', $content);
                $content        = str_replace(']]>', ']]&gt;', $content);
                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $member->ID ),'full' );
                $button_link = get_permalink( $member->ID );
                
                $html.='
                    <div class="item alone_member col-md-12 relative">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="members_img_holder">
                                <a href="'.$button_link.'">
                                    <div class="memeber02-img-holder">
                                    <div class="slide_info" style="background:'.$details_background.'; border-bottom-color:'.$border_color.';">
                                        <h3 style="color:'.$heading_color.';" class="member02_name">'.$member_title.'</h3>
                                        <p style="color:'.$text_color.';" class="member02_position">'.$metabox_member_position.'</p>
                                    </div>
                                    <div class="hover_background"></div>';
                                        if($thumbnail_src) { 
                                            $html .= '<img src="'. $thumbnail_src[0] . '" alt="'. $member->post_title .'" />';
                                        }else{ 
                                            $html .= '<img src="http://placehold.it/600x600" alt="'. $member->post_title .'" />'; 
                                        }
                                    $html.='</div>
                            
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>';

            }
    $html .= '</div>';
    return $html;
}
add_shortcode('mt_members_slider_v2', 'mt_shortcode_members02');





/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    
    vc_map( array(
        "name" => esc_attr__("MT - Members Slider Version 2", 'modeltheme'),
        "base" => "mt_members_slider_v2",
        "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
        "icon" => "smartowl_shortcode",
        "params" => array(
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Number of members", 'modeltheme' ),
                "param_name" => "number",
                "value" => "",
                "description" => esc_attr__( "Enter number of members to show.", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type"         => "dropdown",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "navigation",
                "std"          => '',
                "heading"      => esc_attr__("Navigation", 'modeltheme'),
                "description"  => "",
                "value"        => array(
                    esc_attr__('Disabled', 'modeltheme') => 'false',
                    esc_attr__('Enabled', 'modeltheme')    => 'true',
                )
            ),
            array(
                "group" => "Slider Options",
                "type"         => "dropdown",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "pagination",
                "std"          => '',
                "heading"      => esc_attr__("Pagination", 'modeltheme'),
                "description"  => "",
                "value"        => array(
                    esc_attr__('Disabled', 'modeltheme') => 'false',
                    esc_attr__('Enabled', 'modeltheme')    => 'true',
                )
            ),
            array(
                "group" => "Slider Options",
                "type"         => "dropdown",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "autoPlay",
                "std"          => '',
                "heading"      => esc_attr__("Auto Play", 'modeltheme'),
                "description"  => "",
                "value"        => array(
                    esc_attr__('Disabled', 'modeltheme') => 'false',
                    esc_attr__('Enabled', 'modeltheme')    => 'true',
                )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Pagination Speed", 'modeltheme' ),
                "param_name" => "paginationSpeed",
                "value" => "",
                "description" => esc_attr__( "Pagination Speed(Default: 700)", 'modeltheme' )
            ),
            array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Position Color", 'modeltheme' ),
                  "param_name" => "text_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose the color for position.", 'modeltheme' )
            ),
            array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Name Color", 'modeltheme' ),
                  "param_name" => "heading_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose the color for name.", 'modeltheme' )
            ),
            array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Details container background", 'modeltheme' ),
                  "param_name" => "details_background",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose the background for position.", 'modeltheme' )
            ),
            array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Details container border color", 'modeltheme' ),
                  "param_name" => "border_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose the details container border color.", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Slide Speed", 'modeltheme' ),
                "param_name" => "slideSpeed",
                "value" => "",
                "description" => esc_attr__( "Slide Speed(Default: 700)", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Items for Desktops", 'modeltheme' ),
                "param_name" => "number_desktop",
                "value" => "",
                "description" => esc_attr__( "Default - 4", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Items for Tablets", 'modeltheme' ),
                "param_name" => "number_tablets",
                "value" => "",
                "description" => esc_attr__( "Default - 2", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Items for Mobile", 'modeltheme' ),
                "param_name" => "number_mobile",
                "value" => "",
                "description" => esc_attr__( "Default - 1", 'modeltheme' )
            ),
            array(
                "group" => "Animation",
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => '',
                "holder" => "div",
                "class" => "",
                "description" => "",
                "value" => $animations_list
            )
        )
    ));
}

?>