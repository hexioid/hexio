<?php 

/**
||-> Shortcode: BlogPos02
*/

function modeltheme_shortcode_blogpost02($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'           =>'',
            'number'              =>'',
            'visible_items'       =>''
        ), $params ) );

    $html = '';
    $args_blogposts = array(
            'posts_per_page'   => $number,
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'post_status'      => 'publish' 
            ); 
    


    $html .= '<div class="row">';
    $html .= '<div class="blog-posts blog-posts-shortcode02 blog-posts-shortcode wow '.$animation.' blog_post02_container-'.$visible_items.' owl-carousel owl-theme">';
    
    $blogposts = get_posts($args_blogposts);
    foreach ($blogposts as $blogpost) {
        #thumbnail
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ),'cryptokn_news_shortcode_800x900' );



        if ($thumbnail_src) {
        	
            $post_img = '<img class="blog_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$blogpost->post_title.'" />';
            $post_col = 'col-md-12';
        }else{
        	$html.='<div class="background_overlay"></div>';
            $post_col = 'col-md-12 no-featured-image';
            $post_img = '';
        }

          $html.='<div class="single-post list-view">
                        <div class="blog_custom">
                        <div class="background_overlay"></div>
                          <!-- POST THUMBNAIL -->
                          <div class="col-md-12 post-thumbnail">
                              <a class="relative" href="'.get_permalink($blogpost->ID).'">'.$post_img.'</a>
                              
                          </div>
                          <!-- POST DETAILS -->
                          <div class="post_category_container">
                            <p class="post_category">'.wp_kses_post(get_the_term_list( $blogpost->ID, 'category', '<i class="icon-tag"></i>', ', ' )).'</p>
                          </div>
                          <div class="post-details '.$post_col.'">
                          <div class="title_container">
                            <h3 class="post-name row">
                              <a href="'.get_permalink($blogpost->ID).'" title="'. $blogpost->post_title .'">'. $blogpost->post_title .'</a>
                            </h3>
                          </div>
                          <div class="author_date_container">
                          	<p class="post_author"><i class="fa fa-user-circle-o"></i><a>'.get_the_author_meta( 'display_name').'</a></p>
                            <p class="post_date"><i class="fa fa-clock-o"></i>'.get_the_time(get_option( 'date_format' ),$blogpost->ID).'</p>
                          </div>
                          </div>
                        </div>
                      </div>';
      }
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode('blogpost02', 'modeltheme_shortcode_blogpost02');

/**
||-> Map Shortcode in Visual Composer with: vc_map();
*/

if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( array(
     "name" => esc_attr__("MT - Blog Posts 02", 'modeltheme'),
     "base" => "blogpost02",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Number of posts", 'modeltheme' ),
          "param_name" => "number",
          "value" => "",
          "description" => esc_attr__( "Enter number of blog post to show.", 'modeltheme' )
        ),
         array(
          "group" => "Options",
          "type" => "dropdown",
          "heading" => esc_attr__("Visible blog posts per slide", 'modeltheme'),
          "param_name" => "visible_items",
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => array(
            '1'   => '1',
            '2'   => '2',
            '3'   => '3',
            '4'   => '4'
            )
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => 'fadeInLeft',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
      )
  ));
}

?>