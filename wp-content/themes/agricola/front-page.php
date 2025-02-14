<?php
/**
 * The Front Page template file.
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( agricola_is_on( agricola_get_theme_option( 'front_page_enabled', false ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$agricola_sections = agricola_array_get_keys_by_value( agricola_get_theme_option( 'front_page_sections' ) );
		if ( is_array( $agricola_sections ) ) {
			foreach ( $agricola_sections as $agricola_section ) {
				get_template_part( apply_filters( 'agricola_filter_get_template_part', 'front-page/section', $agricola_section ), $agricola_section );
			}
		}

		// Else if this page is a blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'agricola_filter_get_template_part', 'blog' ) );

		// Else - display a native page content
	} else {
		get_template_part( apply_filters( 'agricola_filter_get_template_part', 'page' ) );
	}

	// Else get the template 'index.php' to show posts
} else {
	get_template_part( apply_filters( 'agricola_filter_get_template_part', 'index' ) );
}

get_footer();
