<?php
/*
Widget Name: Counter
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

class MAE_Counter_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'countto' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-counter';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Counter', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-counter';
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
                'icon_position',
                [
                    'label' => __( 'Icon Position', 'masterlayer' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'right' => [
                            'title' => __( 'Left', 'masterlayer' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'top' => [
                            'title' => __( 'Top', 'masterlayer' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'left' => [
                            'title' => __( 'Right', 'masterlayer' ),
                            'icon' => 'eicon-h-align-right',
                        ]
                    ],
                    'default' => 'top',
                    'prefix_class' => 'icon-position-',
                    'render_type' => 'template'
                ]
            );

			$this->add_control(
				'icon_font',
				[
					'label' => __( 'Icon', 'masterlayer' ),
					'type' => Controls_Manager::ICONS,
					'label_block' => true,
					'fa4compatibility' => 'icon',
					'default' => [
						'value' => 'far fa-chart-bar',
						'library' => 'fa-regular',
					],
				]
			);

	 		$this->add_control(
				'title',
				[
					'label' => __( 'Title', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Projects Done', 'masterlayer' ),
				]
			);

			$this->add_control(
				'number',
				[
					'label' => 'Number',
					'type' => Controls_Manager::TEXT,
					'default' => __( '7200', 'masterlayer' ),
				]
			);

			$this->add_control(
                'number_format',
                [
                    'label'     => __( 'Number Fortmat', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'default',
                    'options'   => [
                        'default'    	=> __( 'Default', 'masterlayer'),
                        'separator'     => __( '1,000', 'masterlayer'),
                        'decimal'      	=> __( '1000.00', 'masterlayer'),
                        'both'      	=> __( '1,000.00', 'masterlayer'),
                    ],
                    'prefix_class' => 'icon-',
                    'render_type' => 'template'
                ]
            );


			$this->add_control(
				'suffix',
				[
					'label' => __( 'Number Suffix', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'duration',
				[
					'label' => __( 'Duration', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min'  => 1000,
							'max'  => 10000,
							'step' => 1000,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 2000,
					],
				]
			);

			$this->end_controls_section();

		// Style
			$this->start_controls_section(
				'section_style_general',
				[
					'label' => __( 'General', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
                'icon_view',
                [
                    'label'     => __( 'Icon View', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'has-bg',
                    'options'   => [
                        ''            => __( 'Default', 'masterlayer'),
                        'has-bg'      => __( 'Has background', 'masterlayer'),
                    ],
                    'prefix_class' => 'icon-',
                ]
            );

            $this->add_control(
                'icon_rounded',
                [
                    'label' => __('Icon Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .master-counter .master-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 'icon_view' => 'has-bg' ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'icon_border',
                    'label' => __( 'Icon Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}} .master-icon',
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label'      => __( 'Icon Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 200,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 60,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

			$this->add_responsive_control(
                'bg_icon_size',
                [
                    'label'      => __( 'Background Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 200,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 100,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => ['icon_view' => 'has-bg'],
                    50
                ]
            );

            $this->end_controls_section();

        // Color
			$this->start_controls_section(
				'section_style_color',
				[
					'label' => __( 'Color', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'box' );

			// Normal
				$this->start_controls_tab(
		            'box_normal',
		            [
		                'label' => __( 'Normal', 'masterlayer' ),
		            ]
		        );

				$this->add_control(
					'icon_bg',
					[
						'label' => __( 'Icon Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-icon' => 'background-color: {{VALUE}};',
						],
						'condition' => [ 'icon_view' => 'has-bg' ]
					]
				);

				$this->add_control(
					'icon_color',
					[
						'label' => __( 'Icon Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-icon' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'number_color',
					[
						'label' => __( 'Number Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .number-wrap span' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'title_color',
					[
						'label' => __( 'Title Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .title' => 'color: {{VALUE}};',
						]
					]
				);

				$this->end_controls_tab();

			// Hover
				$this->start_controls_tab(
		            'box_hover',
		            [
		                'label' => __( 'Hover', 'masterlayer' ),
		            ]
		        );
	        	
	        	$this->add_control(
					'icon_bg_hover',
					[
						'label' => __( 'Icon Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-counter:hover .master-icon' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'icon_color_hover',
					[
						'label' => __( 'Icon Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-counter:hover .master-icon' => 'color: {{VALUE}}',
						],
					]
				);
				$this->add_control(
					'number_color_hover',
					[
						'label' => __( 'Number Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-counter:hover .number-wrap span' => 'color: {{VALUE}};',
						]
					]
				);
				$this->add_control(
					'title_color_hover',
					[
						'label' => __( 'Title Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-counter:hover .title' => 'color: {{VALUE}};',
						]
					]
				);
				$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

		// Background & Border
			$this->start_controls_section(
				'section_style_bg',
				[
					'label' => __( 'Backround & Border', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'box_bg' );

			// Normal
				$this->start_controls_tab(
		            'bg_normal',
		            [
		                'label' => __( 'Normal', 'masterlayer' ),
		            ]
		        );

		        $this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'background',
						'label' => esc_html__( 'Background', 'masterlayer' ),
						'types' => [ 'classic', 'gradient', 'video' ],
						'selector' => '{{WRAPPER}} .master-counter:before',
					]
				);

				$this->add_control(
                    'bg_rounded',
                    [
                        'label' => __('Border Radius', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [ 
                            '{{WRAPPER}} .master-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'bg_border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} .master-counter',
                    ]
                );

		    $this->end_controls_tab();

		    // Hover
				$this->start_controls_tab(
		            'bg_hover',
		            [
		                'label' => __( 'Hover', 'masterlayer' ),
		            ]
		        );

		        $this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'background_hover',
						'label' => esc_html__( 'Background', 'masterlayer' ),
						'types' => [ 'classic', 'gradient', 'video' ],
						'selector' => '{{WRAPPER}}:hover .master-counter:after',
					]
				);

				$this->add_control(
                    'bg_rounded_hover',
                    [
                        'label' => __('Border Radius', 'masterlayer'),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => ['px', '%'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [ 
                            '{{WRAPPER}}:hover .master-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'bg_border_hover',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}}:hover .master-counter',
                    ]
                );

		    $this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

		// Spacing
			$this->start_controls_section(
				'section__style',
				[
					'label' => __( 'Spacing', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
                'padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_margin',
                [
                    'label' => __('Icon Spacing', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-counter .master-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
			

			$this->add_responsive_control(
				'number_spacing',
				[
					'label' => __( 'Number', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 7
					],
					'selectors' => [
						'{{WRAPPER}} .number-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_left_spacing',
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
						'{{WRAPPER}} .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'label' => __( 'Number', 'masterlayer' ),
					'name' => 'number_typography',
					'selector' => '{{WRAPPER}} .number-wrap span',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	
					'label' => __( 'Title', 'masterlayer' ),
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .title',
				]
			);

			$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="master-counter" data-format="<?php echo $settings['number_format']; ?>">
			<?php if ($settings['icon_position'] !== 'left') {
				if ($settings['icon_font']['library']) { ?>
				<div class="icon-wrap">
			        <div class="master-icon">
	                    <?php Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
	                </div>
		        </div>
		    <?php } 
				} ?>

			<div class="inner">
				<div class="number-wrap">
					<span class="number" data-to="<?php echo $settings['number']; ?>" data-time= "<?php echo $settings['duration']['size']; ?>"></span>
					<?php if ($settings['suffix']) echo '<span>' . $settings['suffix'] . '</span>'; ?>
				</div>

				<?php if ($settings['title']) echo '<span class="title">' . $settings['title'] . '</span>'; ?>
			</div>

			<?php if ($settings['icon_position'] == 'left') {
				if ($settings['icon_font']['library']) { ?>
				<div class="icon-wrap">
			        <div class="master-icon">
	                    <?php Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
	                </div>
		        </div>
		    <?php } 
				} ?>
	    </div>
	    <?php
	}

    protected function content_template() {}
}

