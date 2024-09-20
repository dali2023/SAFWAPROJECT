<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

$agricola_template = apply_filters( 'agricola_filter_get_template_part', agricola_blog_archive_get_template() );

if ( ! empty( $agricola_template ) && 'index' != $agricola_template ) {

	get_template_part( $agricola_template );

} else {

	agricola_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$agricola_stickies   = is_home()
								|| ( in_array( agricola_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) agricola_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$agricola_post_type  = agricola_get_theme_option( 'post_type' );
		$agricola_args       = array(
								'blog_style'     => agricola_get_theme_option( 'blog_style' ),
								'post_type'      => $agricola_post_type,
								'taxonomy'       => agricola_get_post_type_taxonomy( $agricola_post_type ),
								'parent_cat'     => agricola_get_theme_option( 'parent_cat' ),
								'posts_per_page' => agricola_get_theme_option( 'posts_per_page' ),
								'sticky'         => agricola_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $agricola_stickies )
															&& count( $agricola_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		agricola_blog_archive_start();

		do_action( 'agricola_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'agricola_action_before_page_author' );
			get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'agricola_action_after_page_author' );
		}

		if ( agricola_get_theme_option( 'show_filters' ) ) {
			do_action( 'agricola_action_before_page_filters' );
			agricola_show_filters( $agricola_args );
			do_action( 'agricola_action_after_page_filters' );
		} else {
			do_action( 'agricola_action_before_page_posts' );
			agricola_show_posts( array_merge( $agricola_args, array( 'cat' => $agricola_args['parent_cat'] ) ) );
			do_action( 'agricola_action_after_page_posts' );
		}

		do_action( 'agricola_action_blog_archive_end' );

		agricola_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
