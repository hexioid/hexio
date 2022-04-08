<?php

$number = $orderby = $order = $hide_empty = $ids = $columns = $el_class = $output = '';

$style = $enable_custom_image_size = $img_size = $enable_carousel = $advanced_opts = $scroll_speed = $autoplay_speed = $custom_nav = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract($atts);

$css_class = 'woocommerce' . $this->getExtraClass($el_class);

if(!empty($ids)){
    $ids = explode( ',', $ids );
    $ids = array_map( 'trim', $ids );
}

$hide_empty = ( $hide_empty == 1 || $hide_empty == true) ? 1 : 0;

$number = absint($number);

// get terms and workaround WP bug with parents/pad counts
$args = array(
    'number'     => $number,
    'taxonomy'   => 'product_cat',
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids,
    'pad_counts' => true
);

if(!empty($ids) && empty($orderby)){
    $args['orderby'] = 'include';
}

$product_categories = get_terms( $args );


if ( $hide_empty ) {
    foreach ( $product_categories as $key => $category ) {
        if ( $category->count == 0 ) {
            unset( $product_categories[ $key ] );
        }
    }
}

if ( $number > 0 ) {
    $product_categories = array_slice( $product_categories, 0, $number );
}

$globalVar      = apply_filters('LaStudio/global_loop_variable', 'lastudio_loop');
$globalVarTmp   = (isset($GLOBALS[$globalVar]) ? $GLOBALS[$globalVar] : '');
$globalParams   = array();

$columns        = LaStudio_Shortcodes_Helper::getColumnFromShortcodeAtts($columns);
$loopCssClass = array();
$loopCssClass[] = 'products';
$loopCssClass[] = 'grid-items';
$loopCssClass[] = 'catalog-grid-' . $style;
$carousel_configs = false;
if($enable_carousel == 'yes'){
    $tmp = array();
    if(!empty($advanced_opts)){
        $tmp = explode(",", $advanced_opts);
    }
    $carousel_configs= array_merge($columns,array(
        'infinite' => in_array('loop', $tmp) ? true : false,
        'dots' => in_array('dot', $tmp) ? true : false,
        'autoplay' => in_array('autoplay', $tmp) ? true : false,
        'arrows' => in_array('nav', $tmp) ? true : false,
        'centerMode' => in_array('center_mode', $tmp) ? true : false,
        'variableWidth' => in_array('variable_width', $tmp) ? true : false,
        'speed' => $scroll_speed,
        'autoplaySpeed' => $autoplay_speed,
        'custom_nav' => $custom_nav
    ));
    $loopCssClass[] = 'la-slick-slider';
}

if($enable_custom_image_size == 'yes' && !empty($img_size)){
    $globalParams['image_size'] = LaStudio_Shortcodes_Helper::getImageSizeFormString($img_size);
}

foreach( $columns as $screen => $value ){
    $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
}

$GLOBALS[$globalVar] = $globalParams;

ob_start();

if ( $product_categories ) {

    echo '<div class="product-categories-wrapper">';
    echo '<ul class="'.esc_attr( implode(' ', $loopCssClass)).'"'. ( $carousel_configs ? ' data-slider_config="'. esc_attr(LaStudio_Shortcodes_Helper::getSliderConfigs($carousel_configs)) .'"' : '' ) .'>';
    foreach ( $product_categories as $category ) {
        wc_get_template( 'content-product_cat.php', array(
            'category' => $category
        ) );
    }
    echo '</ul>';
    echo '</div>';
}

woocommerce_reset_loop();
$GLOBALS[$globalVar] = $globalVarTmp;
echo '<div class="'. esc_attr($css_class) .'">' . ob_get_clean() . '</div>';