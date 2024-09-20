<?php
/**
 * Entry Content / Media
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// // Exit if disabled via Customizer
if ( is_single() && ! agrios_get_mod( 'blog_single_media', true ) )
	return;

$html = $cls = '';

switch ( get_post_format() ) {
	case 'gallery':
		$icon = 'post-gallery';
		$size = 'agrios-post-standard';

		if ( is_single() )
			$size = 'agrios-post-single';
		$images = agrios_get_elementor_option( 'gallery_images' );

		if ( empty( $images ) ) {
			break;
		}

		$html = '<div class="blog-gallery">';
  
		foreach ( $images as $image ) {
			$html .= sprintf(
				'<div>%1$s</div>',
				wp_get_attachment_image( $image['id'], $size )
			);
		}

		$html .= '</div>';
		break;
	case 'video':
		$icon = 'post-video';
		$video = agrios_get_elementor_option( 'video_url' );
		if ( ! $video )
			break;

		if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
			// If URL: show oEmbed HTML
			if ( $oembed = @wp_oembed_get( $video ) )
				$html .= $oembed;
		} else {
			// If embed code: just display
			$html .= $video;
		}
		break;
	default:
		$icon = 'post-standard';
		$size = 'agrios-post-standard';

		$thumb = get_the_post_thumbnail( get_the_ID(), $size );
		if ( empty( $thumb ) ) {
			return;
		}

		if ( is_single() ) {
			$html .= $thumb;
		} else {
			$html .= '<a href="'. esc_url( get_permalink() ) .'">';
			$html .= $thumb;
			$html .= '</a>';
		}
}

// Custom Post Date
if ( agrios_get_mod('blog_single_custom_post_date', false) )
	$html .= '<span class="custom-post-date">' . esc_html(get_the_date('d F Y')) . '</span>';


if ( $html )
	printf( '<div class="post-media %2$s clearfix">%1$s</div>', $html, $cls );
