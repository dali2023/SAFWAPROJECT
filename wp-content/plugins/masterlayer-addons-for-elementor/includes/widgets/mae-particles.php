<?php
/*
Widget Name: Particles
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
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
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Particles_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'particle' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-particles';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Particles Background', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-share';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        // Content Section
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'json',
                [
                    'label' => __( 'JSON Text', 'masterlayer' ),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'description' => __( 'Go <a target="_blank" href="https://vincentgarreau.com/particles.js/">here</a> to create your particles JSON', 'masterlayer' ),
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'width',
                [
                    'label' => __( 'Width', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .master-particles' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'height',
                [
                    'label' => __( 'Height', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .master-particles' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->end_controls_section();

        // Position
            $this->start_controls_section(
                'section_position',
                [
                    'label' => __( 'Position', 'masterlayer' ),
                ]
            );

            $this->add_responsive_control(
                'align',
                [
                    'label' => __( 'Horizontal Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'masterlayer' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'masterlayer' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'default' => 'left'
                ]
            );

            $this->add_responsive_control(
                'left_offset',
                [
                    'label'      => __( 'Left Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-particles' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'align' => 'left', ],
                ]
            );

            $this->add_responsive_control(
                'right_offset',
                [
                    'label'      => __( 'Right Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-particles' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'align' => 'right', ],
                ]
            );

            $this->add_responsive_control(
                'valign',
                [
                    'label' => __( 'Vertical Alignment', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => __( 'Top', 'masterlayer' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'masterlayer' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'top'
                ]
            );

            $this->add_responsive_control(
                'top_offset',
                [
                    'label'      => __( 'Top Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-particles' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'valign' => 'top', ]
                ]
            );

            $this->add_responsive_control(
                'bottom_offset',
                [
                    'label'      => __( 'Bottom Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-particles' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'valign' => 'bottom', ]
                ]
            );

            $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();

        $html = $title = $content = $image = $url = "";

        $config['json'] = $settings['json'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
        ?>

        <div class="master-particles" <?php echo $data; ?>>
            <div id="particles-js" class="canvas-particles"></div>
        </div>
    <?php }

    protected function content_template() {}
}

