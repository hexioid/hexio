<?php get_header(); ?>
<?php do_action( 'precise/action/before_render_main' ); ?>
<div id="main" class="site-main">
    <div class="container">
        <div class="row">
            <main id="site-content" class="<?php echo esc_attr(Precise()->layout->get_main_content_css_class('col-xs-12 site-content'))?>">
                <div class="site-content-inner">

                    <?php do_action( 'precise/action/before_render_main_inner' );?>

                    <div class="page-content">
                        <?php
                        $content_404 = Precise()->settings->get('404_page_content');
                        if(!empty($content_404)) : ?>
                            <div class="customerdefine-404-content">
                                <?php echo Precise_Helper::remove_js_autop($content_404); ?>
                            </div>
                        <?php else : ?>
                            <div class="default-404-content">
                                <div class="bg-404">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/404.png') ?>" alt="<?php echo esc_attr_x('404 Not Found', 'front-view', 'precise'); ?>"/>
                                </div>
                                <p class="btn-wrapper"><a class="btn text-uppercase" href="<?php echo esc_url(home_url('/')) ?>"><?php echo esc_html_x('back to homepage', 'front-view','precise')?></a></p>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>

                    <?php do_action( 'precise/action/after_render_main_inner' );?>
                </div>
            </main>
            <!-- #site-content -->
            <?php get_sidebar();?>
        </div>
    </div>
</div>
<!-- .site-main -->
<?php do_action( 'precise/action/after_render_main' ); ?>
<?php get_footer();?>