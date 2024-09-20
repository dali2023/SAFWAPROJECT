<?php
/*
Widget Name: Gallery Stack
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
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

class MAE_Gallery_Stack_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'waitforimages' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-gallery-stack';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Fancy Images Stack', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-images';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		$animations = [
			'none'			=> 'None',
			'parallax' => 'Parallax Scroll',
			'parallaxHover' => 'Parallax Hover',
			'fadeIn' => 'Fade In',
			'fadeInUpSmall' => 'Fade In Up',
			'fadeInDownSmall' => 'Fade In Down',
			'fadeInLeftSmall' => 'Fade In Left',
			'fadeInRightSmall' => 'Fade In Right',
			'fadeInUpLeft' => 'Fade In Up Left',
			'fadeInUpRight' => 'Fade In Up Right',
			'fadeInDownLeft' => 'Fade In Down Left',
			'fadeInDownRight' => 'Fade In Down Right',
			'zoomInSmall' => 'Zoom In',
			'revealTop' => 'Reveal Top',
			'revealBottom' => 'Reveal Bottom',
			'revealLeft' => 'Reveal Left',
			'revealRight' => 'Reveal Right',
			'reveal revealTop2' => 'Reveal Top 2',
			'reveal revealBottom2' => 'Reveal Bottom 2',
			'reveal revealLeft2' => 'Reveal Left 2',
			'reveal revealRight2' => 'Reveal Right 2',
			'slideUp' => 'Slide Up',
			'slideDown' => 'Slide Down',
			'slideLeft' => 'Slide Left',
			'slideRight' => 'Slide Right',
			'slideUpLeft' => 'Slide Up Left',
			'slideUpRight' => 'Slide Up Right',
			'slideDownLeft' => 'Slide Down Left',
			'slideDownRight' => 'Slide Down Right',
			'custom' => 'Custom CSS',
		];

		$entranceAnimation = [
			'fadeIn',
			'fadeInUpSmall',
			'fadeInDownSmall',
			'fadeInLeftSmall',
			'fadeInRightSmall',
			'fadeInUpLeft',
			'fadeInUpRight',
			'fadeInDownLeft',
			'fadeInDownRight',
			'zoomInSmall',
			'revealTop',
			'revealBottom',
			'revealLeft',
			'revealRight',
			'reveal revealTop2',
			'reveal revealBottom2',
			'reveal revealLeft2',
			'reveal revealRight2',
			'slideUp',
			'slideDown',
			'slideLeft',
			'slideRight',
			'slideUpLeft',
			'slideUpRight',
			'slideDownLeft',
			'slideDownRight',
		];
		// Content
			$this->start_controls_section(
				'section_content',
				[
					'label' => __( 'Images', 'masterlayer' ),
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
				
				$this->add_responsive_control(
		            'content_width',
		            [
		                'label'     => __( 'Content Width', 'masterlayer'),
		                'type'      => Controls_Manager::SELECT,
		                'default'   => 'full',
		                'options'   => [
		                	'full' 			=>  __( 'Full Width', 'masterlayer'),
		                	'fit' 			=>  __( 'Fit First Image Width', 'masterlayer'),
		                ],
		                'prefix_class' => 'image-width-'
		            ]
		        );

			// Images
				$repeater = new Repeater();

				$repeater->start_controls_tabs( 'tab_image' );

				// Image - General
					$repeater->start_controls_tab( 
	                    'tab_image_general',
	                    [
	                        'label' => __( 'Image', 'masterlayer' ),
	                    ] 
	                );

					$repeater->add_control(
						'image',
						[
							'label' => __( 'Image', 'masterlayer' ),
							'type' => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
						]
					);

					$repeater->add_control(
						'width',
						[
							'label' => __( 'Width', 'masterlayer' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => '%',
							],
							'selectors' => [ 
								'{{WRAPPER}} {{CURRENT_ITEM}}.master-fancy-image' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
							],
							'render_type' => 'template'
						]
					);

					$repeater->add_control(
			            'border_radius',
			            [
			                'label' => __('Image Rounded', 'masterlayer'),
			                'type' => Controls_Manager::DIMENSIONS,
			                'size_units' => ['px', '%'],
			                'default' => [
			                    'unit' => 'px',
			                ],
			                'selectors' => [
			                    '{{WRAPPER}} {{CURRENT_ITEM}}.master-fancy-image .image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
			                ],
			            ]
			        );

					$repeater->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'pbox_shadow',
							'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.master-fancy-image .image-wrap',
						]
					);

					$repeater->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' => 'pborder',
							'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.master-fancy-image .image-wrap',
						]
					);

					$repeater->add_control(
						'opacity',
						[
							'label' => esc_html__( 'Opacity', 'masterlayer' ),
							'type' => \Elementor\Controls_Manager::NUMBER,
							'min' => 0,
							'max' => 1,
							'step' => 0.1,
							'selectors' => [
			                    '{{WRAPPER}} {{CURRENT_ITEM}}.master-fancy-image .image-wrap' => 'opacity: {{VALUE}};',
			                ],
						]
					);

					$repeater->end_controls_tab();

				// Image - Position
					$repeater->start_controls_tab( 
	                    'tab_image_position',
	                    [
	                        'label' => __( 'Position', 'masterlayer' ),
	                    ] 
	                );

	                $repeater->add_responsive_control(
			            'visibility',
			            [
			                'label'     => __( 'Visibility', 'masterlayer'),
			                'type'      => Controls_Manager::SELECT,
			                'default'   => 'visible',
			                'options'   => [
			                	'visible' =>  __( 'Visible', 'masterlayer'),
			                	'hidden' =>  __( 'Hidden', 'masterlayer'),
			                ],
			                'selectors' => [
			                    '{{CURRENT_ITEM}}.master-fancy-image' => 'visibility: {{VALUE}};',
			                ],
			            ]
			        );

			        $repeater->add_responsive_control(
			            'calc_height',
			            [
			                'label'     => __( 'Calculate Height?', 'masterlayer'),
			                'type'      => Controls_Manager::SELECT,
			                'default'   => 'no',
			                'options'   => [
			                	'no' =>  __( 'No', 'masterlayer'),
			                	'yes' =>  __( 'Yes', 'masterlayer'),
			                ],
			                'render_type' => 'template'
			            ]
			        );

	                $repeater->add_control(
		                'index',
		                [
		                    'label' => __( 'Z-index', 'masterlayer' ),
		                    'type' => Controls_Manager::NUMBER,
		                    'min' => -10,
		                    'max' => 100,
		                    'step' => 1,
		                    'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-fancy-image' => 'z-index: {{VALUE}}',
			                ],
		                ]
		            ); 

	                $repeater->add_responsive_control(
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
			                'default' => 'left',
			            ]
			        );

			        $repeater->add_responsive_control(
			            'left_offset',
			            [
			                'label'      => __( 'Left Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => -200,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => -100,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-fancy-image' => 'left: {{SIZE}}{{UNIT}};',
			                ],
			                50,
			                'condition' => [ 'align' => 'left', ],
							'render_type' => 'template'
			            ]
			        );

			        $repeater->add_responsive_control(
			            'right_offset',
			            [
			                'label'      => __( 'Right Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => 0,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => 0,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-fancy-image' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
			                ],
			                50,
			                'condition' => [ 'align' => 'right', ],
							'render_type' => 'template'
			            ]
			        );

			        $repeater->add_responsive_control(
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

			        $repeater->add_responsive_control(
			            'top_offset',
			            [
			                'label'      => __( 'Top Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => -200,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => -100,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-fancy-image' => 'top: {{SIZE}}{{UNIT}};',
			                ],
			                50,
			                'condition' => [ 'valign' => 'top', ],
							'render_type' => 'template'
			            ]
			        );

			        $repeater->add_responsive_control(
			            'bottom_offset',
			            [
			                'label'      => __( 'Bottom Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => -200,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => -100,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-fancy-image' => 'bottom: {{SIZE}}{{UNIT}};',
			                ],
			                50,
			                'condition' => [ 'valign' => 'bottom', ],
							'render_type' => 'template'
			            ]
			        );

			        $repeater->end_controls_tab();
			    
			    // Image - Animation
					$repeater->start_controls_tab( 
	                    'tab_image_animation',
	                    [
	                        'label' => __( 'Animation', 'masterlayer' ),
	                    ] 
	                );

	                $repeater->add_control(
			            'animation',
			            [
			                'label'     => __( 'Animation', 'masterlayer'),
			                'type'      => Controls_Manager::SELECT,
			                'default'   => 'none',
			                'options'   => $animations,
			                'render_type' => 'template'
			            ]
			        );

			        $repeater->add_control(
		                'custom',
		                [
		                    'label'     => __( 'CSS Classes', 'masterlayer'),
		                    'type'      => Controls_Manager::TEXT,
		                    'dynamic'   => [
		                        'active'   => true,
		                    ],
		                    'condition' => ['animation' => 'custom']
		                ]
		            );

			        // Parallax Hover
			        	$repeater->add_control(
			                'direction',
			                [
			                    'label'     => __( 'Direction', 'masterlayer'),
			                    'type'      => Controls_Manager::SELECT,
			                    'default'   => 'follow',
			                    'options'   => [
			                        'follow'           => __( 'Follow', 'masterlayer'),
			                        'opposite'         => __( 'Opposite', 'masterlayer'),
			                    ],
								'condition' => [ 'animation' => 'parallaxHover'],
			                	'render_type' => 'template'
			                ]
			            );

						$repeater->add_control(
							'range',
							[
								'label' => __( 'Range', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'min' => 0,
			                    'max' => 1,
			                    'step' => 0.1,
								'condition' => [ 'animation' => 'parallaxHover'],
			                	'render_type' => 'template'
							]
						);

	                // Parallax Scroll
						$repeater->add_control(
							'parallax_x',
							[
								'label' => __( 'Parallax X', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'condition' => [ 'animation' => 'parallax'],
			                	'render_type' => 'template'
							]
						);

						$repeater->add_control(
							'parallax_y',
							[
								'label' => __( 'Parallax Y', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'condition' => [ 'animation' => 'parallax'],
			                	'render_type' => 'template'
							]
						);

						$repeater->add_control(
							'smoothness',
							[
								'label' => __( 'Smoothness', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'default' => '30',
								'condition' => [ 'animation' => 'parallax'],
			                	'render_type' => 'template'
							]
						);

					// Entrance Animation
						$repeater->add_control(
			                'delay',
			                [
			                    'label' => __( 'Animation Delay (ms)', 'masterlayer' ),
			                    'type' => Controls_Manager::NUMBER,
			                    'min' => 0,
			                    'max' => 10000,
			                    'step' => 100,
			                    'condition' => [ 'animation' => $entranceAnimation ],
			                    'selectors'  => [
				                    '{{CURRENT_ITEM}}.master-fancy-image' => 'animation-delay: {{VALUE}}ms',
				                ],
			                	'render_type' => 'template'
			                ]
			            ); 

					$repeater->end_controls_tab();

			    $repeater->end_controls_tabs();

				$this->add_control(
				    'images',
				    [
				        'label'       => '',
				        'type'        => Controls_Manager::REPEATER,
				        'show_label'  => false,
				        'default'     => [
				            [
				                'image'  => [
									'url' => Utils::get_placeholder_image_src(),
								],
				            ],
				        ],
				        'fields'      => $repeater->get_controls(),
				        'title_field' => false,
				    ]
				);

			$this->end_controls_section();

			// Shape
				$this->start_controls_section(
					'section_content_shape',
					[
						'label' => __( 'Shapes', 'masterlayer' ),
					]
				);
				$repeater = new Repeater();

				$repeater->start_controls_tabs( 'tab_shape' );

				// Shape - General
					$repeater->start_controls_tab( 
	                    'tab_shape_general',
	                    [
	                        'label' => __( 'Shape', 'masterlayer' ),
	                    ] 
	                );

	                $repeater->add_control(
			            'shape_color',
			            [
			                'label' => __( 'Color', 'masterlayer' ),
			                'type' => Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} {{CURRENT_ITEM}}.master-shape' => 'background-color: {{VALUE}};',
			                ]
			            ]
			        );

					$repeater->add_responsive_control(
						'shape_width',
						[
							'label' => __( 'Width', 'masterlayer' ),
							'type' => Controls_Manager::SLIDER,
							'default' => [
								'unit' => 'px',
							],
							'size_units' => [ '%', 'px'],
							'range' => [
								'%' => [
									'min' => 1,
									'max' => 100,
								],
								'px' => [
									'min' => 1,
									'max' => 1000,
								],
							],
							'selectors' => [
								'{{WRAPPER}} {{CURRENT_ITEM}}.master-shape' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$repeater->add_responsive_control(
						'shape_height',
						[
							'label' => __( 'Height', 'masterlayer' ),
							'type' => Controls_Manager::SLIDER,
							'default' => [
								'unit' => 'px',
							],
							'size_units' => [ '%', 'px'],
							'range' => [
								'%' => [
									'min' => 1,
									'max' => 100,
								],
								'px' => [
									'min' => 1,
									'max' => 1000,
								],
							],
							'selectors' => [
								'{{WRAPPER}} {{CURRENT_ITEM}}.master-shape' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$repeater->add_control(
			            'shape_border_radius',
			            [
			                'label' => __('Rounded', 'masterlayer'),
			                'type' => Controls_Manager::DIMENSIONS,
			                'size_units' => ['px', '%'],
			                'default' => [
			                    'unit' => 'px',
			                ],
			                'selectors' => [
			                    '{{WRAPPER}} {{CURRENT_ITEM}}.master-shape' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
			                ],
			            ]
			        );

					$repeater->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'shape_box_shadow',
							'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.master-shape',
						]
					);

					$repeater->add_group_control(
	                    Group_Control_Border::get_type(),
	                    [
	                        'name' => 'shape_border',
	                        'label' => __( 'Border', 'masterlayer' ),
	                        'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.master-shape',
	                    ]
	                );

					$repeater->end_controls_tab();

				// Shape - Position
					$repeater->start_controls_tab( 
	                    'tab_shape_position',
	                    [
	                        'label' => __( 'Position', 'masterlayer' ),
	                    ] 
	                );

	                $repeater->add_responsive_control(
			            'shape_visibility',
			            [
			                'label'     => __( 'Visibility', 'masterlayer'),
			                'type'      => Controls_Manager::SELECT,
			                'default'   => 'visible',
			                'options'   => [
			                	'visible' =>  __( 'Visible', 'masterlayer'),
			                	'hidden' =>  __( 'Hidden', 'masterlayer'),
			                ],
			                'selectors' => [
			                    '{{CURRENT_ITEM}}.master-shape' => 'visibility: {{VALUE}};',
			                ],
			            ]
			        );

	                $repeater->add_control(
		                'shape_index',
		                [
		                    'label' => __( 'Z-index', 'masterlayer' ),
		                    'type' => Controls_Manager::NUMBER,
		                    'min' => -10,
		                    'max' => 100,
		                    'step' => 1,
		                    'selectors'  => [
			                    '{{WRAPPER}} {{CURRENT_ITEM}}.master-shape' => 'z-index: {{VALUE}}',
			                ],
		                ]
		            ); 

	                $repeater->add_responsive_control(
			            'shape_align',
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

			        $repeater->add_responsive_control(
			            'shape_left_offset',
			            [
			                'label'      => __( 'Left Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => -200,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => -100,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-shape' => 'left: {{SIZE}}{{UNIT}};',
			                ],
			                50,
			                'condition' => [ 'shape_align' => 'left', ]
			            ]
			        );

			        $repeater->add_responsive_control(
			            'shape_right_offset',
			            [
			                'label'      => __( 'Right Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => 0,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => 0,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-shape' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
			                ],
			                50,
			                'condition' => [ 'shape_align' => 'right', ]
			            ]
			        );

			        $repeater->add_responsive_control(
			            'shape_valign',
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

			        $repeater->add_responsive_control(
			            'shape_top_offset',
			            [
			                'label'      => __( 'Top Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => -200,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => -100,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-shape' => 'top: {{SIZE}}{{UNIT}};',
			                ],
			                50,
			                'condition' => [ 'shape_valign' => 'top', ],
							'render_type' => 'template'
			            ]
			        );

			        $repeater->add_responsive_control(
			            'shape_bottom_offset',
			            [
			                'label'      => __( 'Bottom Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => -200,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => -100,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-shape' => 'bottom: {{SIZE}}{{UNIT}};',
			                ],
			                50,
			                'condition' => [ 'shape_valign' => 'bottom', ],
							'render_type' => 'template'
			            ]
			        );

			        $repeater->end_controls_tab();

			    // Shape - Animation
					$repeater->start_controls_tab( 
	                    'tab_shape_animation',
	                    [
	                        'label' => __( 'Animation', 'masterlayer' ),
	                    ] 
	                );

	                $repeater->add_control(
			            'shape_animation',
			            [
			                'label'     => __( 'Animation', 'masterlayer'),
			                'type'      => Controls_Manager::SELECT,
			                'default'   => 'none',
			                'options'   => $animations,
			                'render_type' => 'template'
			            ]
			        );

			        // Parallax Hover
			        	$repeater->add_control(
			                'shape_direction',
			                [
			                    'label'     => __( 'Direction', 'masterlayer'),
			                    'type'      => Controls_Manager::SELECT,
			                    'default'   => 'follow',
			                    'options'   => [
			                        'follow'           => __( 'Follow', 'masterlayer'),
			                        'opposite'         => __( 'Opposite', 'masterlayer'),
			                    ],
								'condition' => [ 'shape_animation' => 'parallaxHover'],
			                	'render_type' => 'template'
			                ]
			            );

						$repeater->add_control(
							'shape_range',
							[
								'label' => __( 'Range', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'min' => 0,
			                    'max' => 1,
			                    'step' => 0.1,
								'condition' => [ 'shape_animation' => 'parallaxHover'],
			                	'render_type' => 'template'
							]
						);

	                // Parallax Scroll
						$repeater->add_control(
							'shape_parallax_x',
							[
								'label' => __( 'Parallax X', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'condition' => [ 'shape_animation' => 'parallax'],
			                	'render_type' => 'template'
							]
						);

						$repeater->add_control(
							'shape_parallax_y',
							[
								'label' => __( 'Parallax Y', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'condition' => [ 'shape_animation' => 'parallax'],
			                	'render_type' => 'template'
							]
						);

						$repeater->add_control(
							'shape_smoothness',
							[
								'label' => __( 'Smoothness', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'default' => '30',
								'condition' => [ 'shape_animation' => 'parallax'],
			                	'render_type' => 'template'
							]
						);

					// Entrance Animation
						$repeater->add_control(
			                'shape_delay',
			                [
			                    'label' => __( 'Animation Delay (ms)', 'masterlayer' ),
			                    'type' => Controls_Manager::NUMBER,
			                    'min' => 0,
			                    'max' => 10000,
			                    'step' => 100,
			                    'condition' => [ 'shape_animation' => $entranceAnimation ],
			                    'selectors'  => [
				                    '{{CURRENT_ITEM}}.master-shape' => 'animation-delay: {{VALUE}}ms',
				                ],
			                	'render_type' => 'template'
			                ]
			            ); 

					$repeater->end_controls_tab();

				$repeater->end_controls_tabs();

				$this->add_control(
				    'shapes',
				    [
				        'label'       => '',
				        'type'        => Controls_Manager::REPEATER,
				        'show_label'  => false,
				        'fields'      => $repeater->get_controls(),
				        'title_field' => false,
				    ]
				);
				$this->end_controls_section();

			// Text
				$this->start_controls_section(
					'section_content_text',
					[
						'label' => __( 'Text', 'masterlayer' ),
					]
				);

				$repeater = new Repeater();

				$repeater->start_controls_tabs( 'tab_text' );

				// Text - General
					$repeater->start_controls_tab( 
	                    'tab_text_general',
	                    [
	                        'label' => __( 'Text', 'masterlayer' ),
	                    ] 
	                );

					$repeater->add_control(
						'text',
						[
							'label' => __( 'Text', 'masterlayer' ),
							'type' => Controls_Manager::TEXTAREA,
							'placeholder' => __( 'Enter your Text', 'masterlayer' ),
							'label_block' => true,
						]
					);

					$repeater->add_control(
						'text_width',
						[
							'label' => __( 'Max Width', 'masterlayer' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range' => [
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [ 'unit' => 'px' ],
							'selectors' => [
								'{{CURRENT_ITEM}}.master-text .inner' => 'max-width: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$repeater->add_group_control(
						Group_Control_Typography::get_type(),
						[
							'name' => 'text_typography',
							'label' => __( 'Typography', 'masterlayer' ),
							'selector' => '{{CURRENT_ITEM}}.master-text .inner',
						]
					);

					$repeater->end_controls_tab();

				// Text - Style
					$repeater->start_controls_tab( 
	                    'tab_text_style',
	                    [
	                        'label' => __( 'Style', 'masterlayer' ),
	                    ] 
	                );

	                // General
					$repeater->add_control(
						'text_heading_general',
						[
							'label' => __( 'General', 'masterlayer' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);

					$repeater->add_control(
		                'text_rounded',
		                [
		                    'label' => __( 'Rounded', 'masterlayer' ),
		                    'type' => Controls_Manager::DIMENSIONS,
		                    'size_units' => [ 'px', '%' ],
		                    'selectors' => [
		                        '{{CURRENT_ITEM}}.master-text .inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                    ],
		                ]
		            );

					$repeater->add_responsive_control(
		                'text_padding',
		                [
		                    'label' => __( 'Padding', 'masterlayer' ),
		                    'type' => Controls_Manager::DIMENSIONS,
		                    'size_units' => [ 'px', '%' ],
		                    'selectors' => [
		                        '{{CURRENT_ITEM}}.master-text .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                    ],
		                ]
		            );

					$repeater->add_control(
			            'text_rotate',
			            [
			                'label'     => __( 'Text Rotate', 'masterlayer'),
			                'type'      => Controls_Manager::SELECT,
			                'default'   => 'default',
			                'options'   => [
			                	'default' =>  __( 'Default', 'masterlayer'),
			                	'r90deg' =>  __( '90 Deg', 'masterlayer'),
			                	'm90deg' =>  __( '-90 Deg', 'masterlayer'),
			                ],
			            ]
			        );

					// Color
					$repeater->add_control(
						'text_heading_color',
						[
							'label' => __( 'Color', 'masterlayer' ),
							'type' => Controls_Manager::HEADING,
							'separator' => 'before',
						]
					);

					$repeater->add_control(
						'text_color',
						[
							'label' => __( 'Color', 'masterlayer' ),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{CURRENT_ITEM}}.master-text .inner' => 'color: {{VALUE}};',
							],
						]
					);

					$repeater->add_control(
						'text_bg',
						[
							'label' => __( 'Background', 'masterlayer' ),
							'type' => Controls_Manager::COLOR,
							'default' => '',
							'selectors' => [
								'{{CURRENT_ITEM}}.master-text .inner' => 'background-color: {{VALUE}};',
							],
						]
					);

					$repeater->end_controls_tab();

				// Text - Position
					$repeater->start_controls_tab( 
	                    'tab_text_position',
	                    [
	                        'label' => __( 'Position', 'masterlayer' ),
	                    ] 
	                );

	                $repeater->add_responsive_control(
			            'text_visibility',
			            [
			                'label'     => __( 'Visibility', 'masterlayer'),
			                'type'      => Controls_Manager::SELECT,
			                'default'   => 'visible',
			                'options'   => [
			                	'visible' =>  __( 'Visible', 'masterlayer'),
			                	'hidden' =>  __( 'Hidden', 'masterlayer'),
			                ],
			                'selectors' => [
			                    '{{CURRENT_ITEM}}.master-text' => 'visibility: {{VALUE}};',
			                ],
			            ]
			        );

	                $repeater->add_control(
		                'text_index',
		                [
		                    'label' => __( 'Z-index', 'masterlayer' ),
		                    'type' => Controls_Manager::NUMBER,
		                    'min' => -10,
		                    'max' => 100,
		                    'step' => 1,
		                    'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-text' => 'z-index: {{VALUE}}',
			                ],
		                ]
		            ); 

	                $repeater->add_responsive_control(
			            'text_align',
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

			        $repeater->add_responsive_control(
			            'text_left_offset',
			            [
			                'label'      => __( 'Left Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => -200,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => -100,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-text' => 'left: {{SIZE}}{{UNIT}};',
			                ],
			                50,
			                'condition' => [ 'text_align' => 'left', ],
			            ]
			        );

			        $repeater->add_responsive_control(
			            'text_right_offset',
			            [
			                'label'      => __( 'Right Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => 0,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => 0,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-text' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
			                ],
			                50,
			                'condition' => [ 'text_align' => 'right', ],
			            ]
			        );

			        $repeater->add_responsive_control(
			            'text_valign',
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

			        $repeater->add_responsive_control(
			            'text_top_offset',
			            [
			                'label'      => __( 'Top Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => -200,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => -100,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-text' => 'top: {{SIZE}}{{UNIT}};',
			                ],
			                50,
			                'condition' => [ 'text_valign' => 'top', ]
			            ]
			        );

			        $repeater->add_responsive_control(
			            'text_bottom_offset',
			            [
			                'label'      => __( 'Bottom Offset', 'masterlayer' ),
			                'type'       => Controls_Manager::SLIDER,
			                'size_units' => [ 'px', '%' ],
			                'range'      => [
			                    'px' => [
			                        'min' => -200,
			                        'max' => 500,
			                    ],
			                    '%' => [
			                        'min' => -100,
			                        'max' => 100,
			                    ],
			                ],
			                'default' => [
			                    'unit' => 'px',
			                    'size' => 0,
			                ],
			                'selectors'  => [
			                    '{{CURRENT_ITEM}}.master-text' => 'bottom: {{SIZE}}{{UNIT}};',
			                ],
			                50,
			                'condition' => [ 'text_valign' => 'bottom', ]
			            ]
			        );

			        $repeater->end_controls_tab();
			    
			    // Text - Animation
					$repeater->start_controls_tab( 
	                    'tab_text_animation',
	                    [
	                        'label' => __( 'Animation', 'masterlayer' ),
	                    ] 
	                );

	                $repeater->add_control(
			            'text_animation',
			            [
			                'label'     => __( 'Animation', 'masterlayer'),
			                'type'      => Controls_Manager::SELECT,
			                'default'   => 'none',
			                'options'   => $animations,
			                'render_type' => 'template'
			            ]
			        );

			        // Parallax Hover
			        	$repeater->add_control(
			                'text_direction',
			                [
			                    'label'     => __( 'Direction', 'masterlayer'),
			                    'type'      => Controls_Manager::SELECT,
			                    'default'   => 'follow',
			                    'options'   => [
			                        'follow'           => __( 'Follow', 'masterlayer'),
			                        'opposite'         => __( 'Opposite', 'masterlayer'),
			                    ],
								'condition' => [ 'text_animation' => 'parallaxHover'],
			                	'render_type' => 'template'
			                ]
			            );

						$repeater->add_control(
							'text_range',
							[
								'label' => __( 'Range', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'min' => 0,
			                    'max' => 1,
			                    'step' => 0.1,
								'condition' => [ 'text_animation' => 'parallaxHover'],
			                	'render_type' => 'template'
							]
						);

	                // Parallax Scroll
						$repeater->add_control(
							'text_parallax_x',
							[
								'label' => __( 'Parallax X', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'condition' => [ 'text_animation' => 'parallax'],
			                	'render_type' => 'text_template'
							]
						);

						$repeater->add_control(
							'text_parallax_y',
							[
								'label' => __( 'Parallax Y', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'condition' => [ 'text_animation' => 'parallax'],
			                	'render_type' => 'template'
							]
						);

						$repeater->add_control(
							'text_smoothness',
							[
								'label' => __( 'Smoothness', 'masterlayer' ),
								'type' => Controls_Manager::NUMBER,
								'default' => '30',
								'condition' => [ 'text_animation' => 'parallax'],
			                	'render_type' => 'template'
							]
						);

					// Entrance Animation
						$repeater->add_control(
			                'text_delay',
			                [
			                    'label' => __( 'Animation Delay (ms)', 'masterlayer' ),
			                    'type' => Controls_Manager::NUMBER,
			                    'min' => 0,
			                    'max' => 10000,
			                    'step' => 100,
			                    'condition' => [ 'text_animation' => $entranceAnimation ],
			                    'selectors'  => [
				                    '{{CURRENT_ITEM}}.master-text' => 'animation-delay: {{VALUE}}ms',
				                ],
			                	'render_type' => 'template'
			                ]
			            ); 

					$repeater->end_controls_tab();

			    $repeater->end_controls_tabs();

				$this->add_control(
				    'texts',
				    [
				        'label'       => '',
				        'type'        => Controls_Manager::REPEATER,
				        'show_label'  => false,
				        'fields'      => $repeater->get_controls(),
				        'title_field' => '{{{text}}}',
				    ]
				);

			$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$images = $this->get_settings_for_display( 'images' );
		$shapes = $this->get_settings_for_display( 'shapes' );
		$texts = $this->get_settings_for_display( 'texts' );
		?>
		<div class="master-gallery-stack">
			<?php 
				foreach ($images as $image) {
					if (!$image['top_offset']) {
						$image['top_offset']['size'] = 0;
						$image['top_offset']['unit'] = 'px';
					}
					switch ($image['animation']) {
						case 'parallax':
							wp_enqueue_script('parallaxScroll');
							printf(
								'<div class="master-fancy-image elementor-repeater-item-%3$s" data-top="%2$s" data-parallax=\'{"x" : %4$s, "y" : %5$s, "smoothness" : %6$s}\' data-calcHeight="%7$s">
									<div class="image-wrap">%1$s</div>
								</div>',
								wp_get_attachment_image( $image['image']['id'], 'full' ),
								$image['top_offset']['size'].$image['top_offset']['unit'],
								$image['_id'],
								intval( $image['parallax_x'] ),
								intval( $image['parallax_y'] ),
								intval( $image['smoothness'] ),
								$image['calc_height']
							);
							break;
						case 'parallaxHover':
							wp_enqueue_script('gsap');
							printf(
								'<div class="master-fancy-image parallax-hover elementor-repeater-item-%3$s" data-top="%2$s" data-range="%4$s" data-direction="%5$s" data-calcHeight="%6$s">
									<div class="image-wrap">%1$s</div>
								</div>',
								wp_get_attachment_image( $image['image']['id'], 'full' ),
								$image['top_offset']['size'].$image['top_offset']['unit'],
								$image['_id'],
								$image['range'],
								$image['direction'],
								$image['calc_height']
							);
							break;
						case 'custom':
							printf(
								'<div class="master-fancy-image elementor-repeater-item-%3$s %4$s" data-top="%2$s" data-calcHeight="%5$s">
									<div class="image-wrap">%1$s</div>
								</div>',
								wp_get_attachment_image( $image['image']['id'], 'full' ),
								$image['top_offset']['size'].$image['top_offset']['unit'],
								$image['_id'],
								$image['custom'],
								$image['calc_height']
							);
							break;	
						case 'none':
							if ( $image['image']['id'] && ($image['image']['id'] !== '') ) {
								printf(
									'<div class="master-fancy-image elementor-repeater-item-%3$s" data-top="%2$s" data-calcHeight="%4$s">
										<div class="image-wrap">%1$s</div>
									</div>',
									wp_get_attachment_image( $image['image']['id'], 'full' ),
									$image['top_offset']['size'].$image['top_offset']['unit'],
									$image['_id'],
									$image['calc_height']
								);
							} else {
								printf(
									'<div class="master-fancy-image elementor-repeater-item-%3$s" data-top="%2$s" data-calcHeight="%4$s">
										<div class="image-wrap"><img alt="" src="%3$s"/></div>
									</div>',
									wp_get_attachment_image( $image['image']['id'], 'full' ),
									$image['top_offset']['size'].$image['top_offset']['unit'],
									$image['image']['url'],
									$image['calc_height']
								);
							}
							break;
						default:
							printf(
								'<div class="master-fancy-image master-animation elementor-repeater-item-%3$s" data-top="%2$s" data-animation="%4$s" data-calcHeight="%5$s">
									<div class="image-wrap">%1$s</div>
								</div>',
								wp_get_attachment_image( $image['image']['id'], 'full' ),
								$image['top_offset']['size'].$image['top_offset']['unit'],
								$image['_id'],
								$image['animation'],
								$image['calc_height']
							);
							
					}
				}

				// Shape
				foreach ($shapes as $shape) {
					switch ($shape['shape_animation']) {
						case 'parallax':
							wp_enqueue_script('parallaxScroll');
							printf(
								'<div class="master-shape elementor-repeater-item-%1$s" data-parallax=\'{"x" : %2$s, "y" : %3$s, "smoothness" : %4$s}\'>
								</div>',
								$shape['_id'],
								intval( $shape['shape_parallax_x'] ),
								intval( $shape['shape_parallax_y'] ),
								intval( $shape['shape_smoothness'] )
							);
							break;
						case 'parallaxHover':
							wp_enqueue_script('gsap');
							printf(
								'<div class="master-shape parallax-hover elementor-repeater-item-%1$s" data-range="%2$s" data-direction="%3$s"></div>',
								$shape['_id'],
								$shape['shape_range'],
								$shape['shape_direction']
							);
							break;
						case 'none':
							printf(
								'<div class="master-shape elementor-repeater-item-%1$s"></div>',
								$shape['_id']
							);
							break;
						default:
							printf(
								'<div class="master-shape master-animation elementor-repeater-item-%1$s" data-animation="%2$s"></div>',
								$shape['_id'],
								$shape['shape_animation']
							);
							break;
					}
				}

				// Text
				foreach ($texts as $text) {
					$cls = '';
					$cls .= $text['text_rotate'];
					switch ($text['text_animation']) {
						case 'parallax':
							wp_enqueue_script('parallaxScroll');
							printf(
								'<div class="master-text elementor-repeater-item-%1$s %6$s" data-parallax=\'{"x" : %2$s, "y" : %3$s, "smoothness" : %4$s}\'><div class="inner">%5$s</div>
								</div>',
								$text['_id'],
								intval( $text['text_parallax_x'] ),
								intval( $text['text_parallax_y'] ),
								intval( $text['text_smoothness'] ),
								$text['text'],
								esc_attr( $cls )
							);
							break;
						case 'parallaxHover':
							wp_enqueue_script('gsap');
							printf(
								'<div class="master-text parallax-hover elementor-repeater-item-%1$s %5$s" data-range="%2$s" data-direction="%3$s"><div class="inner">%4$s</div></div>',
								$text['_id'],
								$text['text_range'],
								$text['text_direction'],
								$text['text'],
								esc_attr( $cls )
							);
							break;
						case 'none':
							printf(
								'<div class="master-text elementor-repeater-item-%1$s %3$s"><div class="inner">%2$s</div></div>',
								$text['_id'],
								$text['text'],
								esc_attr( $cls )
							);
							break;
						default:
							printf(
								'<div class="master-text master-animation elementor-repeater-item-%1$s %4$s" data-animation="%2$s"><div class="inner">%3$s</div></div>',
								$text['_id'],
								$text['text_animation'],
								$text['text'],
								esc_attr( $cls )
							);
							break;
					}
				}
			?>
		</div>
	    <?php
	}

	protected function content_template() {}
}

