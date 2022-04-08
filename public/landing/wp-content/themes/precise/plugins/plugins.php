<?php
add_action( 'tgmpa_register', 'precise_register_required_plugins' );

if(!function_exists('precise_register_required_plugins')){

	function precise_register_required_plugins() {

		$plugins = array();

		$plugins[] = array(
			'name'					=> esc_html_x('WPBakery Visual Composer', 'admin-view', 'precise'),
			'slug'					=> 'js_composer',
			'source'				=> get_template_directory() . '/plugins/js_composer.zip',
			'required'				=> true,
			'version'				=> '5.5.2'
		);

		$plugins[] = array(
			'name'					=> esc_html_x('LA Studio Core', 'admin-view', 'precise'),
			'slug'					=> 'lastudio-core',
			'source'				=> get_template_directory() . '/plugins/lastudio-core.zip',
			'required'				=> true,
			'version'				=> '2.1.0'
		);
		$plugins[] = array(
			'name'					=> esc_html_x('Precise Package Demo Data', 'admin-view', 'precise'),
			'slug'					=> 'precise-demo-data',
			'source'				=> 'https://github.com/la-studioweb/resource/raw/master/precise/precise-demo-data.zip',
			'required'				=> true,
			'version'				=> '1.0.0'
		);


		$plugins[] = array(
			'name'     				=> esc_html_x('WooCommerce', 'admin-view', 'precise'),
			'slug'     				=> 'woocommerce',
			'version'				=> '3.4.4',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'					=> esc_html_x('Slider Revolution', 'admin-view', 'precise'),
			'slug'					=> 'revslider',
			'source'				=> get_template_directory() . '/plugins/revslider.zip',
			'required'				=> false,
			'version'				=> '5.4.8'
		);

		$plugins[] = array(
			'name'     				=> esc_html_x('Envato Market', 'admin-view', 'precise'),
			'slug'     				=> 'envato-market',
			'source'   				=> 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required' 				=> false,
			'version' 				=> '2.0.0'
		);

		$plugins[] = array(
			'name' 					=> esc_html_x('Contact Form 7', 'admin-view', 'precise'),
			'slug' 					=> 'contact-form-7',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'     				=> esc_html_x('YITH WooCommerce Wishlist', 'admin-view', 'precise'),
			'slug'     				=> 'yith-woocommerce-wishlist',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'     				=> esc_html_x('YITH WooCommerce Compare', 'admin-view', 'precise'),
			'slug'     				=> 'yith-woocommerce-compare',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'     				=> esc_html_x('YITH WooCommerce Social Login', 'admin-view', 'precise'),
			'slug'     				=> 'yith-woocommerce-social-login',
			'required' 				=> false
		);

		$plugins[] = array(
			'name' 					=> esc_html_x('Easy Forms for MailChimp by YIKES', 'admin-view', 'precise'),
			'slug' 					=> 'yikes-inc-easy-mailchimp-extender',
			'required' 				=> false
		);

		$config = array(
			'id'           				=> 'precise',
			'default_path' 				=> '',
			'menu'         				=> 'tgmpa-install-plugins',
			'has_notices'  				=> true,
			'dismissable'  				=> true,
			'dismiss_msg'  				=> '',
			'is_automatic' 				=> false,
			'message'      				=> ''
		);

		tgmpa( $plugins, $config );

	}

}