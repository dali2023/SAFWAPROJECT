<div class="front_page_section front_page_section_contacts<?php
	$agricola_scheme = agricola_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! empty( $agricola_scheme ) && ! agricola_is_inherit( $agricola_scheme ) ) {
		echo ' scheme_' . esc_attr( $agricola_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( agricola_get_theme_option( 'front_page_contacts_paddings' ) );
	if ( agricola_get_theme_option( 'front_page_contacts_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$agricola_css      = '';
		$agricola_bg_image = agricola_get_theme_option( 'front_page_contacts_bg_image' );
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
	$agricola_anchor_icon = agricola_get_theme_option( 'front_page_contacts_anchor_icon' );
	$agricola_anchor_text = agricola_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $agricola_anchor_icon ) || ! empty( $agricola_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $agricola_anchor_icon ) ? ' icon="' . esc_attr( $agricola_anchor_icon ) . '"' : '' )
									. ( ! empty( $agricola_anchor_text ) ? ' title="' . esc_attr( $agricola_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( agricola_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' agricola-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$agricola_css      = '';
			$agricola_bg_mask  = agricola_get_theme_option( 'front_page_contacts_bg_mask' );
			$agricola_bg_color_type = agricola_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $agricola_bg_color_type ) {
				$agricola_bg_color = agricola_get_theme_option( 'front_page_contacts_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$agricola_caption     = agricola_get_theme_option( 'front_page_contacts_caption' );
			$agricola_description = agricola_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $agricola_caption ) || ! empty( $agricola_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $agricola_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $agricola_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $agricola_caption, 'agricola_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $agricola_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $agricola_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $agricola_description ), 'agricola_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$agricola_content = agricola_get_theme_option( 'front_page_contacts_content' );
			$agricola_layout  = agricola_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $agricola_layout && ( ! empty( $agricola_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $agricola_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $agricola_content ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $agricola_content, 'agricola_kses_content' );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $agricola_layout && ( ! empty( $agricola_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$agricola_sc = agricola_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $agricola_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $agricola_sc ) ? 'filled' : 'empty'; ?>">
					<?php
					agricola_show_layout( do_shortcode( $agricola_sc ) );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $agricola_layout && ( ! empty( $agricola_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
