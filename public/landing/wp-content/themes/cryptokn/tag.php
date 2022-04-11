<?php
/**
 * The template for displaying tags results pages.
 *
 */

get_header(); 

$class_row = "col-md-9";
if ( cryptokn_redux('mt_blog_layout') == 'mt_blog_fullwidth' ) {
    $class_row = "col-md-12";
}elseif ( cryptokn_redux('mt_blog_layout') == 'mt_blog_right_sidebar' or cryptokn_redux('mt_blog_layout') == 'mt_blog_left_sidebar') {
    $class_row = "col-md-9";
}
$sidebar = cryptokn_redux('mt_blog_layout_sidebar');


// theme_ini
$theme_init = new cryptokn_init_class;
?>

    <!-- HEADER TITLE BREADCRUBS SECTION -->
    <?php echo wp_kses_post(cryptokn_header_title_breadcrumbs()); ?>

    <!-- Page content -->
    <div class="high-padding">
        <!-- Blog content -->
        <div class="container blog-posts">
            <div class="row">

                <?php if ( cryptokn_redux('mt_blog_layout') != '' && cryptokn_redux('mt_blog_layout') == 'mt_blog_left_sidebar') { ?>
                    <?php if (is_active_sidebar($sidebar)) { ?>
                        <div class="col-md-4 sidebar-content"><?php  dynamic_sidebar( $sidebar ); ?></div>
                    <?php } ?>
                <?php } ?>

                <div class="<?php echo esc_attr($class_row); ?> main-content">
                <?php if ( have_posts() ) : ?>
                    <div class="row">

                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php /* Loop - Variant 1 */ ?>
                            <?php get_template_part( 'content', $theme_init->cryptokn_blogloop_variant() ); ?>
                        <?php endwhile; ?>

                        <div class="modeltheme-pagination-holder col-md-12">             
                            <div class="modeltheme-pagination pagination">             
                                <?php cryptokn_pagination(); ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>
                </div>

                <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                    <?php if ( cryptokn_redux('mt_blog_layout') != '' && cryptokn_redux('mt_blog_layout') == 'mt_blog_right_sidebar') { ?>
                        <?php if (is_active_sidebar($sidebar)) { ?>
                            <div class="col-md-4 sidebar-content">
                                <?php dynamic_sidebar( $sidebar ); ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php }else{ ?>
                    <div class="col-md-4 sidebar-content">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>