<?php
/**
 * Header / Logo
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define vars
$logo_size = '';
$logo_cls = agrios_get_mod( 'logo_extra' );
$logo_url = home_url( '/' );
$logo_title = get_bloginfo( 'name' );

$logo_img = agrios_get_mod( 'custom_logo' );
$logo_width = agrios_get_mod( 'logo_width' );
$logo_margin = agrios_get_mod( 'logo_margin' );

// if page has custom logo
if ( is_page() ) {
	$custom_logo = agrios_get_elementor_option( 'custom_logo' );
	if ( $custom_logo ) {
		if ( $custom_logo['url'] ) {
			$logo_img = $custom_logo['url'];
		} 
	}
}

if ( $logo_width ) $logo_size .= 'max-width:'. intval( $logo_width ) .'px;';
?>

<div id="site-logo" 
	<?php if ( $logo_margin ) echo 'style="' . esc_attr( $logo_margin ) . '"'; ?>
	<?php if ( $logo_cls ) echo 'class="' . esc_attr( $logo_cls ) . '"'; ?>>

	<div id="site-logo-inner" <?php if ( $logo_size ) echo 'style="' . esc_attr( $logo_size ) . '"'; ?>>
		<?php if ( $logo_img ) : ?>
			<a class="main-logo" href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home" ><img src="<?php echo esc_url( $logo_img ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" /></a>
		<?php else : ?>
			<a class="site-logo-text" href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home"><?php echo esc_html( $logo_title ); ?></a>
		<?php endif; ?>
	</div>
</div><!-- #site-logo -->
