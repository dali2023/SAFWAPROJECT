<?php
/**
 * Header
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( (agrios_header_style() == '1') || (get_post_type() == 'elementor_library') ) {
    $cls ='';
    $has_info = false;
    $has_social = false;
    $has_top = false;
    if (agrios_get_mod('header_info_phone', '') ||
        agrios_get_mod('header_info_email', '') ||
        agrios_get_mod('header_info_address', ''))
        $has_info = true;

    if (agrios_get_mod('header_socials', false))
        $has_social = true;

    if ($has_social || $has_info)
        $has_top = true;

    // Get header style
    $cls = agrios_get_mod( 'header_class' );
    ?>

    <header id="site-header" class="<?php echo esc_attr( $cls ); ?>">
        <?php if ($has_top) { ?>
            <div class="top-bar">
                <div class="agrios-container">
                    <div class="top-bar-inner">
                        <div class="topbar-left">
                            <?php get_template_part( 'templates/header-social'); ?>
                        </div> 

                        <div class="topbar-right">
                            <?php get_template_part( 'templates/header-info'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="agrios-container">
        	<div class="site-header-inner">
                <?php 
                get_template_part( 'templates/header-logo');  
                get_template_part( 'templates/header-menu');       
            	get_template_part( 'templates/header-button');
            	?>
        	</div>
        </div>
    </header><!-- /#site-header -->
<?php } else {

    $float = agrios_get_elementor_option('header_float');
    ?>
    <div class="agrios-header agrios-container <?php if ($float == 'yes') echo 'header-float'; ?>">
        <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display(agrios_header_style(), false); ?>
    </div>
    <?php

    $idf = agrios_get_mod( 'header_fixed', '1' );
    if (!is_null(agrios_get_elementor_option('header_fixed')) && (agrios_get_elementor_option('header_fixed') !== '0'))
       $idf = agrios_get_elementor_option('header_fixed');
    if ($idf !== '1') { ?>
        <div class="agrios-header-fixed fixed-hide agrios-container">
            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($idf, false); ?>
        </div>
    <?php }
    
} ?>
