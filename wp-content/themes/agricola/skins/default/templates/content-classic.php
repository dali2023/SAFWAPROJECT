<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

$agricola_template_args = get_query_var( 'agricola_template_args' );

if ( is_array( $agricola_template_args ) ) {
	$agricola_columns    = empty( $agricola_template_args['columns'] ) ? 2 : max( 1, $agricola_template_args['columns'] );
	$agricola_blog_style = array( $agricola_template_args['type'], $agricola_columns );
    $agricola_columns_class = agricola_get_column_class( 1, $agricola_columns, ! empty( $agricola_template_args['columns_tablet']) ? $agricola_template_args['columns_tablet'] : '', ! empty($agricola_template_args['columns_mobile']) ? $agricola_template_args['columns_mobile'] : '' );
} else {
	$agricola_blog_style = explode( '_', agricola_get_theme_option( 'blog_style' ) );
	$agricola_columns    = empty( $agricola_blog_style[1] ) ? 2 : max( 1, $agricola_blog_style[1] );
    $agricola_columns_class = agricola_get_column_class( 1, $agricola_columns );
}
$agricola_expanded   = ! agricola_sidebar_present() && agricola_get_theme_option( 'expand_content' ) == 'expand';

$agricola_post_format = get_post_format();
$agricola_post_format = empty( $agricola_post_format ) ? 'standard' : str_replace( 'post-format-', '', $agricola_post_format );

?><div class="<?php
	if ( ! empty( $agricola_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( agricola_is_blog_style_use_masonry( $agricola_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $agricola_columns ) : esc_attr( $agricola_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $agricola_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $agricola_columns )
				. ' post_layout_' . esc_attr( $agricola_blog_style[0] )
				. ' post_layout_' . esc_attr( $agricola_blog_style[0] ) . '_' . esc_attr( $agricola_columns )
	);
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
								: explode( ',', $agricola_template_args['meta_parts'] )
								)
							: agricola_array_get_keys_by_value( agricola_get_theme_option( 'meta_parts' ) );

	agricola_show_post_featured( apply_filters( 'agricola_filter_args_featured',
		array(
			'thumb_size' => ! empty( $agricola_template_args['thumb_size'] )
				? $agricola_template_args['thumb_size']
				: agricola_get_thumb_size(
				'classic' == $agricola_blog_style[0]
						? ( strpos( agricola_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $agricola_columns > 2 ? 'big' : 'huge' )
								: ( $agricola_columns > 2
									? ( $agricola_expanded ? 'square' : 'square' )
									: ($agricola_columns > 1 ? 'square' : ( $agricola_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( agricola_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $agricola_columns > 2 ? 'masonry-big' : 'full' )
								: ($agricola_columns === 1 ? ( $agricola_expanded ? 'huge' : 'big' ) : ( $agricola_columns <= 2 && $agricola_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $agricola_hover,
			'meta_parts' => $agricola_components,
			'no_links'   => ! empty( $agricola_template_args['no_links'] ),
        ),
        'content-classic',
        $agricola_template_args
    ) );

	// Title and post meta
	$agricola_show_title = get_the_title() != '';
	$agricola_show_meta  = count( $agricola_components ) > 0 && ! in_array( $agricola_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $agricola_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'agricola_filter_show_blog_meta', $agricola_show_meta, $agricola_components, 'classic' ) ) {
				if ( count( $agricola_components ) > 0 ) {
					do_action( 'agricola_action_before_post_meta' );
					agricola_show_post_meta(
						apply_filters(
							'agricola_filter_post_meta_args', array(
							'components' => join( ',', $agricola_components ),
							'seo'        => false,
							'echo'       => true,
						), $agricola_blog_style[0], $agricola_columns
						)
					);
					do_action( 'agricola_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'agricola_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'agricola_action_before_post_title' );
				if ( empty( $agricola_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'agricola_action_after_post_title' );
			}

			if( !in_array( $agricola_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'agricola_filter_show_blog_readmore', ! $agricola_show_title || ! empty( $agricola_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $agricola_template_args['no_links'] ) ) {
						do_action( 'agricola_action_before_post_readmore' );
						agricola_show_post_more_link( $agricola_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'agricola_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $agricola_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('agricola_filter_show_blog_excerpt', empty($agricola_template_args['hide_excerpt']) && agricola_get_theme_option('excerpt_length') > 0, 'classic')) {
			agricola_show_post_content($agricola_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $agricola_template_args['more_button'] )) {
			if ( empty( $agricola_template_args['no_links'] ) ) {
				do_action( 'agricola_action_before_post_readmore' );
				agricola_show_post_more_link( $agricola_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'agricola_action_after_post_readmore' );
			}
		}
		$agricola_content = ob_get_contents();
		ob_end_clean();
		agricola_show_layout($agricola_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
