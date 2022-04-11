<?php
$gallery = Precise()->settings->get_post_meta(get_the_ID(),'gallery');
$client = Precise()->settings->get_post_meta(get_the_ID(),'client');
$timeline = Precise()->settings->get_post_meta(get_the_ID(),'timeline');
$location = Precise()->settings->get_post_meta(get_the_ID(),'location');
$website = Precise()->settings->get_post_meta(get_the_ID(),'website');
if(!empty($gallery)){
    $gallery = explode(',', $gallery);
}
$main_class = 'col-xs-12';
?>
<div class="portfolio-single-page style-1">
    <div class="row">
        <?php
        if(!empty($gallery) && is_array($gallery)){
            $main_class = 's-portfolio-right col-xs-12';
            echo '<div class="s-portfolio-left col-xs-12">';
            echo '<div class="pf-gal-items la-slick-slider" data-slider_config=\'{"autoplay":true}\'>';
            Precise()->images->before_resize();
            foreach($gallery as $g_id){
                printf(
                    '<div class="gal-item"><a href="%1$s" class="la-popup-slideshow" data-rel="pf:galley">%2$s</a></div>',
                    wp_get_attachment_image_url($g_id, 'full'),
                    wp_get_attachment_image($g_id, array(1170,570))
                );
            }
            Precise()->images->after_resize();
            echo '</div>';
            echo '</div>';
        }
        ?>
        <div class="<?php echo esc_attr($main_class)?>">
            <div class="pf-title-wap">
                <h1 class="pf-title h2"><?php the_title();?></h1>
                <div class="entry-tax-list">
                    <?php echo get_the_term_list(get_the_ID(), 'la_portfolio_category');?>
                </div>
                <div class="portfolio-social-links"><?php precise_social_sharing(get_the_permalink(), get_the_title(), (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : '')); ?></div>
            </div>
            <div class="clearfix"></div>
            <div class="portfolio-meta-datawrap clearfix">
                <div class="portfolio-meta-data inline-meta">
                    <?php
                    if(!empty($client)){
                        echo sprintf('<div class="meta-item"><span class="precise-icon fa-user-circle-o"></span><span>%s</span></div>', esc_html($client));
                    }
                    if(!empty($timeline)){
                        echo sprintf('<div class="meta-item"><span class="precise-icon fa-calendar"></span><span>%s</span></div>', esc_html($timeline));
                    }
                    if(!empty($location)){
                        echo sprintf('<div class="meta-item"><span class="precise-icon fa-map-marker"></span><span>%s</span></div>', esc_html($location));
                    }
                    if(!empty($website)){
                        echo sprintf('<div class="meta-item"><span class="precise-icon fa-external-link"></span><span>%s</span></div>', esc_html($website));
                    }
                    ?>
                </div>
            </div>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>