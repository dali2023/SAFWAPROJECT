<?php
/**
 * The template to display single post
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

// Full post loading
$full_post_loading          = agricola_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = agricola_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = agricola_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$agricola_related_position   = agricola_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$agricola_posts_navigation   = agricola_get_theme_option( 'posts_navigation' );
$agricola_prev_post          = false;
$agricola_prev_post_same_cat = agricola_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( agricola_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	agricola_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'agricola_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $agricola_posts_navigation ) {
		$agricola_prev_post = get_previous_post( $agricola_prev_post_same_cat );  // Get post from same category
		if ( ! $agricola_prev_post && $agricola_prev_post_same_cat ) {
			$agricola_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $agricola_prev_post ) {
			$agricola_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $agricola_prev_post ) ) {
		agricola_sc_layouts_showed( 'featured', false );
		agricola_sc_layouts_showed( 'title', false );
		agricola_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $agricola_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/content', 'single-' . agricola_get_theme_option( 'single_style' ) ), 'single-' . agricola_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $agricola_related_position, 'inside' ) === 0 ) {
		$agricola_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'agricola_action_related_posts' );
		$agricola_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $agricola_related_content ) ) {
			$agricola_related_position_inside = max( 0, min( 9, agricola_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $agricola_related_position_inside ) {
				$agricola_related_position_inside = mt_rand( 1, 9 );
			}

			$agricola_p_number         = 0;
			$agricola_related_inserted = false;
			$agricola_in_block         = false;
			$agricola_content_start    = strpos( $agricola_content, '<div class="post_content' );
			$agricola_content_end      = strrpos( $agricola_content, '</div>' );

			for ( $i = max( 0, $agricola_content_start ); $i < min( strlen( $agricola_content ) - 3, $agricola_content_end ); $i++ ) {
				if ( $agricola_content[ $i ] != '<' ) {
					continue;
				}
				if ( $agricola_in_block ) {
					if ( strtolower( substr( $agricola_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$agricola_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $agricola_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $agricola_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$agricola_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $agricola_content[ $i + 1 ] && in_array( $agricola_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$agricola_p_number++;
					if ( $agricola_related_position_inside == $agricola_p_number ) {
						$agricola_related_inserted = true;
						$agricola_content = ( $i > 0 ? substr( $agricola_content, 0, $i ) : '' )
											. $agricola_related_content
											. substr( $agricola_content, $i );
					}
				}
			}
			if ( ! $agricola_related_inserted ) {
				if ( $agricola_content_end > 0 ) {
					$agricola_content = substr( $agricola_content, 0, $agricola_content_end ) . $agricola_related_content . substr( $agricola_content, $agricola_content_end );
				} else {
					$agricola_content .= $agricola_related_content;
				}
			}
		}

		agricola_show_layout( $agricola_content );
	}

	// Comments
	do_action( 'agricola_action_before_comments' );
	comments_template();
	do_action( 'agricola_action_after_comments' );

	// Related posts
	if ( 'below_content' == $agricola_related_position
		&& ( 'scroll' != $agricola_posts_navigation || agricola_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || agricola_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'agricola_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $agricola_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $agricola_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $agricola_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $agricola_prev_post ) ); ?>"
			<?php do_action( 'agricola_action_nav_links_single_scroll_data', $agricola_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
