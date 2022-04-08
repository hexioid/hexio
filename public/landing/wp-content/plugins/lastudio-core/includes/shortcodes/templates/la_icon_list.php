<?php
/**
 * Shortcode attributes
 * @var $el_class
 */

$el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class = $this->getExtraClass($el_class);
$css_class = "clearfix la-lists-icon " . $el_class;
?>
<div class="<?php echo esc_attr($css_class)?>">
    <?php echo wpb_js_remove_wpautop($content);?>
</div>