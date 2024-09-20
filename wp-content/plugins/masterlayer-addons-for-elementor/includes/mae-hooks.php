<?php

// Add new image size
function mae_custom_image_sizes() {	
	add_image_size( 'mae-std1', 370, 370, true );
	add_image_size( 'mae-std2', 370, 300, true );
	add_image_size( 'mae-std3', 370, 570, true );
	add_image_size( 'mae-std4', 570, 375, true );
}
add_action( 'after_setup_theme', 'mae_custom_image_sizes' );

// Add new animation
function mea_add_animation_elementor() {
	return $animations = [
		'Fading' => [
			'fadeIn' => 'Fade In',
			'fadeInDown' => 'Fade In Down',
			'fadeInLeft' => 'Fade In Left',
			'fadeInRight' => 'Fade In Right',
			'fadeInUp' => 'Fade In Up',
			'fadeInUpSmall' => 'Fade In Up Small',
			'fadeInDownSmall' => 'Fade In Down Small',
			'fadeInLeftSmall' => 'Fade In Left Small',
			'fadeInRightSmall' => 'Fade In Right Small',
		],
		'Reveal' => [
			'revealTop' => 'reveal Top',
			'revealBottom' => 'reveal Bottom',
			'revealLeft' => 'reveal Left',
			'revealRight' => 'reveal Right',
			'reveal revealTop2' => 'reveal Top 2',
			'reveal revealBottom2' => 'reveal Bottom 2',
			'reveal revealLeft2' => 'reveal Left 2',
			'reveal revealRight2' => 'reveal Right 2',
		]
	];

}
add_filter( 'elementor/controls/animations/additional_animations', 'mea_add_animation_elementor');

// Update notice
function mae_plugin_update_message( $data, $response ) {
    echo '</br>' . $data['upgrade_notice'];
}
add_action( 'in_plugin_update_message-masterlayer-addons-for-elementor/masterlayer-addons-for-elementor.php', 'mae_plugin_update_message', 10, 2 );