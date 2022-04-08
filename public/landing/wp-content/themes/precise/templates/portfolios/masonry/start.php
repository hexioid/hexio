<?php
global $precise_loop;

$loop_id            = isset($precise_loop['loop_id']) ? $precise_loop['loop_id'] : uniqid('la-show-portfolios-');
$style              = isset($precise_loop['loop_style']) ? $precise_loop['loop_style'] : '1';
$item_gap           = isset($precise_loop['item_gap']) ? $precise_loop['item_gap'] : 0;
$responsive_column  = isset($precise_loop['responsive_column']) ? $precise_loop['responsive_column'] : array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1);

$column_type    = isset($precise_loop['column_type']) ? $precise_loop['column_type'] : 'default';
$item_width     = isset($precise_loop['base_item_w']) ? $precise_loop['base_item_w'] : 300;
$item_height    = isset($precise_loop['base_item_h']) ? $precise_loop['base_item_h'] : 300;
$mb_column      = isset($precise_loop['mb_column']) ? $precise_loop['mb_column'] : array('md'=> 1,'sm'=> 1,'xs'=> 1, 'mb' => 1);


$enable_skill_filter    = isset($precise_loop['enable_skill_filter']) ? true : false;
$filter_style           = isset($precise_loop['filter_style']) ? $precise_loop['filter_style'] : '1';
$filters                = isset($precise_loop['filters']) ? $precise_loop['filters'] : '';

$loopCssClass   = array('la-loop','portfolios-loop');
$loopCssClass[] = 'pf-style-' . $style;
$loopCssClass[] = 'pf-masonry';
$loopCssClass[] = 'la-isotope-container';
$loopCssClass[] = 'grid-space-'. $item_gap;
$loopCssClass[] = 'masonry__column-type-'. $column_type;

$custom_configs = array();

if($column_type != 'custom'){
    $loopCssClass[] = 'grid-items';
    foreach( $responsive_column as $screen => $value ){
        $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
    }
}

?>
<?php if($enable_skill_filter): ?>
    <div class="la-isotope-filter-container filter-style-<?php echo esc_attr($filter_style);?>" data-isotope_container="#<?php echo esc_html($loop_id) ?> .la-isotope-container">
        <div class="la-toggle-filter"><?php echo esc_html_x('All', 'front-view', 'precise'); ?></div><ul><li class="active" data-filter="*"><a href="#"><?php echo esc_html_x('All', 'front-view', 'precise'); ?></a></li><?php
            if(!empty($filters)){
                $filters = explode(',', $filters);
                foreach($filters as $filter){
                    $category = get_term($filter, 'la_portfolio_skill');
                    if(!is_wp_error($category) && $category){
                        printf('<li data-filter="la_portfolio_skill-%s"><a href="#">%s</a></li>',
                            esc_attr($category->slug),
                            esc_html($category->name)
                        );
                    }
                }
            }
        ?></ul>
    </div>
<?php endif; ?>
<div class="<?php echo esc_attr(implode(' ', $loopCssClass)) ?>"<?php
echo ' data-item_selector=".portfolio-item"';
echo ' data-item_margin="0"';
echo ' data-config_isotope="'.esc_attr(json_encode($custom_configs)).'"';
echo ' data-item-width="'.esc_attr($item_width).'"';
echo ' data-item-height="'.esc_attr($item_height).'"';
echo ' data-md-col="'.esc_attr($mb_column['md']).'"';
echo ' data-sm-col="'.esc_attr($mb_column['sm']).'"';
echo ' data-xs-col="'.esc_attr($mb_column['xs']).'"';
echo ' data-mb-col="'.esc_attr($mb_column['mb']).'"';
?>>