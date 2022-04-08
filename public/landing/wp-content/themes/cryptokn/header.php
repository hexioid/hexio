<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php esc_attr(bloginfo( 'charset' )); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <link rel="shortcut icon" href="<?php echo esc_url(cryptokn_redux('mt_favicon', 'url')); ?>">
    <?php } ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php /* PAGE PRELOADER */ ?>
    <?php
        if (cryptokn_redux('mt_preloader_status')) {
            echo '<div class="cryptokn_preloader_holder '.wp_kses_post(cryptokn_redux('mt_preloader_animation')).'">'.wp_kses_post(cryptokn_loader_animation()).'</div>';
        } 
    ?>


    <?php /* VARS */ ?>
    <?php 
    $below_slider_headers = array('header5', 'header6', 'header7', 'header8');
    $normal_headers = array('header1', 'header2', 'header3', 'header4');
    $custom_header_options_status = get_post_meta( get_the_ID(), 'smartowl_custom_header_options_status', true );
    $header_custom_variant = get_post_meta( get_the_ID(), 'smartowl_header_custom_variant', true );
    $header_layout = cryptokn_redux('mt_header_layout');
    if (isset($custom_header_options_status) && $custom_header_options_status == 'yes') {
        $header_layout = $header_custom_variant;
    }
    ?>

    <?php /* SEARCH BLOCK */ ?>
    <?php if(cryptokn_redux('mt_header_is_search') == true){ ?>
        <!-- Fixed Search Form -->
        <div class="fixed-search-overlay">
            <!-- Close Sidebar Menu + Close Overlay -->
            <!-- <i class="icon-close icons"></i> -->
            <i class="fa fa-times"></i>
            <!-- INSIDE SEARCH OVERLAY -->
            <div class="fixed-search-inside">
                <div class="modeltheme-search">
                    <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
                        <input class="search-input" placeholder="<?php echo esc_html__('Hit ENTER to search or ESC to close...', 'cryptokn'); ?>" type="search" value="" name="s" id="search" />
                        <input type="hidden" name="post_type" value="post" />
                    </form>
                </div>

                <div class="search_suggest text-left">
                    
                    <div class="search_suggest_column1">
                        <h3><i class="fa fa-long-arrow-right"></i>May We Suggest?</h3>
                        <p>#bitcoin #ICO #bitchain #btc #cryptocurrency #money #market #crypto #investing #today #trading #value #cash #getbitcoin #bitcointops #currency #dollar #crash #million #coinbase</p>
                    </div>
                    <div class="search_suggest_column2">
                        <h3><i class="fa fa-long-arrow-right"></i>Is It This?</h3>
                        <p>#investing #today #trading #value #cash #getbitcoin #bitcointops #currency #dollar #crash #million #coinbase #bitcoin #ICO #bitchain #btc #cryptocurrency #crypto</p>
                    </div>
                    <div class="search_suggest_column3">
                        <h3><i class="fa fa-long-arrow-right"></i>Are You Lost?</h3>
                        <p>#goBack #lost #hello #back #helloWorld #bitcoin #loosed #find #post #nono #why #yes #bitcoin #getbitcoin #search #currency #dollar #IamLost #findMe #searchMe</p>
                    </div>
                    
                </div>
            </div>
        </div>
    <?php } ?>


    <?php /* BURGER MENU */ ?>
    <?php if(cryptokn_redux('mt_header_fixed_sidebar_menu_status') == true){ ?>
        <!-- Fixed Sidebar Overlay -->
        <div class="fixed-sidebar-menu-overlay"></div>
        <!-- Fixed Sidebar Menu -->
        <div class="relative fixed-sidebar-menu-holder header7">
            <div class="fixed-sidebar-menu">
                <!-- Close Sidebar Menu + Close Overlay -->
                <!-- <i class="icon-close icons"></i> -->
                <i class="fa fa-times"></i>
                <!-- Sidebar Menu Holder -->
                <div class="header7 sidebar-content">
                    <!-- RIGHT SIDE -->
                    <div class="left-side">
                        <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
			              <?php if(cryptokn_redux('mt_logo','url')){ ?>
			                <h1 class="logo">
			                    <a href="<?php echo esc_url(get_site_url()); ?>">
			                        <img src="<?php echo esc_url(get_template_directory_uri().'/images/logo_black.png'); ?>" alt="<?php echo esc_attr(get_bloginfo()); ?>" />
			                    </a>
			                </h1>
			              <?php }else{ ?>
			                <h1 class="logo no-logo">
			                    <a href="<?php echo esc_url(get_site_url()); ?>">
			                      <?php echo esc_html(get_bloginfo()); ?>
			                    </a>
			                </h1>
			              <?php } ?>
			            <?php }else{ ?>
			              <h1 class="logo no-logo">
			                  <a href="<?php echo esc_url(get_site_url()); ?>">
			                    <?php echo esc_html(get_bloginfo()); ?>
			                  </a>
			              </h1>
			            <?php } ?>
                        <?php if (is_active_sidebar( cryptokn_redux('mt_header_fixed_sidebar') )) {
                            dynamic_sidebar( cryptokn_redux('mt_header_fixed_sidebar') ); 
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <!-- PAGE #page -->
    <div id="page" class="hfeed site">
        <?php
            $page_slider = get_post_meta( get_the_ID(), 'select_revslider_shortcode', true );
            if (in_array($header_layout, $below_slider_headers)){
                // Revolution slider
                if (!empty($page_slider)) {
                    echo '<div class="theme_header_slider">';
                    echo do_shortcode('[rev_slider '.esc_attr($page_slider).']');
                    echo '</div>';
                }

                // Header template variant
                echo wp_kses_post(cryptokn_current_header_template());
            }elseif (in_array($header_layout, $normal_headers)){
                // Header template variant
                echo wp_kses_post(cryptokn_current_header_template());
                // Revolution slider
                if (!empty($page_slider)) {
                    echo '<div class="theme_header_slider">';
                    echo do_shortcode('[rev_slider '.esc_attr($page_slider).']');
                    echo '</div>';
                }
            }else{
                echo wp_kses_post(cryptokn_current_header_template());
            }
        ?>