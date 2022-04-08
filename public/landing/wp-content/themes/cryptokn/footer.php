<?php
/**
 * The template for displaying the footer.
 *
*/
?>
    <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
        <!-- BACK TO TOP BUTTON -->
        <a class="back-to-top modeltheme-is-visible modeltheme-fade-out" href="<?php echo esc_url('#0'); ?>">
            <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
        </a>
    <?php } else { ?>
        <?php if (cryptokn_redux('mt_backtotop_status') == true) { ?>
            <!-- BACK TO TOP BUTTON -->
            <a class="back-to-top modeltheme-is-visible modeltheme-fade-out" href="<?php echo esc_url('#0'); ?>">
                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
            </a>
        <?php } ?>
    <?php } ?>


    <!-- FOOTER -->
    <footer>
        <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
            <!-- FOOTER TOP -->
            <div class="row footer-top">
                <div class="container">
                <?php          
                    //FOOTER ROW #1
                    echo wp_kses_post(cryptokn_footer_row1());
                    //FOOTER ROW #2
                    echo wp_kses_post(cryptokn_footer_row2());
                    //FOOTER ROW #3
                    echo wp_kses_post(cryptokn_footer_row3());
                 ?>
                </div>
            </div>
        <?php } ?>

        <!-- FOOTER BOTTOM -->
        <div class="footer-div-parent">
            <div class="container-fluid footer">
                <div class="col-md-12">
                	<p class="copyright text-center">
                        <?php if ( class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                            <?php echo wp_kses_post(cryptokn_redux('mt_footer_text')); ?>
                        <?php }else{ ?>
                            <?php echo esc_html__('Copyright 2019 by ModelTheme. All Rights Reserved.', 'cryptokn'); ?>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>


<?php wp_footer(); ?>
</body>
</html>