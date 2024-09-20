<?php
/**
 * The template to display Admin notices
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.0.1
 */

$agricola_theme_slug = get_option( 'template' );
$agricola_theme_obj  = wp_get_theme( $agricola_theme_slug );
?>
<div class="agricola_admin_notice agricola_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$agricola_theme_img = agricola_get_file_url( 'screenshot.jpg' );
	if ( '' != $agricola_theme_img ) {
		?>
		<div class="agricola_notice_image"><img src="<?php echo esc_url( $agricola_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'agricola' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="agricola_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'agricola' ),
				$agricola_theme_obj->get( 'Name' ) . ( AGRICOLA_THEME_FREE ? ' ' . __( 'Free', 'agricola' ) : '' ),
				$agricola_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="agricola_notice_text">
		<p class="agricola_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $agricola_theme_obj->description ) );
			?>
		</p>
		<p class="agricola_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'agricola' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="agricola_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=agricola_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'agricola' );
			?>
		</a>
	</div>
</div>
