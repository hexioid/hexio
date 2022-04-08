<?php
/**
 * Shortcode attributes
 * @var $el_class
 */

$icon_type = $icon_fontawesome = $icon_la_icon_outline = $icon = $icon_color = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$iconCssStyle = array();
if(!empty($icon_color)){
    $iconCssStyle[] = 'color:' . $icon_color;
}
if(!empty($icon)){
    if(strpos($icon, 'la-icon') !== false) {
        $icon_type = 'la_icon_outline';
        $icon_la_icon_outline = $icon;
    }
    else{
        $icon_fontawesome = $icon;
    }
}

vc_icon_element_fonts_enqueue( $icon_type );

$iconClass = isset( ${'icon_' . $icon_type} ) ? esc_attr( ${'icon_' . $icon_type} ) : 'fa fa-check';
$_icon_html = '<span style="'. esc_attr( implode(';', $iconCssStyle) ) .'"><i class="'.esc_attr($iconClass).'"></i></span>';

$el_class = $this->getExtraClass($el_class);
$css_class = "la-sc-icon-item " . $el_class;
?>
<div class="<?php echo esc_attr($css_class)?>">
    <?php echo $_icon_html; ?><div><?php echo wpb_js_remove_wpautop($content);?></div>
</div>