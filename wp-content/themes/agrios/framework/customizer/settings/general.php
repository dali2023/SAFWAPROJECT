<?php
/**
 * General setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['agrios_Accent_Colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'agrios' ),
	'panel' => 'agrios_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#4BAF47',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'agrios' ),
				'type' => 'color',
				'active_callback' => 'agrios_cac_no_elementor_accent_color'
			),
		),
	)
);

// PreLoader
$this->sections['agrios_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'agrios' ),
	'panel' => 'agrios_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'' => esc_html__( 'Disable','agrios' ),
					'animsition' => esc_html__( 'Enable','agrios' ),
				),
			),
		),
		array(
			'id' => 'preloader_style',
			'default' => 'default',
			'control' => array(
				'label' => esc_html__( 'Style', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'default' => esc_html__( 'Default','agrios' ),
					'image' => esc_html__( 'Image','agrios' ),
				),
			),
		),
		array(
			'id' => 'preload_color_1',
			'default' => '#4BAF47',
			'control' => array(
				'label' => esc_html__( 'Color 1', 'agrios' ),
				'type' => 'color',
				'active_callback' => 'agrios_cac_preloader_default'
			),
			'inline_css' => array(
				'target' => '.animsition-loading',
				'alter' => 'border-top-color',
			),
		),
		array(
			'id' => 'preload_color_2',
			'default' => '#EEC044',
			'control' => array(
				'label' => esc_html__( 'Color 2', 'agrios' ),
				'type' => 'color',
				'active_callback' => 'agrios_cac_preloader_default'
			),
			'inline_css' => array(
				'target' => '.animsition-loading:before',
				'alter' => 'border-top-color',
			),
		),
		array(
			'id' => 'preloader_image',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Preloader Image', 'agrios' ),
				'active_callback' => 'agrios_cac_preloader_image',
				'type' => 'image',
			),
		),
	)
);

// Header Site
$header_style = array( '1' => esc_html__( 'Basic', 'agrios' ) );
$header_fixed = array( '1' => esc_html__( 'None', 'agrios' ));
$args = array(  
    'post_type' => 'header',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
);

$loop = new WP_Query( $args ); 
while ( $loop->have_posts() ) : $loop->the_post(); 
	$header_style[get_the_id()] = get_the_title();
	$header_fixed[get_the_id()] = get_the_title();
endwhile;
wp_reset_postdata();

$this->sections['agrios_header_site'] = array(
	'title' => esc_html__( 'Header', 'agrios' ),
	'panel' => 'agrios_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'agrios' ),
				'type' => 'select',
				'choices' => $header_style,
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings Elementor when edit.', 'agrios' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Fixed', 'agrios' ),
				'type' => 'select',
				'choices' => $header_fixed,
				'active_callback' => 'agrios_cac_header_elementor_builder'
			),
		),
	),
);

// Footer
$footer_style = array( '1' => esc_html__( 'Basic', 'agrios' ) );
$args = array(  
    'post_type' => 'footer',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
);

$loop = new WP_Query( $args ); 
while ( $loop->have_posts() ) : $loop->the_post(); 
	$footer_style[get_the_id()] = get_the_title();
endwhile;
wp_reset_postdata();

$this->sections['agrios_footer_site'] = array(
	'title' => esc_html__( 'Footer', 'agrios' ),
	'panel' => 'agrios_general',
	'settings' => array(
		array(
			'id' => 'footer_site_style',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Style', 'agrios' ),
				'type' => 'select',
				'choices' => $footer_style,
				'desc' => esc_html__( 'Footer Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings Elementor when edit.', 'agrios' )
			),
		),
	),
);

// Scroll to top
$this->sections['agrios_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'agrios' ),
	'panel' => 'agrios_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'agrios' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Forms
$this->sections['agrios_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'agrios' ),
	'panel' => 'agrios_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'agrios' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 1px', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['agrios_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'agrios' ),
	'panel' => 'agrios_general',
	'settings' => array(
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Mobile Logo', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'agrios' ),
				'description' => esc_html__( 'Example: 150px', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'mobile_logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Margin', 'agrios' ),
				'description' => esc_html__( 'Example: 20px 0px 20px 0px', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Mobile Menu', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'agrios' ),
				'description' => esc_html__( 'Example: 40px', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
		array(
			'id' => 'mobile_menu_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo', 'agrios' ),
				'active_callback' => 'agrios_cac_header_basic',
				'type' => 'image',
			),
		),
		array(
			'id' => 'mobile_menu_logo_width',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo: Width', 'agrios' ),
				'type' => 'text',
				'active_callback' => 'agrios_cac_header_basic'
			),
		),
		// Featured Title
		array(
			'id' => 'heading_featured_title',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Mobile Featured Title', 'agrios' ),
			),
		),
		array(
			'id' => 'mobile_featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#featured-title .inner-wrap, #featured-title.centered .inner-wrap, #featured-title.creative .inner-wrap',
				'alter' => 'padding',
			),
		),
	)
);

// 404 Page
$this->sections['agrios_404_page'] = array(
	'title' => esc_html__( '404 Page', 'agrios' ),
	'panel' => 'agrios_general',
	'settings' => array(
		array(
			'id' => '404_image',
			'default' => '',
			'control' => array(
				'label' => esc_html__( '404 Image', 'agrios' ),
				'type' => 'image',
			),
		),
		array(
			'id' => '404_image_max_width',
			'control' => array(
				'label' => esc_html__( '404 Image: Width', 'agrios' ),
				'type' => 'text',
			),
		),
	)
);
