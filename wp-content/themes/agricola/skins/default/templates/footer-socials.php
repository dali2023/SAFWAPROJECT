<?php
/**
 * The template to display the socials in the footer
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.10
 */


// Socials
if ( agricola_is_on( agricola_get_theme_option( 'socials_in_footer' ) ) ) {
	$agricola_output = agricola_get_socials_links();
	if ( '' != $agricola_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php agricola_show_layout( $agricola_output ); ?>
			</div>
		</div>
		<?php
	}
}
