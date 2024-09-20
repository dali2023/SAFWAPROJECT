<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['agrios_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'agrios' ),
	'panel' => 'agrios_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'agrios' ),
				'type' => 'checkbox',
				'active_callback' => 'agrios_cac_footer_basic'
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Copyrights, 2022 Company.com',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'agrios' ),
				'type' => 'agrios_textarea',
				'active_callback' => 'agrios_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'agrios' ),
				'active_callback'=> 'agrios_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'agrios' ),
				'active_callback'=> 'agrios_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'agrios' ),
				'active_callback' => 'agrios_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'agrios' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'agrios' ),
					'cover'        => esc_html__( 'Cover', 'agrios' ),
					'center-top'        => esc_html__( 'Center Top', 'agrios' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'agrios' ),
					'fixed'        => esc_html__( 'Fixed Center', 'agrios' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'agrios' ),
					'repeat'       => esc_html__( 'Repeat', 'agrios' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'agrios' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'agrios' ),
				),
				'active_callback' => 'agrios_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'agrios' ),
				'active_callback'=> 'agrios_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'line_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Line Color', 'agrios' ),
				'active_callback'=> 'agrios_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom:before',
				'alter' => 'background-color',
			),
		),
	),
);

