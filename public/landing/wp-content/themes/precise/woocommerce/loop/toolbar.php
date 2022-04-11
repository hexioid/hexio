<?php

$view_mode = Precise()->settings->get('shop_catalog_display_type', 'grid');

$view_mode = apply_filters('precise/filter/catalog_view_mode', $view_mode);

$per_page_array = apply_filters('precise/filter/product_per_page_array', Precise()->settings->get('product_per_page_allow', '9,15,30'));
$per_page = apply_filters('precise/filter/product_per_page', Precise()->settings->get('product_per_page_default', 9));
$per_page_array = explode(',', $per_page_array);
$per_page_array = array_map('trim', $per_page_array);
$per_page_array = array_map('absint', $per_page_array);
asort($per_page_array);
$current_url = add_query_arg(null, null);
$current_url = remove_query_arg(array('page', 'paged', 'mode_view'), $current_url);
$current_url = preg_replace('/\/page\/\d+/', '', $current_url);

$active_shop_filter = Precise()->settings->get('active_shop_filter', 'off');
$hide_shop_toolbar = Precise()->settings->get('hide_shop_toolbar', 'off');
?>
<div class="wc-toolbar-container">
    <div class="wc-toolbar wc-toolbar-top clearfix">
        <?php if(!is_product()): ?>
            <?php if($hide_shop_toolbar != 'on'): ?>
            <div class="wc-toolbar-left">
                <?php woocommerce_result_count();?>
                <?php if(count($per_page_array) > 1) :?>
                <div class="wc-view-count">
                    <p><?php echo esc_html_x('Show', 'front-view', 'precise'); ?></p>
                    <ul><?php
                        foreach ($per_page_array as $val){?><li
                            <?php echo ($per_page == $val ? ' class="active"' : '')?>><a href="<?php echo esc_url(add_query_arg('per_page', $val, $current_url)); ?>"><?php echo sprintf( esc_html__( '%s' , 'precise'), $val ) ?></a></li>
                        <?php }
                        ?></ul>
                </div>
                <?php endif;?>
            </div>
            <div class="wc-toolbar-right">
                <?php if(Precise()->settings->get('woocommerce_toggle_grid_list','off') == 'on'): ?>
                    <div class="wc-view-toggle">
                    <span data-view_mode="grid"<?php
                    if ($view_mode == 'grid') {
                        echo ' class="active"';
                    }
                    ?>><i title="<?php echo esc_attr_x('Grid view', 'front-view', 'precise') ?>" class="fa-th"></i></span>
                    <span data-view_mode="list"<?php
                    if ($view_mode == 'list') {
                        echo ' class="active"';
                    }
                    ?>><i title="<?php echo esc_attr_x('List view', 'front-view', 'precise') ?>" class="fa-list"></i></span>
                    </div>
                <?php endif;?>
                <?php if($active_shop_filter != 'on'){
                    woocommerce_catalog_ordering();
                } ?>
            </div>
            <?php endif; ?>
            <?php if ($active_shop_filter == 'on' && is_active_sidebar('sidebar-shop-filter')): ?>
                <div class="btn-advanced-shop-filter">
                    <span><?php echo esc_html_x('Filter', 'front-view', 'precise'); ?></span><i></i>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div><!-- .wc-toolbar -->

    <?php if(is_woocommerce() && !is_product()) {
        $layout = Precise()->layout->get_site_layout();
        if ($active_shop_filter == 'on' && is_active_sidebar('sidebar-shop-filter')) {
            ?>
            <div class="clearfix"></div>
            <div class="la-advanced-product-filters clearfix">
                <div class="sidebar-inner clearfix">
                    <?php dynamic_sidebar('sidebar-shop-filter'); ?>

                    <?php if((isset($_GET['la_preset']) && count($_GET) > 1) || (!isset($_GET['la_preset']) && count($_GET) > 0)) : ?>
                    <div class="clearfix"></div>
                    <div class="la-advanced-product-filters-result">
                        <?php
                            $base_filter = Precise_Helper::get_base_shop_url();
                            if(isset($_GET['la_preset'])){
                                $base_filter = add_query_arg('la_preset', $_GET['la_preset'], $base_filter);
                            }
                        ?>
                        <a class="reset-all-shop-filter text-color-primary" href="<?php echo esc_url($base_filter) ?>"><i class="precise-icon-simple-close"></i><span><?php echo esc_html_x('Clear All Filter', 'front-view', 'precise'); ?></span></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php }
    }?>
</div>