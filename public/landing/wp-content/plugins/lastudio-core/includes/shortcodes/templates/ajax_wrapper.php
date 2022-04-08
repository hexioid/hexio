<?php
    $query_settings = json_encode( array(
        'tag' => $this->shortcode,
        'atts' => $atts,
        'content' => $content,
    ) );
?>
<div class="elm-ajax-container-wrapper clearfix">
	<div class="elm-ajax-loader" data-query-settings="<?php echo esc_attr( $query_settings ); ?>" data-request="<?php echo esc_attr( admin_url( 'admin-ajax.php', 'relative' ) ); ?>">
		<?php echo LaStudio_Shortcodes_Helper::getLoadingIcon(); ?>
	</div>
</div>