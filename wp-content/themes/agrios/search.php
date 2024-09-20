<?php get_header(); ?>
    <div id="content-wrap" class="agrios-container">
		<?php if ( have_posts() ) : ?>
	        <div id="site-content" class="site-content clearfix">
	            <div id="inner-content" class="inner-content-wrap">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'templates/entry-search' ); ?>
					<?php endwhile; ?>
					<?php agrios_pagination(); ?>
	            </div><!-- /#inner-content -->
	        </div><!-- /#site-content -->

			<?php get_sidebar(); ?>
        <?php else: ?>
			<div class="search-not-found no-results">
				<div class="no-results-content">
					<div class="no-results-title">
						<h1><?php esc_html_e( 'Nothing Found', 'agrios' ); ?></h1>
					</div>
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'agrios' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div><!-- /.no-results -->
		<?php endif; ?>
    </div><!-- /#content-wrap -->
<?php get_footer(); ?>



