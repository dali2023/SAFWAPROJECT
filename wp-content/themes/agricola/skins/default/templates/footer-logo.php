<?php
/**
 * The template to display the site logo in the footer
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.10
 */

// Logo
if ( agricola_is_on( agricola_get_theme_option( 'logo_in_footer' ) ) ) {
	$agricola_logo_image = agricola_get_logo_image( 'footer' );
	$agricola_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $agricola_logo_image['logo'] ) || ! empty( $agricola_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $agricola_logo_image['logo'] ) ) {
					$agricola_attr = agricola_getimagesize( $agricola_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $agricola_logo_image['logo'] ) . '"'
								. ( ! empty( $agricola_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $agricola_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'agricola' ) . '"'
								. ( ! empty( $agricola_attr[3] ) ? ' ' . wp_kses_data( $agricola_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $agricola_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $agricola_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
