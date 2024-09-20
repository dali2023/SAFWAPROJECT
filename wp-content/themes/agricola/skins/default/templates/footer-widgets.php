<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.10
 */

// Footer sidebar
$agricola_footer_name    = agricola_get_theme_option( 'footer_widgets' );
$agricola_footer_present = ! agricola_is_off( $agricola_footer_name ) && is_active_sidebar( $agricola_footer_name );
if ( $agricola_footer_present ) {
	agricola_storage_set( 'current_sidebar', 'footer' );
	$agricola_footer_wide = agricola_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $agricola_footer_name ) ) {
		dynamic_sidebar( $agricola_footer_name );
	}
	$agricola_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $agricola_out ) ) {
		$agricola_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $agricola_out );
		$agricola_need_columns = true;   //or check: strpos($agricola_out, 'columns_wrap')===false;
		if ( $agricola_need_columns ) {
			$agricola_columns = max( 0, (int) agricola_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $agricola_columns ) {
				$agricola_columns = min( 4, max( 1, agricola_tags_count( $agricola_out, 'aside' ) ) );
			}
			if ( $agricola_columns > 1 ) {
				$agricola_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $agricola_columns ) . ' widget', $agricola_out );
			} else {
				$agricola_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $agricola_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'agricola_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $agricola_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $agricola_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'agricola_action_before_sidebar', 'footer' );
				agricola_show_layout( $agricola_out );
				do_action( 'agricola_action_after_sidebar', 'footer' );
				if ( $agricola_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $agricola_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'agricola_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
