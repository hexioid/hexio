<?php

$feed_type = $hashtag = $location_id = $user_id = $sort_by = $limit = $image_size = $el_class = '';
$enable_carousel = $column = $scroll_speed = $advanced_opts = $autoplay_speed = $custom_nav = $output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$unique_id = uniqid('la_instagram_feed');

$loopCssClass = array('la-loop','la-instagram-loop');

$responsive_column = LaStudio_Shortcodes_Helper::getColumnFromShortcodeAtts($column);
if($enable_carousel){
    $advanced_opts = explode(",", $advanced_opts);
    $carousel_configs = array_merge( $responsive_column,array(
        'infinite' => in_array('loop', $advanced_opts) ? true : false,
        'dots' => in_array('dot', $advanced_opts) ? true : false,
        'autoplay' => in_array('autoplay', $advanced_opts) ? true : false,
        'arrows' => in_array('nav', $advanced_opts) ? true : false,
        'centerMode' => in_array('center_mode', $advanced_opts) ? true : false,
        'variableWidth' => in_array('variable_width', $advanced_opts) ? true : false,
        'speed' => $scroll_speed,
        'autoplaySpeed' => $autoplay_speed,
        'custom_nav' => $custom_nav
    ));
    $slider_configs = LaStudio_Shortcodes_Helper::getSliderConfigs($carousel_configs);
}

if($enable_carousel && !empty($slider_configs)){
    $loopCssClass[] = 'la-instagram-slider';
}else{
    $loopCssClass[] = 'grid-items';
    foreach( $responsive_column as $screen => $value ){
        $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
    }
}

wp_enqueue_script('lastudio-instafeed');
?>
<div id="<?php echo $unique_id?>" class="la-instagram-feeds<?php echo $this->getExtraClass( $el_class ); ?>" data-feed_config="<?php echo esc_attr(json_encode(array(
    'get' => $feed_type,
    'tagName' => $hashtag,
    'locationId' => $location_id,
    'userId' => $user_id,
    'sortBy' => $sort_by,
    'limit' => $limit,
    'resolution' => $image_size,
    'template' => '<div class="grid-item"><div class="instagram-item"><a target="_blank" href="{{link}}" title="{{caption}}" style="background-image: url({{image}});" class="thumbnail"><span class="item--overlay"><i class="fa-instagram"></i></span><img src="{{image}}" alt="{{caption}}"></a><div class="instagram-info"><span class="instagram-like"><i class="fa-heart"></i>{{likes}}</span><span class="instagram-comments"><i class="fa-comments"></i>{{comments}}</span></div></div></div>'
)))?>">
    <div class="instagram-feed-inner">
        <div class="<?php echo esc_attr(implode(' ', $loopCssClass)) ?>"<?php
        if($enable_carousel && !empty($slider_configs)){
            echo ' data-slider_config="'. esc_attr( $slider_configs ) .'"';
        }
        ?>>
        </div>
        <div class="la-shortcode-loading"><div class="content"><div class="la-loader spinner3"><div class="dot1"></div><div class="dot2"></div><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div></div>
    </div>
</div>