<?php

$header_layout = Precise()->layout->get_header_layout();
$header_access_icon = Precise()->settings->get('header_access_icon');

$show_header_top        = Precise()->settings->get('enable_header_top');
$header_top_elements    = Precise()->settings->get('header_top_elements');
$custom_header_top_html = Precise()->settings->get('use_custom_header_top');
?>

<header id="masthead_aside" class="header--aside">
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
                    <div class="site-branding">
                        <a href="<?php echo esc_url( home_url( '/'  ) ); ?>" rel="home">
                            <figure class="logo--normal"><?php Precise()->layout->render_logo();?></figure>
                            <figure class="logo--transparency"><?php Precise()->layout->render_transparency_logo();?></figure>
                        </a>
                    </div>
                    <div class="header7-custom-text"><?php bloginfo('description'); ?></div>
                </div>
                <div class="header-component-outer header-middle">
                    <div class="header-component-inner">
                        <?php
                        if(!empty($header_access_icon)){
                            foreach($header_access_icon as $component){
                                if(isset($component['type'])){
                                    echo Precise_Helper::render_access_component($component['type'], $component, 'header_component');
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="header-component-outer header-right">
                    <nav class="header-aside-nav menu--vertical menu--vertical-<?php echo is_rtl() ? 'right' : 'left' ?> clearfix">
                        <div class="nav-inner" data-container="#masthead_aside">
                            <?php Precise()->layout->render_main_nav(array(
                                'menu_class'    => 'main-menu mega-menu isVerticalMenu'
                            ));?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- #masthead -->