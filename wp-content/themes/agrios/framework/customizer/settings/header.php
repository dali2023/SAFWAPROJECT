<?php
/**
 * Header setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Header General
$this->sections['agrios_header_general'] = array(
	'title' => esc_html__( 'General', 'agrios' ),
	'panel' => 'agrios_header',
	'settings' => array(
		array(
			'id' => 'header_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'agrios' ),
				'type' => 'color',
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#site-header'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'header_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(min-width: 1199px)',
				'target' => '.site-header-inner',
				'alter' => 'padding',
			),
			'sanitize_callback' => 'esc_url',
		),
		array(
			'id' => 'header_class',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Extra Class', 'agrios' ),
				'type' => 'text',
				'desc' => esc_html__( 'Additional classes to custom your header.', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
	)
);

// Header Logo
$this->sections['agrios_header_logo'] = array(
	'title' => esc_html__( 'Logo', 'agrios' ),
	'panel' => 'agrios_header',
	'settings' => array(
		array(
			'id' => 'custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'agrios' ),
				'type' => 'image',
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		array(
			'id' => 'logo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'agrios' ),
				'type' => 'text',
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
	)
);

// Header Menu
$this->sections['agrios_header_menu'] = array(
	'title' => esc_html__( 'Menu', 'agrios' ),
	'panel' => 'agrios_header',
	'settings' => array(
		// General
		array(
			'id' => 'menu_show_current',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Show current page indicator?', 'agrios' ),
				'type' => 'checkbox',
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		array(
			'id' => 'menu_link_spacing',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Link Spacing', 'agrios' ),
				'description' => esc_html__( 'Example: 20px', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li',
				),
				'alter' => array(
					'padding-left',
					'padding-right',
				),
			),
		),
		array(
			'id' => 'menu_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Menu Height', 'agrios' ),
				'description' => esc_html__( 'Example: 100px', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#site-header #main-nav > ul > li > a',
				),
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		array(
			'id' => 'menu_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li > a > span',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li > a:hover > span',
				),
				'alter' => 'color',
			),
		),
	)
);

// Search & Cart
$this->sections['agrios_header_search_cart'] = array(
	'title' => esc_html__( 'Search & Cart', 'agrios' ),
	'panel' => 'agrios_header',
	'settings' => array(
		// Search Icon
		array(
			'id' => 'header_search_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Search Icon', 'agrios' ),
				'type' => 'checkbox',
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		// Cart Icon
		array(
			'id' => 'header_cart_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Cart Icon', 'agrios' ),
				'type' => 'checkbox',
				'active_callback' => 'agrios_cac_header_cart_icon',
			),
		),
	)
);

// Button
$this->sections['agrios_header_button'] = array(
	'title' => esc_html__( 'Button', 'agrios' ),
	'panel' => 'agrios_header',
	'settings' => array(
		array(
			'id' => 'header_button_text',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Text', 'agrios' ),
				'type' => 'text',
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		array(
			'id' => 'header_button_url',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Url', 'agrios' ),
				'type' => 'text',
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
	),
);

// Header Info
$this->sections['agrios_header_info'] = array(
	'title' => esc_html__( 'Header Information', 'agrios' ),
	'panel' => 'agrios_header',
	'settings' => array(
		// Content
		array(
			'id' => 'header_info_phone',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Phone', 'agrios' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		array(
			'id' => 'header_info_email',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Email', 'agrios' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'agrios_cac_header_basic'
			),
		),	
		array(
			'id' => 'header_info_address',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Address', 'agrios' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		// Style
		array(
			'id' => 'header_info_icon_color',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Info Icon Color', 'agrios' ),
				'type' => 'color',
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'target' => '.header-info .content:before',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'header_info_color',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Info Text Color', 'agrios' ),
				'type' => 'color',
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'target' => '.header-info .content',
				'alter' => 'color',
			),
		),
	),
);

// Top Bar Socials
$this->sections['agrios_header_socials'] = array(
	'title' => esc_html__( 'Social', 'agrios' ),
	'panel' => 'agrios_header',
	'settings' => array(
		array(
			'id' => 'header_socials',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'agrios' ),
				'type' => 'checkbox',
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		array(
			'id' => 'header_socials_spacing',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Socials Spacing', 'agrios' ),
				'description' => esc_html__( 'Gap Between Each Social. Example: 10px.', 'agrios' ),
				'type' => 'text',
				'active_callback' => 'agrios_cac_has_header_socials',
			),
		),
	),
);

// Social settings
$social_options = agrios_header_social_options();
foreach ( $social_options as $key => $val ) {
	$this->sections['agrios_header_socials']['settings'][] = array(
		'id' => 'header_social_profiles[' . $key .']',
		'control' => array(
			'label' => $val['label'],
			'type' => 'text',
			'active_callback' => 'agrios_cac_has_header_socials',
		),
	);
}

// Remove var from memory
unset( $social_options );
