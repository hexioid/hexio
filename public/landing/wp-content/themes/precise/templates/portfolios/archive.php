<?php
global $precise_loop;

$loop_layout = Precise()->settings->get('portfolio_display_type', 'grid');
$loop_style = Precise()->settings->get('portfolio_display_style', '1');

$precise_loop['loop_layout'] = $loop_layout;
$precise_loop['loop_style'] = $loop_style;
$precise_loop['responsive_column'] = Precise()->settings->get('portfolio_column', array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1));
$precise_loop['image_size'] = Precise_Helper::get_image_size_from_string(Precise()->settings->get('portfolio_thumbnail_size', 'full'),'full');
$precise_loop['title_tag'] = 'h4';
$precise_loop['excerpt_length'] = 15;
$precise_loop['item_gap'] = (int) Precise()->settings->get('portfolio_item_space', 0);

echo '<div id="archive_portfolio_listing" class="la-portfolio-listing">';

if( have_posts() ){

    get_template_part("templates/portfolios/{$loop_layout}/start", $loop_style);

    while( have_posts() ){

        the_post();

        get_template_part("templates/portfolios/{$loop_layout}/loop", $loop_style);

    }

    get_template_part("templates/portfolios/{$loop_layout}/end", $loop_style);

}

echo '</div>';
/**
 * Display pagination and reset loop
 */

precise_the_pagination();

wp_reset_postdata();