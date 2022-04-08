<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

global $precise_loop;

$is_main_loop = wc_get_loop_prop('is_main_loop', false);

$active_shop_masonry = Precise()->settings->get('active_shop_masonry', 'off');
$shop_masonry_column_type = Precise()->settings->get('shop_masonry_column_type', 'default');
$woocommerce_shop_masonry_columns = Precise()->settings->get('woocommerce_shop_masonry_columns');

$product_masonry_item_width = Precise()->settings->get('product_masonry_item_width', 270);
$product_masonry_item_height = Precise()->settings->get('product_masonry_item_height', 450);
$woocommerce_shop_masonry_custom_columns = Precise()->settings->get('woocommerce_shop_masonry_custom_columns');
$shop_masonry_item_setting = Precise()->settings->get('shop_masonry_item_setting');

$item_gap = Precise()->settings->get('shop_masonry_item_gap', 30);

$column_tmp = Precise()->settings->get('woocommerce_shop_page_columns');

if($is_main_loop && $active_shop_masonry == 'on'){
    $column_tmp = $woocommerce_shop_masonry_columns;
}

?>
<?php
$view_mode = Precise()->settings->get('shop_catalog_display_type', 'grid');
$columns = shortcode_atts(
    array(
        'xlg'	=> 1,
        'lg' 	=> 1,
        'md' 	=> 1,
        'sm' 	=> 1,
        'xs' 	=> 1,
        'mb' 	=> 1
    ),
    $column_tmp
);
$mb_column = $columns;

if($is_main_loop && $active_shop_masonry == 'on' && $shop_masonry_column_type == 'custom'){
    $mb_column = shortcode_atts(
        array(
            'md' 	=> 1,
            'sm' 	=> 1,
            'xs' 	=> 1,
            'mb' 	=> 1
        ),
        $woocommerce_shop_masonry_custom_columns
    );
}

$view_mode = apply_filters('precise/filter/catalog_view_mode', $view_mode);

if($is_main_loop && $active_shop_masonry == 'on'){
    $view_mode = 'grid';
}

$design = Precise()->settings->get("shop_catalog_grid_style", '1');

$loopCssClass = array();
$loopCssClass[] = 'products';
$loopCssClass[] = 'products-' . $view_mode;
$loopCssClass[] = "products-grid-{$design}";

if($is_main_loop && $active_shop_masonry == 'on'){
    precise_set_wc_loop_prop('prods_masonry', true);
    $loopCssClass[] = 'prods_masonry';
    $loopCssClass[] = 'la-isotope-container';
    if( $shop_masonry_column_type != 'custom' ){
        $loopCssClass[] = 'grid-items';
        foreach( $columns as $screen => $value ){
            $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
        }
    }
    else{
        $__new_item_sizes = array();
        if(!empty($shop_masonry_item_setting) && is_array($shop_masonry_item_setting)){
            foreach($shop_masonry_item_setting as $k => $size){
                $__new_item_sizes[$k] = $size;
                if(!empty($size['image_size'])){
                    $__new_item_sizes[$k]['image_size'] = Precise_Helper::get_image_size_from_string($size['image_size']);
                }
            }
        }
        $loopCssClass[] = 'prods_masonry--cover-bg';
        precise_set_wc_loop_prop('masonry_item_sizes', $__new_item_sizes);
        $precise_loop['disable_alt_image'] = true;
    }
    $precise_loop['image_size'] = Precise_Helper::get_image_size_from_string(Precise()->settings->get('product_masonry_image_size', 'shop_catalog'));
    ?>
    <div class="append-css-to-head hide">
        .wc-toolbar .wc-toolbar-right{ display:none };
    </div>
<?php
}
else{
    $loopCssClass[] = 'grid-items';
    foreach( $columns as $screen => $value ){
        $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
    }
}

?>
<div class="row">
    <div class="col-xs-12">
        <ul class="<?php echo esc_attr(implode(' ', $loopCssClass)) ?>"<?php
echo ' data-item_selector=".product_item"';
echo ' data-item_margin="'.esc_attr($item_gap).'"';
echo ' data-item-width="'.esc_attr($product_masonry_item_width).'"';
echo ' data-item-height="'.esc_attr($product_masonry_item_height).'"';
echo ' data-md-col="'.esc_attr($mb_column['md']).'"';
echo ' data-sm-col="'.esc_attr($mb_column['sm']).'"';
echo ' data-xs-col="'.esc_attr($mb_column['xs']).'"';
echo ' data-mb-col="'.esc_attr($mb_column['mb']).'"';
?>>