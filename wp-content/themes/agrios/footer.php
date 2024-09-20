		</div><!-- /.main-content -->
		<?php 
	
		if ( agrios_footer_style() == '1' ) {
			// Basic Footer
			get_template_part( 'templates/footer-widgets');
			get_template_part( 'templates/bottom');
		} else { 
			// Elementor Footer 
			?>
			<footer class="agrios-footer footer">
				<div class="agrios-container">
	        		<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display(agrios_footer_style(), false); ?>
	        	</div>
	        </footer>
		<?php } ?>

		<?php get_template_part( 'templates/scroll-top'); ?>
	</div><!-- /#page -->
</div><!-- /#wrapper -->

<?php wp_footer(); ?>

</body>
</html>