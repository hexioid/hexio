<?php

$css_animation = $icon_type = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_monosocial = '';
$icon_image_id = $title = $value = $spacer = $spacer_position = $line_style = $line_width = $line_height = $line_color = '';
$icon_pos = $icon_size = $icon_color = $el_class  = $use_gfont_title = $title_font = $title_fz = $title_lh = $title_color = '';
$use_gfont_value = $value_font = $value_fz = $value_lh = $value_color = $css = '';
$prefix = $suffix = '';

$la_fix_css = array();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract($atts);

$unique_id = uniqid('la-stats-counter-');
$_tmp_class = 'la-stats-counter wpb_content_element';
$_tmp_class .= ' icon-pos-' . $icon_pos;
if($spacer == 'line'){
    $_tmp_class .= ' spacer-position-' . $spacer_position;
}
if(!empty($css_animation) && 'none' != $css_animation){
    $_tmp_class .= ' wpb_animate_when_almost_visible la-animation animated';
}
$class_to_filter = $_tmp_class . vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

vc_icon_element_fonts_enqueue( $icon_type );

$iconCssStyle = array();

$_icon_html = '';

if($icon_type == 'custom'){
    if( $__icon_html = wp_get_attachment_image($icon_image_id, 'full') ) {
        $_icon_html = $__icon_html;
        if(!empty($icon_size)) {
            $iconCssStyle[] = "width:{$icon_size}px";
        }
    }
}else{
    if($icon_pos !== 'none'){
        $iconClass = isset( ${'icon_' . $icon_type} ) ? esc_attr( ${'icon_' . $icon_type} ) : 'fa fa-adjust';
        $_icon_html = '<i class="'.esc_attr($iconClass).'"></i>';
        if(!empty($icon_size)){
            $iconCssStyle[] = "line-height:{$icon_size}px";
            $iconCssStyle[] = "font-size:{$icon_size}px";
        }
        if(!empty($icon_color)){
            $iconCssStyle[] = "color:{$icon_color}";
        }
    }
}

$inner_html = '';
$spacer_html = $icon_html = $value_html = $title_html = '';

if($spacer == 'line'){
    $lineHtmlAtts = '';
    $lineCssInline = array();
    $parentLineCssInline = array();
    $parentLineCssInline[] = "height:{$line_height}px";
    if(!empty($line_width)){
        $lineHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
            'target'		=> "#{$unique_id} .la-line",
            'media_sizes' 	=> array(
                'width' 	=> $line_width,
            )
        ));
        LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
            'target'		=> "#{$unique_id} .la-line",
            'media_sizes' 	=> array(
                'width' 	=> $line_width,
            )
        ));
    }
    $lineCssInline[] = "border-style:{$line_style}";
    $lineCssInline[] = "border-width:{$line_height}px 0 0";
    $lineCssInline[] = "border-color:{$line_color}";
    $spacer_html = sprintf(
        '<div class="la-separator" style="%s"><span class="la-line la-unit-responsive" style="%s" %s></span></div>',
        esc_attr( implode(';', $parentLineCssInline) ),
        esc_attr( implode(';', $lineCssInline) ),
        $lineHtmlAtts
    );
}

if(!empty($_icon_html)){
    $icon_html .= '<div class="box-icon-inner '.($icon_type == 'custom' ? 'type-img' : 'type-icon').'">';
        $icon_html .= '<div class="wrap-icon">';
            $icon_html .= '<div class="box-icon" style="' . esc_attr( implode(';', $iconCssStyle) ) . '">';
                $icon_html .= $_icon_html;
            $icon_html .= '</div>';
        $icon_html .= '</div>';
    $icon_html .= '</div>';
}

if(!empty($title)){
    if(!empty($title_fz) || !empty( $title_lh)){
        $titleHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
            'target' => '#'. $unique_id.' .icon-heading',
            'media_sizes' => array(
                'font-size' => $title_fz,
                'line-height' => $title_lh
            ),
        ));
        LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
            'target' => '#'. $unique_id.' .icon-heading',
            'media_sizes' => array(
                'font-size' => $title_fz,
                'line-height' => $title_lh
            )
        ));
    }else{
        $titleHtmlAtts = '';
    }

    $titleCssInline = array();
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
    $title_html = '<div class="box-heading"><div class="icon-heading la-unit-responsive" style="'. esc_attr( implode(';', $titleCssInline)).'" '.$titleHtmlAtts.'>' . esc_html($title) . '</div></div>';
}
if(!empty($value)){
    $valueHtmlAtts = '';
    if(!empty($value_fz) || !empty( $value_lh)){
        $valueHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
            'target' => '#'. $unique_id.' .icon-value',
            'media_sizes' => array(
                'font-size' => $value_fz,
                'line-height' => $value_lh
            )
        ));
        LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
            'target' => '#'. $unique_id.' .icon-value',
            'media_sizes' => array(
                'font-size' => $value_fz,
                'line-height' => $value_lh
            )
        ));
    }

    $valueHtmlAtts .= ' data-decimal="" data-separator="" data-speed="3"';
    $valueHtmlAtts .= ' data-counter-value="' . esc_attr($value) . '"';
    $valueHtmlAtts .= ' data-value-prefix="' . esc_attr($prefix) . '"';
    $valueHtmlAtts .= ' data-value-suffix="' . esc_attr($suffix) . '"';

    $valueCssInline = array();
    if(!empty($value_color)){
        $valueCssInline[] = "color:{$value_color}";
    }
    if(!empty($use_gfont_value)){
        $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($value_font);
        if(isset($gfont_data['style'])){
            $valueCssInline[] = $gfont_data['style'];
        }
        if(isset($gfont_data['font_url'])){
            wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
        }
    }
    $value_html = '<div class="icon-value la-unit-responsive" style="'. esc_attr( implode(';', $valueCssInline)).'" '.$valueHtmlAtts.'>' . esc_html($value) . '</div>';
}

switch($spacer_position){
    case 'top';
        $value_html = $spacer_html . $value_html;
        break;
    case 'bottom';
        $title_html .= $spacer_html;
        break;
    case 'middle';
        $value_html .= $spacer_html;
        break;
}

?>
<div id="<?php echo esc_attr($unique_id)?>" class="<?php echo esc_attr($css_class);?>" data-animation-class="<?php echo esc_attr($css_animation)?>">
    <div class="element-inner"><?php
        if($icon_pos == 'top' || $icon_pos == 'left'){
            echo '<div class="box-icon-'. esc_attr($icon_pos) .'">' . $icon_html . '</div>';
        }
        echo '<div class="box-icon-des">' . $value_html . $title_html . '</div>';
        if($icon_pos == 'right'){
            echo '<div class="box-icon-right">' . $icon_html . '</div>';
        }
    ?></div>
</div>
<?php LaStudio_Shortcodes_Helper::renderResponsiveMediaStyleTags($la_fix_css); ?>