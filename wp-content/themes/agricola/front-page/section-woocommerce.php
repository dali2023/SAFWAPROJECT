<?php
$agricola_woocommerce_sc = agricola_get_theme_option( 'front_page_woocommerce_products' );
if ( ! empty( $agricola_woocommerce_sc ) ) {
	?><div class="front_page_section front_page_section_woocommerce<?php
		$agricola_scheme = agricola_get_theme_option( 'front_page_woocommerce_scheme' );
		if ( ! empty( $agricola_scheme ) && ! agricola_is_inherit( $agricola_scheme ) ) {
			echo ' scheme_' . esc_attr( $agricola_scheme );
		}
		echo ' front_page_section_paddings_' . esc_attr( agricola_get_theme_option( 'front_page_woocommerce_paddings' ) );
		if ( agricola_get_theme_option( 'front_page_woocommerce_stack' ) ) {
			echo ' sc_stack_section_on';
		}
	?>"
			<?php
			$agricola_css      = '';
			$agricola_bg_image = agricola_get_theme_option( 'front_page_woocommerce_bg_image' );
			if ( ! empty( $agricola_bg_image ) ) {
				$agricola_css .= 'background-image: url(' . esc_url( agricola_get_attachment_url( $agricola_bg_image ) ) . ');';
			}
			if ( ! empty( $agricola_css ) ) {
				echo ' style="' . esc_attr( $agricola_css ) . '"';
			}
			?>
	>
	<?php
		// Add anchor
		$agricola_anchor_icon = agricola_get_theme_option( 'front_page_woocommerce_anchor_icon' );
		$agricola_anchor_text = agricola_get_theme_option( 'front_page_woocommerce_anchor_text' );
		if ( ( ! empty( $agricola_anchor_icon ) || ! empty( $agricola_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
			echo do_shortcode(
				'[trx_sc_anchor id="front_page_section_woocommerce"'
											. ( ! empty( $agricola_anchor_icon ) ? ' icon="' . esc_attr( $agricola_anchor_icon ) . '"' : '' )
											. ( ! empty( $agricola_anchor_text ) ? ' title="' . esc_attr( $agricola_anchor_text ) . '"' : '' )
											. ']'
			);
		}
	?>
		<div class="front_page_section_inner front_page_section_woocommerce_inner
			<?php
			if ( agricola_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
				echo ' agricola-full-height sc_layouts_flex sc_layouts_columns_middle';
			}
			?>
				"
				<?php
				$agricola_css      = '';
				$agricola_bg_mask  = agricola_get_theme_option( 'front_page_woocommerce_bg_mask' );
				$agricola_bg_color_type = agricola_get_theme_option( 'front_page_woocommerce_bg_color_type' );
				if ( 'custom' == $agricola_bg_color_type ) {
					$agricola_bg_color = agricola_get_theme_option( 'front_page_woocommerce_bg_color' );
				} elseif ( 'scheme_bg_color' == $agricola_bg_color_type ) {
					$agricola_bg_color = agricola_get_scheme_color( 'bg_color', $agricola_scheme );
				} else {
					$agricola_bg_color = '';
				}
				if ( ! empty( $agricola_bg_color ) && $agricola_bg_mask > 0 ) {
					$agricola_css .= 'background-color: ' . esc_attr(
						1 == $agricola_bg_mask ? $agricola_bg_color : agricola_hex2rgba( $agricola_bg_color, $agricola_bg_mask )
					) . ';';
				}
				if ( ! empty( $agricola_css ) ) {
					echo ' style="' . esc_attr( $agricola_css ) . '"';
				}
				?>
		>
			<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
				<?php
				// Content wrap with title and description
				$agricola_caption     = agricola_get_theme_option( 'front_page_woocommerce_caption' );
				$agricola_description = agricola_get_theme_option( 'front_page_woocommerce_description' );
				if ( ! empty( $agricola_caption ) || ! empty( $agricola_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					// Caption
					if ( ! empty( $agricola_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $agricola_caption ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( $agricola_caption, 'agricola_kses_content' );
						?>
						</h2>
						<?php
					}

					// Description (text)
					if ( ! empty( $agricola_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
						?>
						<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $agricola_description ) ? 'filled' : 'empty'; ?>">
						<?php
							echo wp_kses( wpautop( $agricola_description ), 'agricola_kses_content' );
						?>
						</div>
						<?php
					}
				}

				// Content (widgets)
				?>
				<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
					<?php
					if ( 'products' == $agricola_woocommerce_sc ) {
						$agricola_woocommerce_sc_ids      = agricola_get_theme_option( 'front_page_woocommerce_products_per_page' );
						$agricola_woocommerce_sc_per_page = count( explode( ',', $agricola_woocommerce_sc_ids ) );
					} else {
						$agricola_woocommerce_sc_per_page = max( 1, (int) agricola_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
					}
					$agricola_woocommerce_sc_columns = max( 1, min( $agricola_woocommerce_sc_per_page, (int) agricola_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
					echo do_shortcode(
						"[{$agricola_woocommerce_sc}"
										. ( 'products' == $agricola_woocommerce_sc
												? ' ids="' . esc_attr( $agricola_woocommerce_sc_ids ) . '"'
												: '' )
										. ( 'product_category' == $agricola_woocommerce_sc
												? ' category="' . esc_attr( agricola_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
												: '' )
										. ( 'best_selling_products' != $agricola_woocommerce_sc
												? ' orderby="' . esc_attr( agricola_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
													. ' order="' . esc_attr( agricola_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
												: '' )
										. ' per_page="' . esc_attr( $agricola_woocommerce_sc_per_page ) . '"'
										. ' columns="' . esc_attr( $agricola_woocommerce_sc_columns ) . '"'
						. ']'
					);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
