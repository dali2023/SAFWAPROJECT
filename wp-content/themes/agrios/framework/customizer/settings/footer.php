<?php
/**
 * Footer setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer General
$this->sections['agrios_footer_general'] = array(
	'title' => esc_html__( 'General', 'agrios' ),
	'panel' => 'agrios_footer',
	'settings' => array(
		array(
			'id' => 'footer_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Footer Column(s)', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'5' => '5-3-4',
					'4' => '3-3-3-3',
					'3' => '4-4-4',
					'2' => '6-6',
					'1' => '12',
				),
				'active_callback' => 'agrios_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_column_gutter',
			'default' => '30',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Footer Column Gutter', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'5'    => '5px',
					'10'   => '10px',
					'15'   => '15px',
					'20'   => '20px',
					'25'   => '25px',
					'30'   => '30px',
					'35'   => '35px',
					'40'   => '40px',
					'45'   => '45px',
					'50'   => '50px',
					'60'   => '60px',
					'70'   => '70px',
					'80'   => '80px',
				),
				'active_callback' => 'agrios_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'agrios' ),
				'active_callback' => 'agrios_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'agrios' ),
				'active_callback' => 'agrios_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'footer_bg_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'agrios' ),
				'active_callback' => 'agrios_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_bg_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'agrios' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'agrios' ),
					'cover'        => esc_html__( 'Cover', 'agrios' ),
					'center-top'   => esc_html__( 'Center Top', 'agrios' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'agrios' ),
					'fixed'        => esc_html__( 'Fixed Center', 'agrios' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'agrios' ),
					'repeat'       => esc_html__( 'Repeat', 'agrios' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'agrios' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'agrios' ),
				),
				'active_callback' => 'agrios_cac_footer_basic'
			),
		),
		array(
			'id' => 'footer_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'agrios' ),
				'description' => esc_html__( 'Example: 60px.', 'agrios' ),
				'active_callback' => 'agrios_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'footer_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'agrios' ),
				'description' => esc_html__( 'Example: 60px.', 'agrios' ),
				'active_callback' => 'agrios_cac_footer_basic'
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-bottom',
			),
		),
	),
);