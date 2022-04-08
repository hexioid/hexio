.site-loading .la-image-loading {
    opacity: 1;
    visibility: visible
}
.la-image-loading.spinner-custom .content {
    width: 100px;
    margin-top: -50px;
    height: 100px;
    margin-left: -50px;
    text-align: center
}

.la-image-loading.spinner-custom .content img {
    width: auto;
    margin: 0 auto
}

.site-loading #page.site {
    opacity: 0;
    transition: all .3s ease-in-out
}

#page.site {
    opacity: 1
}

.la-image-loading {
    opacity: 0;
    position: fixed;
    z-index: 999999;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background-color: #fff;
    overflow: hidden;
    transition: all .3s ease-in-out;
    -webkit-transition: all .3s ease-in-out;
    visibility: hidden;
<?php Precise_Helper::render_background_atts(Precise()->settings->get('page_loading_background'));?>
}

.la-image-loading .content {
    position: absolute;
    width: 50px;
    height: 50px;
    top: 50%;
    left: 50%;
    margin-left: -25px;
    margin-top: -25px;
}
.la-image-loading .la-loader.spinner5 > div,
.la-image-loading .la-loader.spinner4 > div,
.la-image-loading .la-loader.spinner3 > div,
.la-image-loading .la-loader.spinner2,
.la-image-loading .la-loader.spinner1{
    background-color: <?php echo esc_attr(Precise()->settings->get('page_loading_color', '#e9595e')); ?>;
}

<?php
$current_context = Precise()->get_current_context();

$page_title_bar_func = 'get';
if(Precise()->settings->get_setting_by_context('page_title_bar_style', 'no') == 'yes'){
    $page_title_bar_func = 'get_setting_by_context';
}


$page_title_bar_bg = Precise()->settings->$page_title_bar_func('page_title_bar_background');
$page_title_bar_heading_color = Precise()->settings->$page_title_bar_func('page_title_bar_heading_color', '#252634');
$page_title_bar_text_color = Precise()->settings->$page_title_bar_func('page_title_bar_text_color', '#8a8a8a');
$page_title_bar_link_color = Precise()->settings->$page_title_bar_func('page_title_bar_link_color', '#8a8a8a');
$page_title_bar_link_hover_color = Precise()->settings->$page_title_bar_func('page_title_bar_link_hover_color', '#343538');
$page_title_bar_spacing = Precise()->settings->$page_title_bar_func('page_title_bar_spacing');
$page_title_bar_spacing_tablet = Precise()->settings->$page_title_bar_func('page_title_bar_spacing_tablet');
$page_title_bar_spacing_mobile = Precise()->settings->$page_title_bar_func('page_title_bar_spacing_mobile');

$page_title_bar_bg = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => ''
), $page_title_bar_bg);

$page_title_bar_spacing = shortcode_atts(array(
    'bottom' => 25,
    'top'    => 25
), $page_title_bar_spacing );

$page_title_bar_spacing_tablet = shortcode_atts(array(
    'bottom' => 25,
    'top'    => 25
), $page_title_bar_spacing_tablet );

$page_title_bar_spacing_mobile = shortcode_atts(array(
    'bottom' => 25,
    'top'    => 25
), $page_title_bar_spacing_mobile );

?>
.section-page-header{
    color: <?php echo esc_attr($page_title_bar_text_color); ?>;
    <?php Precise_Helper::render_background_atts($page_title_bar_bg);?>
}
.section-page-header .page-title{
    color: <?php echo esc_attr($page_title_bar_heading_color); ?>;
}
.section-page-header a{
    color: <?php echo esc_attr($page_title_bar_link_color); ?>;
}
.section-page-header a:hover{
    color: <?php echo esc_attr($page_title_bar_link_hover_color); ?>;
}
.section-page-header .page-header-inner{
    padding-top: <?php echo absint($page_title_bar_spacing_mobile['top']) ?>px;
    padding-bottom: <?php echo absint($page_title_bar_spacing_mobile['bottom']) ?>px;
}
@media(min-width: 768px){
    .section-page-header .page-header-inner{
        padding-top: <?php echo absint($page_title_bar_spacing_tablet['top']) ?>px;
        padding-bottom: <?php echo absint($page_title_bar_spacing_tablet['bottom']) ?>px;
    }
}
@media(min-width: 992px){
    .section-page-header .page-header-inner{
        padding-top: <?php echo absint($page_title_bar_spacing['top']) ?>px;
        padding-bottom: <?php echo absint($page_title_bar_spacing['bottom']) ?>px;
    }
}

<?php
$main_space = Precise()->settings->get_setting_by_context('main_space');
if(!empty($main_space) && is_array($main_space)){
    $main_space = shortcode_atts(array(
        'top' => '',
        'bottom' => ''
    ), $main_space);
    echo '.site-main{';
    if($main_space['top'] != ''){
        echo  'padding-top:' . absint($main_space['top']) . 'px;';
    }
    if($main_space['bottom'] != ''){
        echo  'padding-bottom:' . absint($main_space['bottom']) . 'px';
    }
    echo '}';
}

$font_source = Precise()->settings->get('font_source', 1);

$body_font_family = '';
$heading_font_family = '';
$highlight_font_family = '';

switch ($font_source) {
    case '1':

        $_s_main_font = (array) Precise()->settings->get('main_font');
        $_s_secondary_font = (array) Precise()->settings->get('secondary_font');
        $_s_highlight_font = (array) Precise()->settings->get('highlight_font');

        if(!empty($_s_main_font['family'])){
            $body_font_family = '"' . $_s_main_font['family'] . '"';
        }
        if(!empty($_s_secondary_font['family'])){
            $heading_font_family = '"' . $_s_secondary_font['family'] . '"';
        }
        if(!empty($_s_highlight_font['family'])){
            $highlight_font_family = '"' . $_s_highlight_font['family'] . '"';
            if($_s_highlight_font['family'] == 'Playfair Display'){
                $highlight_font_family .= '; font-style: italic';
            }
        }

        break;

    case '2':
        $body_font_family = Precise()->settings->get('main_google_font_face');
        $heading_font_family = Precise()->settings->get('secondary_google_font_face');
        $highlight_font_family = Precise()->settings->get('highlight_google_font_face');
        break;

    case '3':
        $body_font_family = Precise()->settings->get('main_typekit_font_face');
        $heading_font_family = Precise()->settings->get('secondary_typekit_font_face');
        $highlight_font_family = Precise()->settings->get('highlight_typekit_font_face');
        break;
}

$body_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => '#fff'
), Precise()->settings->get('body_background'));

$header_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => '#fff'
), Precise()->settings->get('header_background'));

$transparency_header_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => 'rgba(0,0,0,0)'
), Precise()->settings->get('transparency_header_background'));

$footer_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => '#fff'
), Precise()->settings->get('footer_background'));

$body_boxed = Precise()->settings->get('body_boxed', 'no');
$body_boxed_background = shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => ''
), Precise()->settings->get('body_boxed_background'));

$body_font_size = Precise()->settings->get('body_font_size', 16);
$body_font_size = str_replace('px', '', $body_font_size);
$body_max_width = Precise()->settings->get('body_max_width', 1230);
$body_max_width = str_replace('px', '', $body_max_width);
?>
body.precise-body{
    font-size: <?php echo esc_attr($body_font_size) ?>px;
    <?php Precise_Helper::render_background_atts($body_background);?>
}
body.precise-body.body-boxed #page.site{
    width: <?php echo esc_attr($body_max_width) ?>px;
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
    <?php Precise_Helper::render_background_atts($body_boxed_background);?>
}
#masthead_aside,
.site-header .site-header-inner{
    <?php Precise_Helper::render_background_atts($header_background);?>
}
.enable-header-transparency .site-header:not(.is-sticky) .site-header-inner{
    <?php Precise_Helper::render_background_atts($transparency_header_background);?>
}
.site-footer{
    <?php Precise_Helper::render_background_atts($footer_background);?>
}
<?php

$popup_background =  shortcode_atts(array(
    'image' => '',
    'repeat' => 'repeat',
    'position' => 'left top',
    'attachment' => 'scroll',
    'size' => '',
    'color' => ''
), Precise()->settings->get('popup_background'));

?>
.open-newsletter-popup .lightcase-inlineWrap{
    <?php Precise_Helper::render_background_atts($popup_background);?>
}

<?php if( Precise()->settings->get('catalog_mode', 'off') == 'on'){
    if( Precise()->settings->get('catalog_mode_price', 'off') == 'on'){
        ?>
.woocommerce .product-price,
.woocommerce span.price,
.woocommerce div.price,
.woocommerce p.price{
    display: none !important;
}
        <?php
    }
}
?>

<?php
$normal_header_height = str_replace('px', '', Precise()->settings->get('header_height', 100));
$sticky_header_height = str_replace('px', '', Precise()->settings->get('header_sticky_height', 80));

$header_sm_height = str_replace('px', '', Precise()->settings->get('header_sm_height', 100));
$header_sm_sticky_height = str_replace('px', '', Precise()->settings->get('header_sm_sticky_height', 80));

$header_mb_height = str_replace('px', '', Precise()->settings->get('header_mb_height', 70));
$header_mb_sticky_height = str_replace('px', '', Precise()->settings->get('header_mb_sticky_height', 70));


?>


/****************************************** Header Height ******************************************/

.site-header .site-branding a{
    height: <?php echo esc_attr($normal_header_height) ?>px;
    line-height: <?php echo esc_attr($normal_header_height) ?>px;
}
.site-header .header-component-inner{
    padding-top: <?php echo esc_attr(($normal_header_height-40)/2) ?>px;
    padding-bottom: <?php echo esc_attr(($normal_header_height-40)/2) ?>px;
}

.site-header .header-main .la_com_action--dropdownmenu .menu,
.site-header .mega-menu > li > .popup{
    margin-top: <?php echo esc_attr((($normal_header_height-40)/2) + 20) ?>px;
}
.site-header .header-main .la_com_action--dropdownmenu:hover .menu,
.site-header .mega-menu > li:hover > .popup{
    margin-top: <?php echo esc_attr((($normal_header_height-40)/2)) ?>px;
}

.site-header.is-sticky .site-branding a{
    height: <?php echo esc_attr($sticky_header_height) ?>px;
    line-height: <?php echo esc_attr($sticky_header_height) ?>px;
}
.site-header.is-sticky .header-component-inner{
    padding-top: <?php echo esc_attr(($sticky_header_height-40)/2) ?>px;
    padding-bottom: <?php echo esc_attr(($sticky_header_height-40)/2) ?>px;
}
.site-header.is-sticky .header-main .la_com_action--dropdownmenu .menu,
.site-header.is-sticky .mega-menu > li > .popup{
    margin-top: <?php echo esc_attr((($sticky_header_height-40)/2) + 20) ?>px;
}
.site-header.is-sticky .header-main .la_com_action--dropdownmenu:hover .menu,
.site-header.is-sticky .mega-menu > li:hover > .popup{
    margin-top: <?php echo esc_attr((($sticky_header_height-40)/2)) ?>px;
}

/****************************************** ./Header Height ******************************************/


/****************************************** Tablet Header Height ******************************************/

/****************************************** ./Tablet Header Height ******************************************/


/****************************************** ./Mobile Header Height ******************************************/
@media(max-width: 991px){

    .site-header-mobile .site-branding a{
        height: <?php echo esc_attr($header_mb_height) ?>px;
        line-height: <?php echo esc_attr($header_mb_height) ?>px;
    }
    .site-header-mobile .header-component-inner{
        padding-top: <?php echo esc_attr(($header_mb_height-40)/2) ?>px;
        padding-bottom: <?php echo esc_attr(($header_mb_height-40)/2) ?>px;
    }


    .site-header-mobile.is-sticky .site-branding a{
        height: <?php echo esc_attr($header_mb_sticky_height) ?>px;
        line-height: <?php echo esc_attr($header_mb_sticky_height) ?>px;
    }
    .site-header-mobile.is-sticky .header-component-inner{
        padding-top: <?php echo esc_attr(($header_mb_sticky_height-40)/2) ?>px;
        padding-bottom: <?php echo esc_attr(($header_mb_sticky_height-40)/2) ?>px;
    }
}
/****************************************** ./Mobile Header Height ******************************************/