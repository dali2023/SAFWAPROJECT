<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

// Page (category, tag, archive, author) title

if ( agricola_need_page_title() ) {
	agricola_sc_layouts_showed( 'title', true );
	agricola_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								agricola_show_post_meta(
									apply_filters(
										'agricola_filter_post_meta_args', array(
											'components' => join( ',', agricola_array_get_keys_by_value( agricola_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', agricola_array_get_keys_by_value( agricola_get_theme_option( 'counters' ) ) ),
											'seo'        => agricola_is_on( agricola_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$agricola_blog_title           = agricola_get_blog_title();
							$agricola_blog_title_text      = '';
							$agricola_blog_title_class     = '';
							$agricola_blog_title_link      = '';
							$agricola_blog_title_link_text = '';
							if ( is_array( $agricola_blog_title ) ) {
								$agricola_blog_title_text      = $agricola_blog_title['text'];
								$agricola_blog_title_class     = ! empty( $agricola_blog_title['class'] ) ? ' ' . $agricola_blog_title['class'] : '';
								$agricola_blog_title_link      = ! empty( $agricola_blog_title['link'] ) ? $agricola_blog_title['link'] : '';
								$agricola_blog_title_link_text = ! empty( $agricola_blog_title['link_text'] ) ? $agricola_blog_title['link_text'] : '';
							} else {
								$agricola_blog_title_text = $agricola_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $agricola_blog_title_class ); ?>">
								<?php
								$agricola_top_icon = agricola_get_term_image_small();
								if ( ! empty( $agricola_top_icon ) ) {
									$agricola_attr = agricola_getimagesize( $agricola_top_icon );
									?>
									<img src="<?php echo esc_url( $agricola_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'agricola' ); ?>"
										<?php
										if ( ! empty( $agricola_attr[3] ) ) {
											agricola_show_layout( $agricola_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $agricola_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $agricola_blog_title_link ) && ! empty( $agricola_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $agricola_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $agricola_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'agricola_action_breadcrumbs' );
						$agricola_breadcrumbs = ob_get_contents();
						ob_end_clean();
						agricola_show_layout( $agricola_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
