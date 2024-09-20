<?php
/**
 * The Portfolio template to display the content
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

$agricola_post_format = get_post_format();
$agricola_post_format = empty( $agricola_post_format ) ? 'standard' : str_replace( 'post-format-', '', $agricola_post_format );

?><div class="
<?php
if ( ! empty( $agricola_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( agricola_is_blog_style_use_masonry( $agricola_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $agricola_columns ) : esc_attr( $agricola_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $agricola_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $agricola_columns )
		. ( 'portfolio' != $agricola_blog_style[0] ? ' ' . esc_attr( $agricola_blog_style[0] )  . '_' . esc_attr( $agricola_columns ) : '' )
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

	$agricola_hover   = ! empty( $agricola_template_args['hover'] ) && ! agricola_is_inherit( $agricola_template_args['hover'] )
								? $agricola_template_args['hover']
								: agricola_get_theme_option( 'image_hover' );

	if ( 'dots' == $agricola_hover ) {
		$agricola_post_link = empty( $agricola_template_args['no_links'] )
								? ( ! empty( $agricola_template_args['link'] )
									? $agricola_template_args['link']
									: get_permalink()
									)
								: '';
		$agricola_target    = ! empty( $agricola_post_link ) && false === strpos( $agricola_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$agricola_components = ! empty( $agricola_template_args['meta_parts'] )
							? ( is_array( $agricola_template_args['meta_parts'] )
								? $agricola_template_args['meta_parts']
								: explode( ',', $agricola_template_args['meta_parts'] )
								)
							: agricola_array_get_keys_by_value( agricola_get_theme_option( 'meta_parts' ) );

	// Featured image
	agricola_show_post_featured( apply_filters( 'agricola_filter_args_featured',
        array(
			'hover'         => $agricola_hover,
			'no_links'      => ! empty( $agricola_template_args['no_links'] ),
			'thumb_size'    => ! empty( $agricola_template_args['thumb_size'] )
								? $agricola_template_args['thumb_size']
								: agricola_get_thumb_size(
									agricola_is_blog_style_use_masonry( $agricola_blog_style[0] )
										? (	strpos( agricola_get_theme_option( 'body_style' ), 'full' ) !== false || $agricola_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( agricola_get_theme_option( 'body_style' ), 'full' ) !== false || $agricola_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => agricola_is_blog_style_use_masonry( $agricola_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $agricola_components,
			'class'         => 'dots' == $agricola_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $agricola_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $agricola_post_link )
												? '<a href="' . esc_url( $agricola_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $agricola_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $agricola_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $agricola_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!