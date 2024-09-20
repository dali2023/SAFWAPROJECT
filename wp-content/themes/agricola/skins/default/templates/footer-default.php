<?php
/**
 * The template to display default site footer
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$agricola_footer_scheme = agricola_get_theme_option( 'footer_scheme' );
if ( ! empty( $agricola_footer_scheme ) && ! agricola_is_inherit( $agricola_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $agricola_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
