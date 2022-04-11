<header class="header2">
  <div class="logo-infos">
    <div class="row">
      <!-- BOTTOM BAR -->
      <div class="container">
        <div class="row">

          <!-- LOGO -->
          <div class="navbar-header col-md-3">
            <!-- NAVIGATION BURGER MENU -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <?php if(cryptokn_redux('mt_logo','url')){ ?>
              <h1 class="logo">
                  <a href="<?php echo esc_url(get_site_url()); ?>">
                      <img src="<?php echo esc_url(cryptokn_redux('mt_logo','url')); ?>" alt="<?php echo esc_attr(get_bloginfo()); ?>" />
                  </a>
              </h1>
            <?php }else{ ?>
              <h1 class="logo no-logo">
                  <a href="<?php echo esc_url(get_site_url()); ?>">
                    <?php echo esc_html(get_bloginfo()); ?>
                  </a>
              </h1>
            <?php } ?>
          </div>

          <div class="col-md-9">
            <div class="header-infos header-light-holder">
              <?php if(cryptokn_redux('mt_divider_header_info_1_status') == true){ ?>
                <!-- HEADER INFO 1 -->
                <div class="text-center header-info-group pull-right <?php echo esc_attr(cryptokn_redux('mt_divider_header_info_1_media_type')); ?>">
                  <div class="header-info-icon">
                    <?php if(cryptokn_redux('mt_divider_header_info_1_media_type') == 'font_awesome'){ ?>
                      <i class="<?php echo esc_attr(cryptokn_redux('mt_divider_header_info_1_faicon')); ?>"></i>
                    <?php }elseif(cryptokn_redux('mt_divider_header_info_1_media_type') == 'media_image'){ ?>
                      <img src="<?php echo esc_url(cryptokn_redux('mt_divider_header_info_1_image_icon','url')); ?>" alt="<?php echo esc_attr__('Image Header Info', 'cryptokn'); ?>" />
                    <?php }elseif(cryptokn_redux('mt_divider_header_info_1_media_type') == 'text_title'){ ?>
                      <p class="header_text_title"><strong><?php echo esc_html(cryptokn_redux('mt_divider_header_info_1_text_1')); ?></strong>
                    <?php } ?>
                    <?php echo esc_html(cryptokn_redux('mt_divider_header_info_1_heading1')); ?>
                  </div>
                </div>
                <!-- // HEADER INFO 1 -->
              <?php } ?>

              <?php if(cryptokn_redux('mt_divider_header_info_2_status') == true){ ?>
                <!-- HEADER INFO 2 -->
                <div class="text-center header-info-group pull-right <?php echo esc_attr(cryptokn_redux('mt_divider_header_info_2_media_type')); ?>">
                  <div class="header-info-icon">
                    <?php if(cryptokn_redux('mt_divider_header_info_2_media_type') == 'font_awesome'){ ?>
                      <i class="<?php echo esc_attr(cryptokn_redux('mt_divider_header_info_2_faicon')); ?>"></i>
                    <?php }elseif(cryptokn_redux('mt_divider_header_info_2_media_type') == 'media_image'){ ?>
                      <img src="<?php echo esc_url(cryptokn_redux('mt_divider_header_info_2_image_icon','url')); ?>" alt="<?php echo esc_attr__('Image Header Info', 'cryptokn'); ?>" />
                    <?php }elseif(cryptokn_redux('mt_divider_header_info_2_media_type') == 'text_title'){ ?>
                      <p class="header_text_title"><strong><?php echo esc_html(cryptokn_redux('mt_divider_header_info_2_text_2')); ?></strong>
                    <?php } ?>
                    <?php echo esc_html(cryptokn_redux('mt_divider_header_info_2_heading1')); ?>
                  </div>
                </div>
                <!-- // HEADER INFO 2 -->
              <?php } ?>

              <?php if(cryptokn_redux('mt_divider_header_info_3_status') == true){ ?>
                <!-- HEADER INFO 3 -->
                <div class="text-center header-info-group pull-right <?php echo esc_attr(cryptokn_redux('mt_divider_header_info_3_media_type')); ?>">
                  <div class="header-info-icon">
                    <?php if(cryptokn_redux('mt_divider_header_info_3_media_type') == 'font_awesome'){ ?>
                      <i class="<?php echo esc_attr(cryptokn_redux('mt_divider_header_info_3_faicon')); ?>"></i>
                    <?php }elseif(cryptokn_redux('mt_divider_header_info_3_media_type') == 'media_image'){ ?>
                      <img src="<?php echo esc_url(cryptokn_redux('mt_divider_header_info_3_image_icon','url')); ?>" alt="<?php echo esc_attr__('Image Header Info', 'cryptokn'); ?>" />
                    <?php }elseif(cryptokn_redux('mt_divider_header_info_3_media_type') == 'text_title'){ ?>
                      <p class="header_text_title"><strong><?php echo esc_html(cryptokn_redux('mt_divider_header_info_3_text_3')); ?></strong>
                    <?php } ?>
                    <?php echo esc_html(cryptokn_redux('mt_divider_header_info_3_heading1')); ?>
                  </div>
                </div>
                <!-- // HEADER INFO 3 -->
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- BOTTOM BAR -->
  <nav class="navbar navbar-default" id="modeltheme-main-head">
    <div class="container">
      <div class="row">
        <!-- NAV MENU -->
        <div id="navbar" class="navbar-collapse collapse col-md-9">
          <ul class="menu nav navbar-nav pull-left nav-effect nav-menu">
            <?php
              if ( has_nav_menu( 'primary' ) ) {
                $defaults = array(
                  'menu'            => '',
                  'container'       => false,
                  'container_class' => '',
                  'container_id'    => '',
                  'menu_class'      => 'menu',
                  'menu_id'         => '',
                  'echo'            => true,
                  'fallback_cb'     => false,
                  'before'          => '',
                  'after'           => '',
                  'link_before'     => '',
                  'link_after'      => '',
                  'items_wrap'      => '%3$s',
                  'depth'           => 0,
                  'walker'          => ''
                );

                $defaults['theme_location'] = 'primary';

                wp_nav_menu( $defaults );
              }else{
                echo '<p class="no-menu text-right">';
                  echo esc_html__('Primary navigation menu is missing. Add one from ', 'cryptokn');
                  echo '<a href="'.esc_url(get_admin_url() . 'nav-menus.php').'"><strong>'.esc_html__(' Appearance -> Menus','cryptokn').'</strong></a>';
                echo '</p>';
              }
            ?>
          </ul>
        </div>
        <div class="col-md-3 right-side-social-actions">
          <!-- ACTIONS BUTTONS GROUP -->
          <div class="pull-right actions-group">
            <?php if(cryptokn_redux('mt_header_fixed_sidebar_menu_status') == true) { ?>
              <!-- MT BURGER -->
              <div id="mt-nav-burger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
            <?php } ?>

            <?php if(cryptokn_redux('mt_header_is_search') == true){ ?>
              <!-- SEARCH ICON -->
              <a href="<?php echo esc_url('#'); ?>" class="mt-search-icon">
                <i class="fa fa-search" aria-hidden="true"></i>
              </a>
            <?php } ?>
          </div>
        </div>

      </div>
    </div>
  </nav>
</header>