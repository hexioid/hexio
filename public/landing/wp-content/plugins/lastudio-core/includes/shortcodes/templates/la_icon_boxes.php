<?php
if (!defined('ABSPATH')){
    die('-1');
}

$la_fix_css = array();
$icon_type = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_monosocial = $icon_image_id = $title = '';
$icon_pos = $icon_style = $icon_size = $icon_width = $icon_color = $icon_bg = $icon_border_style = $icon_border_width = $icon_border_color = $icon_border_radius = $el_class = $css = '';
$icon_padding = '';
$css_animation = '';
$output = '';
$title_class = $desc_class = '';

$use_gfont_title = $title_font = $title_fz = $title_lh = $title_color = '';
$use_gfont_desc = $desc_font = $desc_fz = $desc_lh = $desc_color = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$unique_id = uniqid('la-icon-boxes-');
$_tmp_class = 'la-sc-icon-boxes wpb_content_element';
if($icon_type == 'custom'){
    $_tmp_class .= ' icon-type-img';
}else{
    $_tmp_class .= ' icon-type-normal';
}

$_tmp_class .= " icon-pos-{$icon_pos}";
$_tmp_class .= " icon-style-{$icon_style}";


if(!empty($css_animation) && 'none' != $css_animation){
    $_tmp_class .= ' wpb_animate_when_almost_visible la-animation animated';
}

$title_class = 'la-unit-responsive icon-heading' . $this->getExtraClass($title_class);
$desc_class = 'la-unit-responsive box-description' . $this->getExtraClass($desc_class);
$class_to_filter = $_tmp_class . vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

vc_icon_element_fonts_enqueue( $icon_type );

if($icon_style == 'simple'){
    $icon_width = null;
}

$wapIconCssStyle = $iconCssStyle = array();
if(!empty($icon_size)){
    $iconCssStyle[] = "line-height:{$icon_size}px";
    $iconCssStyle[] = "font-size:{$icon_size}px";
    if(!empty($icon_width)){
        $iconCssStyle[] = "width:{$icon_width}px";
        $iconCssStyle[] = "height:{$icon_width}px";
    }else{
        $iconCssStyle[] = "width:{$icon_size}px";
        $iconCssStyle[] = "height:{$icon_size}px";
    }
}
if(!empty($icon_width)){
    $__padding_tmp = intval(($icon_width - $icon_size) / 2);
    $iconCssStyle[] = "padding:{$__padding_tmp}px";
}
if($icon_style != 'simple' && !empty($icon_bg)){
    $iconCssStyle[] = "background-color:{$icon_bg}";
}
if($icon_style == 'advanced'){
    $wapIconCssStyle[] = "border-radius:{$icon_border_radius}px";
    $iconCssStyle[] = "border-radius:{$icon_border_radius}px";
    if(!empty($icon_padding)){
        $wapIconCssStyle[] = "padding:" . intval($icon_padding) . 'px';
    }
}
if(!empty($icon_color)){
    $wapIconCssStyle[] = "color:{$icon_color}";
    $iconCssStyle[] = "color:{$icon_color}";
}
if(!empty($icon_border_style)){
    $wapIconCssStyle[] = "border-style:{$icon_border_style}";
    $wapIconCssStyle[] = "border-width:{$icon_border_width}px";
    $wapIconCssStyle[] = "border-color:{$icon_border_color}";
}

$_icon_html = '';
if($icon_type == 'custom'){
    if( $__icon_html = wp_get_attachment_image($icon_image_id, 'full') ) {
        $_icon_html = '<span style="'. esc_attr( implode(';', $iconCssStyle) ) .'">' . $__icon_html . '</span>';
    }
}else{
    $iconClass = isset( ${'icon_' . $icon_type} ) ? esc_attr( ${'icon_' . $icon_type} ) : 'fa fa-adjust';
    $_icon_html = '<span style="'. esc_attr( implode(';', $iconCssStyle) ) .'"><i class="'.esc_attr($iconClass).'"></i></span>';
}

$inner_html = '';
$icon_html = $box_heading_html = $box_content_html = '';

if(!empty($_icon_html)){
    $icon_html .= '<div class="box-icon-inner '.($icon_type == 'custom' ? 'type-img' : 'type-icon').'">';
        $icon_html .= '<div class="wrap-icon">';
            $icon_html .= '<div class="box-icon box-icon-style-'. $icon_style .'" style="'.esc_attr( implode(';', $wapIconCssStyle) ).'">';
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
            ),
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
    $box_heading_html = '<div class="box-heading"><h5 class="'.esc_attr($title_class).'" style="'. esc_attr( implode(';', $titleCssInline)).'" '.$titleHtmlAtts.'>' . esc_html($title) . '</h5></div>';
}
if(!empty($content)){
    if(!empty($desc_fz) || !empty( $desc_lh)){
        $descHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
            'target' => '#'. $unique_id.' .box-description',
            'media_sizes' => array(
                'font-size' => $desc_fz,
                'line-height' => $desc_lh
            ),
        ));
        LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
            'target' => '#'. $unique_id.' .box-description',
            'media_sizes' => array(
                'font-size' => $desc_fz,
                'line-height' => $desc_lh
            ),
        ));
    }else{
        $descHtmlAtts = '';
    }

    $descCssInline = array();
    if(!empty($desc_color)){
        $descCssInline[] = "color:{$desc_color}";
    }
    if(!empty($use_gfont_title)){
        $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($desc_font);
        if(isset($gfont_data['style'])){
            $descCssInline[] = $gfont_data['style'];
        }
        if(isset($gfont_data['font_url'])){
            wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
        }
    }
    $box_content_html = '<div class="'.esc_html($desc_class).'" style="'. esc_attr( implode(';', $descCssInline)).'" '.$descHtmlAtts.'>' . LaStudio_Shortcodes_Helper::remove_js_autop($content, true) . '</div>';
}

switch($icon_pos){
    case 'top':
        $inner_html .= '<div class="box-icon-top">';
            $inner_html .= $icon_html;
        $inner_html .= '</div>';
        $inner_html .= '<div class="box-contents">';
            $inner_html .= $box_heading_html . $box_content_html;
        $inner_html .= '</div>';
        break;
    case 'left':
        $inner_html .= '<div class="box-icon-left">';
            $inner_html .= $icon_html;
        $inner_html .= '</div>';
        $inner_html .= '<div class="box-contents">';
            $inner_html .= $box_heading_html . $box_content_html;
        $inner_html .= '</div>';
        break;
    case 'right':
        $inner_html .= '<div class="box-contents">';
            $inner_html .= $box_heading_html . $box_content_html;
        $inner_html .= '</div>';
        $inner_html .= '<div class="box-icon-right">';
            $inner_html .= $icon_html;
        $inner_html .= '</div>';
        break;
    case 'heading-right':
        $inner_html .= '<div class="box-heading-top">';
            $inner_html .= $box_heading_html;
            $inner_html .= '<div class="box-icon-heading">';
                $inner_html .= $icon_html;
            $inner_html .= '</div>';
        $inner_html .= '</div>';
        $inner_html .= '<div class="box-contents">';
            $inner_html .= $box_content_html;
        $inner_html .= '</div>';
        break;
    default:
        $inner_html .= '<div class="box-heading-top">';
            $inner_html .= '<div class="box-icon-heading">';
                $inner_html .= $icon_html;
            $inner_html .= '</div>';
            $inner_html .= $box_heading_html;
        $inner_html .= '</div>';
        $inner_html .= '<div class="box-contents">';
            $inner_html .= $box_content_html;
        $inner_html .= '</div>';

}

?>
<div id="<?php echo esc_attr($unique_id)?>" class="<?php echo esc_attr($css_class)?>" data-animation-class="<?php echo esc_attr($css_animation)?>">
    <div class="icon-boxes-inner"><?php echo $inner_html;?></div>
</div>
<?php LaStudio_Shortcodes_Helper::renderResponsiveMediaStyleTags($la_fix_css); ?>