<?php
/**
 * Services setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Service General
$this->sections['agrios_services_general'] = array(
	'title' => esc_html__( 'General', 'agrios' ),
	'panel' => 'agrios_services',
	'settings' => array(
		array(
			'id' => 'agrios_service_single_featured_title',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Feature Title', 'agrios' ),
			),
		),
		array(
			'id' => 'service_single_featured_title',
			'default' =>  '',
			'control' => array(
				'label' => esc_html__( 'Title', 'agrios' ),
				'type' => 'text',
				'description' => esc_html__( 'If empty, it will be blog title by default.', 'agrios' ),
			),
		),
		array(
			'id' => 'service_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Service: Featured Title Background', 'agrios' ),
			),
		)
	),
);