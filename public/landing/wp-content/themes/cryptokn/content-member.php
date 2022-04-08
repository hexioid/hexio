<?php
/*
Template Name: Template Member
Template Post Type: member
*/
get_header(); ?>

<!-- HEADER TITLE BREADCRUBS SECTION -->
<?php 
$breadcrumbs_on_off             = get_post_meta( get_the_ID(), 'breadcrumbs_on_off',               true );
if ( function_exists('modeltheme_framework')) {
    if (isset($breadcrumbs_on_off) && $breadcrumbs_on_off == 'yes' || $breadcrumbs_on_off == '') {
        echo cryptokn_header_title_breadcrumbs();
    }
}else{
    echo wp_kses_post(cryptokn_header_title_breadcrumbs());
}
?>


<div class="container">
	<?php the_content(); ?>
</div>

<?php get_footer(); ?>


