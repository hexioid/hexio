<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

class Precise_Widget_Recent_Posts extends WP_Widget_Recent_Posts {

    public function __construct() {
        parent::__construct();
        $this->id_base = 'la-recent-posts';
        $this->name = esc_html_x( '[Precise] - Recent Posts', 'backend-view', 'precise' );
        $this->option_name = 'widget_' . $this->id_base;
        $this->control_options = array( 'id_base' => $this->id_base );
    }

    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : _x( 'Recent Posts', 'front-view', 'precise' );

        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );

        if ($r->have_posts()) :
            ?>
            <?php echo $args['before_widget']; ?>
            <?php if ( $title ) {
            echo ($args['before_title'] . $title . $args['after_title']);
        } ?>
            <ul>
                <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <li>
                        <div class="pr-item">
                            <div class="pr-item--left">
                                <?php if(has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');?>)"><span class="hidden"><?php the_title();?></span></a>
                                <?php endif; ?>
                            </div>
                            <div class="pr-item--right">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <?php if ( $show_date ) : ?>
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php echo ($args['after_widget']); ?>
            <?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

        endif;
    }

}