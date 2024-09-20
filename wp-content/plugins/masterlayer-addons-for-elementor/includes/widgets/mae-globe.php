<?php
/*
Widget Name: Globe
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
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Globe_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }
    
    public function get_script_depends() {
        return [ 'threejs', 'globe', 'threeOrbit', 'threeMesh' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-globe';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - 3D Globe', 'masterlayer' );
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

		// Content
			$this->start_controls_section(
				'section__content',
				[
					'label' => __( 'Content', 'masterlayer' ),
				]
			);

			$this->add_responsive_control(
                'width',
                [
                    'label'      => __( 'Width', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-globe .inner-globe' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'render_type' => 'template'
                ]
            );

            $this->add_responsive_control(
                'height',
                [
                    'label'      => __( 'Height', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-globe .inner-globe' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'color',
                [
                    'label' => __( 'Dots Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
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
                        '{{WRAPPER}} .master-globe' => 'position: {{VALUE}};',
                    ],
                    'prefix_class' => 'canvas-',
                    'render_type' => 'template'
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
                        '{{WRAPPER}} .master-globe' => 'left: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-globe' => 'right: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-globe' => 'top: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-globe' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'valign' => 'bottom', ]
                ]
            );

            $this->add_control(
                'overflow',
                [
                    'label'     => __( 'Overflow', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'visible',
                    'options'   => [
                        'visible'          =>  __( 'Visible', 'masterlayer'),
                        'hidden'          =>  __( 'Hidden', 'masterlayer'),
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .master-png-dots' => 'overflow: {{VALUE}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'inner_left_offset',
                [
                    'label'      => __( 'Inner Left Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-globe .globe' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'overflow' => 'hidden', ],
                ]
            );

            $this->add_responsive_control(
                'inner_top_offset',
                [
                    'label'      => __( 'Inner Top Offset', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-globe .globe' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'overflow' => 'hidden', ],
                ]
            );

            $this->end_controls_section();
	}

	protected function render() {
		$config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();

        $html = $title = $content = $image = $url = "";

        $config['color'] = $settings['color'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
		?>

		<div class="master-globe" <?php echo $data; ?>>
			<div class="inner-globe">
				<div class="globe js-globe">
					<canvas class="globe-canvas js-canvas"></canvas>
				</div>
			</div>
	    </div>

	    <?php
	}

    protected function content_template() {}
}

