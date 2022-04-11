<?php
// Add backend styles for Gutenberg.
add_action( 'enqueue_block_editor_assets', 'cryptokn_add_gutenberg_assets' );
/**
 * Load Gutenberg stylesheet.
 */
function cryptokn_add_gutenberg_assets() {
	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'cryptokn-gutenberg-style', get_theme_file_uri( '/css/gutenberg-editor-style.css' ), false );
    wp_enqueue_style( 
        'cryptokn-gutenberg-fonts', 
        '//fonts.googleapis.com/css?family=Nunito%3A300%2Cregular%2C600%2C700%2C800%2C900%2Clatin' 
    ); 
}
?>