<?php if(get_the_author_meta('description')) : ?>
	<div class="author-info">
		<div class="author-info--inner">
			<div class="author-info__avatar author-avatar">
                <div class="author-info__avatar-inner">
                    <?php
                    printf( '<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'nicename' ) ) ),
                        get_the_author(),
                        get_avatar( get_the_author_meta( 'user_email' ), 170 )
                    );
                    ?>
                </div>
			</div>
            <div class="author-info__description author-description">
                <div class="author-info__title">
                    <?php
                    printf( '<div class="author-info__name"><a href="%1$s" title="%2$s" rel="author">%2$s</a><span>%3$s</span></div>',
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'nicename' ) ) ),
                        get_the_author(),
                        get_the_author_meta('author_custom')
                    );
                    ?>
                </div>
                <div class="author-info__bio author-bio">
                <?php
                    $author_facebook = get_the_author_meta('author_facebook');
                    $author_twitter = get_the_author_meta('author_twitter');
                    $author_pinterest = get_the_author_meta('author_pinterest');
                    $author_linkedin = get_the_author_meta('author_linkedin');
                    $author_gplus = get_the_author_meta('author_gplus');
                    $author_dribble = get_the_author_meta('author_dribble');
                    the_author_meta( 'description' );
                ?>
                </div>
                <div class="author-info__social">
                    <?php
                    if(!empty($author_facebook) || !empty($author_twitter) || !empty($author_pinterest) || !empty($author_linkedin) || !empty($author_gplus) || !empty($author_dribble)):
                        echo '<div class="social--sharing">';
                        if(!empty($author_facebook)){
                            printf('<a class="facebook" target="_blank" href="%s"><i class="fa fa-facebook"></i></a>', esc_url($author_facebook));
                        }
                        if(!empty($author_twitter)){
                            printf('<a class="twitter" target="_blank" href="%s"><i class="fa fa-twitter"></i></a>', esc_url($author_twitter));
                        }
                        if(!empty($author_pinterest)){
                            printf('<a class="pinterest" target="_blank" href="%s"><i class="fa fa-pinterest-p"></i></a>', esc_url($author_pinterest));
                        }
                        if(!empty($author_linkedin)){
                            printf('<a class="linkedin" target="_blank" href="%s"><i class="fa fa-linkedin"></i></a>', esc_url($author_linkedin));
                        }
                        if(!empty($author_gplus)){
                            printf('<a class="google-plus" target="_blank" href="%s"><i class="fa fa-google-plus"></i></a>', esc_url($author_gplus));
                        }
                        if(!empty($author_dribble)){
                            printf('<a class="dribble" target="_blank" href="%s"><i class="fa fa-dribble"></i></a>', esc_url($author_dribble));
                        }
                        echo '</div>';
                    endif;
                    ?>
                </div>
            </div>
		</div>
	</div>
<?php endif; ?>