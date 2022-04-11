<?php if ( ! defined( 'ABSPATH' ) ) { die; }

if(!function_exists('precise_entry_meta_item_postdate')){
    function precise_entry_meta_item_postdate(){
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated hidden" datetime="%3$s">%4$s</time>';
        }
        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );
        printf(
            '<span class="posted-on"><a href="%1$s" rel="bookmark"><i class="fa-clock-o"></i><span class="screen-reader-text">%2$s </span>%3$s</a></span>',
            esc_url( get_permalink() ),
            esc_html_x('Posted on', 'front-view', 'precise'),
            $time_string
        );
    }
}
if(!function_exists('precise_entry_meta_item_author')){
    function precise_entry_meta_item_author(){
        printf(
            '<span class="byline"><span class="author vcard"><a class="url fn n" href="%1$s"><i class="fa-user-o"></i><span class="screen-reader-text">%2$s </span>%3$s</a></span></span>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_html_x('by', 'front-view', 'precise'),
            esc_html( get_the_author() )
        );
    }
}
if(!function_exists('precise_entry_meta_item_category_list')){
    function precise_entry_meta_item_category_list($before = '', $after = '', $separator = ', ', $parents = '', $post_id = false){
        add_filter('get_the_terms', 'precise_exclude_demo_term_in_category');
        $categories_list = get_the_category_list('{{_}}', $parents, $post_id );
        remove_filter('get_the_terms', 'precise_exclude_demo_term_in_category');
        if ( $categories_list ) {
            printf(
                '%3$s<span class="screen-reader-text">%1$s </span><span>%2$s</span>%4$s',
                esc_html_x('Posted in', 'front-view', 'precise'),
                str_replace('{{_}}', $separator, $categories_list),
                $before,
                $after
            );
        }
    }
}

if(!function_exists('precise_exclude_demo_term_in_category')){
    function precise_exclude_demo_term_in_category( $term ){
        return apply_filters('precise/post_category_excluded', $term);
    }
}

if(!function_exists('precise_entry_meta_item_comment_post_link')){
    function precise_entry_meta_item_comment_post_link(){
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link();
            echo '</span>';
        }
    }
}
if(!function_exists('precise_entry_meta_item_post_love')) {
    function precise_entry_meta_item_post_love()
    {
        echo '<span class="post-love-count">';
        $post_love_count = get_post_meta(get_the_ID(), '_la_love_count', true);
        printf(
            '<a data-post-id="%s" href="%s">%s</a>',
            esc_attr(get_the_ID()),
            esc_url( get_permalink() ),
            absint($post_love_count)
        );
        echo '</span>';
    }
}

if(!function_exists('precise_single_post_thumbnail')){
    function precise_single_post_thumbnail( $thumbnail_size = 'full'){
        if ( post_password_required() || is_attachment() ) {
            return;
        }
        $flag_format_content = false;

        switch(get_post_format()){
            case 'link':
                $link = Precise()->settings->get_post_meta( get_the_ID(), 'format_link' );
                if(!empty($link)){
                    printf(
                        '<div class="entry-thumbnail format-link" %2$s><div class="format-content">%1$s</div><a class="post-link-overlay" href="%1$s"></a></div>',
                        esc_url($link),
                        ''
                    /* has_post_thumbnail() ? 'style="background-image:url('.Precise()->images->get_post_thumbnail_url(get_the_ID()).')"' : '' */
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
                        '<div class="entry-thumbnail format-quote" style="%3$s"><div class="format-content">%1$s</div><a class="post-link-overlay" href="%2$s"></a></div>',
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
                        '<div class="post-item"><div class="entry-thumbnail format-gallery"><div class="la-slick-slider" data-slider_config="%1$s">%2$s</div></div></div>',
                        esc_attr(json_encode(array(
                            'slidesToShow' => 1,
                            'slidesToScroll' => 1,
                            'dots' => false,
                            'arrows' => true,
                            'speed' => 300,
                            'autoplay' => false,
                            'prevArrow'=> '<button type="button" class="slick-prev"><i class="precise-icon-arrows-minimal-left"></i></button>',
                            'nextArrow'=> '<button type="button" class="slick-next"><i class="precise-icon-arrows-minimal-right"></i></button>'
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
                        '<div class="entry-thumbnail format-embed"><div class="la-media-wrapper la-media-aspect-%2$s">%1$s</div></div>',
                        $embed_source,
                        esc_attr($embed_aspect_ration ? $embed_aspect_ration : 'origin')
                    );
                }
                break;
        }

        if(!$flag_format_content && has_post_thumbnail()){ ?>
            <div class="entry-thumbnail">
                <a href="<?php the_permalink();?>">
                    <?php Precise()->images->the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
                    <span class="pf-icon pf-icon-<?php echo get_post_format() ? get_post_format() : 'standard' ?>"></span>
                </a>
            </div>
            <?php
        }

    }
}

if(!function_exists('precise_social_sharing')){
    function precise_social_sharing( $post_link = '', $post_title = '', $image = '', $echo = true){
        if(empty($post_link) || empty($post_title)){
            return;
        }
        if(!$echo){
            ob_start();
        }
        echo '<div class="social--sharing">';
        if(Precise()->settings->get('sharing_facebook') || 'on' == Precise()->settings->get('sharing_facebook')){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="facebook" title="%2$s"><i class="fa fa-facebook"></i></a>',
                esc_url( 'https://www.facebook.com/sharer.php?u=' . $post_link ),
                esc_attr_x('Share this post on Facebook', 'front-view', 'precise')
            );
        }
        if(Precise()->settings->get('sharing_twitter') || 'on' == Precise()->settings->get('sharing_twitter')){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="twitter" title="%2$s"><i class="fa fa-twitter"></i></a>',
                esc_url( 'https://twitter.com/intent/tweet?text=' . $post_title . '&url=' . $post_link ),
                esc_attr_x('Share this post on Twitter', 'front-view', 'precise')
            );
        }
        if(Precise()->settings->get('sharing_reddit') || 'on' == Precise()->settings->get('sharing_reddit')){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="reddit" title="%2$s"><i class="fa fa-reddit"></i></a>',
                esc_url( 'https://www.reddit.com/submit?url=' . $post_link . '&title=' . $post_title ),
                esc_attr_x('Share this post on Reddit', 'front-view', 'precise')
            );
        }
        if(Precise()->settings->get('sharing_linkedin') || 'on' == Precise()->settings->get('sharing_linkedin')){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="linkedin" title="%2$s"><i class="fa fa-linkedin"></i></a>',
                esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . $post_link . '&title=' . $post_title ),
                esc_attr_x('Share this post on Linked In', 'front-view', 'precise')
            );
        }
        if(Precise()->settings->get('sharing_google_plus') || 'on' == Precise()->settings->get('sharing_google_plus')){
            printf('<a href="%1$s" rel="nofollow" class="google-plus" title="%2$s"><i class="fa fa-google-plus"></i></a>',
                esc_url( 'https://plus.google.com/share?url=' . $post_link ),
                esc_attr_x('Share this post on Google Plus', 'front-view', 'precise')
            );
        }
        if(Precise()->settings->get('sharing_tumblr') || 'on' == Precise()->settings->get('sharing_tumblr')){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="tumblr" title="%2$s"><i class="fa fa-tumblr"></i></a>',
                esc_url( 'https://www.tumblr.com/share/link?url=' . $post_link ) ,
                esc_attr_x('Share this post on Tumblr', 'front-view', 'precise')
            );
        }
        if(Precise()->settings->get('sharing_pinterest') || 'on' == Precise()->settings->get('sharing_pinterest')){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="pinterest" title="%2$s"><i class="fa fa-pinterest-p"></i></a>',
                esc_url( 'https://pinterest.com/pin/create/button/?url=' . $post_link . '&media=' . $image . '&description=' . $post_title) ,
                esc_attr_x('Share this post on Pinterest', 'front-view', 'precise')
            );
        }
        if(Precise()->settings->get('sharing_vk') || 'on' == Precise()->settings->get('sharing_vk')){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="vk" title="%2$s"><i class="fa fa-vk"></i></a>',
                esc_url( 'http://vkontakte.ru/share.php?url=' . $post_link . '&title=' . $post_title ) ,
                esc_attr_x('Share this post on VK', 'front-view', 'precise')
            );
        }
        if(Precise()->settings->get('sharing_email') || 'on' == Precise()->settings->get('sharing_email')){
            printf('<a target="_blank" href="%1$s" rel="nofollow" class="email" title="%2$s"><i class="fa fa-envelope"></i></a>',
                esc_url( 'mailto:?subject=' . $post_title . '&body=' . $post_link ),
                esc_attr_x('Share this post via Email', 'front-view', 'precise')
            );
        }
        echo '</div>';
        if(!$echo){
            return ob_get_clean();
        }
    }
}

if(!function_exists('precise_the_pagination')){
    function precise_the_pagination($args = array(), $query = null) {
        if(null === $query) {
            $query = $GLOBALS['wp_query'];
        }
        if($query->max_num_pages < 2) {
            return;
        }
        $paged        = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $wp_rewrite  = $GLOBALS['wp_rewrite'];
        $query_args   = array();
        $url_parts    = explode('?', $pagenum_link);
        if(isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }

        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
        $pagenum_link = trailingslashit($pagenum_link) . '%_%';

        $format  = $wp_rewrite->using_index_permalinks() && ! strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';
        printf('<div class="la-pagination">%s</div>',
            paginate_links(array_merge(array(
                'base'     => $pagenum_link,
                'format'   => $format,
                'total'    => $query->max_num_pages,
                'current'  => $paged,
                'mid_size' => 1,
                'add_args' => array_map('urlencode', $query_args),
                'prev_text'    => esc_html_x('Prev', 'front-view', 'precise'),
                'next_text'    => esc_html_x('Next', 'front-view', 'precise'),
                'type'         => 'list'
            ), $args))
        );
    }
}

if(!function_exists('precise_get_social_media')){
    function precise_get_social_media( $style = 'default', $el_class = ''){
        $css_class = implode(' ', array(
                'social-media-link',
                'style-' . $style
            )) ;
        $css_class .= ' ' . $el_class;

        $social_links = Precise()->settings->get('social_links', array());
        if(!empty($social_links)){
            echo '<div class="'.esc_attr($css_class).'">';
            foreach($social_links as $item){
                if(!empty($item['link']) && !empty($item['icon'])){
                    $title = isset($item['title']) ? $item['title'] : '';
                    printf(
                        '<a href="%1$s" class="%2$s" title="%3$s" target="_blank" rel="nofollow"><i class="%4$s"></i></a>',
                        esc_url($item['link']),
                        esc_attr(sanitize_title($title)),
                        esc_attr($title),
                        esc_attr($item['icon'])
                    );
                }
            }
            echo '</div>';
        }
    }
}
if(!function_exists('precise_get_portfolio_social_media')){
    function precise_get_portfolio_social_media($post_id = 0, $el_class = ''){

        $css_class = 'social--sharing ' . $el_class;

        $social_links = Precise()->settings->get_post_meta($post_id,'social_links');

        if(!empty($social_links) && is_array($social_links)){
            echo '<div class="'.esc_attr($css_class).'">';
            foreach($social_links as $item){
                if(!empty($item['link']) && !empty($item['icon'])){
                    $title = isset($item['title']) ? $item['title'] : '';
                    $custom_style = array();
                    if(!empty($item['text_color'])){
                        $custom_style[] = "color:" .$item['text_color'];
                    }
                    if(!empty($item['bg_color'])){
                        $custom_style[] = "background-color:" .$item['bg_color'];
                    }
                    printf(
                        '<a href="%1$s" class="%2$s" title="%3$s" style="%5$s" target="_blank" rel="nofollow"><i class="%4$s"></i></a>',
                        esc_url($item['link']),
                        esc_attr(sanitize_title($title)),
                        esc_attr($title),
                        esc_attr($item['icon']),
                        esc_attr(implode(';', $custom_style))
                    );
                }
            }
            echo '</div>';
        }
    }
}

if(!function_exists('precise_comment_form_callback')) {
    function precise_comment_form_callback($comment, $args, $depth){
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li id="pingback-comment-<?php comment_ID(); ?>">
                <p class="cmt-pingback"><?php echo esc_html_x('Pingback:', 'front-view', 'precise'); ?><?php comment_author_link(); ?><?php edit_comment_link(esc_html_x('Edit', 'front-view', 'precise'), '<span class="ping-meta"><span class="edit-link">', '</span></span>'); ?></p>
                <?php
                break;
            default :
                // Proceed with normal comments.
                ?>
            <li id="li-comment-<?php echo esc_attr(get_comment_ID()); ?>" <?php comment_class('clearfix'); ?>>
                <div id="comment-<?php echo esc_attr(get_comment_ID()); ?>" class="comment_container clearfix">
                    <?php echo get_avatar($comment, $args['avatar_size']); ?>
                    <div class="comment-text">
                        <div class="description"><?php comment_text(); ?></div>
                        <div class="comment-meta">
                            <div class="comment-author"><?php comment_author_link(); ?></div><?php
                            printf('<time datetime="%1$s">%2$s</time>',
                                get_comment_time('c'),
                                sprintf(esc_html_x('%1$s', '1: date', 'precise'), get_comment_date())
                            );
                            edit_comment_link(esc_html_x('Edit', 'front-view', 'precise'), ' <span class="edit-link">', '</span>'); ?>
                            <?php if ('0' == $comment->comment_approved) : ?>
                                <em class="comment-awaiting-moderation"><?php echo esc_html_x('Your comment is awaiting moderation.', 'front-view', 'precise'); ?></em>
                            <?php endif; ?>
                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        </div>
                    </div>
                </div>
                <?php
                break;
        endswitch;
    }
}