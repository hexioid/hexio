<?php

$id = $name = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract($atts);

if ($id || $name) {
    $el_class = $this->getExtraClass( $el_class );
    $query_args = array( 'post_type' => 'la_block' );
    if ($id){
        $query_args['p'] = (int) $id;
    }
    if ($name){
        $query_args['name'] = $name;
    }

    $the_query = new WP_Query($query_args);

    if ($the_query->have_posts()) {
        while($the_query->have_posts()){
            $the_query->the_post();
            wp_enqueue_script('wpb_composer_front_js');
            $shortcodes_custom_css = get_post_meta( get_the_ID(), '_wpb_post_custom_css', true );
        ?>
        <div class="la-static-block<?php echo esc_attr($el_class)?>">
            <?php the_content();?>
        </div>
        <?php if($shortcodes_custom_css):?>
            <style type="text/css" data-type="vc_shortcodes-custom-css"><?php echo $shortcodes_custom_css;?></style>
        <?php endif;?>
        <?php
        }
    }

    wp_reset_postdata();
}