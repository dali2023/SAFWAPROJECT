<?php
/**
 * Entry Content / Meta
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( is_single() && ! agrios_get_mod( 'blog_single_meta', true ) )
	return;
?>

<div class="post-meta <?php echo esc_attr( agrios_get_mod( 'blog_custom_meta', 'style-1' ) ); ?>">
	<div class="post-meta-content">
		<div class="post-meta-content-inner clearfix">
			<?php agrios_entry_meta(); ?>
		</div>
	</div>
</div>



