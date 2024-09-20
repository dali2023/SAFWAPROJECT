<?php
/*
Widget Name: Post Content
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use \Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Post_Content_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-post-content';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Post Content', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-text';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
        // Content  
        $this->start_controls_section(
            'section__content',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ]
        );
        $this->end_controls_section();
	}

	protected function render() {
		if ( get_post_type() == 'elementor_library' ) { 
            echo '<p>' . __( 'This is a sample content.', 'masterlayer') . '<br>We re an award-winning, forward thinking, boutique digital & creative agency located in Edmonton, Canada. Our strategists, designers and coders work with clients from all over the world to build successful digital experiences, brands, and campaigns.</p>';
		} elseif ( !is_front_page() && is_home() ) {
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    get_template_part( 'templates/entry-content' );
                endwhile;

                agrios_pagination();
            endif;
        } elseif ( is_search() ) {
            if ( have_posts() ) {
                while ( have_posts() ) : the_post();
                    get_template_part( 'templates/entry-search' );
                endwhile;

                agrios_pagination();
            } else { ?>
                <div class="search-not-found no-results">
                    <div class="no-results-content">
                        <div class="no-results-title">
                            <h1><?php esc_html_e( 'Nothing Found', 'masterlayer' ); ?></h1>
                        </div>
                        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'masterlayer' ); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                </div><!-- /.no-results -->
            <?php }
        } else {
            wp_reset_postdata();
            the_content();
		}
	}
}

