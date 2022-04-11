<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Blog settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function precise_options_section_maintenance( $sections )
{
    $sections['maintenance'] = array(
        'name' => 'maintenance_panel',
        'title' => esc_html_x('Maintenance', 'admin-view', 'precise'),
        'icon' => 'fa fa-lock',
        'fields' => array(
            array(
                'id'        => 'enable_maintenance',
                'type'      => 'radio',
                'default'   => 'no',
                'class'     => 'la-radio-style',
                'title'     => esc_html_x('Enable Maintenance Mode', 'admin-view', 'precise'),
                'desc'      => esc_html_x('Turn on to make your website to be private', 'admin-view', 'precise'),
                'options'   => array(
                    'no'    => esc_html_x('No', 'admin-view', 'precise'),
                    'yes'   => esc_html_x('Yes', 'admin-view', 'precise')
                )
            ),
            array(
                'id'        => 'maintenance_page',
                'type'      => 'select',
                'title'     => esc_html_x('Maintenance Page', 'admin-view', 'precise'),
                'options'   => 'pages',
                'query_args'    => array(
                    'posts_per_page'  => -1
                ),
                'default_option' => esc_html_x('Select a page', 'admin-view', 'precise'),
                'dependency'   => array( 'enable_maintenance_yes', '==', 'true' )
            )
        )
    );
    return $sections;
}