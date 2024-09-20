<?php

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


add_filter( 'elementor/icons_manager/additional_tabs', 'mae_iconpicker_register' );

function mae_iconpicker_register( $icons = array() ) {

	$icons['core'] = array(
		'name'          => 'core',
		'label'         => esc_html__( 'Core Icons', 'masterlayer' ),
		'labelIcon'     => 'ci-like',
		'prefix'        => 'ci-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/core-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/core-icons/core-icons.json',
		'ver'           => '1.0.0',
	);

	$icons['agrios'] = array(
		'name'          => 'agrios',
		'label'         => esc_html__( 'Agrios Icons', 'masterlayer' ),
		'labelIcon'     => 'agi-farmer',
		'prefix'        => 'agi-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/agrios-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/agrios-icons/agrios-icons.json',
		'ver'           => '1.0.0',
	);

	return $icons;
}
