<?php
/**
 * Scroll Top Button
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! agrios_get_mod( 'scroll_top', true ) ) return false;
?>

<div id="scroll-top"></div>