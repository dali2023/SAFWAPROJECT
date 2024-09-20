<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'agricola_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'agricola_cf7_theme_setup9', 9 );
	function agricola_cf7_theme_setup9() {
		if ( agricola_exists_cf7() ) {
			add_action( 'wp_enqueue_scripts', 'agricola_cf7_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_cf7', 'agricola_cf7_frontend_scripts', 10, 1 );
			add_filter( 'agricola_filter_merge_styles', 'agricola_cf7_merge_styles' );
			add_filter( 'agricola_filter_merge_scripts', 'agricola_cf7_merge_scripts' );
		}
		if ( is_admin() ) {
			add_filter( 'agricola_filter_tgmpa_required_plugins', 'agricola_cf7_tgmpa_required_plugins' );
			add_filter( 'agricola_filter_theme_plugins', 'agricola_cf7_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'agricola_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('agricola_filter_tgmpa_required_plugins',	'agricola_cf7_tgmpa_required_plugins');
	function agricola_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( agricola_storage_isset( 'required_plugins', 'contact-form-7' ) && agricola_storage_get_array( 'required_plugins', 'contact-form-7', 'install' ) !== false ) {
			// CF7 plugin
			$list[] = array(
				'name'     => agricola_storage_get_array( 'required_plugins', 'contact-form-7', 'title' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'agricola_cf7_theme_plugins' ) ) {
	//Handler of the add_filter( 'agricola_filter_theme_plugins', 'agricola_cf7_theme_plugins' );
	function agricola_cf7_theme_plugins( $list = array() ) {
		return agricola_add_group_and_logo_to_slave( $list, 'contact-form-7', 'contact-form-7-' );
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'agricola_exists_cf7' ) ) {
	function agricola_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'agricola_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'agricola_cf7_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_cf7', 'agricola_cf7_frontend_scripts', 10, 1 );
	function agricola_cf7_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && agricola_need_frontend_scripts( 'cf7' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$agricola_url = agricola_get_file_url( 'plugins/contact-form-7/contact-form-7.css' );
			if ( '' != $agricola_url ) {
				wp_enqueue_style( 'agricola-contact-form-7', $agricola_url, array(), null );
			}
			$agricola_url = agricola_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
			if ( '' != $agricola_url ) {
				wp_enqueue_script( 'agricola-contact-form-7', $agricola_url, array( 'jquery' ), null, true );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'agricola_cf7_merge_styles' ) ) {
	//Handler of the add_filter('agricola_filter_merge_styles', 'agricola_cf7_merge_styles');
	function agricola_cf7_merge_styles( $list ) {
		$list[ 'plugins/contact-form-7/contact-form-7.css' ] = false;
		return $list;
	}
}

// Merge custom scripts
if ( ! function_exists( 'agricola_cf7_merge_scripts' ) ) {
	//Handler of the add_filter('agricola_filter_merge_scripts', 'agricola_cf7_merge_scripts');
	function agricola_cf7_merge_scripts( $list ) {
		$list[ 'plugins/contact-form-7/contact-form-7.js' ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( agricola_exists_cf7() ) {
	require_once agricola_get_file_dir( 'plugins/contact-form-7/contact-form-7-style.php' );
}
