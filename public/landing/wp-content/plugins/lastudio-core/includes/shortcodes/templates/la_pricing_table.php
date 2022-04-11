<?php
if (!defined('ABSPATH')){
    die('-1');
}

$la_fix_css = array();
$css_animation = $style = $icon_type = $icon_fontawesome = $icon_la_icon_outline = $icon_image_id = $package_title = $package_price = $price_unit = $features = $desc_before = $desc_after = $button_text = $button_link = $package_featured = $el_class = $main_bg_color = $main_text_color = $highlight_color = $icon_fz = $icon_lh = $icon_color = $use_gfont_package_title = $package_title_font = $package_title_fz = $package_title_lh = $package_title_color = $use_gfont_package_price = $package_price_font = $package_price_fz = $package_price_lh = $package_price_color = $use_gfont_package_price_unit = $package_price_unit_font = $package_price_unit_fz = $package_price_unit_lh = $package_price_unit_color = $use_gfont_package_desc = $package_desc_font = $package_desc_fz = $package_desc_lh = $package_desc_color = $use_gfont_package_featured = $package_featured_font = $package_featured_fz = $package_featured_lh = $package_featured_color = $use_gfont_package_button = $package_button_font = $package_button_fz = $package_button_lh = $package_button_color = '';
$custom_badge = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$unique_id = uniqid('la_pricing_table_');
$features = json_decode(urldecode($features),true);

$css_class = array(
    'la-pricing-table-wrap',
    'wpb_content_element',
    'style-' . $style
);
if($package_featured == 'yes'){
    $css_class[] = 'is_box_featured';
}
if(!empty($css_animation) && 'none' != $css_animation){
    $css_class[] = 'wpb_animate_when_almost_visible la-animation animated';
}
$css_class = implode(' ', $css_class) . $this->getExtraClass( $el_class );


$button_link = ( '||' === $button_link ) ? '' : $button_link;
$button_link = vc_parse_multi_attribute( $button_link, array( 'url' => '', 'title' => '', 'target' => '_self', 'rel' => '' ) );

// Build title
$packageTitleCssInline = array();
$packageTitleHtmlAtts = '';
if(!empty($package_title_fz) || !empty($package_title_lh)){
    $packageTitleHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
        'target' => '#' . $unique_id . ' .la-pricing-table .pricing-heading',
        'media_sizes' => array(
            'font-size' => $package_title_fz,
            'line-height' => $package_title_lh
        )
    ));
    LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
        'target' => '#' . $unique_id . ' .la-pricing-table .pricing-heading',
        'media_sizes' => array(
            'font-size' => $package_title_fz,
            'line-height' => $package_title_lh
        )
    ));
}
if(!empty($package_title_color)){
    $packageTitleCssInline[] = "color:{$package_title_color}";
}
if(!empty($use_gfont_package_title)){
    $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($package_title_font);
    if(isset($gfont_data['style'])){
        $packageTitleCssInline[] = $gfont_data['style'];
    }
    if(isset($gfont_data['font_url'])){
        wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
    }
}


// Build price
$packagePriceCssInline = array();
$packagePriceHtmlAtts = '';
if(!empty($package_price_fz) || !empty($package_price_lh)){
    $packagePriceHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
        'target' => '#' . $unique_id . ' .la-pricing-table .price-box .price-value',
        'media_sizes' => array(
            'font-size' => $package_price_fz,
            'line-height' => $package_price_lh
        )
    ));
    LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
        'target' => '#' . $unique_id . ' .la-pricing-table .price-box .price-value',
        'media_sizes' => array(
            'font-size' => $package_price_fz,
            'line-height' => $package_price_lh
        )
    ));
}
if(!empty($package_price_color)){
    $packagePriceCssInline[] = "color:{$package_price_color}";
}
if(!empty($use_gfont_package_price)){
    $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($package_price_font);
    if(isset($gfont_data['style'])){
        $packagePriceCssInline[] = $gfont_data['style'];
    }
    if(isset($gfont_data['font_url'])){
        wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
    }
}

// Build price unit
$packagePriceUnitCssInline = array();
$packagePriceUnitHtmlAtts = '';
if(!empty($package_price_unit_fz) || !empty($package_price_unit_lh)){
    $packagePriceUnitHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
        'target' => '#' . $unique_id . ' .la-pricing-table .price-box .price-unit',
        'media_sizes' => array(
            'font-size' => $package_price_unit_fz,
            'line-height' => $package_price_unit_lh
        )
    ));
    LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
        'target' => '#' . $unique_id . ' .la-pricing-table .price-box .price-unit',
        'media_sizes' => array(
            'font-size' => $package_price_unit_fz,
            'line-height' => $package_price_unit_lh
        )
    ));
}
if(!empty($package_price_unit_color)){
    $packagePriceUnitCssInline[] = "color:{$package_price_unit_color}";
}
if(!empty($use_gfont_package_price_unit)){
    $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($package_price_unit_font);
    if(isset($gfont_data['style'])){
        $packagePriceUnitCssInline[] = $gfont_data['style'];
    }
    if(isset($gfont_data['font_url'])){
        wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
    }
}

// Build Description
$packageDescCssInline = array();
$packageDescHtmlAtts = '';
if(!empty($package_desc_fz) || !empty($package_desc_lh)){
    $packageDescHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
        'target' => '#' . $unique_id . ' .la-pricing-table .desc-featured',
        'media_sizes' => array(
            'font-size' => $package_desc_fz,
            'line-height' => $package_desc_lh
        )
    ));
    LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
        'target' => '#' . $unique_id . ' .la-pricing-table .desc-featured',
        'media_sizes' => array(
            'font-size' => $package_desc_fz,
            'line-height' => $package_desc_lh
        )
    ));
}
if(!empty($package_desc_color)){
    $packageDescCssInline[] = "color:{$package_desc_color}";
}
if(!empty($use_gfont_package_desc)){
    $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($package_desc_font);
    if(isset($gfont_data['style'])){
        $packageDescCssInline[] = $gfont_data['style'];
    }
    if(isset($gfont_data['font_url'])){
        wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
    }
}

// Build Package Featured
$packageFeaturedCssInline = array();
$packageFeaturedHtmlAtts = '';
if(!empty($package_featured_fz) || !empty($package_featured_lh)){
    $packageFeaturedHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
        'target' => '#' . $unique_id . ' .la-pricing-table .package-featured',
        'media_sizes' => array(
            'font-size' => $package_featured_fz,
            'line-height' => $package_featured_lh
        )
    ));
    LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
        'target' => '#' . $unique_id . ' .la-pricing-table .package-featured',
        'media_sizes' => array(
            'font-size' => $package_featured_fz,
            'line-height' => $package_featured_lh
        )
    ));
}
if(!empty($package_featured_color)){
    $packageFeaturedCssInline[] = "color:{$package_featured_color}";
}
if(!empty($use_gfont_package_featured)){
    $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($package_featured_font);
    if(isset($gfont_data['style'])){
        $packageFeaturedCssInline[] = $gfont_data['style'];
    }
    if(isset($gfont_data['font_url'])){
        wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
    }
}

// Build action
$packageActionCssInline = array();
$packageActionHtmlAtts = '';
if(!empty($package_button_fz) || !empty($package_button_lh)){
    $packageActionHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
        'target' => '#' . $unique_id . ' .la-pricing-table .pricing-action a',
        'media_sizes' => array(
            'font-size' => $package_button_fz,
            'line-height' => $package_button_lh
        )
    ));
    LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
        'target' => '#' . $unique_id . ' .la-pricing-table .pricing-action a',
        'media_sizes' => array(
            'font-size' => $package_button_fz,
            'line-height' => $package_button_lh
        )
    ));
}
if(!empty($package_button_color)){
    $packageActionCssInline[] = "color:{$package_button_color}";
}
if(!empty($use_gfont_package_button)){
    $gfont_data = LaStudio_Shortcodes_Helper::parseGoogleFontAtts($package_button_font);
    if(isset($gfont_data['style'])){
        $packageActionCssInline[] = $gfont_data['style'];
    }
    if(isset($gfont_data['font_url'])){
        wp_enqueue_style( 'vc_google_fonts_' . $gfont_data['font_family'], $gfont_data['font_url'] );
    }
}

// Build Package Icon
$iconInnerHTML = '';
$packageIconCssInline = array();
$packageIconHtmlAtts = '';
if($icon_type == 'custom'){
    if( $__icon_html = wp_get_attachment_image($icon_image_id, 'full') ) {
        $iconInnerHTML = $__icon_html;
    }
}else{
    if(!empty( ${'icon_' . $icon_type} )){
        $iconInnerHTML = '<i class="'.esc_attr(${'icon_' . $icon_type}).'"></i>';
    }
}
$packageIconHtmlAtts = LaStudio_Shortcodes_Helper::getResponsiveMediaCss(array(
    'target' => '#' . $unique_id . ' .la-pricing-table .wrap-icon .icon-inner',
    'media_sizes' => array(
        'font-size' => $icon_fz,
        'line-height' => $icon_lh,
        'width' => $icon_lh,
        'height' => $icon_lh
    )
));
LaStudio_Shortcodes_Helper::renderResponsiveMediaCss($la_fix_css, array(
    'target' => '#' . $unique_id . ' .la-pricing-table .wrap-icon .icon-inner',
    'media_sizes' => array(
        'font-size' => $icon_fz,
        'line-height' => $icon_lh,
        'width' => $icon_lh,
        'height' => $icon_lh
    )
));
if(!empty($icon_color)){
    $packageIconCssInline[] = "color:{$icon_color}";
}

?>
<div id="<?php echo esc_attr($unique_id);?>" class="<?php echo esc_attr($css_class)?>" data-animation-class="<?php echo esc_attr($css_animation)?>">
    <div class="la-pricing-table">
        <?php
        if($package_featured == 'yes'){
            printf('<div class="pricing-badge"><span>%s</span></div>', esc_html($custom_badge));
        }
        ?>
        <div class="pricing-heading-wrap">
            <div class="wrap2">
                <?php

                if(!empty($iconInnerHTML) && $style == 1){
                    printf('<div class="wrap-icon"><div class="icon-inner la-unit-responsive" style="%s"%s>%s</div></div>',
                        esc_attr( implode(';', $packageIconCssInline) ),
                        $packageIconHtmlAtts,
                        $iconInnerHTML
                    );
                }

                if(!empty($package_title)){
                    printf('<div class="pricing-heading la-unit-responsive" style="%s"%s>%s</div>',
                        esc_attr( implode(';', $packageTitleCssInline) ),
                        $packageTitleHtmlAtts,
                        esc_html($package_title)
                    );
                }
                if(!empty($iconInnerHTML) && $style == 2){
                    printf('<div class="wrap-icon"><div class="icon-inner la-unit-responsive" style="%s"%s>%s</div></div>',
                        esc_attr( implode(';', $packageIconCssInline) ),
                        $packageIconHtmlAtts,
                        $iconInnerHTML
                    );
                }
                if(!empty($package_price) || !empty($price_unit)){
                    $supPrice = preg_replace('/[^0-9\.\,]+/', '<sup>$0</sup>', $package_price);
                    printf('<div class="price-box-wrap"><div class="price-box"><div class="price-value la-unit-responsive" style="%s"%s>%s</div><div class="price-unit la-unit-responsive" style="%s"%s>%s</div></div></div>',
                        esc_attr( implode(';', $packagePriceCssInline) ),
                        $packagePriceHtmlAtts,
                        $supPrice,
                        esc_attr( implode(';', $packagePriceUnitCssInline) ),
                        $packagePriceUnitHtmlAtts,
                        $price_unit
                    );
                }
                if(!empty($iconInnerHTML) && ( $style == 3 || $style == 4 )){
                    printf('<div class="wrap-icon"><div class="icon-inner la-unit-responsive" style="%s"%s>%s</div></div>',
                        esc_attr( implode(';', $packageIconCssInline) ),
                        $packageIconHtmlAtts,
                        $iconInnerHTML
                    );
                }
                ?>
            </div>
        </div>
        <div class="pricing-body">
            <?php
            if(!empty($desc_before)){
                printf('<div class="desc-featured before-featured la-unit-responsive" style="%s"%s>%s</div>',
                    esc_attr( implode(';', $packageDescCssInline) ),
                    $packageDescHtmlAtts,
                    $desc_before
                );
            }

            if(count($features) > 0){
                $featuredInnerHTML = '<ul>';
                foreach ($features as $feature){
                    $featuredInnerHTML .= sprintf('<li><span>%s</span>%s</li>',
                        ( !empty($feature['highlight']) ? '<strong>'.$feature['highlight'].' </strong>' : '' ) . ( !empty($feature['text']) ? $feature['text'] : ''),
                        ( !empty($feature['icon']) ? '<i class="'.esc_attr($feature['icon']).'"></i>' : '')
                    );
                }
                $featuredInnerHTML .= '</ul>';
                printf('<div class="package-featured la-unit-responsive" style="%s"%s>%s</div>',
                    esc_attr( implode(';', $packageFeaturedCssInline) ),
                    $packageFeaturedHtmlAtts,
                    $featuredInnerHTML
                );
            }

            if(!empty($desc_after)){
                printf('<div class="desc-featured after-featured la-unit-responsive" style="%s"%s>%s</div>',
                    esc_attr( implode(';', $packageDescCssInline) ),
                    $packageDescHtmlAtts,
                    $desc_after
                );
            }
            ?>
        </div>
        <?php
            if(!empty($button_link['url'])){
                printf('<div class="pricing-action"><a class="la-unit-responsive" href="%s" target="%s" title="%s" style="%s"%s>%s</a></div>',
                    esc_url($button_link['url']),
                    esc_attr($button_link['target']),
                    esc_attr($button_link['title']),
                    esc_attr( implode(';', $packageActionCssInline) ),
                    $packageActionHtmlAtts,
                    esc_html($button_text)
                );
            }
        ?>
    </div>
</div>
<style type="text/css">
    #<?php echo $unique_id ?> .la-pricing-table{
        background-color: <?php echo $main_bg_color;?>;
        color : <?php echo $main_text_color;?>;
    }
    <?php if($style == 1): ?>
        #<?php echo $unique_id ?> .la-pricing-table .pricing-action a,
        #<?php echo $unique_id ?> .la-pricing-table .wrap-icon .icon-inner,
        #<?php echo $unique_id ?> .la-pricing-table .pricing-heading{
            color: <?php echo $highlight_color;?>;
        }
        #<?php echo $unique_id ?> .la-pricing-table .pricing-action a:hover,
        #<?php echo $unique_id ?>.is_box_featured .la-pricing-table .pricing-action a{
            background-color: <?php echo $highlight_color;?>;
            border-color: <?php echo $highlight_color;?>;
            color: #fff;
        }
    <?php endif; ?>
    <?php if($style == 2): ?>
        #<?php echo $unique_id ?> .la-pricing-table .wrap-icon .icon-inner{
            color: <?php echo $highlight_color;?>;
        }
        #<?php echo $unique_id ?> .la-pricing-table .pricing-action,
        #<?php echo $unique_id ?> .la-pricing-table .pricing-heading{
            background-color: <?php echo $highlight_color;?>;
        }
    <?php endif; ?>
    <?php if($style == 3): ?>
        #<?php echo $unique_id ?> .la-pricing-table .featured i{
            color: <?php echo $highlight_color;?>;
        }
        #<?php echo $unique_id ?> .la-pricing-table .pricing-action a,
        #<?php echo $unique_id ?> .la-pricing-table .pricing-heading-wrap{
            background-color: <?php echo $highlight_color;?>;
        }
        #<?php echo $unique_id ?> .la-pricing-table .pricing-heading-wrap:after{
            border-top-color:<?php echo $highlight_color;?>;
        }
    <?php endif; ?>
</style>
<?php LaStudio_Shortcodes_Helper::renderResponsiveMediaStyleTags($la_fix_css); ?>