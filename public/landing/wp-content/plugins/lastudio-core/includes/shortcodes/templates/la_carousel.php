<?php
$slider_type    = $slide_to_scroll = $speed = $infinite_loop = $autoplay = $autoplay_speed = '';
$lazyload       = $arrows = $dots = $dots_icon = $next_icon = $prev_icon = $dots_color = $draggable = $touch_move = '';
$rtl            = $arrow_color = $arrow_size = $arrow_style = $arrow_bg_color = $arrow_border_color = $border_size = $item_space = $el_class = '';
$item_animation = '';
$slides_column = '';
$autowidth = '';
extract( shortcode_atts( array(
    "slides_column"      => "",
    "slider_type"        => "horizontal",
    "slide_to_scroll"    => "all",
    "speed"              => "300",
    "infinite_loop"      => "",
    "autoplay"           => "",
    "autoplay_speed"     => "5000",
    "lazyload"           => "",
    "arrows"             => "",
    "dots"               => "",
    "dots_icon"          => "laslick-record",
    "next_icon"          => "laslick-arrow-right4",
    "prev_icon"          => "laslick-arrow-left4",
    "dots_color"         => "",
    "arrow_color"        => "",
    "arrow_size"         => "20",
    "arrow_style"        => "default",
    "arrow_bg_color"     => "",
    "arrow_border_color" => "",
    "border_size"        => "1.5",
    "draggable"          => "",
    "touch_move"         => "",
    "rtl"                => "",
    "item_space"         => "15",
    "el_class"           => "",
    "item_animation"     => "",
    "adaptive_height"    => "",
    "autowidth"          => "",
    "css_ad_carousel"    => "",
    "pauseohover" 		 => "",
    "centermode" 		 => ""
), $atts ) );


$uid = uniqid( rand() );


$slides_column = LaStudio_Shortcodes_Helper::getColumnFromShortcodeAtts($slides_column);

$settings = $responsive = $infinite = $dot_display = $custom_dots = $arr_style = $wrap_data = $design_style = '';

$desing_style = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css_ad_carousel, ' ' ), 'la_carousel', $atts );

$el_class = LaStudio_Shortcodes_Helper::getExtraClass($el_class);

if ( $slide_to_scroll == 'all' ) {
    $slide_to_scroll = $slides_column['xlg'];
} else {
    $slide_to_scroll = 1;
}

$settings .= 'slidesToShow: '. $slides_column['xlg'] . ',' . "\n";
$settings .= 'slidesToScroll: '. $slide_to_scroll . ',' . "\n";

$arr_style .= 'color:' . $arrow_color . '; font-size:' . $arrow_size . 'px;';
if ( $arrow_style == "circle-bg" || $arrow_style == "square-bg" ) {
    $arr_style .= "background:" . $arrow_bg_color . ";";
} elseif ( $arrow_style == "circle-border" || $arrow_style == "square-border" ) {
    $arr_style .= "border:" . $border_size . "px solid " . $arrow_border_color . ";";
}

if ( $dots == 'yes' ) {
    $settings .= 'dots: true,' . "\n";
} else {
    $settings .= 'dots: false,'. "\n";
}
if ( $autoplay == 'yes' ) {
    $settings .= 'autoplay: true,'. "\n";
}
if ( $autoplay_speed !== '' ) {
    $settings .= 'autoplaySpeed: ' . $autoplay_speed . ',' . "\n";
}
if ( $speed !== '' ) {
    $settings .= 'speed: ' . $speed . ',' . "\n";
}
if ( $infinite_loop == 'yes' ) {
    $settings .= 'infinite: true,' . "\n";
} else {
    $settings .= 'infinite: false,' . "\n";
}
if ( $lazyload == 'yes' ) {
    $settings .= 'lazyLoad: true,' . "\n";
}

if ( is_rtl() ) {
    if ( $arrows == 'yes' ) {
        $settings .= 'arrows: true,' . "\n";
        $settings .= 'nextArrow: \'<button type="button" role="button" aria-label="Next" style="' . esc_attr($arr_style) . '" class="slick-next ' . esc_attr($arrow_style) . '"><i class="' . esc_attr($prev_icon) . '"></i></button>\',' . "\n";
        $settings .= 'prevArrow: \'<button type="button" role="button" aria-label="Previous" style="' . esc_attr($arr_style) . '" class="slick-prev ' . esc_attr($arrow_style) . '"><i class="' . esc_attr($next_icon) . '"></i></button>\',' . "\n";
    } else {
        $settings .= 'arrows: false,' . "\n";
    }
} else {
    if ( $arrows == 'yes' ) {
        $settings .= 'arrows: true,'. "\n";
        $settings .= 'nextArrow: \'<button type="button" role="button" aria-label="Next" style="' . esc_attr($arr_style) . '" class="slick-next ' . esc_attr($arrow_style) . '"><i class="' . esc_attr($next_icon) . '"></i></button>\','. "\n";
        $settings .= 'prevArrow: \'<button type="button" role="button" aria-label="Previous" style="' . esc_attr($arr_style) . '" class="slick-prev ' . esc_attr($arrow_style) . '"><i class="' . esc_attr($prev_icon) . '"></i></button>\','. "\n";
    } else {
        $settings .= 'arrows: false,'. "\n";
    }
}

if ( $draggable == 'yes' ) {
    $settings .= 'swipe: true,'. "\n";
    $settings .= 'draggable: true,'. "\n";
} else {
    $settings .= 'swipe: false,'. "\n";
    $settings .= 'draggable: false,'. "\n";
}

if ( $touch_move == 'yes' ) {
    $settings .= 'touchMove: true,'. "\n";
} else {
    $settings .= 'touchMove: false,'. "\n";
}

if ( $rtl == 'yes' ) {
    $settings .= 'rtl: true,'. "\n";
    $wrap_data = 'dir="rtl"'. "\n";
}

if ( $slider_type == 'vertical' ) {
    $settings .= 'vertical: true,'. "\n";
}

$site_rtl = 'false';
if ( is_rtl() ) {
    $site_rtl = 'true';
}

if ( is_rtl() ) {
    $settings .= 'rtl: true,';
}

if ( $pauseohover == 'yes' ) {
    $settings .= 'pauseOnHover: true,'. "\n";
} else {
    $settings .= 'pauseOnHover: false,'. "\n";
}

if ( $centermode == 'yes' ) {
    $settings .= 'centerMode: true,'. "\n";
    $settings .= 'centerPadding: "0px",'. "\n";
}

if ( $autowidth == 'yes' ) {
    $settings .= 'variableWidth: true,'. "\n";
}

if ( $adaptive_height == 'yes' ) {
    $settings .= 'adaptiveHeight: true,'. "\n";
}

$settings .= 'responsive: [
    {
      breakpoint: 1824,
      settings: {
        slidesToShow: ' . $slides_column['lg'] . ',
        slidesToScroll: ' . $slides_column['lg'] . '
      }
    },
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: ' . $slides_column['md'] . ',
        slidesToScroll: ' . $slides_column['md'] . '
      }
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: ' . $slides_column['sm'] . ',
        slidesToScroll: ' . $slides_column['sm'] . '
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: ' . $slides_column['xs'] . ',
        slidesToScroll: ' . $slides_column['xs'] . '
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: ' . $slides_column['mb'] . ',
        slidesToScroll: ' . $slides_column['mb'] . '
      }
    }
],'. "\n";
$settings .= 'pauseOnDotsHover: true,'. "\n";
if ( $dots_icon !== 'off' && $dots_icon !== '' ) {
    if ( $dots_color !== 'off' && $dots_color !== '' ) {
        $custom_dots = 'style="color:' . esc_attr( $dots_color ) . ';"';
    }
$settings .= 'customPaging: function(slider, i) {
   return \'<i type="button" ' . $custom_dots . ' class="' . esc_attr( $dots_icon ) . '" data-role="none"></i>\';
}';
}

if ( $item_animation == '' ) {
    $item_animation = 'no-animation';
}

$elem_css = 'la-carousel-wrapper la_carousel_' . $slider_type . $desing_style . $el_class;
?>
<div id="la-carousel-<?php echo esc_attr($uid)?>" class="<?php echo esc_attr($elem_css) ?>" data-gutter="<?php echo esc_attr($item_space)?>" data-rtl="<?php echo esc_attr($site_rtl)?>">
    <div class="la-carousel-<?php echo esc_attr($uid)?>" <?php echo $wrap_data ?>>
        <?php
        la_fw_override_shortcodes( $item_space, $item_animation );
        echo wpb_js_remove_wpautop( $content );
        la_fw_restore_shortcodes();
        ?>
    </div>
</div>
<style type="text/css">
    #la-carousel-<?php echo esc_attr($uid)?>{
        margin-left: -<?php echo absint($item_space); ?>px;
        margin-right: -<?php echo absint($item_space); ?>px;
    }
    #la-carousel-<?php echo esc_attr($uid)?> .la-item-wrap.slick-slide{
        margin: 0 <?php echo absint($item_space); ?>px;
    }
</style>
<script type="text/javascript">
jQuery(document).ready(function ($) {
    $('.la-carousel-<?php echo $uid; ?>').slick({
        <?php echo $settings; ?>
    });
});
</script>