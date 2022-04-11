<?php
get_header();

the_post();

$portfolio_style = Precise()->settings->get('single_portfolio_design', '1');
$current_design = Precise()->settings->get_post_meta(get_the_ID(), 'portfolio_design');
if(!empty($current_design) && $current_design != 'inherit'){
    $portfolio_style = $current_design;
}
do_action( 'precise/action/before_render_main' ); ?>
<div id="main" class="site-main">
    <div class="container">
        <div class="row">
            <main id="site-content" class="<?php echo esc_attr(Precise()->layout->get_main_content_css_class('col-xs-12 site-content'))?>">
                <div class="site-content-inner">

                    <?php do_action( 'precise/action/before_render_main_inner' );?>

                    <div class="page-content">
                        <div class="single-post-content single-portfolio-content clearfix">
                            <?php

                            do_action( 'precise/action/before_render_main_content' );

                            if($portfolio_style != 'use_vc'){
                                get_template_part('templates/portfolios/single/single', $portfolio_style);
                            }
                            else{
                                echo '<div class="portfolio-single-page">';
                                the_content();
                                echo '</div>';
                            }
                            do_action( 'precise/action/after_render_main_content' );

                            ?>
                        </div>
                    </div>

                    <?php do_action( 'precise/action/after_render_main_inner' );?>
                </div>
            </main>
            <!-- #site-content -->
            <?php get_sidebar();?>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="portfolio-nav">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-4">
                <?php
                $prev = get_previous_post(false,'','la_portfolio_category');
                if(!empty($prev) && isset($prev->ID)){
                    if(has_post_thumbnail($prev->ID)){
                        printf(
                            '<a href="%s" style="%s"><i class="fa-angle-left"></i><span>%s</span></a>',
                            get_the_permalink($prev->ID),
                            'background-image: url('.esc_url( get_the_post_thumbnail_url($prev->ID) ).')',
                            get_the_title($prev->ID)
                        );
                    }
                }
                ?>
            </div>
            <div class="col-xs-4">
                <?php
                $post_terms = wp_get_post_terms( get_the_ID(), 'la_portfolio_category' );
                if ( is_array( $post_terms ) && isset( $post_terms[0] ) && is_object( $post_terms[0] ) ) {
                    $term_id = $post_terms[0]->term_id;
                    echo '<div class="nav-parents">';
                    echo sprintf('<a href="%s"><i class="precise-icon-grid"></i></a>',
                        esc_url(get_term_link($term_id, 'la_portfolio_category'))
                    );
                    echo '</div>';
                }
                ?>
            </div>
            <div class="col-xs-4">
                <?php
                $next = get_next_post(false,'','la_portfolio_category');
                if(!empty($next) && isset($next->ID)){
                    if(has_post_thumbnail($next->ID)){
                        printf(
                            '<a href="%s" style="%s"><span>%s</span><i class="fa-angle-right"></i></a>',
                            get_the_permalink($next->ID),
                            'background-image: url('.esc_url( get_the_post_thumbnail_url($next->ID) ).')',
                            get_the_title($next->ID)
                        );
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- .site-main -->
<?php do_action( 'precise/action/after_render_main' ); ?>
<?php get_footer();?>