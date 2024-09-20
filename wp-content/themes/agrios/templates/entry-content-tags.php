<?php
/**
 * Entry Content / Tags
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( is_single() && ! agrios_get_mod( 'blog_single_tags', true ) )
	return;

if ( agrios_get_mod( 'blog_single_social_share', false ) )
	echo '<div class="agrios-socials-share single-post">';

$text = agrios_get_mod( 'blog_single_tags_text', 'Tags' );
if ($text) {
    the_tags( '<div class="post-tags clearfix"><div class="inner"><span class="tag-text">'. esc_html( $text ) . '</span>','','</div></div>' );
} else {
    the_tags( '<div class="post-tags clearfix"><div class="inner">','','</div></div>' );
}

if ( agrios_get_mod( 'blog_single_social_share', false ) )
	echo do_shortcode('[xs_social_share]') . '</div>';
