<?php

$post_class             = array('loop-item','grid-item', 'blog_item');

?>
<article <?php post_class($post_class); ?>>
    <div class="blog_item--inner item-inner">
        <div class="blog_item--inner2 item-inner-wrap">
            <div class="blog_item--info clearfix">
                <header class="blog_item--title entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( get_the_permalink() ) ), '</a></h2>' ); ?>
                </header>
                <div class="blog_item--meta entry-meta clearfix"><?php
                    precise_entry_meta_item_author();
                    precise_entry_meta_item_postdate();
                ?></div><!-- .entry-meta -->
                <div class="blog_item--excerpt entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <footer class="blog_item--meta-footer clearfix">
                    <a class="btn btn-style-outline btn-size-sm btn-color-gray btn-shape-round btn-brw-2" href="<?php the_permalink();?>"><?php echo esc_html_x('Read more', 'front-view', 'precise'); ?></a>
                </footer>
            </div>
        </div>
    </div>
</article>