<?php
/*
Widget Name: SVG Drawing
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

class MAE_SVG_Drawing_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'gsap', 'appear' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-svg-drawing';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - SVG Drawing', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-lottie';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'svg',
                [
                    'label' => __( 'SVG Image', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'description' => __( '* Only working with SVG stroke')
                ]
            );

            $this->add_control(
                'color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-svg-drawing path' => 'stroke: {{VALUE}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'lineWidth',
                [
                    'label'      => __( 'Line Width', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 30,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-svg-drawing path' => 'stroke-width: {{SIZE}}',
                    ],
                    50
                ]
            );

            $this->end_controls_section();

        // Options
            $this->start_controls_section( 'setting_general_section',
                [
                    'label' => __( 'Options', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_responsive_control(
                'maxWidth',
                [
                    'label'      => __( 'Max Width', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 50,
                            'max' => 1000,
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-svg-drawing' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}}',
                    ],
                    50
                ]
            );

            $this->add_control(
                'duration',
                [
                    'label' => __( 'Animation Duration (ms)', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10000,
                    'step' => 100,
                ]
            );

            $this->add_control(
                'delay',
                [
                    'label' => __( 'Animation Delay (ms)', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10000,
                    'step' => 100,
                ]
            );

            $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            'options',
            [
                'data-duration' => $settings['duration'],
                'data-delay' => $settings['delay'],
            ]
        );
        ?>
        <div class="master-svg-drawing" <?php echo $this->get_render_attribute_string( 'options' ); ?>>
            <?php 
            if ($settings['svg']['library'] == 'svg') {
                Icons_Manager::render_icon( $settings['svg'], [ 'aria-hidden' => 'true' ] ); 
            } else {
                printf('<span>%1$s</span>', __( 'Please use a SVG Image', 'masterlayer'));
            }
            ?>
        </div>
        <?php 
        
    }

    protected function content_template() {}
}

