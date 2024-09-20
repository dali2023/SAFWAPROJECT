<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

$agricola_args = get_query_var( 'agricola_logo_args' );

// Site logo
$agricola_logo_type   = isset( $agricola_args['type'] ) ? $agricola_args['type'] : '';
$agricola_logo_image  = agricola_get_logo_image( $agricola_logo_type );
$agricola_logo_text   = agricola_is_on( agricola_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$agricola_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $agricola_logo_image['logo'] ) || ! empty( $agricola_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $agricola_logo_image['logo'] ) ) {
			if ( empty( $agricola_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($agricola_logo_image['logo']) && (int) $agricola_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$agricola_attr = agricola_getimagesize( $agricola_logo_image['logo'] );
				echo '<img src="' . esc_url( $agricola_logo_image['logo'] ) . '"'
						. ( ! empty( $agricola_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $agricola_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $agricola_logo_text ) . '"'
						. ( ! empty( $agricola_attr[3] ) ? ' ' . wp_kses_data( $agricola_attr[3] ) : '' )
						. '>';
			}
		} else {
			agricola_show_layout( agricola_prepare_macros( $agricola_logo_text ), '<span class="logo_text">', '</span>' );
			agricola_show_layout( agricola_prepare_macros( $agricola_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
