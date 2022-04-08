<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Portfolio settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function precise_options_section_portfolio( $sections )
{
    $sections['portfolio'] = array(
        'name' => 'portfolio_panel',
        'title' => esc_html_x('Portfolio', 'admin-view', 'precise'),
        'icon' => 'fa fa-th',
        'sections' => array(
            array(
                'name'      => 'portfolio_general_section',
                'title'     => esc_html_x('General Setting', 'admin-view', 'precise'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout_archive_portfolio',
                        'type'      => 'image_select',
                        'title'     => esc_html_x('Archive Portfolio Layout', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Controls the layout of archive portfolio page', 'admin-view', 'precise'),
                        'default'   => 'col-1c',
                        'radio'     => true,
                        'options'   => Precise_Options::get_config_main_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'main_full_width_archive_portfolio',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'inherit',
                        'title'     => esc_html_x('100% Main Width', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('[Portfolio] Turn on to have the main area display at 100% width according to the window size. Turn off to follow site width.', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_opts()
                    ),
                    array(
                        'id'            => 'main_space_archive_portfolio',
                        'type'          => 'spacing',
                        'title'         => esc_html_x('Custom Main Space', 'admin-view', 'precise'),
                        'desc'          => esc_html_x('[Portfolio]Leave empty if you not need', 'admin-view', 'precise'),
                        'unit' 	        => 'px'
                    ),
                    array(
                        'id'        => 'portfolio_display_type',
                        'default'   => 'grid',
                        'title'     => esc_html_x('Display Type as', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Controls the type display of portfolio for the archive page', 'admin-view', 'precise'),
                        'type'      => 'select',
                        'options'   => array(
                            'grid'           => esc_html_x('Grid', 'admin-view', 'precise'),
                            'masonry'        => esc_html_x('Masonry', 'admin-view', 'precise')
                        )
                    ),
                    array(
                        'id'        => 'portfolio_item_space',
                        'default'   => '0',
                        'title'     => esc_html_x('Item Padding', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Select gap between item in grids', 'admin-view', 'precise'),
                        'type'      => 'select',
                        'options'   => array(
                            '0'         => esc_html_x('0px', 'admin-view', 'precise'),
                            '5'         => esc_html_x('5px', 'admin-view', 'precise'),
                            '10'        => esc_html_x('10px', 'admin-view', 'precise'),
                            '15'        => esc_html_x('15px', 'admin-view', 'precise'),
                            '20'        => esc_html_x('20px', 'admin-view', 'precise'),
                            '25'        => esc_html_x('25px', 'admin-view', 'precise'),
                            '30'        => esc_html_x('30px', 'admin-view', 'precise'),
                            '35'        => esc_html_x('35px', 'admin-view', 'precise'),
                        )
                    ),
                    array(
                        'id'        => 'portfolio_display_style',
                        'default'   => '1',
                        'title'     => esc_html_x('Select Style', 'admin-view', 'precise'),
                        'type'      => 'select',
                        'options'   => array(
                            '1'           => esc_html_x('Style 01', 'admin-view', 'precise'),
                            '2'           => esc_html_x('Style 02', 'admin-view', 'precise')
                        )
                    ),
                    array(
                        'id'        => 'portfolio_column',
                        'type'      => 'column_responsive',
                        'title'     => esc_html_x('Portfolio Column', 'admin-view', 'precise'),
                        'default'   => array(
                            'xlg' => 3,
                            'lg' => 3,
                            'md' => 2,
                            'sm' => 2,
                            'xs' => 1,
                            'mb' => 1
                        )
                    ),
                    array(
                        'id'        => 'portfolio_per_page',
                        'type'      => 'number',
                        'default'   => 10,
                        'attributes'=> array(
                            'min' => 1,
                            'max' => 100
                        ),
                        'title'     => esc_html_x('Total Portfolio will be display in a page', 'admin-view', 'precise')
                    ),
                    array(
                        'id'        => 'portfolio_thumbnail_size',
                        'type'      => 'text',
                        'default'   => 'full',
                        'title'     => esc_html_x('Portfolio Thumbnail size', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'admin-view', 'precise')
                    )
                )
            ),
            array(
                'name'      => 'single_portfolio_general_section',
                'title'     => esc_html_x('Portfolio Single', 'admin-view', 'precise'),
                'icon'      => 'fa fa-check',
                'fields'    => array(
                    array(
                        'id'        => 'layout_single_portfolio',
                        'type'      => 'image_select',
                        'title'     => esc_html_x('Single Portfolio Layout', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Controls the layout of portfolio detail page', 'admin-view', 'precise'),
                        'default'   => 'col-1c',
                        'radio'     => true,
                        'options'   => Precise_Options::get_config_main_layout_opts(true, false)
                    ),
                    array(
                        'id'        => 'single_portfolio_design',
                        'default'   => '1',
                        'title'     => esc_html_x('Select Design', 'admin-view', 'precise'),
                        'type'      => 'select',
                        'options'   => array(
                            '1'           => esc_html_x('Design 01', 'admin-view', 'precise'),
                            '2'           => esc_html_x('Design 02', 'admin-view', 'precise'),
                            'use_vc'      => esc_html_x('Show only post content', 'admin-view', 'precise')
                        )
                    ),
                    array(
                        'id'        => 'single_portfolio_nextprev',
                        'type'      => 'radio',
                        'class'     => 'la-radio-style',
                        'default'   => 'on',
                        'title'     => esc_html_x('Show Next / Previous Portfolio', 'admin-view', 'precise'),
                        'desc'      => esc_html_x('Turn on to display next/previous portfolio', 'admin-view', 'precise'),
                        'options'   => Precise_Options::get_config_radio_onoff(false)
                    )
                )
            )
        )
    );
    return $sections;
}