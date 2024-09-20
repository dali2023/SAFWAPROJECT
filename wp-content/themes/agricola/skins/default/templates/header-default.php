<?php
/**
 * The template to display default site header
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

$agricola_header_css   = '';
$agricola_header_image = get_header_image();
$agricola_header_video = agricola_get_header_video();
if ( ! empty( $agricola_header_image ) && agricola_trx_addons_featured_image_override( is_singular() || agricola_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$agricola_header_image = agricola_get_current_mode_image( $agricola_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $agricola_header_image ) || ! empty( $agricola_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $agricola_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $agricola_header_image ) {
		echo ' ' . esc_attr( agricola_add_inline_css_class( 'background-image: url(' . esc_url( $agricola_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( agricola_is_on( agricola_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight agricola-full-height';
	}
	$agricola_header_scheme = agricola_get_theme_option( 'header_scheme' );
	if ( ! empty( $agricola_header_scheme ) && ! agricola_is_inherit( $agricola_header_scheme  ) ) {
		echo ' scheme_' . esc_attr( $agricola_header_scheme );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $agricola_header_video ) ) {
		get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( agricola_is_on( agricola_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
