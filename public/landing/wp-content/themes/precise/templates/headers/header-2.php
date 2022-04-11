<?php

$header_layout = Precise()->layout->get_header_layout();

$header_access_icon = Precise()->settings->get('header_access_icon');
$show_hamburger_menu    = (Precise()->settings->get('header_show_menu_hamburger') == 'yes') ? true : false;

$show_header_top        = Precise()->settings->get('enable_header_top');
$header_top_elements    = Precise()->settings->get('header_top_elements');
$custom_header_top_html = Precise()->settings->get('use_custom_header_top');

$aside_sidebar_name = apply_filters('precise/filter/aside_widget_bottom', 'aside-widget');
?>
<?php if($show_hamburger_menu): ?>
<aside id="header_aside" class="header--aside">
    <div class="header-aside-wrapper">
        <a class="btn-aside-toggle" href="#"><i class="precise-icon-simple-close"></i></a>
        <div class="header-aside-inner">
            <?php if(is_active_sidebar($aside_sidebar_name)): ?>
                <div class="header-widget-bottom">
                    <?php
                    dynamic_sidebar($aside_sidebar_name);
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</aside>
<?php endif;?>
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
                        <nav class="site-main-nav clearfix" data-container="#masthead .header-main">
                            <?php Precise()->layout->render_main_nav();?>
                        </nav>
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
                        <?php if($show_hamburger_menu): ?>
                            <div class="header_component header_component--hamburger-menu la_compt_iem la_com_action--hamburger-menu">
                                <a class="component-target btn-aside-toggle" href="javascript:;"><i class="precise-icon-menu"></i></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- #masthead -->