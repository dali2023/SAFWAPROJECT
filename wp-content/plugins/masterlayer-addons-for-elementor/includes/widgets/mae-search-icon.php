<?php
/*
Widget Name: Search_Icon
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Search_Icon_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-search-icon';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Search Icon', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-search';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Search Icon', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'search_icon',
                [
                    'label' => __( 'Search Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'default' => [
                        'value' => 'ci-magnifying-glass',
                        'library' => 'core',
                    ]
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __( 'Icon Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .agrios-search i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .agrios-search svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'search_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .agrios-search .search-trigger' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'search_color_hover',
                [
                    'label' => __( 'Hover Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .agrios-search:hover .search-trigger' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display(); ?>

        <div class="agrios-search">
            <a aria-label="search" href="#" class="search-trigger">
                <?php \Elementor\Icons_Manager::render_icon( $settings['search_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </a>
        </div>
        <?php 
        
    }

    protected function content_template() {}
}

