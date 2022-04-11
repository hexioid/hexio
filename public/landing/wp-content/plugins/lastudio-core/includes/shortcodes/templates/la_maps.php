<?php
if (!defined('ABSPATH')){
    die('-1');
}

$width = $height = $map_type = $lat = $lng = $zoom = $streetviewcontrol = $maptypecontrol = $top_margin = '';
$zoomcontrol = $zoomcontrolsize = $dragging = $marker_icon = $icon_img = $icon_img_url = $map_override = $output = '';
$map_style = $scrollwheel = $el_class = $css = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

if(empty($lat) || empty($lng)){
    return;
}

$_tmp_class = 'la-shortcode-maps';
$class_to_filter = $_tmp_class . vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

wp_enqueue_script('googleapis');

$marker_lat = $lat;
$marker_lng = $lng;

$icon_url = LaStudio_Plugin::$plugin_dir_url . 'assets/images/icon-marker.png';
if($marker_icon == "default"){
    $icon_url = '';
}else{
    if(!empty($icon_img_url)){
        $icon_url = $icon_img_url;
    }
    if(!empty($icon_img)){
        if($_icon_img = wp_get_attachment_image_url($icon_img,'full')){
            $icon_url = $_icon_img;
        }
    }
}

$id = uniqid('la_maps_');
$tmp_id = 'wrap_' . $id;
$map_type = strtoupper($map_type);
$map_width = (substr($width, -1)!="%" && substr($width, -2)!="px" ? $width . "px" : $width);
$map_height = (substr($height, -1)!="%" && substr($height, -2)!="px" ? $height . "px" : $height);

$output .= '<div id="'.esc_attr($tmp_id).'" class="'.esc_attr($css_class).'" style="min-height:'.esc_attr($map_height).'">';
$output .= '<div id="'.esc_attr($id).'" class="la-maps-inner" style="'.esc_attr( implode(';', array(
        "width:{$map_width}",
        "height:{$map_height}"
    ))).'">';
$output .= '</div>';
$output .= '</div>';

ob_start();
?><script type='text/javascript'>
    (function($) {
        'use strict';
        $(document).ready(function(){
            try{
                var map_<?php echo esc_attr($id)?> = null;
                var coordinate_<?php echo esc_attr($id)?>;
                var isDraggable = $(document).width() > 641 ? true : <?php echo $dragging;?>;
                coordinate_<?php echo esc_attr($id)?> = new google.maps.LatLng(<?php echo esc_attr($lat)?>,<?php echo esc_attr($lng)?>);
                var mapOptions = {
                    zoom: <?php echo esc_attr($zoom)?>,
                    center: coordinate_<?php echo esc_attr($id)?>,
                    scaleControl: true,
                    streetViewControl: <?php echo esc_attr($streetviewcontrol)?>,
                    mapTypeControl: <?php echo esc_attr($maptypecontrol)?>,
                    zoomControl: <?php echo $zoomcontrol;?>,
                    scrollwheel: <?php echo $scrollwheel == 'disable' ? 'false' : 'true';?>,
                    draggable: isDraggable,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.<?php echo esc_attr($zoomcontrolsize);?>
                    },
                    mapTypeControlOptions:{
                        mapTypeIds: [google.maps.MapTypeId.<?php echo esc_attr($map_type);?>, 'map_style']
                    }
                };
                var styles = <?php if($map_style !== ''){ echo rawurldecode(base64_decode(strip_tags($map_style))); } else{ ?>[{"featureType":"administrative","elementType":"geometry","stylers":[{"saturation":"2"},{"visibility":"simplified"}]},{"featureType":"administrative","elementType":"labels","stylers":[{"saturation":"-28"},{"lightness":"-10"},{"visibility":"on"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"saturation":"-1"},{"lightness":"-12"}]},{"featureType":"landscape.natural","elementType":"labels.text","stylers":[{"lightness":"-31"}]},{"featureType":"landscape.natural","elementType":"labels.text.fill","stylers":[{"lightness":"-74"}]},{"featureType":"landscape.natural","elementType":"labels.text.stroke","stylers":[{"lightness":"65"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry","stylers":[{"lightness":"-15"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"lightness":"0"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"on"},{"saturation":"0"},{"lightness":"-9"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"lightness":"-14"}]},{"featureType":"road","elementType":"labels","stylers":[{"lightness":"-35"},{"gamma":"1"},{"weight":"1.39"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"lightness":"-19"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"lightness":"46"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"lightness":"-13"},{"weight":"1.23"},{"invert_lightness":true},{"visibility":"simplified"},{"hue":"#ff0000"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#adadad"},{"visibility":"on"}]}]<?php }?>;
                var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
                var map_<?php echo esc_attr($id)?> = new google.maps.Map(document.getElementById('<?php echo esc_attr($id)?>'),mapOptions);
                <?php //if($map_style !== ''): ?>
                map_<?php echo esc_attr($id)?>.mapTypes.set('map_style', styledMap);
                map_<?php echo esc_attr($id)?>.setMapTypeId('map_style');
                <?php //endif;?>
                var marker_<?php echo esc_attr($id)?> = new google.maps.Marker({
                    position: new google.maps.LatLng(<?php echo esc_attr($marker_lat)?>,<?php echo $marker_lng?>),
                    animation:  google.maps.Animation.DROP,
                    map: map_<?php echo esc_attr($id)?>,
                    icon: '<?php echo esc_url($icon_url)?>'
                });

                <?php if(trim($content) !== ""){ ?>
                    var infowindow = new google.maps.InfoWindow();
                    infowindow.setContent(atob('<?php echo base64_encode('<div class="map_info_text">'. LaStudio_Shortcodes_Helper::remove_js_autop($content,true) .'</div>')?>'));
                    <?php if($infowindow_open != 'yes'){ ?>
                    infowindow.open(map_<?php echo esc_attr($id)?>,marker_<?php echo esc_attr($id)?>);
                    <?php }?>
                    google.maps.event.addListener(marker_<?php echo esc_attr($id)?>, 'click', function() {
                        infowindow.open(map_<?php echo esc_attr($id)?>,marker_<?php echo esc_attr($id)?>);
                    });
                <?php }?>

                google.maps.event.trigger(map_<?php echo esc_attr($id)?>, 'resize');
                $(window).resize(function(){
                    google.maps.event.trigger(map_<?php echo esc_attr($id)?>, 'resize');
                    if(map_<?php echo esc_attr($id)?>!=null)
                        map_<?php echo esc_attr($id)?>.setCenter(coordinate_<?php echo esc_attr($id)?>);
                });
                $(window).load(function(){
                    setTimeout(function(){
                        $(window).trigger('resize');
                    },200);
                });
            }catch (ex){
                console.log(ex);
            }
        });

    })(jQuery);
</script><?php
$tmp = ob_get_clean();
echo $output . $tmp;