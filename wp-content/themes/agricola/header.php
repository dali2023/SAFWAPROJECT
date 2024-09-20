<?php
/**
 * The Header: Logo and main menu
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( agricola_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'agricola_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'agricola_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('agricola_action_body_wrap_attributes'); ?>>

		<?php do_action( 'agricola_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'agricola_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('agricola_action_page_wrap_attributes'); ?>>

			<?php do_action( 'agricola_action_page_wrap_start' ); ?>

			<?php
			$agricola_full_post_loading = ( agricola_is_singular( 'post' ) || agricola_is_singular( 'attachment' ) ) && agricola_get_value_gp( 'action' ) == 'full_post_loading';
			$agricola_prev_post_loading = ( agricola_is_singular( 'post' ) || agricola_is_singular( 'attachment' ) ) && agricola_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $agricola_full_post_loading && ! $agricola_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="agricola_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to content", 'agricola' ); ?></a>
				<?php if ( agricola_sidebar_present() ) { ?>
				<a class="agricola_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to sidebar", 'agricola' ); ?></a>
				<?php } ?>
				<a class="agricola_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to footer", 'agricola' ); ?></a>

				<?php
				do_action( 'agricola_action_before_header' );

				// Header
				$agricola_header_type = agricola_get_theme_option( 'header_type' );
				if ( 'custom' == $agricola_header_type && ! agricola_is_layouts_available() ) {
					$agricola_header_type = 'default';
				}
				get_template_part( apply_filters( 'agricola_filter_get_template_part', "templates/header-" . sanitize_file_name( $agricola_header_type ) ) );

				// Side menu
				if ( in_array( agricola_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'agricola_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'agricola_action_after_header' );

			}
			?>

			<?php do_action( 'agricola_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( agricola_is_off( agricola_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $agricola_header_type ) ) {
						$agricola_header_type = agricola_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $agricola_header_type && agricola_is_layouts_available() ) {
						$agricola_header_id = agricola_get_custom_header_id();
						if ( $agricola_header_id > 0 ) {
							$agricola_header_meta = agricola_get_custom_layout_meta( $agricola_header_id );
							if ( ! empty( $agricola_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$agricola_footer_type = agricola_get_theme_option( 'footer_type' );
					if ( 'custom' == $agricola_footer_type && agricola_is_layouts_available() ) {
						$agricola_footer_id = agricola_get_custom_footer_id();
						if ( $agricola_footer_id ) {
							$agricola_footer_meta = agricola_get_custom_layout_meta( $agricola_footer_id );
							if ( ! empty( $agricola_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'agricola_action_page_content_wrap_class', $agricola_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'agricola_filter_is_prev_post_loading', $agricola_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( agricola_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'agricola_action_page_content_wrap_data', $agricola_prev_post_loading );
			?>>
				<?php
				do_action( 'agricola_action_page_content_wrap', $agricola_full_post_loading || $agricola_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'agricola_filter_single_post_header', agricola_is_singular( 'post' ) || agricola_is_singular( 'attachment' ) ) ) {
					if ( $agricola_prev_post_loading ) {
						if ( agricola_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'agricola_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$agricola_path = apply_filters( 'agricola_filter_get_template_part', 'templates/single-styles/' . agricola_get_theme_option( 'single_style' ) );
					if ( agricola_get_file_dir( $agricola_path . '.php' ) != '' ) {
						get_template_part( $agricola_path );
					}
				}

				// Widgets area above page
				$agricola_body_style   = agricola_get_theme_option( 'body_style' );
				$agricola_widgets_name = agricola_get_theme_option( 'widgets_above_page' );
				$agricola_show_widgets = ! agricola_is_off( $agricola_widgets_name ) && is_active_sidebar( $agricola_widgets_name );
				if ( $agricola_show_widgets ) {
					if ( 'fullscreen' != $agricola_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					agricola_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $agricola_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'agricola_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $agricola_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'agricola_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'agricola_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="agricola_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( agricola_is_singular( 'post' ) || agricola_is_singular( 'attachment' ) )
							&& $agricola_prev_post_loading 
							&& agricola_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'agricola_action_between_posts' );
						}

						// Widgets area above content
						agricola_create_widgets_area( 'widgets_above_content' );

						do_action( 'agricola_action_page_content_start_text' );
