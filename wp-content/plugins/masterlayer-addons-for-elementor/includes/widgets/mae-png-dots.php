<?php
/*
Widget Name: PNG Dots
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

class MAE_Png_Dots_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'gsap', 'threejs', 'appear' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-png-dots';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - PNG Dots', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-image';
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
                'image',
                [
                    'label' => __( 'PNG Image', 'masterlayer' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
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
                        '{{WRAPPER}} .master-png-dots' => 'width: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-png-dots' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'size',
                [
                    'label' => __( 'Dots Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                ]
            );

            $this->add_responsive_control(
                'gap',
                [
                    'label' => __( 'Dots Gap', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                ]
            );

            $this->add_control(
                'color',
                [
                    'label' => __( 'Dots Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                ]
            );

            $this->add_control(
                'animation',
                [
                    'label'     => __( 'Animation', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'random',
                    'options'   => [
                        'random'          =>  __( 'Random', 'masterlayer'),
                        'vertical'           =>  __( 'Vertical', 'masterlayer'),
                        'horizontal'         =>  __( 'Horizontal', 'masterlayer'),
                        'slideInLeft'        =>  __( 'Slide In Left', 'masterlayer'),
                        'slideInRight'       =>  __( 'Slide In Right', 'masterlayer'),
                        'slideInTop'         =>  __( 'Slide In Top', 'masterlayer'),
                        'slideInBottom'      =>  __( 'Slide In Bottom', 'masterlayer'),
                        'zoomIn'             =>  __( 'Zoom In', 'masterlayer'),
                        //'zoomOut'            =>  __( 'Zoom Out', 'masterlayer'),
                    ],
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'moving',
                [
                    'label' => __( 'Dots Moving', 'masterlayer' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'your-plugin' ),
                    'label_off' => __( 'No', 'your-plugin' ),
                    'return_value' => true,
                    'default' => false,
                ]
            );

            $this->add_control(
                'rotate3D',
                [
                    'label' => __( '3D Rotate', 'masterlayer' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'your-plugin' ),
                    'label_off' => __( 'No', 'your-plugin' ),
                    'return_value' => true,
                    'default' => false,
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

            $this->add_control(
                'position',
                [
                    'label'     => __( 'Position', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'relative',
                    'options'   => [
                        'relative'          =>  __( 'Default', 'masterlayer'),
                        'absolute'          =>  __( 'Absolute', 'masterlayer'),
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .master-png-dots' => 'position: {{VALUE}};',
                    ],
                    'prefix_class' => 'canvas-'
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
                        '{{WRAPPER}} .master-png-dots' => 'left: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-png-dots' => 'right: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-png-dots' => 'top: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-png-dots' => 'bottom: {{SIZE}}{{UNIT}};',
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
        if ( $settings['image']['url'] )
            $config['image'] = esc_url($settings['image']['url']);
        if ( $settings['size']['size'] )
            $config['size'] = $settings['size']['size'];
        if ( $settings['gap']['size'] )
            $config['gap'] = $settings['gap']['size'];
        $config['color'] = $settings['color'];
        $config['rotate3D'] = $settings['rotate3D'];
        $config['moving'] = $settings['moving'];
        $config['animation'] = $settings['animation'];
        //$config['moving'] = $settings['moving']['size'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        if ( strpos( $settings['image']['url'], '.png') && $settings['image']['id'] ) {
        ?>

            <div class="master-png-dots" <?php echo $data; ?>>
                <div class="canvas-dots">
                    <canvas></canvas>
                    <?php if ( $settings['image']['id'] ) {
                        echo wp_get_attachment_image( $settings['image']['id'], 'full' );
                    } else {
                        echo '<img alt="Image" src="' . esc_url($settings['image']['url']) . '" />';
                    } ?>
                </div>
            </div>

        <?php } else {
            echo '<span>Please use a PNG format image</span>';
        }
    }

    protected function content_template() {}
}

