<?php
/**
 * Header / Info
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get defaults from Customizer
$cls = '';

$email = agrios_get_mod('header_info_email', '');
$phone = agrios_get_mod('header_info_phone', '');
$address = agrios_get_mod('header_info_address', '');

?>

<div class="header-info <?php echo esc_attr( $cls ); ?>">
    <?php
    if ( $email ) : ?>
        <span class="email content">
            <?php echo do_shortcode( $email ); ?>
        </span>
    <?php endif;

    if ( $phone ) : ?>
        <span class="phone content">
            <?php echo do_shortcode( $phone ); ?>
        </span>
    <?php endif; 

    if ( $address ) : ?>
        <span class="address content">
            <?php echo do_shortcode( $address ); ?>
        </span>
    <?php endif; ?>
</div><!-- /.header-info -->