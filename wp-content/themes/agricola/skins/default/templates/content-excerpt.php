<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

$agricola_template_args = get_query_var( 'agricola_template_args' );
$agricola_columns = 1;
if ( is_array( $agricola_template_args ) ) {
	$agricola_columns    = empty( $agricola_template_args['columns'] ) ? 1 : max( 1, $agricola_template_args['columns'] );
	$agricola_blog_style = array( $agricola_template_args['type'], $agricola_columns );
	if ( ! empty( $agricola_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $agricola_columns > 1 ) {
	    $agricola_columns_class = agricola_get_column_class( 1, $agricola_columns, ! empty( $agricola_template_args['columns_tablet']) ? $agricola_template_args['columns_tablet'] : '', ! empty($agricola_template_args['columns_mobile']) ? $agricola_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $agricola_columns_class ); ?>">
		<?php
	}
}
$agricola_expanded    = ! agricola_sidebar_present() && agricola_get_theme_option( 'expand_content' ) == 'expand';
$agricola_post_format = get_post_format();
$agricola_post_format = empty( $agricola_post_format ) ? 'standard' : str_replace( 'post-format-', '', $agricola_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $agricola_post_format ) );
	agricola_add_blog_animation( $agricola_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$agricola_hover      = ! empty( $agricola_template_args['hover'] ) && ! agricola_is_inherit( $agricola_template_args['hover'] )
							? $agricola_template_args['hover']
							: agricola_get_theme_option( 'image_hover' );
	$agricola_components = ! empty( $agricola_template_args['meta_parts'] )
							? ( is_array( $agricola_template_args['meta_parts'] )
								? $agricola_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $agricola_template_args['meta_parts'] ) )
								)
							: agricola_array_get_keys_by_value( agricola_get_theme_option( 'meta_parts' ) );
	agricola_show_post_featured( apply_filters( 'agricola_filter_args_featured',
		array(
			'no_links'   => ! empty( $agricola_template_args['no_links'] ),
			'hover'      => $agricola_hover,
			'meta_parts' => $agricola_components,
			'thumb_size' => ! empty( $agricola_template_args['thumb_size'] )
							? $agricola_template_args['thumb_size']
							: agricola_get_thumb_size( strpos( agricola_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $agricola_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$agricola_template_args
	) );

	// Title and post meta
	$agricola_show_title = get_the_title() != '';
	$agricola_show_meta  = count( $agricola_components ) > 0 && ! in_array( $agricola_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $agricola_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'agricola_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'agricola_action_before_post_title' );
				if ( empty( $agricola_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'agricola_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'agricola_filter_show_blog_excerpt', empty( $agricola_template_args['hide_excerpt'] ) && agricola_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'agricola_filter_show_blog_meta', $agricola_show_meta, $agricola_components, 'excerpt' ) ) {
				if ( count( $agricola_components ) > 0 ) {
					do_action( 'agricola_action_before_post_meta' );
					agricola_show_post_meta(
						apply_filters(
							'agricola_filter_post_meta_args', array(
								'components' => join( ',', $agricola_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'agricola_action_after_post_meta' );
				}
			}

			if ( agricola_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'agricola_action_before_full_post_content' );
					the_content( '' );
					do_action( 'agricola_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'agricola' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'agricola' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				agricola_show_post_content( $agricola_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'agricola_filter_show_blog_readmore',  ! isset( $agricola_template_args['more_button'] ) || ! empty( $agricola_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $agricola_template_args['no_links'] ) ) {
					do_action( 'agricola_action_before_post_readmore' );
					if ( agricola_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						agricola_show_post_more_link( $agricola_template_args, '<p>', '</p>' );
					} else {
						agricola_show_post_comments_link( $agricola_template_args, '<p>', '</p>' );
					}
					do_action( 'agricola_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $agricola_template_args ) ) {
	if ( ! empty( $agricola_template_args['slider'] ) || $agricola_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
