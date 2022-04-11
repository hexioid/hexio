<?php do_action('foton_mikado_action_before_mobile_navigation'); ?>

<nav class="mkdf-mobile-nav">
    <div class="mkdf-grid">
        <?php wp_nav_menu(array(
            'theme_location' => 'mobile-navigation' ,
            'container'  => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'top_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new FotonMikadoClassMobileNavigationWalker()
        )); ?>
    </div>
</nav>

<?php do_action('foton_mikado_action_after_mobile_navigation'); ?>