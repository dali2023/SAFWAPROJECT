<?php
/**
 * Layout setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['agrios_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'agrios' ),
	'panel' => 'agrios_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','agrios' ),
					'boxed' => esc_html__( 'Boxed','agrios' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'agrios' ),
				'type' => 'checkbox',
				'active_callback' => 'agrios_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'agrios' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'agrios' ),
				'active_callback' => 'agrios_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'agrios' ),
				'type' => 'color',
				'active_callback' => 'agrios_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'agrios' ),
				'type' => 'image',
				'active_callback' => 'agrios_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'agrios' ),
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
				'active_callback' => 'agrios_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['agrios_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'agrios' ),
	'panel' => 'agrios_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'agrios' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'agrios' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'agrios' ),
				),
				'desc' => esc_html__( 'Specify layout for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings elementor when edit.', 'agrios' )
			),
		),
		array(
			'id' => 'custom_page_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Custom Page Layout Position', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'agrios' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'agrios' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'agrios' ),
				),
				'desc' => esc_html__( 'Specify layout for all custom pages.', 'agrios' )
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'agrios' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'agrios' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'agrios' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'agrios' )
			),
		),
		array(
			'id' => 'single_project_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Project Layout Position', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'agrios' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'agrios' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'agrios' ),
				),
				'desc' => esc_html__( 'Specify layout for all single project pages.', 'agrios' ),
				'active_callback' => 'agrios_cac_has_single_project',
			),
		),
		array(
			'id' => 'single_service_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Service Layout Position', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'agrios' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'agrios' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'agrios' ),
				),
				'desc' => esc_html__( 'Specify layout for all single service pages.', 'agrios' ),
				'active_callback' => 'agrios_cac_has_single_service',
			),
		),
	),
);

// Layout Widths
$this->sections['agrios_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'agrios' ),
	'panel' => 'agrios_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'agrios' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1170px', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .agrios-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'agrios' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'agrios' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 28%', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);