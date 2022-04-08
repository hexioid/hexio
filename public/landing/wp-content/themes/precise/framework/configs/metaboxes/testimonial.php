<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}


/**
 * MetaBox
 *
 * @param array $sections An array of our sections.
 * @return array
 */
function precise_metaboxes_section_testimonial( $sections )
{
    $sections['testimonial'] = array(
        'name'      => 'testimonial',
        'title'     => esc_html_x('Information', 'admin-view', 'precise'),
        'icon'      => 'laicon-file',
        'fields'    => array(
            array(
                'id'    => 'role',
                'type'  => 'text',
                'title' => esc_html_x('Role', 'admin-view', 'precise'),
            ),
            array(
                'id'    => 'content',
                'type'  => 'textarea',
                'title' => esc_html_x('Content', 'admin-view', 'precise'),
            ),
            array(
                'id'    => 'avatar',
                'type'  => 'image',
                'title' => esc_html_x('Avatar', 'admin-view', 'precise'),
            ),
            array(
                'id'        => 'rating',
                'type'      => 'slider',
                'default'    => 10,
                'title'     => esc_html_x( 'Rating', 'admin-view', 'precise' ),
                'options'   => array(
                    'step'    => 1,
                    'min'     => 0,
                    'max'     => 10
                )
            )
        )
    );
    return $sections;
}