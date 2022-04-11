<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

echo '<div class="la-wc-tabs-wrapper'. (is_active_sidebar('la-p-s-block-1') ? ' active-sidebar-p-s-block' : '') .'">';

if ( ! empty( $tabs ) ) : ?>
	<div class="wc-tabs-outer">
		<div class="woocommerce-tabs wc-tabs-wrapper">
			<ul class="tabs wc-tabs">
				<?php foreach ( $tabs as $key => $tab ) : ?><li class="<?php echo esc_attr( $key ); ?>_tab">
						<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
					</li><?php endforeach; ?>
			</ul>
			<div class="line-fullwidth vc_row" data-vc-full-width="true" data-vc-stretch-content="true"></div><div class="vc_row-full-width vc_clearfix"></div>
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<div class="clearfix woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
					<div class="wc-tab-title"><a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a></div>
					<div class="tab-content">
						<?php call_user_func( $tab['callback'], $key, $tab ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
<?php
if(is_active_sidebar('la-p-s-block-1')){
	echo '<div class="la-p-s-block">';
	dynamic_sidebar('la-p-s-block-1');
	echo '</div>';
}
?>
</div>