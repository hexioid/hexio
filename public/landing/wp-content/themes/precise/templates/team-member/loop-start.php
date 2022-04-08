<?php
global $precise_loop;
$loop_id = isset($precise_loop['loop_id']) ? $precise_loop['loop_id'] : uniqid('la-team-member-');
$loop_style = isset($precise_loop['loop_style']) ? $precise_loop['loop_style'] : 1;
$responsive_column = isset($precise_loop['responsive_column']) ? $precise_loop['responsive_column'] : array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1);
$excerpt_length = isset($precise_loop['excerpt_length']) ? $precise_loop['excerpt_length'] : 15;
$slider_configs = isset($precise_loop['slider_configs']) ? $precise_loop['slider_configs'] : '';

$loopCssClass = array('la-loop','la-members');
$loopCssClass[] = 'la-members--style-' . $loop_style;

$loopCssClass[] = 'grid-items';
if(!empty($slider_configs)){
    $loopCssClass[] = 'la-slick-slider';
}else{
    foreach( $responsive_column as $screen => $value ){
        $loopCssClass[]  =  sprintf('%s-grid-%s-items', $screen, $value);
    }
}
?>
<div class="<?php echo esc_attr(implode(' ', $loopCssClass)) ?>"<?php
    if(!empty($slider_configs)){
        echo ' data-slider_config="'. esc_attr( $slider_configs ) .'"';
    }
?>>