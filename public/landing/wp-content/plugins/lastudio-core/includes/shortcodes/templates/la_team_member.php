<?php
if (!defined('ABSPATH')){
    die('-1');
}

$output = $excerpt_length = '';
$per_page = '';
$style = $ids = $enable_carousel = $column = $img_size = $el_class = $scroll_speed = $advanced_opts = $autoplay_speed = $custom_nav = $title_tag = '';
$enable_loadmore = false;
$paged = 1;
$load_more_text = __('Load More', 'la-studio');
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$_tmp_class = 'la-team-member';
$el_class = $_tmp_class . $this->getExtraClass($el_class);

if(!empty($ids)){
    $ids = explode(',', $ids);
    $ids = array_map('trim', $ids);
    $ids = array_map('absint', $ids);
}

$unique_id = uniqid('la-team-member-');
$query_args = array(
    'post_type' => 'la_team_member',
    'posts_per_page' => $per_page,
    'paged'=> $paged
);
if(!empty($ids)){
    $query_args['post__in'] = $ids;
    $query_args['orderby'] = 'post__in';
}

$globalVar = apply_filters('LaStudio/global_loop_variable', 'lastudio_loop');

$globalVarTmp = (isset($GLOBALS[$globalVar]) ? $GLOBALS[$globalVar] : '');
$globalParams = array();
$globalParams['loop_id'] = $unique_id;
$globalParams['loop_style'] = $style;
$globalParams['responsive_column'] = LaStudio_Shortcodes_Helper::getColumnFromShortcodeAtts($column);
$globalParams['image_size'] = LaStudio_Shortcodes_Helper::getImageSizeFormString($img_size);
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
if( $the_query->have_posts() ){
    ?><div id="<?php echo esc_attr($unique_id);?>" class="<?php echo esc_attr($el_class)?>">
        <?php
        global $la_custom_excerpt_length;
        $la_custom_excerpt_length = $excerpt_length;
        add_filter('excerpt_length', create_function('','global $la_custom_excerpt_length; return $la_custom_excerpt_length;'), 1010);

        do_action('LaStudio/shortcodes/before_loop/', 'shortcode', $this->shortcode, $atts);

        get_template_part('templates/team-member/loop','start');

        while($the_query->have_posts()){

            $the_query->the_post();

            get_template_part('templates/team-member/loop', $style);

        }

        get_template_part('templates/team-member/loop','end');

        do_action('LaStudio/shortcodes/after_loop','shortcode', $this->shortcode, $atts);

        remove_all_filters('excerpt_length', 1010);

        if(isset($GLOBALS['la_custom_excerpt_length'])){
            unset($GLOBALS['la_custom_excerpt_length']);
        }

        if($enable_loadmore){
            echo sprintf(
                '<div class="elm-loadmore-ajax" data-query-settings="%s" data-request="%s" data-paged="%s" data-max-page="%s" data-container="#%s .team-member-loop" data-item-class=".team-member-item">%s<a href="#">%s</a></div>',
                esc_attr( json_encode( array(
                    'tag' => $this->shortcode,
                    'atts' => $atts
                ) ) ),
                esc_url( admin_url( 'admin-ajax.php', 'relative' ) ),
                esc_attr($paged),
                esc_attr($the_query->max_num_pages),
                esc_attr($unique_id),
                LaStudio_Shortcodes_Helper::getLoadingIcon(),
                esc_html($load_more_text)
            );
        }
        ?>
    </div><?php
}
$GLOBALS[$globalVar] = $globalVarTmp;
wp_reset_postdata();