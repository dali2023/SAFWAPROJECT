<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'agricola_booked_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'agricola_booked_theme_setup9', 9 );
	function agricola_booked_theme_setup9() {
		if ( agricola_exists_booked() ) {
			add_action( 'wp_enqueue_scripts', 'agricola_booked_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'agricola_booked_frontend_scripts', 10, 1 );
			add_action( 'wp_enqueue_scripts', 'agricola_booked_frontend_scripts_responsive', 2000 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'agricola_booked_frontend_scripts_responsive', 10, 1 );
			add_filter( 'agricola_filter_merge_styles', 'agricola_booked_merge_styles' );
			add_filter( 'agricola_filter_merge_styles_responsive', 'agricola_booked_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'agricola_filter_tgmpa_required_plugins', 'agricola_booked_tgmpa_required_plugins' );
			add_filter( 'agricola_filter_theme_plugins', 'agricola_booked_theme_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( ! function_exists( 'agricola_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('agricola_filter_tgmpa_required_plugins',	'agricola_booked_tgmpa_required_plugins');
	function agricola_booked_tgmpa_required_plugins( $list = array() ) {
		if ( agricola_storage_isset( 'required_plugins', 'booked' ) && agricola_storage_get_array( 'required_plugins', 'booked', 'install' ) !== false && agricola_is_theme_activated() ) {
			$path = agricola_get_plugin_source_path( 'plugins/booked/booked.zip' );
			if ( ! empty( $path ) || agricola_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => agricola_storage_get_array( 'required_plugins', 'booked', 'title' ),
					'slug'     => 'booked',
					'source'   => ! empty( $path ) ? $path : 'upload://booked.zip',
					'version'  => '2.3',
					'required' => false,
				);
			}
		}
		return $list;
	}
}


// Filter theme-supported plugins list
if ( ! function_exists( 'agricola_booked_theme_plugins' ) ) {
	//Handler of the add_filter( 'agricola_filter_theme_plugins', 'agricola_booked_theme_plugins' );
	function agricola_booked_theme_plugins( $list = array() ) {
		return agricola_add_group_and_logo_to_slave( $list, 'booked', 'booked-' );
	}
}


// Check if plugin installed and activated
if ( ! function_exists( 'agricola_exists_booked' ) ) {
	function agricola_exists_booked() {
		return class_exists( 'booked_plugin' );
	}
}


// Return a relative path to the plugin styles depend the version
if ( ! function_exists( 'agricola_booked_get_styles_dir' ) ) {
	function agricola_booked_get_styles_dir( $file ) {
		$base_dir = 'plugins/booked/';
		return $base_dir
				. ( defined( 'BOOKED_VERSION' ) && version_compare( BOOKED_VERSION, '2.4', '<' ) && agricola_get_folder_dir( $base_dir . 'old' )
					? 'old/'
					: ''
					)
				. $file;
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'agricola_booked_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'agricola_booked_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'agricola_booked_frontend_scripts', 10, 1 );
	function agricola_booked_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && agricola_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$agricola_url = agricola_get_file_url( agricola_booked_get_styles_dir( 'booked.css' ) );
			if ( '' != $agricola_url ) {
				wp_enqueue_style( 'agricola-booked', $agricola_url, array(), null );
			}
		}
	}
}


// Enqueue responsive styles for frontend
if ( ! function_exists( 'agricola_booked_frontend_scripts_responsive' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'agricola_booked_frontend_scripts_responsive', 2000 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'agricola_booked_frontend_scripts_responsive', 10, 1 );
	function agricola_booked_frontend_scripts_responsive( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && agricola_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$agricola_url = agricola_get_file_url( agricola_booked_get_styles_dir( 'booked-responsive.css' ) );
			if ( '' != $agricola_url ) {
				wp_enqueue_style( 'agricola-booked-responsive', $agricola_url, array(), null, agricola_media_for_load_css_responsive( 'booked' ) );
			}
		}
	}
}


// Merge custom styles
if ( ! function_exists( 'agricola_booked_merge_styles' ) ) {
	//Handler of the add_filter('agricola_filter_merge_styles', 'agricola_booked_merge_styles');
	function agricola_booked_merge_styles( $list ) {
		$list[ agricola_booked_get_styles_dir( 'booked.css' ) ] = false;
		return $list;
	}
}


// Merge responsive styles
if ( ! function_exists( 'agricola_booked_merge_styles_responsive' ) ) {
	//Handler of the add_filter('agricola_filter_merge_styles_responsive', 'agricola_booked_merge_styles_responsive');
	function agricola_booked_merge_styles_responsive( $list ) {
		$list[ agricola_booked_get_styles_dir( 'booked-responsive.css' ) ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( agricola_exists_booked() ) {
	require_once agricola_get_file_dir( agricola_booked_get_styles_dir( 'booked-style.php' ) );
}
