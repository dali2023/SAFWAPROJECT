<?php
// Custom classes to body tag
function agrios_body_classes() {
	$classes[] = '';

	// Elementor
	if ( class_exists( '\Elementor\Plugin' ) ) {
		if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$classes[] = 'elementor-preview';
		}
	}
	
	if ( get_post_type() == 'elementor_library' )
		$classes[] = 'elementor-template';

	// Get layout position
	$classes[] = agrios_layout_position();
	$layout_position = agrios_layout_position();
	if ( ! is_page() && $layout_position != 'no-sidebar' && ! is_active_sidebar( 'sidebar-blog' ) )
		$classes[] = 'blog-empty-widget';

	if ( is_page() && $layout_position != 'no-sidebar' && ! is_active_sidebar( 'sidebar-page' ) )
		$classes[] = 'page-empty-widget';

	// Get layout style
	$layout_style = agrios_get_mod( 'site_layout_style', 'full-width' );
	$classes[] = 'site-layout-'. $layout_style;


	if ( is_page() ) $classes[] = 'is-page';

	if ( is_page_template( 'templates/page-onepage.php' ) )
		$classes[] = 'one-page';

	// Add classes for Woo pages
	if ( class_exists( 'woocommerce' ) ) {
		if ( agrios_is_woocommerce_page() )
			$classes[] = 'woocommerce-page';

		if ( is_account_page() )
			$classes[] = 'woocommerce-account';

		if ( agrios_is_woocommerce_shop() )
			$classes[] = 'main-shop-page';

		if ( agrios_is_woocommerce_shop() || agrios_is_woocommerce_archive_product() ) {
			$shop_cols = agrios_get_mod( 'shop_columns', '3' );
			$classes[] = 'shop-col-'. $shop_cols;
		}
	}

	// Add class for search page
	if ( is_search() )
		$classes[] = 'search-page';

	// Boxed Layout dropshadow
	if ( 'boxed' == $layout_style && agrios_get_mod( 'site_layout_boxed_shadow' ) )
		$classes[] = 'box-shadow';

	if ( agrios_get_mod( 'header_search_icon' ) )
		$classes[] = 'header-simple-search';

	if ( is_singular( 'post' ) )
		$classes[] = 'is-single-post';

	if ( is_singular( 'project' ) )
		$classes[] = 'page-single-project';

	if ( is_singular( 'service' ) )
		$classes[] = 'page-single-service';

	if ( agrios_get_mod( 'agrios_blog_single_related', false ) )
		$classes[] = 'has-related-post';

	if ( agrios_get_mod( 'project_related', false ) )
		$classes[] = 'has-related-project';

	if ( ! is_active_sidebar( 'sidebar-footer-1' ) &&
		! is_active_sidebar( 'sidebar-footer-2' ) &&
		! is_active_sidebar( 'sidebar-footer-3' ) &&
		! is_active_sidebar( 'sidebar-footer-4' ) &&
		! is_active_sidebar( 'sidebar-footer-5' ))
		$classes[] = 'footer-no-widget';

	// CPT pages
	if ( is_singular( 'header' ) )
		$classes[] = 'page-header-single';
	
	if ( is_singular( 'footer' ) )
		$classes[] = 'page-footer-single';

	// Hide related product
	$column = agrios_get_mod( 'shop_realted_columns', 3 );
	if ($column == 0)
		$classes[] = 'shop-no-related-product';

	// Return classes
	return $classes;
}
add_filter( 'body_class', 'agrios_body_classes' );

// Remove products and pages results from the search form widget
function agrios_custom_search_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'product' ) )
		return;

	if ( $query->is_search() ) {
    	$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

	    $post_types_to_remove = array( 'product' );

	    foreach ( $post_types_to_remove as $post_type_to_remove ) {
			if ( is_array( $in_search_post_types ) 
				&& in_array( $post_type_to_remove, $in_search_post_types ) 
			) {
				unset( $in_search_post_types[ $post_type_to_remove ] );
				$query->set( 'post_type', $in_search_post_types );
			}
	    }
	}
}
add_action( 'pre_get_posts', 'agrios_custom_search_query' );

// Sets the content width in pixels, based on the theme's design and stylesheet.
function agrios_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'agrios_content_width', 1170 );
}
add_action( 'after_setup_theme', 'agrios_content_width', 0 );

// Modifies tag cloud widget arguments to have all tags in the widget same font size.
function agrios_widget_tag_cloud_args( $args ) {
	$args['largest'] = 14;
	$args['smallest'] = 14;
	$args['unit'] = 'px';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'agrios_widget_tag_cloud_args' );

// Change default read more style
function agrios_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'agrios_excerpt_more', 10 );

// Custom excerpt length for posts
function agrios_content_length() {
	$length = agrios_get_mod( 'blog_excerpt_length', '50' );
	$length = intval( $length );

	if ( ! empty( $length ) || $length != 0 )
		return $length;
}
add_filter( 'excerpt_length', 'agrios_content_length', 999 );

// Prevent page scroll when clicking the more link
function agrios_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );

	return $link;
}
add_filter( 'the_content_more_link', 'agrios_remove_more_link_scroll' );

// Remove read-more link so we can custom it
function agrios_remove_read_more_link() {
    return '';
}
add_filter( 'the_content_more_link', 'agrios_remove_read_more_link' );

// Custom html categories widget
function cat_count_span( $link ) {
  $link = str_replace( '</a> (', '</a> <span>', $link );
  $link = str_replace( ')', '</span>', $link );
  return $link;
}
add_filter( 'wp_list_categories', 'cat_count_span' );
 
// Column of related product
function agrios_related_products_args( $args ) {
	$column = agrios_get_mod( 'shop_realted_columns', 3 );
	if ($column !== 0) {
		$args['posts_per_page'] = $column; 
		$args['columns'] = $column; 
		return $args;
	} 
}

add_filter( 'woocommerce_output_related_products_args', 'agrios_related_products_args', 20 );

// Remove p in CF7
add_filter('wpcf7_autop_or_not', '__return_false');

// ShopEngine Affiliate 
add_filter('wpmet_author_id', function($id) { return 586; });
