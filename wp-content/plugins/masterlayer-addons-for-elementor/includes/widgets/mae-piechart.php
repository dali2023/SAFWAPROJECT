<?php
/*
Widget Name: Pie Chart
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Pie_Chart_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'piechart', 'countto' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-pie-chart';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Progress Circle', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-counter-circle';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		//Content
			$this->start_controls_section(
				'content_section',
				[
					'label' => __( 'Content', 'masterlayer' ),
				]
			);

			$this->add_control(
				'percent',
				[
					'label' => 'Percentage',
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 70,
						'unit' => '%',
					],
				]
			);

			$this->add_control(
				'title',
				[
					'label' => 'Title',
					'type' => Controls_Manager::TEXTAREA,
					'default' => __( 'Renewable Resources', 'masterlayer' ),
				]
			);
		
			$this->add_control(
				'desc',
				[
					'label' => __( 'Description', 'masterlayer' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => __( 'We work on a wide range of building typologies and projects', 'masterlayer' ),
					'placeholder' => __( 'Enter your description', 'masterlayer' ),
					'label_block' => true,
				]
			);

			$this->end_controls_section();

		// Style
			$this->start_controls_section(
				'section__general_style',
				[
					'label' => __( 'General', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
                'inline',
                [
                    'label'     => __( 'Inline', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'no',
                    'options'   => [
                        'no'           => __( 'No', 'masterlayer'),
                        'yes'      		=> __( 'Yes', 'masterlayer'),
                    ],
                    'prefix_class' => 'pie-chart-inline-'
                ]
            );

			if ( is_rtl() ) {
				$this->add_responsive_control(
					'align',
					[
						'label' => __( 'Alignment', 'masterlayer' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'right'    => [
								'title' => __( 'Left', 'masterlayer' ),
								'icon' => 'eicon-text-align-left',
							],
							'center' => [
								'title' => __( 'Center', 'masterlayer' ),
								'icon' => 'eicon-text-align-center',
							],
							'left' => [
								'title' => __( 'Right', 'masterlayer' ),
								'icon' => 'eicon-text-align-right',
							],
						],
						'prefix_class' => 'align-%s'
					]
				);
			} else {
				$this->add_responsive_control(
					'align',
					[
						'label' => __( 'Alignment', 'masterlayer' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'left'    => [
								'title' => __( 'Left', 'masterlayer' ),
								'icon' => 'eicon-text-align-left',
							],
							'center' => [
								'title' => __( 'Center', 'masterlayer' ),
								'icon' => 'eicon-text-align-center',
							],
							'right' => [
								'title' => __( 'Right', 'masterlayer' ),
								'icon' => 'eicon-text-align-right',
							],
						],
						'prefix_class' => 'align-%s'
					]
				);
			}

			$this->add_control(
                'valign',
                [
                    'label'     => __( 'Alignment', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'top',
                    'options'   => [
                        'top'           => __( 'Top', 'masterlayer'),
                        'middle'      	=> __( 'Middle', 'masterlayer'),
                        'bottom'      	=> __( 'Bottom', 'masterlayer'),
                    ],
                    'prefix_class' => 'valign-',
					'condition' => [ 'inline' => 'yes']
                ]
            );

			$this->add_responsive_control(
				'size',
				[
					'label' => __( 'Chart Size', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 50,
							'max' => 400,
						],
					],
					'default' => [
						'size' => 140
					]
				]
			);

			$this->add_responsive_control(
				'lineWidth',
				[
					'label' => __( 'Line Width', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 20,
						],
					],
					'default' => [
						'size' => 3
					]
				]
			);

			$this->end_controls_section();

		// Style - Color
			$this->start_controls_section(
				'section__color_style',
				[
					'label' => __( 'Color', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'barColor',
				[
					'label' => __( 'Bar', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#42d9be',
				]
			);

			$this->add_control(
				'trackColor',
				[
					'label' => __( 'Track', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#eef3f7',
				]
			);

			$this->add_control(
				'percent_color',
				[
					'label' => __( 'Percent Text', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .percent-wrap' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Title', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .headline-2' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label' => __( 'Description', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .desc' => 'color: {{VALUE}};',
					]
				]
			);

			$this->end_controls_section();

		// Spacing
			$this->start_controls_section(
				'section__style_spacing',
				[
					'label' => __( 'Spacing', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			if ( is_rtl() ) {
				$this->add_responsive_control(
					'chart_space',
					[
						'label' => __( 'Chart', 'masterlayer' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'default' => [ 'size' => 20 ],
						'selectors' => [
							'{{WRAPPER}}.pie-chart-inline-no .chart' => 'margin-bottom: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}}.pie-chart-inline-yes .chart' => 'margin-left: {{SIZE}}{{UNIT}};',
						],
					]
				);
			} else {
				$this->add_responsive_control(
					'chart_space',
					[
						'label' => __( 'Chart', 'masterlayer' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'default' => [ 'size' => 20 ],
						'selectors' => [
							'{{WRAPPER}}.pie-chart-inline-no .chart' => 'margin-bottom: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}}.pie-chart-inline-yes .chart' => 'margin-right: {{SIZE}}{{UNIT}};',
						],
					]
				);
			}

			$this->add_responsive_control(
				'title_space',
				[
					'label' => __( 'Title', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .headline-2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'desc_space',
				[
					'label' => __( 'Description', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

		// Typography
			$this->start_controls_section(
				'section__style_typo',
				[
					'label' => __( 'Typography', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	
					'label' => __( 'Percent', 'masterlayer' ),
					'name' => 'percent_typography',
					'selector' => '{{WRAPPER}} .percent-wrap',
				]
			);
		
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	
					'label' => __( 'Title', 'masterlayer' ),
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .headline-2',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	
					'label' => __( 'Description', 'masterlayer' ),
					'name' => 'desc_typography',
					'selector' => '{{WRAPPER}} .desc',
				]
			);

			$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$config = array();

		// Data config 
        $config['barColor'] = $settings['barColor'];
        $config['trackColor'] = $settings['trackColor'];
        $config['size'] = $settings['size']['size'];
        $config['percent'] = $settings['percent']['size'];
        $config['lineWidth'] = $settings['lineWidth']['size'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';
		?>
		<div class="master-pie-chart" <?php echo $data; ?>>
			<div class="chart">
				<span class="percent-wrap">
					<span class="percent">
						<?php echo $settings['percent']['size']; ?>
					</span>%
				</span>
			</div>

			<div class="content-wrap">
				<?php if ( $settings['title'] ) echo '<h2 class="headline-2">'. $settings['title'] .'</h2>'; ?>
				<?php if ( $settings['desc'] ) echo '<div class="desc">'. $settings['desc'] .'</div>'; ?>
			</div>
		</div>
	    <?php
	}

    protected function content_template() {}
}

