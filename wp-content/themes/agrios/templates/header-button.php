<?php
/**
 * Header / Button
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get defaults from Customizer
$text = agrios_get_mod( 'header_button_text', '' );
$url = agrios_get_mod( 'header_button_url', '' );

if ( $text && $url ) : ?>
	<div class="header-button">
	    <?php
	    if ( $text && $url ) : ?>
	        <a class="button" href="<?php echo esc_url( do_shortcode( $url ) ); ?>">
	            <?php echo do_shortcode( $text ); ?>
	        </a>
	    <?php endif; ?>
	</div><!-- /.header-info -->
<?php endif; ?>