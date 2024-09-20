<div class="front_page_section front_page_section_about<?php
	$agricola_scheme = agricola_get_theme_option( 'front_page_about_scheme' );
	if ( ! empty( $agricola_scheme ) && ! agricola_is_inherit( $agricola_scheme ) ) {
		echo ' scheme_' . esc_attr( $agricola_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( agricola_get_theme_option( 'front_page_about_paddings' ) );
	if ( agricola_get_theme_option( 'front_page_about_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$agricola_css      = '';
		$agricola_bg_image = agricola_get_theme_option( 'front_page_about_bg_image' );
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
	$agricola_anchor_icon = agricola_get_theme_option( 'front_page_about_anchor_icon' );
	$agricola_anchor_text = agricola_get_theme_option( 'front_page_about_anchor_text' );
if ( ( ! empty( $agricola_anchor_icon ) || ! empty( $agricola_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_about"'
									. ( ! empty( $agricola_anchor_icon ) ? ' icon="' . esc_attr( $agricola_anchor_icon ) . '"' : '' )
									. ( ! empty( $agricola_anchor_text ) ? ' title="' . esc_attr( $agricola_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_about_inner
	<?php
	if ( agricola_get_theme_option( 'front_page_about_fullheight' ) ) {
		echo ' agricola-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$agricola_css           = '';
			$agricola_bg_mask       = agricola_get_theme_option( 'front_page_about_bg_mask' );
			$agricola_bg_color_type = agricola_get_theme_option( 'front_page_about_bg_color_type' );
			if ( 'custom' == $agricola_bg_color_type ) {
				$agricola_bg_color = agricola_get_theme_option( 'front_page_about_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$agricola_caption = agricola_get_theme_option( 'front_page_about_caption' );
			if ( ! empty( $agricola_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo ! empty( $agricola_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $agricola_caption, 'agricola_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$agricola_description = agricola_get_theme_option( 'front_page_about_description' );
			if ( ! empty( $agricola_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo ! empty( $agricola_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $agricola_description ), 'agricola_kses_content' ); ?></div>
				<?php
			}

			// Content
			$agricola_content = agricola_get_theme_option( 'front_page_about_content' );
			if ( ! empty( $agricola_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo ! empty( $agricola_content ) ? 'filled' : 'empty'; ?>">
					<?php
					$agricola_page_content_mask = '%%CONTENT%%';
					if ( strpos( $agricola_content, $agricola_page_content_mask ) !== false ) {
						$agricola_content = preg_replace(
							'/(\<p\>\s*)?' . $agricola_page_content_mask . '(\s*\<\/p\>)/i',
							sprintf(
								'<div class="front_page_section_about_source">%s</div>',
								apply_filters( 'the_content', get_the_content() )
							),
							$agricola_content
						);
					}
					agricola_show_layout( $agricola_content );
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
