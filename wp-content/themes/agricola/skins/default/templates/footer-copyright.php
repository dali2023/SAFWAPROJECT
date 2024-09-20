<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$agricola_copyright_scheme = agricola_get_theme_option( 'copyright_scheme' );
if ( ! empty( $agricola_copyright_scheme ) && ! agricola_is_inherit( $agricola_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $agricola_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$agricola_copyright = agricola_get_theme_option( 'copyright' );
			if ( ! empty( $agricola_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$agricola_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $agricola_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$agricola_copyright = agricola_prepare_macros( $agricola_copyright );
				// Display copyright
				echo wp_kses( nl2br( $agricola_copyright ), 'agricola_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
