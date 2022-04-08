<?php

if ( ! function_exists( 'foton_mikado_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function foton_mikado_register_search_opener_widget( $widgets ) {
		$widgets[] = 'FotonMikadoClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'foton_mikado_filter_register_widgets', 'foton_mikado_register_search_opener_widget' );
}