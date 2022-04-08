<?php
global $precise_loop;
$thumbnail_size = (isset($precise_loop['image_size']) && !empty($precise_loop['image_size']) ? $precise_loop['image_size'] : 'thumbnail');
$title_tag      = (isset($precise_loop['title_tag']) && !empty($precise_loop['title_tag']) ? $precise_loop['title_tag'] : 'h3');
$role           = Precise()->settings->get_post_meta(get_the_ID(), 'role');
$post_class     = array('loop-item','grid-item','la-member');
?>
<article <?php post_class($post_class)?>>
    <div class="la-member__inner item-inner">
        <div class="la-member__image">
            <a href="javascript:;"><?php
                Precise()->images->the_post_thumbnail(get_the_ID(), $thumbnail_size);
            ?><div class="item--overlay"></div></a>
        </div>
        <div class="la-member__info">
            <div class="la-member__info-title-role">
                <?php
                printf(
                    '<%1$s class="%4$s"><a href="%2$s">%3$s</a></%1$s>',
                    esc_attr($title_tag),
                    'javascript:;',
                    get_the_title(),
                    'la-member__info-title'
                );
                if(!empty($role)){
                    printf(
                        '<p class="la-member__info-role">%s</p>',
                        esc_html($role)
                    );
                }
                ?>
            </div>
            <?php Precise()->template->member_social_template(get_the_ID()); ?>
        </div>
    </div>
</article>