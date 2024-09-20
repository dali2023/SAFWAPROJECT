<?php
/**
 * Blog setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['agrios_blog_post'] = array(
	'title' => esc_html__( 'General', 'agrios' ),
	'panel' => 'agrios_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'Our Blog', 'agrios' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'agrios' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'agrios' ),
				'description' => esc_html__( 'Example: 30px.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Entry Border Width', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'blog_entry_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Border Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'meta,title,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'agrios' ),
				'type' => 'agrios-sortable',
				'object' => 'Agrios_Customize_Control_Sorter',
				'choices' => array(
					'meta'            => esc_html__( 'Meta', 'agrios' ),
					'title'           => esc_html__( 'Title', 'agrios' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'agrios' ),
					'readmore'        => esc_html__( 'Read More', 'agrios' ),

				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'agrios' ),
			),
		),
	),
);

// Blog Posts Media
$this->sections['agrios_blog_post_media'] = array(
	'title' => esc_html__( 'Blog Post - Media', 'agrios' ),
	'panel' => 'agrios_blog',
	'settings' => array(
		array(
			'id' => 'blog_media_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Margin', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin-bottom',
			),
		),
	),
);

// Blog Posts Title
$this->sections['agrios_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'agrios' ),
	'panel' => 'agrios_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['agrios_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'agrios' ),
	'panel' => 'agrios_blog',
	'settings' => array(
		array(
			'id' => 'blog_before_author',
			'default' => esc_html__( 'by', 'agrios' ),
			'control' => array(
				'label' => esc_html__( 'Text Before Author', 'agrios' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_before_category',
			'default' => esc_html__( 'in', 'agrios' ),
			'control' => array(
				'label' => esc_html__( 'Text Before Category', 'agrios' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'author', 'comments', 'date', 'categories' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'agrios' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'agrios' ),
				'type' => 'agrios-sortable',
				'object' => 'Agrios_Customize_Control_Sorter',
				'choices' => array(
					'author'     => esc_html__( 'Author', 'agrios' ),
					'comments' => esc_html__( 'Comments', 'agrios' ),
					'date'       => esc_html__( 'Date', 'agrios' ),
					'categories' => esc_html__( 'Categories', 'agrios' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Item Meta', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['agrios_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'agrios' ),
	'panel' => 'agrios_blog',
	'settings' => array(
		array(
			'id' => 'blog_content_style',
			'default' => 'style-2',
			'control' => array(
				'label' => esc_html__( 'Content Style', 'agrios' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Normal', 'agrios' ),
					'style-2' => esc_html__( 'Excerpt', 'agrios' ),
				),
			),
		),
		array(
			'id' => 'blog_excerpt_length',
			'default' => '50',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'agrios' ),
				'type' => 'text',
				'desc' => esc_html__( 'This option only apply for Content Style: Excerpt.', 'agrios' )
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['agrios_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'agrios' ),
	'panel' => 'agrios_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'Read More', 'agrios' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'agrios' ),
				'type' => 'text',
			),
		),
	),
);

