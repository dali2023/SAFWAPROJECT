<?php
/**
 * Required plugins
 *
 * @package AGRICOLA
 * @since AGRICOLA 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$agricola_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'agricola' ),
	'page_builders' => esc_html__( 'Page Builders', 'agricola' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'agricola' ),
	'socials'       => esc_html__( 'Socials and Communities', 'agricola' ),
	'events'        => esc_html__( 'Events and Appointments', 'agricola' ),
	'content'       => esc_html__( 'Content', 'agricola' ),
	'other'         => esc_html__( 'Other', 'agricola' ),
);
$agricola_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'agricola' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'agricola' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $agricola_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'agricola' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'agricola' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $agricola_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'agricola' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'agricola' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $agricola_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'agricola' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'agricola' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $agricola_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'agricola' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'agricola' ),
		'required'    => false,
		'install'     => false,
		'logo'        => 'woocommerce.png',
		'group'       => $agricola_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'agricola' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'agricola' ),
		'required'    => false,
		'install'     => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $agricola_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'agricola' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'agricola' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $agricola_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'agricola' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'agricola' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $agricola_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'agricola' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $agricola_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'agricola' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $agricola_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'agricola' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'agricola' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $agricola_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'agricola' ),
		'description' => '',
		'required'    => false,
		'logo'        => agricola_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $agricola_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'agricola' ),
		'description' => '',
		'required'    => false,
		'logo'        => agricola_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $agricola_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'agricola' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => agricola_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $agricola_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'agricola' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => agricola_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $agricola_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'agricola' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => agricola_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $agricola_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'agricola' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $agricola_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'agricola' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $agricola_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'agricola' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'agricola' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $agricola_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'agricola' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'agricola' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $agricola_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'agricola' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'agricola' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $agricola_theme_required_plugins_groups['other'],
	),
);

if ( AGRICOLA_THEME_FREE ) {
	unset( $agricola_theme_required_plugins['js_composer'] );
	unset( $agricola_theme_required_plugins['booked'] );
	unset( $agricola_theme_required_plugins['the-events-calendar'] );
	unset( $agricola_theme_required_plugins['calculated-fields-form'] );
	unset( $agricola_theme_required_plugins['essential-grid'] );
	unset( $agricola_theme_required_plugins['revslider'] );
	unset( $agricola_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $agricola_theme_required_plugins['trx_updater'] );
	unset( $agricola_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
agricola_storage_set( 'required_plugins', $agricola_theme_required_plugins );