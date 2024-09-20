<?php
/**
 * Gets all theme mods and stores them in an easily accessable global var to limit DB requests
 *
 * @package agrios
 * @version 3.8.9
 */

global $agrios_theme_mods;
$agrios_theme_mods = get_theme_mods();

// Returns theme mod from global var
function agrios_get_mod( $id, $default = '' ) {

	// Return get_theme_mod on customize_preview
	if ( is_customize_preview() ) {
		return get_theme_mod( $id, $default );
	}
   
	// Get global object
	global $agrios_theme_mods;

	// Return data from global object
	if ( ! empty( $agrios_theme_mods ) ) {

		// Return value
		if ( isset( $agrios_theme_mods[$id] ) ) {
			return $agrios_theme_mods[$id];
		} 
		else {
			return $default;
		}
	}

	// Global object not found return using get_theme_mod
	else {
		return get_theme_mod( $id, $default );
	}
}

// Returns global mods
function agrios_get_mods() {
	global $agrios_theme_mods;
	return $agrios_theme_mods;
}