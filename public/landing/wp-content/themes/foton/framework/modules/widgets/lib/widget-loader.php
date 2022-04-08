<?php

if ( ! function_exists( 'foton_mikado_register_widgets' ) ) {
	function foton_mikado_register_widgets() {
		$widgets = apply_filters( 'foton_mikado_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'foton_mikado_register_widgets' );
}