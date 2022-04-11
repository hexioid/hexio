<?php
if (!defined('ABSPATH')){
    die('-1');
}

$layout = $list_style = $grid_style = $masonry_style = $category__in = $category__not_in = $post__in = $post__not_in = $per_page = $title_tag = $excerpt_length = $img_size = $column = $enable_carousel = $el_class = $scroll_speed = $advanced_opts = $autoplay_speed = $custom_nav = '';
$orderby = $order = $img_size2 = '';
$paged = $load_more_text = $items_per_page = $style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$_tmp_class = 'wpb_content_element la-showposts';
$el_class = $_tmp_class . $this->getExtraClass($el_class);
$unique_id = uniqid('la-showposts-');

$query_args = array(
    'post_type'             => 'post',
    'post_status'		    => 'publish',
    'orderby'               => $orderby,
    'order'                 => $order,
    'ignore_sticky_posts'   => 1,
    'paged'                 => $paged,
    'posts_per_page'        => $per_page
);

if($style != 'all'){
    if($per_page != '-1' && $items_per_page > $per_page){
        $items_per_page = $per_page;
    }
    $query_args['posts_per_page'] = $items_per_page;
}

if ( $category__in ) {
    $category__in = explode( ',', $category__in );
    $category__in = array_map( 'trim', $category__in );
}
if ( $category__not_in ) {
    $category__not_in = explode( ',', $category__not_in );
    $category__not_in = array_map( 'trim', $category__not_in );
}
if ( $post__in ) {
    $post__in = explode( ',', $post__in );
    $post__in = array_map( 'trim', $post__in );
}
if ( $post__not_in ) {
    $post__not_in = explode( ',', $post__not_in );
    $post__not_in = array_map( 'trim', $post__not_in );
}
if ( !empty ( $category__in ) ) {
    $query_args['category__in'] = $category__in;
}
if ( !empty ( $category__not_in ) ) {
    $query_args['category__not_in'] = $category__not_in;
}
if ( !empty ( $post__in ) ) {
    $query_args['post__in'] = $post__in;
}
if ( !empty ( $post__not_in ) ) {
    $query_args['post__not_in'] = $post__not_in;
}

$globalVar = apply_filters('LaStudio/global_loop_variable', 'lastudio_loop');
$globalVarTmp = (isset($GLOBALS[$globalVar]) ? $GLOBALS[$globalVar] : '');
$globalParams = array();

$globalParams['loop_id'] = $unique_id;
$globalParams['loop_layout'] = $layout;
$globalParams['loop_style'] = ${$layout . '_style'};
$globalParams['responsive_column'] = LaStudio_Shortcodes_Helper::getColumnFromShortcodeAtts($column);
$globalParams['image_size'] = LaStudio_Shortcodes_Helper::getImageSizeFormString($img_size);
$globalParams['image_size2'] = LaStudio_Shortcodes_Helper::getImageSizeFormString($img_size2);
$globalParams['title_tag'] = $title_tag;
$globalParams['excerpt_length'] = $excerpt_length;
if($enable_carousel){
    $advanced_opts = explode(",", $advanced_opts);
    $carousel_configs= array_merge($globalParams['responsive_column'],array(
        'infinite' => in_array('loop', $advanced_opts) ? true : false,
        'dots' => in_array('dot', $advanced_opts) ? true : false,
        'autoplay' => in_array('autoplay', $advanced_opts) ? true : false,
        'arrows' => in_array('nav', $advanced_opts) ? true : false,
        'centerMode' => in_array('center_mode', $advanced_opts) ? true : false,
        'variableWidth' => in_array('variable_width', $advanced_opts) ? true : false,
        'speed' => $scroll_speed,
        'autoplaySpeed' => $autoplay_speed,
        'custom_nav' => $custom_nav
    ));
    $globalParams['slider_configs'] = LaStudio_Shortcodes_Helper::getSliderConfigs($carousel_configs);
}

$GLOBALS[$globalVar] = $globalParams;

$the_query = $this->query($query_args);
$max_paged = $the_query->max_num_pages;
$max_posts = $the_query->found_posts;
if($style != 'all'){
    if($per_page > 0){
        $__max_paged = ceil($per_page / $items_per_page);
        if($max_paged > $__max_paged){
            $max_paged = $__max_paged;
        }
        if($max_posts > $per_page){
            $max_posts = $per_page;
        }
    }
}

if( $the_query->have_posts() ){
    ?><div id="<?php echo esc_attr($unique_id);?>" class="<?php echo esc_attr($el_class)?>">
    <?php
    global $la_custom_excerpt_length;
    $la_custom_excerpt_length = $excerpt_length;

    add_filter('excerpt_length', create_function('','global $la_custom_excerpt_length; return $la_custom_excerpt_length;'), 1010);

    do_action('LaStudio/shortcodes/before_loop/', 'shortcode', $this->shortcode, $atts);

    $start_tpl = $end_tpl = $loop_tpl = array();

    $start_tpl[] = "templates/posts/{$layout}/start-" . ${$layout . '_style'} . ".php";
    $start_tpl[] = "templates/posts/{$layout}/start.php";
    $start_tpl[] = "templates/posts/start.php";
    $loop_tpl[] = "templates/posts/{$layout}/loop-" . ${$layout . '_style'} . ".php";
    $loop_tpl[] = "templates/posts/{$layout}/loop.php";
    $loop_tpl[] = "templates/posts/loop.php";
    $end_tpl[] = "templates/posts/{$layout}/end-" . ${$layout . '_style'} . ".php";
    $end_tpl[] = "templates/posts/{$layout}/end.php";
    $end_tpl[] = "templates/posts/end.php";

    locate_template($start_tpl, true, false);
    $i_counter = 1 * ($paged == 1 ? $paged : ($paged + 1));

    while($the_query->have_posts()){
        if($i_counter > $max_posts){
            break;
        }
        $the_query->the_post();
        locate_template($loop_tpl, true, false);
        $i_counter++;
    }

    locate_template($end_tpl, true, false);

    do_action('LaStudio/shortcodes/after_loop','shortcode', $this->shortcode, $atts);

    remove_all_filters('excerpt_length', 1010);

    if(isset($GLOBALS['la_custom_excerpt_length'])){
        unset($GLOBALS['la_custom_excerpt_length']);
    }

    if($style == 'load-more'){
        echo sprintf(
            '<div class="elm-loadmore-ajax" data-query-settings="%s" data-request="%s" data-paged="%s" data-max-page="%s" data-container="#%s .showposts-loop" data-item-class=".post-item">%s<a href="#">%s</a></div>',
            esc_attr( json_encode( array(
                'tag' => $this->shortcode,
                'atts' => $atts
            ) ) ),
            esc_url( admin_url( 'admin-ajax.php', 'relative' ) ),
            esc_attr($paged),
            esc_attr($max_paged),
            esc_attr($unique_id),
            LaStudio_Shortcodes_Helper::getLoadingIcon(),
            esc_html($load_more_text)
        );
    }
    if($enable_carousel != 'yes' && $style == 'pagination'){

        $__url = add_query_arg('la_paged', 999999999, add_query_arg(null,null));
        $_paginate_links = paginate_links( array(
            'base'         => esc_url_raw( str_replace( 999999999, '%#%', $__url ) ),
            'format'       => '?la_paged=%#%',
            'add_args'     => '',
            'current'      => max( 1, $paged ),
            'total'        => $max_paged,
            'prev_text'    => '<i class="fa-long-arrow-left"></i>',
            'next_text'    => '<i class="fa-long-arrow-right"></i>',
            'type'         => 'list'
        ) );

        printf('<div class="elm-pagination-ajax" data-query-settings="%s" data-request="%s" data-append-type="replace"
            data-paged="%s" data-parent-container="#%s" data-container="#%s .showposts-loop" data-item-class=".post-item"><div class="la-loading-icon">%s</div><div class="la-pagination">%s</div></div>',
            esc_attr( json_encode( array(
                'tag' => $this->shortcode,
                'atts' => $atts
            ))),
            esc_url( admin_url( 'admin-ajax.php', 'relative' ) ),
            esc_attr($paged),
            esc_attr($unique_id),
            esc_attr($unique_id),
            LaStudio_Shortcodes_Helper::getLoadingIcon(),
            $_paginate_links
        );
?>
<?php
    }
    ?>
    </div><?php
}
$GLOBALS[$globalVar] = $globalVarTmp;
wp_reset_postdata();