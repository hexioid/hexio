<?php
global $precise_loop;
$loop_style     = isset($precise_loop['loop_style']) ? $precise_loop['loop_style'] : 1;
$title_tag      = (isset($precise_loop['title_tag']) && !empty($precise_loop['title_tag']) ? $precise_loop['title_tag'] : 'div');
$role           = Precise()->settings->get_post_meta(get_the_ID(),'role');
$content        = Precise()->settings->get_post_meta(get_the_ID(),'content');
$avatar         = Precise()->settings->get_post_meta(get_the_ID(),'avatar');
$post_class     = array('loop-item','grid-item','testimonial_item');
?>
<div <?php post_class($post_class)?>>
    <div class="testimonial_item--inner item-inner">
        <?php if($avatar): ?>
            <div class="testimonial_item--image"><?php
                echo wp_get_attachment_image($avatar, 'full');
                ?></div>
        <?php endif; ?>
        <div class="testimonial_item--info">
            <div class="testimonial_item--excerpt"><?php echo esc_html($content);?></div>
        </div>
        <div class="testimonial_item--bottom">
            <div class="testimonial_item--title-role">
                <?php
                printf(
                    '<%1$s class="%4$s">%3$s</%1$s>',
                    esc_attr($title_tag),
                    'javascript:;',
                    get_the_title(),
                    'testimonial_item--title'
                );
                if(!empty($role)){
                    printf(
                        '<p class="testimonial_item--role">%s</p>',
                        esc_html($role)
                    );
                }
                ?>
            </div>
        </div>
    </div>
</div>