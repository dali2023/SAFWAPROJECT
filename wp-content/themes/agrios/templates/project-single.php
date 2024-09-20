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

<article id="project-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
	<div class="inner-content single-project-inner">
		<?php		
		echo '<div class="post-media">' . get_the_post_thumbnail( get_the_ID(), 'agrios-project-standard' ) . '</div>';
		echo '<h1 class="post-title">' . get_the_title() . '</h1>';
		the_content();
		
		get_template_part( 'templates/project-prev-next-links' );

		get_template_part( 'templates/project-related' ); 
		?>
	</div>
</article><!-- /.hentry -->