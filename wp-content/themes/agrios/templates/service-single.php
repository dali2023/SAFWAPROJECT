<?php
/**
 * Entry Content / Single
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} 

?>

<article id="service-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
	<div class="inner-content single-service-inner">
		<?php		
		echo '<div class="post-media">' . get_the_post_thumbnail( get_the_ID(), 'agrios-post-standard' ) . '</div>';
		echo '<h1 class="post-title">' . get_the_title() . '</h1>';
		the_content();
		?>
	</div>
</article><!-- /.hentry -->