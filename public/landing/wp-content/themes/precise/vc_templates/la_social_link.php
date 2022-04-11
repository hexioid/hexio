<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$output = $el_class = $style = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$css_class = implode(' ', array(
    'social-media-link',
    'style-' . $style
))  . $this->getExtraClass( $el_class );

$social_links = Precise()->settings->get('social_links', array());
if(!empty($social_links)){
    echo '<div class="'.esc_attr($css_class).'">';
    foreach($social_links as $item){
        if(!empty($item['link']) && !empty($item['icon'])){
            $title = isset($item['title']) ? $item['title'] : '';
            printf(
                '<a href="%1$s" class="%2$s" title="%3$s" target="_blank" rel="nofollow"><i class="%4$s"></i></a>',
                esc_url($item['link']),
                esc_attr(sanitize_title($title)),
                esc_attr($title),
                esc_attr($item['icon'])
            );
        }
    }
    echo '</div>';
}