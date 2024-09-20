<?php
/**
 * The template to display the background video in the header
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.14
 */
$agricola_header_video = agricola_get_header_video();
$agricola_embed_video  = '';
if ( ! empty( $agricola_header_video ) && ! agricola_is_from_uploads( $agricola_header_video ) ) {
	if ( agricola_is_youtube_url( $agricola_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $agricola_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php agricola_show_layout( agricola_get_embed_video( $agricola_header_video ) ); ?></div>
		<?php
	}
}
