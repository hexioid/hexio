<?php
//GET HEADER TITLE/BREADCRUMBS AREA
function cryptokn_header_title_breadcrumbs(){

    $html = '';
    $html .= '<div class="header-title-breadcrumb relative">';

    if(cryptokn_redux('mt_breadcrumbs_image', 'url')) {

        $html .= '<img src="'.esc_url(cryptokn_redux('mt_breadcrumbs_image', 'url')).'" class="img-responsive single-post-featured-img" alt="'.esc_attr__('Featured Image', 'cryptokn').'" />';
    } else {
        $html .= '<img src="'.esc_url(get_template_directory_uri().'/images/breadcrumbs_image_default.jpg').'" class="img-responsive single-post-featured-img" alt="'.esc_attr__('Featured Image', 'cryptokn').'" />';
    } 
        $html .= '<div class="header-title-breadcrumb-overlay text-center">
                        
                        <div class="container flex">
                            <div class="breadcrumbs-text-holder">
                                <div class="col-md-12 text-center">';
                                    if (is_singular('post')) {
                                        $html .= '<h1>'.esc_html__( 'Blog', 'cryptokn' ) . get_search_query().'</h1>';
                                    }elseif (class_exists( 'WooCommerce' ) && is_shop()) {
                                        $html .= '<h1>'.esc_html__( 'Shop', 'cryptokn' ).'</h1>';
                                    }elseif (is_page()) {
                                        $html .= '<h1>'.get_the_title().'</h1>';
                                    }elseif (is_search()) {
                                        $html .= '<h1>'.esc_html__( 'Search Results for: ', 'cryptokn' ) . get_search_query().'</h1>';
                                    }elseif (is_category()) {
                                        $html .= '<h1>'.esc_html__( 'Category: ', 'cryptokn' ).' <span>'.single_cat_title( '', false ).'</span></h1>';
                                    }elseif (is_tag()) {
                                        $html .= '<h1>'.esc_html__( 'Tag Archives: ', 'cryptokn' ) . single_tag_title( '', false ).'</h1>';
                                    }elseif (is_author() || is_archive()) {
                                        $html .= '<h1>'.get_the_archive_title() . get_the_archive_description().'</h1>';
                                    }elseif (is_home()) {
                                        $html .= '<h1>'.esc_html__( 'From the Blog', 'cryptokn' ).'</h1>';
                                    }else {
                                        $html .= '<h1>'.get_the_title().'</h1>';
                                    }
                      $html .= '</div>
                                <div class="col-md-12">
                                    <ol class="breadcrumb text-center">'.cryptokn_breadcrumb().'</ol>                    
                                </div>
                            </div>
                        </div>
                    </div>';

    $html .= '</div>';
    $html .= '<div class="clearfix"></div>';

    return $html;
}

?>