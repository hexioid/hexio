<?php
if (!defined('ABSPATH')){
    die('-1');
}
$la_fix_css = array();
$height = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = "la-divider la-unit-responsive" . $this->getExtraClass($el_class);
$unique_id = uniqid('la_divider');

?>
<div id="<?php echo esc_attr($unique_id)?>" class="<?php echo esc_attr($css_class)?>"<?php
if(!empty($height)){
    $default_style = LaStudio_Shortcodes_Helper::getColumnFromShortcodeAtts($height);
    echo LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
        'target'		=> "#{$unique_id}",
        'media_sizes' 	=> array(
            'padding-top' 	=> $height,
        )
    ));
    LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
        'target'		=> "#{$unique_id}",
        'media_sizes' 	=> array(
            'padding-top' 	=> $height,
        )
    ));
}
?>></div>
<?php LaStudio_Shortcodes_Helper::renderResponsiveMediaStyleTags($la_fix_css); ?>