<?php
/**
 * The template to display default site footer
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.10
 */

$agricola_footer_id = agricola_get_custom_footer_id();
$agricola_footer_meta = get_post_meta( $agricola_footer_id, 'trx_addons_options', true );
if ( ! empty( $agricola_footer_meta['margin'] ) ) {
	agricola_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( agricola_prepare_css_value( $agricola_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $agricola_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $agricola_footer_id ) ) ); ?>
						<?php
						$agricola_footer_scheme = agricola_get_theme_option( 'footer_scheme' );
						if ( ! empty( $agricola_footer_scheme ) && ! agricola_is_inherit( $agricola_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $agricola_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'agricola_action_show_layout', $agricola_footer_id );
	?>
</footer><!-- /.footer_wrap -->
