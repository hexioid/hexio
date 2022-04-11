<?php

global $precise_loop;

$blog_design            = isset($precise_loop['blog_design']) ? $precise_loop['blog_design'] : 'grid';
$title_tag              = 'h2';
$show_featured_image    = (Precise()->settings->get('featured_images_blog') == 'on') ? true : false;
$show_format_content    = false;
$tmp_img_size           = Precise_Helper::get_image_size_from_string(Precise()->settings->get('blog_thumbnail_size', 'full'), 'full');
$content_display_type   = ( Precise()->settings->get('blog_content_display', 'excerpt') == 'excerpt') ? 'excerpt' : 'full';
$post_class             = array('loop-item','grid-item', 'blog_item');
if($show_featured_image){
    $show_format_content    = (Precise()->settings->get('format_content_blog') == 'on') ? true : false;
}

if($show_featured_image){
    $post_class[] = 'show-featured-image';
}else{
    $post_class[] = 'hide-featured-image';
}
if($show_format_content){
    $post_class[] = 'show-format-content';
}else{
    $post_class[] = 'hide-format-content';
}
if($content_display_type != 'full' && !Precise()->settings->get('blog_excerpt_length')){
    $post_class[] = 'hide-excerpt';
}

$thumbnail_size = $tmp_img_size;

$loop_index = isset($precise_loop['loop_index']) ? $precise_loop['loop_index'] : 0;
$loop_index++;
$precise_loop['loop_index'] = $loop_index;


$thumbnail_size = apply_filters('precise/filter/blog/post_thumbnail', $thumbnail_size, $precise_loop);
?>
<article <?php post_class($post_class); ?>>
    <div class="blog_item--inner item-inner">
        <div class="blog_item--inner2 item-inner-wrap">
            <?php
            if($show_featured_image){
                $flag_format_content = false;
                if($show_format_content){
                    switch(get_post_format()){
                        case 'link':
                            $link = Precise()->settings->get_post_meta( get_the_ID(), 'format_link' );
                            if(!empty($link)){
                                printf(
                                    '<div class="blog_item--thumbnail format-link" %2$s><div class="format-content">%1$s</div><a class="post-link-overlay" href="%1$s"></a></div>',
                                    esc_url($link),
                                    ''
                                );
                                $flag_format_content = true;
                            }
                            break;
                        case 'quote':
                            $quote_content = Precise()->settings->get_post_meta(get_the_ID(), 'format_quote_content');
                            $quote_author = Precise()->settings->get_post_meta(get_the_ID(), 'format_quote_author');
                            $quote_background = Precise()->settings->get_post_meta(get_the_ID(), 'format_quote_background');
                            $quote_color = Precise()->settings->get_post_meta(get_the_ID(), 'format_quote_color');
                            if(!empty($quote_content)){
                                $quote_content = '<p class="format-quote-content">'. $quote_content .'</p>';
                                if(!empty($quote_author)){
                                    $quote_content .= '<span class="quote-author">'. $quote_author .'</span>';
                                }
                                $styles = array();
                                $styles[] = 'background-color:' . $quote_background;
                                $styles[] = 'color:' . $quote_color;
                                printf(
                                    '<div class="blog_item--thumbnail format-quote" style="%3$s"><div class="format-content">%1$s</div><a class="post-link-overlay" href="%2$s"></a></div>',
                                    $quote_content,
                                    get_the_permalink(),
                                    esc_attr( implode(';', $styles) )
                                );
                                $flag_format_content = true;
                            }

                            break;

                        case 'gallery':
                            $ids = Precise()->settings->get_post_meta(get_the_ID(), 'format_gallery');
                            $ids = explode(',', $ids);
                            $ids = array_map('trim', $ids);
                            $ids = array_map('absint', $ids);
                            $__tmp = '';
                            if(!empty( $ids )){
                                foreach($ids as $image_id){
                                    $__tmp .= sprintf('<div><a href="%1$s">%2$s</a></div>',
                                        get_the_permalink(),
                                        Precise()->images->get_attachment_image( $image_id, $thumbnail_size)
                                    );
                                }
                            }
                            if(has_post_thumbnail()){
                                $__tmp .= sprintf('<div><a href="%1$s">%2$s</a></div>',
                                    get_the_permalink(),
                                    Precise()->images->get_post_thumbnail(get_the_ID(), $thumbnail_size )
                                );
                            }
                            if(!empty($__tmp)){
                                printf(
                                    '<div class="blog_item--thumbnail format-gallery"><div class="la-slick-slider" data-slider_config="%1$s">%2$s</div></div>',
                                    esc_attr(json_encode(array(
                                        'slidesToShow' => 1,
                                        'slidesToScroll' => 1,
                                        'dots' => false,
                                        'arrows' => true,
                                        'speed' => 300,
                                        'autoplay' => false,
                                        'prevArrow'=> '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
                                        'nextArrow'=> '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>'
                                    ))),
                                    $__tmp
                                );
                                $flag_format_content = true;
                            }
                            break;

                        case 'audio':
                        case 'video':
                            $embed_source = Precise()->settings->get_post_meta(get_the_ID(), 'format_embed');
                            $embed_aspect_ration = Precise()->settings->get_post_meta(get_the_ID(), 'format_embed_aspect_ration');
                            if(!empty($embed_source)){
                                $flag_format_content = true;
                                printf(
                                    '<div class="blog_item--thumbnail format-embed"><div class="la-media-wrapper la-media-aspect-%2$s">%1$s</div></div>',
                                    $embed_source,
                                    esc_attr($embed_aspect_ration ? $embed_aspect_ration : 'origin')
                                );
                            }
                            break;
                    }
                }
                if(!$flag_format_content && has_post_thumbnail()){ ?>
                    <div class="blog_item--thumbnail blog_item--thumbnail blog_item--thumbnail-with-effect">
                        <a href="<?php the_permalink();?>">
                            <?php Precise()->images->the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
                            <span class="pf-icon pf-icon-<?php echo get_post_format() ? get_post_format() : 'standard' ?>"></span>
                            <div class="item--overlay"></div>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="blog_item--info clearfix">
                <?php
                precise_entry_meta_item_category_list('<div class="blog_item--category-link">','</div>','');
                ?>
                <header class="blog_item--title entry-header">
                    <?php the_title( sprintf( '<%s class="entry-title"><a href="%s">',$title_tag, esc_url( get_the_permalink() ) ), sprintf('</a></%s>', $title_tag) ); ?>
                </header>
                <div class="blog_item--meta entry-meta clearfix"><?php
                    precise_entry_meta_item_author();
                    precise_entry_meta_item_postdate();
                ?></div><!-- .entry-meta -->
                <?php
                if($content_display_type != 'full'){
                    if( Precise()->settings->get('blog_excerpt_length') ){
                        echo '<div class="blog_item--excerpt entry-excerpt">';
                        the_excerpt();
                        echo '</div>';
                    }
                }
                else{
                    echo '<div class="blog_item--excerpt entry-content">';
                    the_content( esc_html_x( 'Continue reading', 'front-view', 'precise' ) );
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html_x( 'Pages:', 'front-view', 'precise' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . esc_html_x( 'Page', 'front-view', 'precise' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                    echo '</div>';
                }
                ?>
                <?php if($content_display_type != 'full' && Precise()->settings->get('blog_excerpt_length') ) :?>
                <footer class="blog_item--meta-footer clearfix">
                    <a class="btn btn-style-outline btn-size-sm btn-color-gray btn-shape-round btn-brw-2" href="<?php the_permalink();?>"><?php echo esc_html_x('Read more', 'front-view', 'precise'); ?></a>
                </footer>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>