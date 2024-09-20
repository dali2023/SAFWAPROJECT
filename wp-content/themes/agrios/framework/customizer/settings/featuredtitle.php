<?php
/**
 * Featured Title setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['agrios_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'agrios' ),
	'panel' => 'agrios_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'agrios' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_style',
			'default' => 'simple',
			'control' => array(
				'label'  => esc_html__( 'Style', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Simple', 'agrios' ),
					'centered' => esc_html__( 'Centered', 'agrios' ),
				),
				'active_callback' => 'agrios_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'agrios' ),
				'description' => esc_html__( 'Example: 250px 0px 150px 0px', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 992px)',
				'target' => '#featured-title .inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
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
				'active_callback' => 'agrios_cac_has_featured_title',
			),
		),
	),
);

// Featured Title Headings
$this->sections['agrios_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Headings', 'agrios' ),
	'panel' => 'agrios_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'agrios' ),
				'type' => 'checkbox',
				'active_callback' => 'agrios_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_heading_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Bottom Margin', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title_center',
				'description' => esc_html__( 'Example: 30px.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.centered .title-group',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .main-title',
				'alter' => 'color',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['agrios_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'agrios' ),
	'panel' => 'agrios_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'agrios' ),
				'type' => 'checkbox',
				'active_callback' => 'agrios_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a:hover',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'portfolio_page',
			'control' => array(
				'label'  => esc_html__( 'Projects', 'agrios' ),
				'type' => 'select',
				'choices' => agrios_get_pages(),
				'active_callback' => 'agrios_cac_has_single_project',
			),
		),
	),
);