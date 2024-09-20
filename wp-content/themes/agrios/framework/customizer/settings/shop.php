<?php
/**
 * Shop setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Shop
$this->sections['agrios_shop_general'] = array(
	'title' => esc_html__( 'Main Shop', 'agrios' ),
	'panel' => 'agrios_shop',
	'settings' => array(
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'agrios' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'agrios' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'agrios' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'agrios' ),
				'active_callback' => 'agrios_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'Our Shop', 'agrios' ),
			'control' => array(
				'label' => esc_html__( 'Shop: Featured Title', 'agrios' ),
				'type' => 'agrios_textarea',
				'active_callback' => 'agrios_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop: Featured Title Background', 'agrios' ),
				'active_callback' => 'agrios_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 6,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'agrios' ),
				'type' => 'number',
				'active_callback' => 'agrios_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'agrios_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'agrios' ),
				'description' => esc_html__( 'Example: 30px.', 'agrios' ),
				'active_callback' => 'agrios_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.products li',
				'alter' => 'margin-top',
			),
		),
	),
);

// Single Shop
$this->sections['agrios_single_shop_general'] = array(
	'title' => esc_html__( 'Single Shop', 'agrios' ),
	'panel' => 'agrios_shop',
	'settings' => array(
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'agrios' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'agrios' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'agrios' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'agrios' ),
				'active_callback' => 'agrios_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title',
			'default' => esc_html__( 'Our Shop', 'agrios' ),
			'control' => array(
				'label' => esc_html__( 'Shop Single: Featured Title', 'agrios' ),
				'type' => 'text',
				'active_callback' => 'agrios_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop Single: Featured Title Background', 'agrios' ),
				'active_callback' => 'agrios_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_realted_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Related Product Columns', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'0' => '0',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'agrios_cac_has_woo',
			),
		),
	),
);