<?php
/**
 * The template to display the side menu
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */
?>
<div class="menu_side_wrap
<?php
echo ' menu_side_' . esc_attr( agricola_get_theme_option( 'menu_side_icons' ) > 0 ? 'icons' : 'dots' );
$agricola_menu_scheme = agricola_get_theme_option( 'menu_scheme' );
$agricola_header_scheme = agricola_get_theme_option( 'header_scheme' );
if ( ! empty( $agricola_menu_scheme ) && ! agricola_is_inherit( $agricola_menu_scheme  ) ) {
	echo ' scheme_' . esc_attr( $agricola_menu_scheme );
} elseif ( ! empty( $agricola_header_scheme ) && ! agricola_is_inherit( $agricola_header_scheme ) ) {
	echo ' scheme_' . esc_attr( $agricola_header_scheme );
}
?>
				">
	<span class="menu_side_button icon-menu-2"></span>

	<div class="menu_side_inner">
		<?php
		// Logo
		set_query_var( 'agricola_logo_args', array( 'type' => 'side' ) );
		get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/header-logo' ) );
		set_query_var( 'agricola_logo_args', array() );
		// Main menu button
		?>
		<div class="toc_menu_item"
			<?php
			if ( agricola_mouse_helper_enabled() ) {
				echo ' data-mouse-helper="click" data-mouse-helper-axis="y" data-mouse-helper-text="' . esc_attr__( 'Open main menu', 'agricola' ) . '"';
			}
			?>
		>
			<a href="#" class="toc_menu_description menu_mobile_description"><span class="toc_menu_description_title"><?php esc_html_e( 'Main menu', 'agricola' ); ?></span></a>
			<a class="menu_mobile_button toc_menu_icon icon-menu-2" href="#"></a>
		</div>		
	</div>

</div><!-- /.menu_side_wrap -->
