<?php
$bg_overlay = $bg_overlay_hover = '';
$output = $css_animation = $style = $banner_id = $banner_link = $title = $tag = $el_class = $title_class = $subtitle_class = $use_gfont_title = $title_font = $title_fz = $title_lh = $title_color = $use_gfont_subtitle = $subtitle_font = $subtitle_fz = $subtitle_lh = $subtitle_color = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$heading_html = '';
$subheading_html = '';

$a_href = $a_title = $a_target = '';
$a_attributes = array();

$la_fix_css = array();

extract( $atts );

if(empty($banner_id) || !wp_attachment_is_image($banner_id)){
    return;
}

//parse link
$banner_link = ( '||' === $banner_link ) ? '' : $banner_link;
$banner_link = vc_build_link( $banner_link );

$use_link = false;
if ( strlen( $banner_link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $banner_link['url'];
    $a_title = $banner_link['title'];
    $a_target = $banner_link['target'];
}

if ( $use_link ) {
    $a_attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
    $a_attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
    if ( ! empty( $a_target ) ) {
        $a_attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
    }
    $a_attributes = implode( ' ', $a_attributes );
}

$unique_id = uniqid('la_banner_box_');
$_tmp_class = array(
    'wpb_content_element',
    'la-banner-box',
    'banner-type-' . $style
);

if(!empty($css_animation) && 'none' != $css_animation){
    $_tmp_class[] = 'wpb_animate_when_almost_visible la-animation animated';
}

$title_class = 'heading-tag la-unit-responsive' . $this->getExtraClass($title_class);
$subtitle_class = 'subheading-tag la-unit-responsive' . $this->getExtraClass($subtitle_class);
$css_class = implode(' ', $_tmp_class) . $this->getExtraClass( $el_class );

if(!empty($title)){
    $titleHtmlAtts = '';
    $titleCssInline = array();
    if(!empty($title_fz) || !empty( $title_lh)){
        $titleHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
            'target' => '#'. $unique_id.' .heading-tag',
            'media_sizes' => array(
                'font-size' => $title_fz,
                'line-height' => $title_lh
            ),
        ));
        LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
            'target' => '#'. $unique_id.' .heading-tag',
            'media_sizes' => array(
                'font-size' => $title_fz,
                'line-height' => $title_lh
            ),
        ));
    }
    if(!empty($title_color)){
        $titleCssInline[] = "color:{$title_color}";
    }
    if(!empty($use_gfont_title)){
        $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($title_font);
        if(isset($gfont_data['style'])){
            $titleCssInline[] = $gfont_data['style'];
        }
        if(isset($gfont_data['font_url'])){
            wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
        }
    }
    $heading_html = sprintf(
        '<%1$s class="%2$s" style="%3$s" %4$s>%5$s</%1$s>',
        $tag,
        $title_class,
        esc_attr( implode(';', $titleCssInline) ),
        $titleHtmlAtts,
        esc_html($title)
    );
}

if(!empty($content)){
    $subtitleHtmlAtts = '';
    $subtitleCssInline = array();
    if(!empty($subtitle_fz) || !empty( $subtitle_lh)){
        $subtitleHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
            'target' => '#'. $unique_id.' .subheading-tag',
            'media_sizes' => array(
                'font-size' => $subtitle_fz,
                'line-height' => $subtitle_lh
            ),
        ));
        LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
            'target' => '#'. $unique_id.' .subheading-tag',
            'media_sizes' => array(
                'font-size' => $subtitle_fz,
                'line-height' => $subtitle_lh
            ),
        ));
    }
    if(!empty($subtitle_color)){
        $subtitleCssInline[] = "color:{$subtitle_color}";
    }
    if(!empty($use_gfont_subtitle)){
        $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($subtitle_font);
        if(isset($gfont_data['style'])){
            $subtitleCssInline[] = $gfont_data['style'];
        }
        if(isset($gfont_data['font_url'])){
            wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
        }
    }
    $subheading_html = sprintf(
        '<div class="%1$s" style="%2$s" %3$s>%4$s</div>',
        $subtitle_class,
        esc_attr( implode(';', $subtitleCssInline) ),
        $subtitleHtmlAtts,
        wpb_js_remove_wpautop($content, false)
    );
}

?>
<div id="<?php echo esc_attr($unique_id)?>" class="<?php echo esc_attr($css_class);?>" data-animation-class="<?php echo esc_attr($css_animation)?>">
    <div class="box-inner">
        <div class="banner--image"><?php echo wp_get_attachment_image($banner_id,'full'); ?><span class="item--overlay"></span></div>
        <div class="banner--info"><?php echo $heading_html . $subheading_html ?></div>
        <?php if($use_link): ?>
            <a class="banner--link-overlay" <?php echo $a_attributes; ?>><?php echo esc_html($a_title) ?></a>
        <?php else: ?>
            <div class="banner--link-overlay"></div>
        <?php endif; ?>
    </div>
</div>
<?php if(!empty($bg_overlay) || !empty($bg_overlay_hover)): ?>
<style type="text/css">
#<?php echo esc_attr($unique_id)?> .item--overlay{
    background-color: <?php echo esc_attr($bg_overlay); ?>;
}
#<?php echo esc_attr($unique_id);?>:hover .item--overlay{
   background-color: <?php echo esc_attr($bg_overlay_hover); ?>;
}
</style>
<?php endif;?>
<?php LaStudio_Shortcodes_Helper::renderResponsiveMediaStyleTags($la_fix_css); ?>