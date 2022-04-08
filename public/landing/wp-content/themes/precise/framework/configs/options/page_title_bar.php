<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Page title bar settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function precise_options_section_page_title_bar( $sections ) {

    $page_title_layout = array(
        'hide' => esc_html_x("Don't show", 'admin-view', 'precise')
    );
    $page_title_layout = $page_title_layout + Precise_Options::get_config_page_title_bar_opts(false);

    $desc1 = esc_html_x('For page title bar', 'admin-view', 'precise');
    $desc2 = esc_html_x('For page title bar of WooCommerce', 'admin-view', 'precise');

    $sections['page_title_bar'] = array(
        'name'          => 'page_title_bar_panel',
        'title'         => esc_html_x('Page Title Bar', 'admin-view', 'precise'),
        'icon'          => 'fa fa-sliders',
        'sections' => array(
            array(
                'name'      => 'page_title_bar_sections',
                'title'     => esc_html_x('Global Page Title', 'admin-view', 'precise'),
                'icon'      => 'fa fa-plus',
                'fields'    => array(
                    array(
                        'id'            => 'page_title_bar_layout',
                        'type'          => 'select',
                        'class'         => 'chosen',
                        'title'         => esc_html_x('Select Layout', 'admin-view', 'precise'),
                        'desc'          => $desc1,
                        'options'       => $page_title_layout
                    ),
                    array(
                        'id'        => 'page_title_bar_background',
                        'type'      => 'background',
                        'title'     => esc_html_x('Background', 'admin-view', 'precise'),
                        'desc'      => $desc1
                    ),
                    array(
                        'id'        => 'page_title_bar_heading_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('heading_color'),
                        'title'     => esc_html_x('Heading Color', 'admin-view', 'precise'),
                        'desc'      => $desc1
                    ),
                    array(
                        'id'        => 'page_title_bar_text_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('body_color'),
                        'title'     => esc_html_x('Text Color', 'admin-view', 'precise'),
                        'desc'      => $desc1
                    ),
                    array(
                        'id'        => 'page_title_bar_link_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('body_color'),
                        'title'     => esc_html_x('Link Color', 'admin-view', 'precise'),
                        'desc'      => $desc1
                    ),
                    array(
                        'id'        => 'page_title_bar_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'precise'),
                        'desc'      => $desc1
                    ),
                    array(
                        'id'        => 'page_title_bar_spacing',
                        'type'      => 'spacing',
                        'title'     => esc_html_x('Spacing', 'admin-view', 'precise'),
                        'desc'      => $desc1,
                        'unit' 	    => 'px',
                        'default'   => array(
                            'top' => 40,
                            'bottom' => 40
                        )
                    ),
                    array(
                        'id'        => 'page_title_bar_spacing_tablet',
                        'type'      => 'spacing',
                        'title'     => esc_html_x('Spacing', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For page title bar on Tablet', 'admin-view', 'precise'),
                        'unit' 	    => 'px',
                        'default'   => array(
                            'top' => 25,
                            'bottom' => 25
                        )
                    ),
                    array(
                        'id'        => 'page_title_bar_spacing_mobile',
                        'type'      => 'spacing',
                        'title'     => esc_html_x('Spacing', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For page title bar on Mobile', 'admin-view', 'precise'),
                        'unit' 	    => 'px',
                        'default'   => array(
                            'top' => 25,
                            'bottom' => 25
                        )
                    )
                )
            ),
            array(
                'name'      => 'page_title_bar_woo_sections',
                'title'     => esc_html_x('WooCommerce Page Title Bar', 'admin-view', 'precise'),
                'fields'    => array(
                    array(
                        'id'        => 'woo_override_page_title_bar',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'off',
                        'title'     => esc_html_x('Enable Override', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Turn on to override all setting page title bar of WooCommerce Settings ( Shop page/Product details/Product Category/ Product tags and search page )', 'admin-view', 'precise'),
                        'info'      => esc_html_x('This option will not work with these pages were overwritten', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_onoff(false)
                    ),
                    array(
                        'id'            => 'woo_page_title_bar_layout',
                        'type'          => 'select',
                        'class'         => 'chosen',
                        'title'         => esc_html_x('WooCommerce Page Title Bar Layout', 'admin-view', 'precise'),
                        'options'       => $page_title_layout,
                        'dependency'    => array('woo_override_page_title_bar_on', '==', 'true')
                    ),
                    array(
                        'id'        => 'woo_page_title_bar_background',
                        'type'      => 'background',
                        'title'     => esc_html_x('Background', 'admin-view', 'precise'),
                        'dependency'=> array('woo_override_page_title_bar_on|woo_page_title_bar_layout', '==|!=', 'true|hide'),
                        'desc'      => $desc2
                    ),
                    array(
                        'id'        => 'woo_page_title_bar_heading_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('header_color'),
                        'title'     => esc_html_x('Heading Color', 'admin-view', 'precise'),
                        'dependency'=> array('woo_override_page_title_bar_on|woo_page_title_bar_layout', '==|!=', 'true|hide'),
                        'desc'      => $desc2
                    ),
                    array(
                        'id'        => 'woo_page_title_bar_text_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('body_color'),
                        'title'     => esc_html_x('Text Color', 'admin-view', 'precise'),
                        'dependency'=> array('woo_override_page_title_bar_on|woo_page_title_bar_layout', '==|!=', 'true|hide'),
                        'desc'      => $desc2
                    ),
                    array(
                        'id'        => 'woo_page_title_bar_link_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('body_color'),
                        'title'     => esc_html_x('Link Color', 'admin-view', 'precise'),
                        'dependency'=> array('woo_override_page_title_bar_on|woo_page_title_bar_layout', '==|!=', 'true|hide'),
                        'desc'      => $desc2
                    ),
                    array(
                        'id'        => 'woo_page_title_bar_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'precise'),
                        'dependency'=> array('woo_override_page_title_bar_on|woo_page_title_bar_layout', '==|!=', 'true|hide'),
                        'desc'      => $desc2
                    ),
                    array(
                        'id'        => 'woo_page_title_bar_spacing',
                        'type'      => 'spacing',
                        'title'     => esc_html_x('Spacing', 'admin-view', 'precise'),
                        'dependency'=> array('woo_override_page_title_bar_on|woo_page_title_bar_layout', '==|!=', 'true|hide'),
                        'desc'      => $desc2,
                        'unit' 	    => 'px',
                        'default'   => array(
                            'top' => 40,
                            'bottom' => 40
                        )
                    ),
                    array(
                        'id'        => 'woo_page_title_bar_spacing_tablet',
                        'type'      => 'spacing',
                        'title'     => esc_html_x('Spacing', 'admin-view', 'precise'),
                        'dependency'=> array('woo_override_page_title_bar_on|woo_page_title_bar_layout', '==|!=', 'true|hide'),
                        'desc'      => esc_html_x('For page title bar of WooCommerce on Tablet', 'admin-view', 'precise'),
                        'unit' 	    => 'px',
                        'default'   => array(
                            'top' => 25,
                            'bottom' => 25
                        )
                    ),
                    array(
                        'id'        => 'woo_page_title_bar_spacing_mobile',
                        'type'      => 'spacing',
                        'title'     => esc_html_x('Spacing', 'admin-view', 'precise'),
                        'dependency'=> array('woo_override_page_title_bar_on|woo_page_title_bar_layout', '==|!=', 'true|hide'),
                        'desc'      => esc_html_x('For page title bar of WooCommerce on Mobile', 'admin-view', 'precise'),
                        'unit' 	    => 'px',
                        'default'   => array(
                            'top' => 25,
                            'bottom' => 25
                        )
                    )
                )
            )
        )
    );
    return $sections;
}