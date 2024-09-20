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

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
	<?php if ( get_post_type() == 'elementor_library' ) { ?>
		<div class="inner-content">
			<?php		
			get_template_part( 'templates/entry-content-body' );
			?>
		</div>
	<?php } else { ?>
		<div class="inner-content">
			<?php		
			get_template_part( 'templates/entry-content-media' );
			get_template_part( 'templates/entry-content-meta' );
			get_template_part( 'templates/entry-content-title' );	
			get_template_part( 'templates/entry-content-body' );
			get_template_part( 'templates/entry-content-tags' );
			get_template_part( 'templates/entry-content-prev-next-links' );
			?>
		</div>
		
		<?php
		get_template_part( 'templates/entry-content-author' );
		get_template_part( 'templates/entry-content-related' );
		?>
	<?php } ?>
</article><!-- /.hentry -->