<?php
/**
 * Blog Single setting for Customizer
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Single General
$this->sections['agrios_blog_single_general'] = array(
	'title' => esc_html__( 'General', 'agrios' ),
	'panel' => 'agrios_blogsingle',
	'settings' => array(
		array(
			'id' => 'agrios_blog_single_featured_title',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Feature Title', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_featured_title',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Title', 'agrios' ),
				'type' => 'text',
				'description' => esc_html__( 'If empty, it will be blog title by default.', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'agrios' ),
				'active_callback' => 'agrios_cac_has_featured_title',
			),
		),
		array(
			'id' => 'agrios_blog_single_media_heading',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Media', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_media',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Media on Single Post', 'agrios' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_media_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Media Margin', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'agrios_blog_single_meta_heading',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Meta', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_meta',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Meta on Single Post', 'agrios' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-single-wrap .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'agrios_blog_single_title_heading',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Title', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Title on Single Post', 'agrios' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Margin', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left. Default: 0 0 10px 0.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-single-wrap .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_single_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-content-single-wrap .post-title'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'agrios_blog_single_tags_heading',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Tags', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_tags',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Tags on Single Post', 'agrios' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_tags_text',
			'default' => esc_html__( 'Tags', 'agrios' ),
			'control' => array(
				'label' => esc_html__( 'Tags Text', 'agrios' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'agrios_blog_single_social_heading',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Social Share', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_social_share',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Social Share after Post Tags (need install WP Social)', 'agrios' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'agrios_blog_single_related_heading',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Related Posts', 'agrios' ),
			),
		),
		array(
			'id' => 'agrios_blog_single_related',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Related Posts on Single Post', 'agrios' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'agrios_blog_single_custom_date_heading',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Custom Post Date', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_custom_post_date',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Custom Post Date on Single Post', 'agrios' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Blog Single Post Author
$this->sections['agrios_blog_single_post_author'] = array(
	'title' => esc_html__( 'Blog Single Post - Author', 'agrios' ),
	'panel' => 'agrios_blogsingle',
	'settings' => array(
		array(
			'id' => 'blog_single_author_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'agrios' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_single_author_name_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Name Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .name',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_author_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .author-desc > p',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_author_avatar_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Image Width', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-author .author-avatar',
					'.hentry .post-author .author-avatar a'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'blog_single_author_avatar_margin_right',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Image Right Margin', 'agrios' ),
				'description' => esc_html__( 'Example: 40px.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .author-avatar',
				'alter' => 'margin-right',
			),
		),
		array(
			'id' => 'blog_single_author_avatar_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Image Rounded', 'agrios' ),
				'description' => esc_html__( 'Example: 10px. 0px is square.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .author-avatar a, .hentry .post-author .author-avatar a img',
				'alter' => 'border-radius',
			),
		),
	),
);

// Blog Single Comment
$this->sections['agrios_blog_single_post_comment'] = array(
	'title' => esc_html__( 'Blog Single Post - Comment', 'agrios' ),
	'panel' => 'agrios_blogsingle',
	'settings' => array(
		array(
			'id' => 'heading_comment_title',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Title', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_comment_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'.comments-area .comments-title',
					'.comments-area .comment-reply-title'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_comment_title_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Bottom Margin', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'.comments-area .comments-title',
					'.comments-area .comment-reply-title'
				),
				'alter' => 'margin-bottom',
			),
		),
		// Comment List
		array(
			'id' => 'heading_comment_list',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Comment List', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_comment_avatar_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Avatar Width', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article .gravatar',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'blog_single_comment_avatar_margin_right',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Avatar Right Margin', 'agrios' ),
				'description' => esc_html__( 'Example: 30px.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article .gravatar',
				'alter' => 'margin-right',
			),
		),
		array(
			'id' => 'blog_single_comment_avatar_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Avatar Rounded', 'agrios' ),
				'description' => esc_html__( 'Example: 10px. 0px is square.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article .gravatar',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'blog_single_comment_article_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Article Bottom Margin', 'agrios' ),
				'description' => esc_html__( 'Example: 40px.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'blog_single_comment_name_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Name Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.comment-author, .comment-author a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_comment_time_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Date Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.comment-time',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_comment_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.comment-text',
				'alter' => 'color',
			),
		),
		// Comment Form
		array(
			'id' => 'heading_comment_form',
			'control' => array(
				'type' => 'agrios-heading',
				'label' => esc_html__( 'Comment Form', 'agrios' ),
			),
		),
		array(
			'id' => 'blog_single_comment_form_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Form Border Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.name-wrap input, .email-wrap input, .message-wrap textarea',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_single_comment_form_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Form Rounded', 'agrios' ),
				'description' => esc_html__( 'Example: 3px. 0px is square.', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.name-wrap input, .email-wrap input, .message-wrap textarea',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'blog_single_comment_form_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Form Border Width', 'agrios' ),
			),
			'inline_css' => array(
				'target' => '.name-wrap input, .email-wrap input, .message-wrap textarea',
				'alter' => 'border-width',
			),
		),
	),
);

// Blog Single Prev-Next Links
$this->sections['agrios_blog_single_prev_next_links'] = array(
	'title' => esc_html__( 'Blog Single Post - Previous Next Links', 'agrios' ),
	'panel' => 'agrios_blogsingle',
	'settings' => array(
		array(
			'id' => 'blog_single_prev_next_links',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'agrios' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Color', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Background', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Color : Hover', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a:hover',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_bg_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Background : Hover', 'agrios' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a:hover',
				),
				'alter' => 'background-color',
			),
		),
	),
);
