<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Header settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function precise_options_section_header( $sections ) {
    $sections['header'] = array(
        'name'          => 'header_panel',
        'title'         => esc_html_x('Header', 'admin-view', 'precise'),
        'icon'          => 'fa fa-arrow-up',
        'sections' => array(
            array(
                'name'      => 'header_layout_sections',
                'title'     => esc_html_x('Layout', 'admin-view', 'precise'),
                'icon'      => 'fa fa-cog',
                'fields'    => array(
                    array(
                        'id'        => 'header_layout',
                        'title'     => esc_html_x('Header Layout', 'admin-view', 'precise'),
                        'type'      => 'image_select',
                        'radio'     => true,
                        'class'     => 'la-radio-style',
                        'default'   => '1',
                        'desc'      => esc_html_x('Controls the general layout of the header.', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_header_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'header_full_width',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('100% Header Width', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Turn on to have the header area display at 100% width according to the window size. Turn off to follow site width.', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_opts(false),
                        'info'      => esc_html_x('This option do not allow for header type 6,7', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'header_transparency',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Header Transparency', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_opts(false),
                        'info'      => esc_html_x('This option do not allow for header type 6,7', 'admin-view', 'precise')
                    )
                )
            ),
            array(
                'name'      => 'header_element_sections',
                'title'     => esc_html_x('Elements', 'admin-view', 'precise'),
                'icon'      => 'fa fa-cog',
                'fields'    => array(
                    array(
                        'id'            => 'store_working_hours',
                        'type'          => 'text',
                        'title'         => esc_html_x('Store working hours', 'admin-view', 'precise')
                    ),
                    array(
                        'id'            => 'store_email',
                        'type'          => 'text',
                        'title'         => esc_html_x('Store Email', 'admin-view', 'precise')
                    ),
                    array(
                        'id'            => 'store_phone',
                        'type'          => 'text',
                        'title'         => esc_html_x('Store Phone', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'header_access_icon',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Access Element', 'admin-view', 'precise'),
                        'button_title'    => esc_html_x('Add Element','admin-view', 'precise'),
                        'accordion_title' => 'type',
                        'max_item'  => 5,
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'precise'),
                                'options'  => array(
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'precise'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'precise'),
                                    'link_text'         => esc_html_x('Text with link', 'admin-view', 'precise'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'precise'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'precise'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'precise'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'precise')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_icon,link_text,dropdown_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_text' )
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'precise'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'precise')
                            )
                        )
                    ),

                    array(
                        'id'        => 'header_show_menu_hamburger',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Header Hamburger Menu', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Show/Hide Hamburger Menu Icon in the Header.', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_opts(false)
                    ),
                    array(
                        'id'        => 'enable_header_top',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Enable Header Top Area?', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Show/Hide Header Top Area in the Header.', 'admin-view', 'precise'),
                        'options'   => array(
                            'no'            => esc_html_x('Hide', 'admin-view', 'precise'),
                            'yes'           => esc_html_x('Yes', 'admin-view', 'precise'),
                            'custom'        => esc_html_x('Use Custom HTML', 'admin-view', 'precise')
                        )
                    ),
                    array(
                        'id'        => 'header_top_elements',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Top Element', 'admin-view', 'precise'),
                        'button_title'    => esc_html_x('Add Element','admin-view', 'precise'),
                        'accordion_title' => 'type',
                        'max_item'  => 10,
                        'dependency'    => array('enable_header_top_yes', '==', true),
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'precise'),
                                'options'  => array(
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'precise'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'precise'),
                                    'link_text'         => esc_html_x('Text with link', 'admin-view', 'precise'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'precise'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'precise'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'precise'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'precise')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_icon,link_text,dropdown_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_text,dropdown_menu')
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'precise'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'precise')
                            )
                        )
                    ),
                    array(
                        'id'        => 'use_custom_header_top',
                        'type'      => 'ace_editor',
                        'mode'      => 'html',
                        'title'     => esc_html_x('Custom HTML For Header Top', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Paste your custom HTML code here.', 'admin-view', 'precise'),
                        'dependency'    => array('enable_header_top_custom', '==', true)
                    )
                )
            ),
            array(
                'name'      => 'header_default_styling_sections',
                'title'     => esc_html_x('Normal Styling', 'admin-view', 'precise'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'header_background',
                        'type'      => 'background',
                        'default'       => array(
                            'color' => '#fff'
                        ),
                        'title'     => esc_html_x('Background', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('for default header', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'header_text_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'title'     => esc_html_x('Text Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'header_link_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'title'     => esc_html_x('Link Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'header_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'mm_lv_1_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'title'     => esc_html_x('Menu Level 1 Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'mm_lv_1_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Menu Level 1 Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_lv_1_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Menu Level 1 Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_lv_1_hover_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Menu Level 1 Hover Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header', 'admin-view', 'precise')
                    ),
                    array(
                        'type'    => 'notice',
                        'class'   => 'no-format la-section-title',
                        'content' => sprintf('<h3>%s</h3>', esc_html_x('Header Top Styling', 'admin-view', 'precise'))
                    ),
                    array(
                        'id'        => 'header_top_background_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Header Top Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header top', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'header_top_text_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(255,255,255,0.2)',
                        'title'     => esc_html_x('Header Top Text Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header top', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'header_top_link_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html_x('Header Top Link Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header top', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'header_top_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Header Top Link Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For default header top', 'admin-view', 'precise'),
                    )
                )
            ),
            array(
                'name'      => 'header_transparency_styling_sections',
                'title'     => esc_html_x('Transparency Styling', 'admin-view', 'precise'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'transparency_header_background',
                        'type'      => 'background',
                        'default'       => array(
                            'color' => 'rgba(0,0,0,0)'
                        ),
                        'title'     => esc_html_x('Background', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'transparency_header_text_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html_x('Text Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'transparency_header_link_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html_x('Link Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'transparency_header_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html_x('Menu Level 1 Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Menu Level 1 Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Menu Level 1 Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'transparency_mm_lv_1_hover_bg_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Menu Level 1 Hover Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header', 'admin-view', 'precise')
                    ),
                    array(
                        'type'    => 'notice',
                        'class'   => 'no-format la-section-title',
                        'content' => sprintf('<h3>%s</h3>', esc_html_x('Transparency Header Top Styling', 'admin-view', 'precise'))
                    ),
                    array(
                        'id'        => 'transparency_header_top_background_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(0,0,0,0)',
                        'title'     => esc_html_x('Header Top Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header top', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'transparency_header_top_text_color',
                        'type'      => 'color_picker',
                        'default'   => 'rgba(255,255,255,0.2)',
                        'title'     => esc_html_x('Header Top Text Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header top', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'transparency_header_top_link_color',
                        'type'      => 'color_picker',
                        'default'   => '#fff',
                        'title'     => esc_html_x('Header Top Link Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header top', 'admin-view', 'precise'),
                    ),
                    array(
                        'id'        => 'transparency_header_top_link_hover_color',
                        'type'      => 'color_picker',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'title'     => esc_html_x('Header Top Link Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For transparency header top', 'admin-view', 'precise'),
                    )
                )
            ),
            array(
                'name'      => 'header_offcanvas_styling_sections',
                'title'     => esc_html_x('Aside Menu Styling', 'admin-view', 'precise'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'offcanvas_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'offcanvas_text_color',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Text color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'offcanvas_heading_color',
                        'default'   => Precise_Options::get_color_default('heading_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Heading color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'offcanvas_link_color',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'offcanvas_link_hover_color',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Aside Header', 'admin-view', 'precise')
                    )
                )
            ),
            array(
                'name'      => 'header_megamenu_styling_sections',
                'title'     => esc_html_x('Mega Menu Styling', 'admin-view', 'precise'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'mm_dropdown_bg',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_color',
                        'default'   => Precise_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_hover_color',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_dropdown_link_hover_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "DropDown"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_bg',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_heading_color',
                        'default'   => Precise_Options::get_color_default('heading_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Heading Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_color',
                        'default'   => Precise_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_hover_color',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mm_wide_dropdown_link_hover_bg',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Link Hover Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For type "Wide"', 'admin-view', 'precise')
                    )
                )
            ),
            array(
                'name'      => 'header_mobile_styling_sections',
                'title'     => esc_html_x('Header Mobile', 'admin-view', 'precise'),
                'icon'      => 'fa fa-paint-brush',
                'fields'    => array(
                    array(
                        'id'        => 'header_mb_layout',
                        'title'     => esc_html_x('Header Mobile Layout', 'admin-view', 'precise'),
                        'type'      => 'image_select',
                        'radio'     => true,
                        'class'     => 'la-radio-style',
                        'attributes'   => array(
                            'data-depend-id' => 'header_mb_layout',
                        ),
                        'default'   => '1',
                        'desc'      => esc_html_x('Controls the general layout of the header on mobile.', 'admin-view', 'precise'),
                        'options'   => array(
                                '1' => Precise::$template_dir_url . '/assets/images/theme_options/header-mobile-1.png',
                                '2' => Precise::$template_dir_url . '/assets/images/theme_options/header-mobile-2.png',
                                '3' => Precise::$template_dir_url . '/assets/images/theme_options/header-mobile-3.png',
                                '4' => Precise::$template_dir_url . '/assets/images/theme_options/header-mobile-4.png'
                        )
                    ),
                    array(
                        'id'        => 'mm_mb_effect',
                        'default'   => '1',
                        'title'     => esc_html_x('Mobile Menu Transition Effect', 'admin-view', 'precise'),
                        'desc'      => '<a target="_blank" href="//tympanus.net/Development/ResponsiveMultiLevelMenu/index.html">'. esc_html_x('See Demo', 'admin-view', 'precise') .'</a>',
                        'type'      => 'select',
                        'options'   => array(
                            '1'        => esc_html_x('Effect 1','admin-view',  'precise'),
                            '2'        => esc_html_x('Effect 2','admin-view',  'precise'),
                            '3'        => esc_html_x('Effect 3','admin-view',  'precise'),
                            '4'        => esc_html_x('Effect 4','admin-view',  'precise'),
                            '5'        => esc_html_x('Effect 5','admin-view',  'precise')
                        )
                    ),
                    array(
                        'id'        => 'header_mb_component_1',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Mobile Icon Component 01', 'admin-view', 'precise'),
                        'button_title'    => esc_html_x('Add Icon Component ','admin-view', 'precise'),
                        'accordion_title' => 'type',
                        'max_item'  => 5,
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'precise'),
                                'options'  => array(
                                    'primary_menu'      => esc_html_x('Toggle Primary Menu', 'admin-view', 'precise'),
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'precise'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'precise'),
                                    'link_text'         => esc_html_x('Text with link', 'admin-view', 'precise'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'precise'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'precise'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'precise'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'precise')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_icon,link_text,dropdown_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_text' )
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'precise'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'precise')
                            )
                        )
                    ),
                    array(
                        'id'        => 'header_mb_component_2',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Mobile Icon Component 02', 'admin-view', 'precise'),
                        'button_title'    => esc_html_x('Add Icon Component ','admin-view', 'precise'),
                        'accordion_title' => 'type',
                        'dependency'    => array('header_mb_layout', 'any', '1,4'),
                        'max_item'  => 5,
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'precise'),
                                'options'  => array(
                                    'primary_menu'      => esc_html_x('Toggle Primary Menu', 'admin-view', 'precise'),
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'precise'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'precise'),
                                    'link_text'         => esc_html_x('Text with link', 'admin-view', 'precise'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'precise'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'precise'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'precise'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'precise')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_icon,link_text,dropdown_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_text' )
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'precise'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'precise')
                            )
                        )
                    ),

                    array(
                        'id'        => 'enable_header_mb_footer_bar',
                        'type'      => 'radio',
                        'default'   => 'no',
                        'class'     => 'la-radio-style',
                        'title'     => esc_html_x('Enable Mobile Footer Bar?', 'admin-view', 'precise'),
                        'options'   => array(
                            'no'            => esc_html_x('Hide', 'admin-view', 'precise'),
                            'yes'           => esc_html_x('Yes', 'admin-view', 'precise')
                        )
                    ),
                    array(
                        'id'        => 'header_mb_footer_bar_component',
                        'type'      => 'group',
                        'wrap_class'=> 'group-disable-clone',
                        'title'     => esc_html_x('Header Mobile Footer Bar Component', 'admin-view', 'precise'),
                        'button_title'    => esc_html_x('Add Icon Component ','admin-view', 'precise'),
                        'dependency'    => array('enable_header_mb_footer_bar_yes', '==', true),
                        'accordion_title' => 'type',
                        'max_item'  => 4,
                        'fields'    => array(
                            array(
                                'id'        => 'type',
                                'type'      => 'select',
                                'title'     => esc_html_x('Type', 'admin-view', 'precise'),
                                'options'  => array(
                                    'dropdown_menu'     => esc_html_x('Dropdown Menu', 'admin-view', 'precise'),
                                    'text'              => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                    'link_icon'         => esc_html_x('Icon with link', 'admin-view', 'precise'),
                                    'search_1'          => esc_html_x('Search box style 01', 'admin-view', 'precise'),
                                    'cart'              => esc_html_x('Cart Icon', 'admin-view', 'precise'),
                                    'wishlist'          => esc_html_x('Wishlist Icon', 'admin-view', 'precise'),
                                    'compare'           => esc_html_x('Compare Icon', 'admin-view', 'precise')
                                )
                            ),
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'default'       => 'fa fa-share',
                                'title'         => esc_html_x('Custom Icon', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_icon,link_text,dropdown_menu' )
                            ),
                            array(
                                'id'            => 'text',
                                'type'          => 'text',
                                'title'         => esc_html_x('Custom Text', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'text,link_text' )
                            ),
                            array(
                                'id'            => 'link',
                                'type'          => 'text',
                                'default'       => '#',
                                'title'         => esc_html_x('Link (URL)', 'admin-view', 'precise'),
                                'dependency'    => array( 'type', 'any', 'link_icon,link_text,cart,wishlist,compare' )
                            ),
                            array(
                                'id'            => 'menu_id',
                                'type'          => 'select',
                                'title'         => esc_html_x('Select the menu','admin-view', 'precise'),
                                'class'         => 'chosen',
                                'options'       => 'tags',
                                'query_args'    => array(
                                    'orderby'   => 'name',
                                    'order'     => 'ASC',
                                    'taxonomies'=>  'nav_menu',
                                    'hide_empty'=> false
                                ),
                                'dependency'    => array( 'type', '==', 'dropdown_menu' )
                            ),
                            array(
                                'id'            => 'el_class',
                                'type'          => 'text',
                                'default'       => '',
                                'title'         => esc_html_x('Extra CSS class for item', 'admin-view', 'precise')
                            )
                        )
                    ),

                    array(
                        'id'        => 'header_mb_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Header', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'header_mb_text_color',
                        'default'   => Precise_Options::get_color_default('body_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Text Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Header', 'admin-view', 'precise')
                    ),
                    array(
                        'type'    => 'notice',
                        'class'   => 'no-format la-section-title',
                        'content' => sprintf('<h3>%s</h3>', esc_html_x('Mobile Menu Styling', 'admin-view', 'precise'))
                    ),
                    array(
                        'id'        => 'mb_background',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mb_lv_1_color',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 1 Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mb_lv_1_bg_color',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 1 Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mb_lv_1_hover_color',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 1 Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mb_lv_1_hover_bg_color',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 1 Hover Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mb_lv_2_color',
                        'default'   => Precise_Options::get_color_default('secondary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 2 Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mb_lv_2_bg_color',
                        'default'   => 'rgba(0,0,0,0)',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 2 Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mb_lv_2_hover_color',
                        'default'   => '#fff',
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 2 Hover Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'mb_lv_2_hover_bg_color',
                        'default'   => Precise_Options::get_color_default('primary_color'),
                        'type'      => 'color_picker',
                        'title'     => esc_html_x('Menu Level 2 Hover Background Color', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('For Mobile Menu', 'admin-view', 'precise')
                    )
                )
            ),
            array(
                'name'      => 'header_extra_sections',
                'title'     => esc_html_x('Extra Setting', 'admin-view', 'precise'),
                'icon'      => 'fa fa-cog',
                'fields'    => array(
                    array(
                        'id'        => 'header_height',
                        'type'      => 'slider',
                        'default'    => '100px',
                        'title'     => esc_html_x( '[Desktop] Header Container Height', 'admin-view', 'precise' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_sticky_height',
                        'type'      => 'slider',
                        'default'    => '80px',
                        'title'     => esc_html_x( '[Desktop] Header Sticky Container Height', 'admin-view', 'precise' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_sm_height',
                        'type'      => 'slider',
                        'default'    => '100px',
                        'title'     => esc_html_x( '[Tablet] Header Container Height', 'admin-view', 'precise' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_sm_sticky_height',
                        'type'      => 'slider',
                        'default'    => '80px',
                        'title'     => esc_html_x( '[Tablet] Header Sticky Container Height', 'admin-view', 'precise' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_mb_height',
                        'type'      => 'slider',
                        'default'    => '70px',
                        'title'     => esc_html_x( '[Mobile] Header Container Height', 'admin-view', 'precise' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    ),
                    array(
                        'id'        => 'header_mb_sticky_height',
                        'type'      => 'slider',
                        'default'    => '70px',
                        'title'     => esc_html_x( '[Mobile] Header Sticky Container Height', 'admin-view', 'precise' ),
                        'options'   => array(
                            'step'    => 1,
                            'min'     => 50,
                            'max'     => 200,
                            'unit'    => 'px'
                        )
                    )
                )
            )
        )
    );
    return $sections;
}