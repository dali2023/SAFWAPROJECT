<?php
/**
 * Entry Search
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
	<div class="post-content-archive-wrap clearfix">
		<div class="post-content-wrap">
			<?php get_template_part( 'templates/entry-content-title' ); ?>
			<p class="desc"><?php the_excerpt(); ?></p>
			<?php printf( '<div class="custom-post-date">%1$s</div>', get_the_date( ) ); ?>
		</div><!-- /.post-content-wrap -->
	</div><!-- /.post-content-archive-wrap -->
</article><!-- /.hentry -->