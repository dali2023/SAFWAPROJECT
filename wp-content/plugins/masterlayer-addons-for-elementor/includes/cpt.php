<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MAE_Custom_Post_Type' ) ) {

	// Class Deeper_Custom_Post_Type
	class MAE_Custom_Post_Type {
		function __construct() {
			require_once __DIR__ .'/post-type/header.php';
			require_once __DIR__ .'/post-type/footer.php';
			require_once __DIR__ .'/post-type/service.php';
			require_once __DIR__ .'/post-type/project.php';
	    }
	}

	new MAE_Custom_Post_Type;
}