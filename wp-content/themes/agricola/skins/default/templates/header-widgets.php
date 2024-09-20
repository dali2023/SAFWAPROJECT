<?php
/**
 * The template to display the widgets area in the header
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */

// Header sidebar
$agricola_header_name    = agricola_get_theme_option( 'header_widgets' );
$agricola_header_present = ! agricola_is_off( $agricola_header_name ) && is_active_sidebar( $agricola_header_name );
if ( $agricola_header_present ) {
	agricola_storage_set( 'current_sidebar', 'header' );
	$agricola_header_wide = agricola_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $agricola_header_name ) ) {
		dynamic_sidebar( $agricola_header_name );
	}
	$agricola_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $agricola_widgets_output ) ) {
		$agricola_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $agricola_widgets_output );
		$agricola_need_columns   = strpos( $agricola_widgets_output, 'columns_wrap' ) === false;
		if ( $agricola_need_columns ) {
			$agricola_columns = max( 0, (int) agricola_get_theme_option( 'header_columns' ) );
			if ( 0 == $agricola_columns ) {
				$agricola_columns = min( 6, max( 1, agricola_tags_count( $agricola_widgets_output, 'aside' ) ) );
			}
			if ( $agricola_columns > 1 ) {
				$agricola_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $agricola_columns ) . ' widget', $agricola_widgets_output );
			} else {
				$agricola_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $agricola_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'agricola_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $agricola_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $agricola_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'agricola_action_before_sidebar', 'header' );
				agricola_show_layout( $agricola_widgets_output );
				do_action( 'agricola_action_after_sidebar', 'header' );
				if ( $agricola_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $agricola_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'agricola_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
