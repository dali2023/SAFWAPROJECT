<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

if ( agricola_sidebar_present() ) {
	
	$agricola_sidebar_type = agricola_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $agricola_sidebar_type && ! agricola_is_layouts_available() ) {
		$agricola_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $agricola_sidebar_type ) {
		// Default sidebar with widgets
		$agricola_sidebar_name = agricola_get_theme_option( 'sidebar_widgets' );
		agricola_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $agricola_sidebar_name ) ) {
			dynamic_sidebar( $agricola_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$agricola_sidebar_id = agricola_get_custom_sidebar_id();
		do_action( 'agricola_action_show_layout', $agricola_sidebar_id );
	}
	$agricola_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $agricola_out ) ) {
		$agricola_sidebar_position    = agricola_get_theme_option( 'sidebar_position' );
		$agricola_sidebar_position_ss = agricola_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $agricola_sidebar_position );
			echo ' sidebar_' . esc_attr( $agricola_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $agricola_sidebar_type );

			$agricola_sidebar_scheme = apply_filters( 'agricola_filter_sidebar_scheme', agricola_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $agricola_sidebar_scheme ) && ! agricola_is_inherit( $agricola_sidebar_scheme ) && 'custom' != $agricola_sidebar_type ) {
				echo ' scheme_' . esc_attr( $agricola_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="agricola_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'agricola_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $agricola_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$agricola_title = apply_filters( 'agricola_filter_sidebar_control_title', 'float' == $agricola_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'agricola' ) : '' );
				$agricola_text  = apply_filters( 'agricola_filter_sidebar_control_text', 'above' == $agricola_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'agricola' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $agricola_title ); ?>"><?php echo esc_html( $agricola_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'agricola_action_before_sidebar', 'sidebar' );
				agricola_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $agricola_out ) );
				do_action( 'agricola_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'agricola_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
