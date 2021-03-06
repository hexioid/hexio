<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * Additional code settings
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function precise_options_section_404( $sections )
{
    $sections['section_404'] = array(
        'name'          => '404_panel',
        'title'         => esc_html_x('404 Page', 'admin-view', 'precise'),
        'icon'          => 'fa fa-file-o',
        'fields'        => array(
            array(
                'id'    => '404_page_content',
                'type'  => 'wp_editor',
                'desc'  => esc_html_x('Leaving empty content to inherit from theme', 'admin-view', 'precise'),
                'title' => esc_html_x('Custom 404 Page Content', 'admin-view', 'precise'),
            )
        )
    );
    return $sections;
}