<?php
/**
 * Entry Content / Prev Next Link
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// // Exit if disabled via Customizer
if ( is_single() && ! agrios_get_mod( 'blog_single_prev_next_links', false ) )
	return;

?>

<div class="nav-links">
	<div class="prev">
		<?php previous_post_link('%link'); ?>    
	</div>

	<div class="next">
		<?php next_post_link('%link'); ?>
	</div>
</div>
