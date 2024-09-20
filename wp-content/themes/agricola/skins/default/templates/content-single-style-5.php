<?php
/**
 * The "Style 5" template to display the content of the single post or attachment:
 * featured image placed to the post header and title placed inside content
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.75.0
 */
?>
<article id="post-<?php the_ID(); ?>"
	<?php
	post_class( 'post_item_single'
		. ' post_type_' . esc_attr( get_post_type() ) 
		. ' post_format_' . esc_attr( str_replace( 'post-format-', '', get_post_format() ) )
	);
	agricola_add_seo_itemprops();
	?>
>
<?php

	do_action( 'agricola_action_before_post_data' );

	agricola_add_seo_snippets();

	// Single post thumbnail and title
	if ( apply_filters( 'agricola_filter_single_post_header', is_singular( 'post' ) || is_singular( 'attachment' ) ) ) {
        $agricola_post_format = str_replace( 'post-format-', '', get_post_format() );
        $post_meta = in_array( $agricola_post_format, array( 'video' ) ) ? get_post_meta( get_the_ID(), 'trx_addons_options', true ) : false;
        $video_autoplay = ! empty( $post_meta['video_autoplay'] )
            && ! empty( $post_meta['video_list'] )
            && is_array( $post_meta['video_list'] )
            && count( $post_meta['video_list'] ) == 1
            && ( ! empty( $post_meta['video_list'][0]['video_url'] ) || ! empty( $post_meta['video_list'][0]['video_embed'] ) );

        // Featured image
		ob_start();
		agricola_show_post_featured_image( array(
			'thumb_bg' => false,
			'class'    => 'alignwide',
            'popup'    => false,
            'class_avg' => $video_autoplay
                ? 'with_video with_video_autoplay'   // 'with_thumb' is removed
                : '',
            'autoplay'  => $video_autoplay,
            'post_meta' => $post_meta
		) );
		$agricola_post_header = ob_get_contents();
		ob_end_clean();
		$agricola_with_featured_image = agricola_is_with_featured_image( $agricola_post_header );
		if ( strpos( $agricola_post_header, 'post_featured' ) !== false
			|| strpos( $agricola_post_header, 'post_meta' ) !== false
		) {
			?>
			<div class="post_header_wrap post_header_wrap_in_content post_header_wrap_style_<?php
				echo esc_attr( agricola_get_theme_option( 'single_style' ) );
				if ( $agricola_with_featured_image ) {
					echo ' with_featured_image';
				}
			?>">
				<?php
				agricola_show_layout( $agricola_post_header );
				?>
			</div>
			<?php
		}
	}

	do_action( 'agricola_action_before_post_content' );

	// Post content
	$agricola_share_position = agricola_array_get_keys_by_value( agricola_get_theme_option( 'share_position' ) );
	?>
	<div class="post_content post_content_single entry-content<?php
		if ( in_array( 'left', $agricola_share_position ) ) {
			echo ' post_info_vertical_present' . ( in_array( 'top', $agricola_share_position ) ? ' post_info_vertical_hide_on_mobile' : '' );
		}
	?>" itemprop="mainEntityOfPage">
		<?php
		if ( in_array( 'left', $agricola_share_position ) ) {
			?><div class="post_info_vertical<?php
				if ( agricola_get_theme_option( 'share_fixed' ) > 0 ) {
					echo ' post_info_vertical_fixed';
				}
			?>"><?php
				agricola_show_post_meta(
					apply_filters(
						'agricola_filter_post_meta_args',
						array(
							'components'      => 'share',
							'class'           => 'post_share_vertical',
							'share_type'      => 'block',
							'share_direction' => 'vertical',
						),
						'single',
						1
					)
				);
			?></div><?php
		}
		the_content();
		?>
	</div><!-- .entry-content -->
	<?php
	do_action( 'agricola_action_after_post_content' );
	
	// Post footer: Tags, likes, share, author, prev/next links and comments
	do_action( 'agricola_action_before_post_footer' );
	?>
	<div class="post_footer post_footer_single entry-footer">
		<?php
		agricola_show_post_pagination();
		if ( is_single() && ! is_attachment() ) {
			agricola_show_post_footer();
		}
		?>
	</div>
	<?php
	do_action( 'agricola_action_after_post_footer' );
	?>
</article>
