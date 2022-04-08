<header class="header3">
  <div class="logo-infos">
    <div class="row">
      <!-- BOTTOM BAR -->
      <div class="container">
        <div class="row">

          <!-- LEFT SIDE HOLDER -->
          <div class="col-md-4 text-right right-side-social-actions">
            <!-- SOCIAL LINKS -->
            <ul class="social-links pull-left">
              <?php if ( cryptokn_redux('mt_social_fb') && cryptokn_redux('mt_social_fb') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_fb') ) ?>"><i class="fa fa-facebook"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_tw') && cryptokn_redux('mt_social_tw') != '' ) { ?>
                <li><a href="https://twitter.com/<?php echo esc_attr( cryptokn_redux('mt_social_tw') ) ?>"><i class="fa fa-twitter"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_gplus') && cryptokn_redux('mt_social_gplus') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_gplus') ) ?>"><i class="fa fa-google-plus"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_youtube') && cryptokn_redux('mt_social_youtube') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_youtube') ) ?>"><i class="fa fa-youtube"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_pinterest') && cryptokn_redux('mt_social_pinterest') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_pinterest') ) ?>"><i class="fa fa-pinterest"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_linkedin') && cryptokn_redux('mt_social_linkedin') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_linkedin') ) ?>"><i class="fa fa-linkedin"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_skype') && cryptokn_redux('mt_social_skype') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_skype') ) ?>"><i class="fa fa-skype"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_instagram') && cryptokn_redux('mt_social_instagram') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_instagram') ) ?>"><i class="fa fa-instagram"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_dribbble') && cryptokn_redux('mt_social_dribbble') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_dribbble') ) ?>"><i class="fa fa-dribbble"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_deviantart') && cryptokn_redux('mt_social_deviantart') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_deviantart') ) ?>"><i class="fa fa-deviantart"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_digg') && cryptokn_redux('mt_social_digg') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_digg') ) ?>"><i class="fa fa-digg"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_flickr') && cryptokn_redux('mt_social_flickr') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_flickr') ) ?>"><i class="fa fa-flickr"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_stumbleupon') && cryptokn_redux('mt_social_stumbleupon') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_stumbleupon') ) ?>"><i class="fa fa-stumbleupon"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_tumblr') && cryptokn_redux('mt_social_tumblr') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_tumblr') ) ?>"><i class="fa fa-tumblr"></i></a></li>
              <?php } ?>
              <?php if ( cryptokn_redux('mt_social_vimeo') && cryptokn_redux('mt_social_vimeo') != '' ) { ?>
                <li><a href="<?php echo esc_url( cryptokn_redux('mt_social_vimeo') ) ?>"><i class="fa fa-vimeo-square"></i></a></li>
              <?php } ?>
            </ul>
          </div>

          <!-- LOGO HOLDER -->
          <div class="navbar-header col-md-4 text-center">
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

            <!-- NAVIGATION BURGER MENU -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
          </div>

          <!-- RIGHT SIDE HOLDER -->
          <div class="col-md-4 text-right right-side-social-actions">
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
    </div>
  </div>



  <!-- BOTTOM BAR -->
  <nav class="navbar navbar-default" id="modeltheme-main-head">
    <div class="container">
      <div class="row">
        <!-- NAV MENU -->
        <div id="navbar" class="navbar-collapse collapse col-md-12">
          <ul class="menu nav navbar-nav nav-effect nav-menu">
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
      </div>
    </div>
  </nav>
</header>