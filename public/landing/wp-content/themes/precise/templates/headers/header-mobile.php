<?php

$header_mobile_layout = Precise()->settings->get('header_mb_layout', '1');
$header_component_1 = Precise()->settings->get('header_mb_component_1');
$header_component_2 = Precise()->settings->get('header_mb_component_2');

$show_cart      = (Precise_Helper::is_active_woocommerce() && (Precise()->settings->get('header_show_cart', 'no') == 'yes')) ? true : false;
$show_wishlist  = (Precise_Helper::is_active_woocommerce() && Precise()->settings->get('header_show_wishlist') == 'yes' && function_exists('yith_wcwl_object_id'));
$show_account_menu      = (Precise()->settings->get('header_show_menu_account') == 'yes') ? true : false;
$show_search    = (Precise()->settings->get('header_show_search', 'no') == 'yes') ? true : false;
?>
<div class="site-header-mobile">
    <div class="la-header-sticky-height-mb"></div>
    <div class="site-header-inner">
        <div class="container">
            <div class="header-main clearfix">
                <div class="header-component-outer header-component-outer_logo">
                    <div class="site-branding">
                        <a href="<?php echo esc_url( home_url( '/'  ) ); ?>" rel="home">
                            <figure><?php Precise()->layout->render_mobile_logo();?></figure>
                        </a>
                    </div>
                </div>
                <div class="header-component-outer header-component-outer_1">
                    <div class="header-component-inner clearfix">
                        <?php
                        if(!empty($header_component_1)){
                            foreach($header_component_1 as $component){
                                if(isset($component['type'])){
                                    echo Precise_Helper::render_access_component($component['type'], $component, 'header_component');
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php if( ($header_mobile_layout == 1 || $header_mobile_layout == 4 ) && !empty($header_component_2) ) : ?>
                <div class="header-component-outer header-component-outer_2">
                    <div class="header-component-inner clearfix">
                        <?php
                        foreach($header_component_2 as $component){
                            if(isset($component['type'])){
                                echo Precise_Helper::render_access_component($component['type'], $component, 'header_component');
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="mobile-menu-wrap">
            <div id="la_mobile_nav" class="dl-menuwrapper"></div>
        </div>
    </div>
</div>
<!-- .site-header-mobile -->