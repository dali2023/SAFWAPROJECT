<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

							do_action( 'agricola_action_page_content_end_text' );
							
							// Widgets area below the content
							agricola_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'agricola_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'agricola_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'agricola_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'agricola_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$agricola_body_style = agricola_get_theme_option( 'body_style' );
					$agricola_widgets_name = agricola_get_theme_option( 'widgets_below_page' );
					$agricola_show_widgets = ! agricola_is_off( $agricola_widgets_name ) && is_active_sidebar( $agricola_widgets_name );
					$agricola_show_related = agricola_is_single() && agricola_get_theme_option( 'related_position' ) == 'below_page';
					if ( $agricola_show_widgets || $agricola_show_related ) {
						if ( 'fullscreen' != $agricola_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $agricola_show_related ) {
							do_action( 'agricola_action_related_posts' );
						}

						// Widgets area below page content
						if ( $agricola_show_widgets ) {
							agricola_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $agricola_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'agricola_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'agricola_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! agricola_is_singular( 'post' ) && ! agricola_is_singular( 'attachment' ) ) || ! in_array ( agricola_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="agricola_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'agricola_action_before_footer' );

				// Footer
				$agricola_footer_type = agricola_get_theme_option( 'footer_type' );
				if ( 'custom' == $agricola_footer_type && ! agricola_is_layouts_available() ) {
					$agricola_footer_type = 'default';
				}
				get_template_part( apply_filters( 'agricola_filter_get_template_part', "templates/footer-" . sanitize_file_name( $agricola_footer_type ) ) );

				do_action( 'agricola_action_after_footer' );

			}
			?>

			<?php do_action( 'agricola_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'agricola_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'agricola_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>