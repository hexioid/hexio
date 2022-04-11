<?php
global $precise_loop;
$thumbnail_size = (isset($precise_loop['image_size']) && !empty($precise_loop['image_size']) ? $precise_loop['image_size'] : 'thumbnail');
$title_tag      = (isset($precise_loop['title_tag']) && !empty($precise_loop['title_tag']) ? $precise_loop['title_tag'] : 'h3');
$role           = Precise()->settings->get_post_meta(get_the_ID(), 'role');
$post_class     = array('loop-item','grid-item','la-member');
$email          = Precise()->settings->get_post_meta(get_the_ID(), 'email');
$phone          = Precise()->settings->get_post_meta(get_the_ID(), 'phone');
?>
<article <?php post_class($post_class)?>>
    <div class="la-member__inner item-inner">
        <div class="la-member__image">
            <a href="javascript:;"><?php
                Precise()->images->the_post_thumbnail(get_the_ID(), $thumbnail_size);
            ?><div class="item--overlay"></div></a>
        </div>
        <div class="la-member__info">
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
            <div class="member-social">
                <?php if(!empty($email)): ?>
                    <?php echo sprintf('<a class="social-email email" href="%s"><i class="fa fa-envelope"></i><span>%s</span></a>', esc_url('mailto:'.$email), esc_html($email)) ?>
                <?php endif; ?>
                <?php if(!empty($phone)): ?>
                    <?php echo sprintf('<a class="social-phone phone" href="javascript:;"><i class="fa fa-phone"></i><span>%s</span></a>', esc_html($phone)) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>