<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * General settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function precise_options_section_general( $sections ) {
    $sections['general'] = array(
        'name'          => 'general_panel',
        'title'         => esc_html_x('General', 'admin-view', 'precise'),
        'icon'          => 'fa fa-tachometer',
        'sections' => array(
            array(
                'name'      => 'general_sections',
                'title'     => esc_html_x('General', 'admin-view', 'precise'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout',
                        'title'     => esc_html_x('Global Layout', 'admin-view', 'precise'),
                        'type'      => 'image_select',
                        'radio'     => true,
                        'default'   => 'col-1c',
                        'desc'      => esc_html_x('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_main_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'body_boxed',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Enable Layout Boxed', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'body_max_width',
                        'type'      => 'slider',
                        'default'    => 1230,
                        'title'     => esc_html_x( 'Body Max Width', 'admin-view', 'precise' ),
                        'dependency' => array('body_boxed_yes', '==', 'true'),
                        'options'   => array(
                            'step'    => 5,
                            'min'     => 900,
                            'max'     => 2000,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'main_full_width',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('100% Main Width', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Turn on to have the main area display at 100% width according to the window size. Turn off to follow site width.', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'            => 'main_space',
                        'type'          => 'spacing',
                        'title'         => esc_html_x('Custom Main Space', 'admin-view', 'precise'),
                        'desc'          => esc_html_x('Leave empty if you not need', 'admin-view', 'precise'),
                        'unit' 	        => 'px',
                        'default'       => array(
                            'top'       => '70',
                            'bottom'    => '30'
                        )
                    ),
                    array(
                        'id'        => 'google_rich_snippets',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Breadcrumbs Google Rich Snippets', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Turn on to the Google Rich Snippets in the Breadcrumbs.', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'backtotop_btn',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('"Back to top" Button', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Turn on to show "Back to top" button', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'enable_one_time_click',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('One click on the product', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Disable double click when viewing the site on touch-enabled devices', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_opts(false)
                    )
                )
            ),
            array(
                'name'      => 'favicon_sections',
                'title'     => esc_html_x('Custom Favicon', 'admin-view', 'precise'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'favicon',
                        'type'      => 'image',
                        'title'     => esc_html_x('Favicon', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Favicon for your website at 16px x 16px.', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'favicon_iphone',
                        'type'      => 'image',
                        'title'     => esc_html_x('Apple iPhone Icon Upload', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Favicon for Apple iPhone at 57px x 57px.', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'favicon_ipad',
                        'type'      => 'image',
                        'title'     => esc_html_x('Apple iPad Icon Upload', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Favicon for Apple iPad at 72px x 72px.', 'admin-view', 'precise')
                    )
                )
            ),
            array(
                'name'      => 'logo_sections',
                'title'     => esc_html_x('Logo', 'admin-view', 'precise'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'logo',
                        'type'      => 'image',
                        'title'     => esc_html_x('Default Logo', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Select an image file for your logo.', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'logo_2x',
                        'type'      => 'image',
                        'title'     => esc_html_x('Retina Default Logo', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Select an image file for the retina version of the logo. It should be exactly 2x the size of the main logo.', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'logo_transparency',
                        'type'      => 'image',
                        'title'     => esc_html_x('Transparency Header Logo', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Select an image file for your transparency header logo.', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'logo_transparency_2x',
                        'type'      => 'image',
                        'title'     => esc_html_x('Retina Transparency Logo', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Select an image file for the retina version of the logo. It should be exactly 2x the size of the transparency header logo.', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'logo_mobile',
                        'type'      => 'image',
                        'title'     => esc_html_x('Mobile Logo', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Select an image file for your mobile logo.', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'logo_mobile_2x',
                        'type'      => 'image',
                        'title'     => esc_html_x('Retina Mobile Logo', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Select an image file for the retina version of the logo. It should be exactly 2x the size of the mobile logo.', 'admin-view', 'precise')
                    )
                )
            ),
            array(
                'name'      => 'color_sections',
                'title'     => esc_html_x('Colors', 'admin-view', 'precise'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'body_background',
                        'type'      => 'background',
                        'title'     => esc_html_x('Body Background', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'body_boxed_background',
                        'type'      => 'background',
                        'title'     => esc_html_x('Body Boxed Background', 'admin-view', 'precise'),
                        'dependency' => array('body_boxed_yes', '==', 'true'),
                    ),
                    array(
                        'id'        => 'text_color',
                        'default'   => Precise_Options::get_color_default('text_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Text Color', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'heading_color',
                        'default'   => Precise_Options::get_color_default('heading_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Heading Color', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'primary_color',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Primary Color', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'secondary_color',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Secondary Color', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'three_color',
                        'default'   => Precise_Options::get_color_default('three_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Three Color', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'border_color',
                        'default'   => Precise_Options::get_color_default('border_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Border Color', 'admin-view', 'precise')
                    )
                )
            ),
            array(
                'name'      => 'loading_sections',
                'title'     => esc_html_x('Page Preload', 'admin-view', 'precise'),
                'icon'      => 'fa fa-refresh fa-spin',
                'fields'    => array(
                    array(
                        'id'        => 'page_loading_animation',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html_x('Page Preload Animation', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Turn on to show the icon/images loading animation before view site', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_onoff(false)
                    ),
                    array(
                        'id'        => 'page_loading_style',
                        'type'      => 'select',
                        'default'   => '1',
                        'title'     => esc_html_x('Select Preload Style', 'admin-view', 'precise'),
                        'options'   => array(
                            '1'         => esc_html_x('Style 1', 'admin-view', 'precise'),
                            '2'         => esc_html_x('Style 2', 'admin-view', 'precise'),
                            '3'         => esc_html_x('Style 3', 'admin-view', 'precise'),
                            '4'         => esc_html_x('Style 4', 'admin-view', 'precise'),
                            '5'         => esc_html_x('Style 5', 'admin-view', 'precise'),
                            'custom'    => esc_html_x('Custom image', 'admin-view', 'precise')
                        ),
                        'dependency' => array('page_loading_animation_on', '==', 'true'),
                    ),
                    array(
                        'id'        => 'page_loading_background',
                        'type'      => 'background',
                        'title'     => esc_html_x('Page Preload Background', 'admin-view', 'precise'),
                        'dependency' => array('page_loading_animation_on', '==', 'true'),
                    ),
                    array(
                        'id'        => 'page_loading_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Page Preload Color', 'admin-view', 'precise'),
                        'dependency' => array('page_loading_animation_on', '==', 'true'),
                    ),
                    array(
                        'id'        => 'page_loading_custom',
                        'type'      => 'image',
                        'title'     => esc_html_x('Custom Page Loading Image', 'admin-view', 'precise'),
                        'add_title' => esc_html_x('Add Image', 'admin-view', 'precise'),
                        'dependency'=> array('page_loading_animation_on|page_loading_style', '==|==', 'true|custom'),
                    )
                )
            )
        )
    );
    return $sections;
}