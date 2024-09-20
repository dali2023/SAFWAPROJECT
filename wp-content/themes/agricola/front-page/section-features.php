<div class="front_page_section front_page_section_features<?php
	$agricola_scheme = agricola_get_theme_option( 'front_page_features_scheme' );
	if ( ! empty( $agricola_scheme ) && ! agricola_is_inherit( $agricola_scheme ) ) {
		echo ' scheme_' . esc_attr( $agricola_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( agricola_get_theme_option( 'front_page_features_paddings' ) );
	if ( agricola_get_theme_option( 'front_page_features_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$agricola_css      = '';
		$agricola_bg_image = agricola_get_theme_option( 'front_page_features_bg_image' );
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
	$agricola_anchor_icon = agricola_get_theme_option( 'front_page_features_anchor_icon' );
	$agricola_anchor_text = agricola_get_theme_option( 'front_page_features_anchor_text' );
if ( ( ! empty( $agricola_anchor_icon ) || ! empty( $agricola_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_features"'
									. ( ! empty( $agricola_anchor_icon ) ? ' icon="' . esc_attr( $agricola_anchor_icon ) . '"' : '' )
									. ( ! empty( $agricola_anchor_text ) ? ' title="' . esc_attr( $agricola_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_features_inner
	<?php
	if ( agricola_get_theme_option( 'front_page_features_fullheight' ) ) {
		echo ' agricola-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$agricola_css      = '';
			$agricola_bg_mask  = agricola_get_theme_option( 'front_page_features_bg_mask' );
			$agricola_bg_color_type = agricola_get_theme_option( 'front_page_features_bg_color_type' );
			if ( 'custom' == $agricola_bg_color_type ) {
				$agricola_bg_color = agricola_get_theme_option( 'front_page_features_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_features_content_wrap content_wrap">
			<?php
			// Caption
			$agricola_caption = agricola_get_theme_option( 'front_page_features_caption' );
			if ( ! empty( $agricola_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_features_caption front_page_block_<?php echo ! empty( $agricola_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $agricola_caption, 'agricola_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$agricola_description = agricola_get_theme_option( 'front_page_features_description' );
			if ( ! empty( $agricola_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_features_description front_page_block_<?php echo ! empty( $agricola_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $agricola_description ), 'agricola_kses_content' ); ?></div>
				<?php
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_features_output">
				<?php
				if ( is_active_sidebar( 'front_page_features_widgets' ) ) {
					dynamic_sidebar( 'front_page_features_widgets' );
				} elseif ( current_user_can( 'edit_theme_options' ) ) {
					if ( ! agricola_exists_trx_addons() ) {
						agricola_customizer_need_trx_addons_message();
					} else {
						agricola_customizer_need_widgets_message( 'front_page_features_caption', 'ThemeREX Addons - Services' );
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
