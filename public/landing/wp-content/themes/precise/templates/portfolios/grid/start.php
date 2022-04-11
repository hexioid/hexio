<?php
global $precise_loop;
$loop_id            = isset($precise_loop['loop_id']) ? $precise_loop['loop_id'] : uniqid('la-show-portfolios-');
$layout             = isset($precise_loop['loop_layout']) ? $precise_loop['loop_layout'] : 'grid';
$style              = isset($precise_loop['loop_style']) ? $precise_loop['loop_style'] : 1;
$item_gap           = isset($precise_loop['item_gap']) ? $precise_loop['item_gap'] : 0;
$responsive_column  = isset($precise_loop['responsive_column']) ? $precise_loop['responsive_column'] : array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1);
$slider_configs     = isset($precise_loop['slider_configs']) ? $precise_loop['slider_configs'] : '';

$loopCssClass = array('la-loop','portfolios-loop');
$loopCssClass[] = 'pf-style-' . $style;
$loopCssClass[] = 'pf-' . $layout;
$loopCssClass[] = 'grid-space-'. $item_gap;

if(!empty($slider_configs)){
    $loopCssClass[] = 'la-slick-slider';
}else{
    if('list' != $layout){
        $loopCssClass[] = 'grid-items';
        foreach( $responsive_column as $screen => $value ){
            $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
        }
    }
    if('masonry' == $layout){
        $loopCssClass[] = 'la-isotope-container';
    }
}
?>
<div class="<?php echo esc_attr(implode(' ', $loopCssClass)) ?>"<?php
if(!empty($slider_configs)){
    echo ' data-slider_config="'. esc_attr( $slider_configs ) .'"';
}
if('masonry' == $layout){
    echo ' data-item_selector=".portfolio-item"';
    echo ' data-config_isotope="'.esc_attr(json_encode(array(

        ))).'"';
}
?>>