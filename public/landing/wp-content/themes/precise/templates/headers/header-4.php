<?php

$header_layout = Precise()->layout->get_header_layout();
$header_access_icon = Precise()->settings->get('header_access_icon');

$show_header_top        = Precise()->settings->get('enable_header_top');
$header_top_elements    = Precise()->settings->get('header_top_elements');
$custom_header_top_html = Precise()->settings->get('use_custom_header_top');

$store_working_hours = Precise()->settings->get('store_working_hours');
$store_email = Precise()->settings->get('store_email');
$store_phone = Precise()->settings->get('store_phone');

?>
<aside id="header_aside" class="header--aside">
    <div class="header-aside-wrapper">
        <a class="btn-aside-toggle" href="#"><i class="precise-icon-simple-close"></i></a>
        <div class="header-aside-inner">
            <nav class="header-aside-nav menu--vertical menu--vertical-<?php echo is_rtl() ? 'left' : 'right' ?> clearfix">
                <div class="nav-inner" data-container="#header_aside">
                    <?php Precise()->layout->render_main_nav(array(
                        'menu_class'    => 'main-menu mega-menu isVerticalMenu',
                    ));?>
                </div>
            </nav>
        </div>
    </div>
</aside>
<header id="masthead" class="site-header">
    <div class="la-header-sticky-height"></div>
    <?php if($show_header_top == 'custom' && !empty($custom_header_top_html) ): ?>
        <div class="site-header-top use-custom-html">
            <div class="container">
                <?php echo Precise_Helper::remove_js_autop($custom_header_top_html); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if($show_header_top == 'yes' && !empty($header_top_elements) ): ?>
        <div class="site-header-top use-default">
            <div class="container">
                <div class="header-top-elements">
                    <?php
                    foreach($header_top_elements as $component){
                        if(isset($component['type'])){
                            echo Precise_Helper::render_access_component($component['type'], $component, 'header_component');
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="site-header-inner">
        <div class="container">
            <div class="header-main clearfix">
                <div class="header-component-outer header-left">
                    <div class="header-component-inner clearfix">
                        <?php if(!empty($store_phone)): ?>
                        <div class="header_component header_component--linktext la_compt_iem la_com_action--linktext">
                            <span class="component-target"><i class="fa fa-mobile"></i><span class="component-target-text"><?php echo esc_html($store_phone) ?></span></span>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($store_email)): ?>
                            <div class="header_component header_component--linktext la_compt_iem la_com_action--linktext">
                                <a class="component-target" href="<?php echo esc_url('mailto:'. $store_email)?>"><i class="fa fa-envelope-o"></i><span class="component-target-text"><?php echo esc_html($store_email) ?></span></a>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($store_working_hours)): ?>
                            <div class="header_component header_component--linktext la_compt_iem la_com_action--linktext">
                                <span class="component-target"><i class="fa fa-clock-o"></i><span class="component-target-text"><?php echo esc_html($store_working_hours) ?></span></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="header-component-outer header-middle">
                    <div class="site-branding">
                        <a href="<?php echo esc_url( home_url( '/'  ) ); ?>" rel="home">
                            <figure class="logo--normal"><?php Precise()->layout->render_logo();?></figure>
                            <figure class="logo--transparency"><?php Precise()->layout->render_transparency_logo();?></figure>
                        </a>
                    </div>
                </div>
                <div class="header-component-outer header-right">
                    <div class="header-component-inner clearfix">
                        <?php
                        if(!empty($header_access_icon)){
                            foreach($header_access_icon as $component){
                                if(isset($component['type'])){
                                    echo Precise_Helper::render_access_component($component['type'], $component, 'header_component');
                                }
                            }
                        }
                        ?>
                        <div class="header_component header_component--hamburger-menu la_compt_iem la_com_action--hamburger-menu">
                            <a class="component-target btn-aside-toggle" href="javascript:;"><i class="precise-icon-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- #masthead -->