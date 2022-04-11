<?php
/**
 * Shortcode attributes
 * @var $style
 * @var $el_class
 */

$style = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );
$el_class = $this->getExtraClass($el_class);
$css_class = "wpb_content_element la-timeline-wrap clearfix style-{$style}" . $el_class;
?>
<div class="<?php echo esc_attr($css_class)?>">
    <div class="timeline-line"><span></span></div>
    <div class="timeline-wrapper">
        <?php echo wpb_js_remove_wpautop($content);?>
    </div>
</div>
