<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.50
 */

$agricola_template_args = get_query_var( 'agricola_template_args' );
if ( is_array( $agricola_template_args ) ) {
	$agricola_columns    = empty( $agricola_template_args['columns'] ) ? 2 : max( 1, $agricola_template_args['columns'] );
	$agricola_blog_style = array( $agricola_template_args['type'], $agricola_columns );
} else {
	$agricola_blog_style = explode( '_', agricola_get_theme_option( 'blog_style' ) );
	$agricola_columns    = empty( $agricola_blog_style[1] ) ? 2 : max( 1, $agricola_blog_style[1] );
}
$agricola_blog_id       = agricola_get_custom_blog_id( join( '_', $agricola_blog_style ) );
$agricola_blog_style[0] = str_replace( 'blog-custom-', '', $agricola_blog_style[0] );
$agricola_expanded      = ! agricola_sidebar_present() && agricola_get_theme_option( 'expand_content' ) == 'expand';
$agricola_components    = ! empty( $agricola_template_args['meta_parts'] )
							? ( is_array( $agricola_template_args['meta_parts'] )
								? join( ',', $agricola_template_args['meta_parts'] )
								: $agricola_template_args['meta_parts']
								)
							: agricola_array_get_keys_by_value( agricola_get_theme_option( 'meta_parts' ) );
$agricola_post_format   = get_post_format();
$agricola_post_format   = empty( $agricola_post_format ) ? 'standard' : str_replace( 'post-format-', '', $agricola_post_format );

$agricola_blog_meta     = agricola_get_custom_layout_meta( $agricola_blog_id );
$agricola_custom_style  = ! empty( $agricola_blog_meta['scripts_required'] ) ? $agricola_blog_meta['scripts_required'] : 'none';

if ( ! empty( $agricola_template_args['slider'] ) || $agricola_columns > 1 || ! agricola_is_off( $agricola_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $agricola_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( agricola_is_off( $agricola_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $agricola_custom_style ) ) . "-1_{$agricola_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $agricola_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $agricola_columns )
					. ' post_layout_' . esc_attr( $agricola_blog_style[0] )
					. ' post_layout_' . esc_attr( $agricola_blog_style[0] ) . '_' . esc_attr( $agricola_columns )
					. ( ! agricola_is_off( $agricola_custom_style )
						? ' post_layout_' . esc_attr( $agricola_custom_style )
							. ' post_layout_' . esc_attr( $agricola_custom_style ) . '_' . esc_attr( $agricola_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'agricola_action_show_layout', $agricola_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $agricola_template_args['slider'] ) || $agricola_columns > 1 || ! agricola_is_off( $agricola_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
