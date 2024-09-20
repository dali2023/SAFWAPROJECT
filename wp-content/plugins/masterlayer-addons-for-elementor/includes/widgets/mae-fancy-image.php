<?php
/*
Widget Name: Fancy Image
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
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Fancy_Image_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-fancy-image';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Fancy Image', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-image-rollover';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		// Image
			$this->start_controls_section(
				'section__image',
				[
					'label' => __( 'Image', 'masterlayer' ),
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
				'image',
				[
					'label' => __( 'Choose Image', 'masterlayer' ),
					'type' => Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'video_icon',
				[
					'label'   => esc_html__( 'Show Video Icon', 'masterlayer' ),
					'type'    => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'masterlayer' ),
					'label_off' => __( 'Hide', 'masterlayer' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

			$this->add_control(
				'video_url',
				[
					'label' => __( 'Youtube/Video URL', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'https://www.youtube.com/watch?v=nEntUzCFXv4',
					'condition' => [
						'video_icon' => 'yes',
					]
				]
			);

			$this->end_controls_section();

		// Style - Image
			$this->start_controls_section(
				'section__style',
				[
					'label' => __( 'Image', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'space',
				[
					'label' => __( 'Width', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'size_units' => [ '%', 'px', 'vw' ],
					'range' => [
						'%' => [
							'min' => 1,
							'max' => 100,
						],
						'px' => [
							'min' => 1,
							'max' => 1000,
						],
						'vw' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-fancy-image .image-wrap' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_border_radius',
				[
					'label' => __( 'Border Radius', 'masterlayer' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .master-fancy-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'image_box_shadow',
					'exclude' => [
						'box_shadow_position',
					],
					'selector' => '{{WRAPPER}} .master-fancy-image img',
				]
			);

			$this->start_controls_tabs( 'image_hover' );
	        $this->start_controls_tab(
	            'image_hover_normal',
	            [
	                'label' => __( 'Normal', 'masterlayer' ),
	            ]
	        );

	        $this->add_control(
				'opacity',
				[
					'label' => __( 'Opacity', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1,
							'step' => 0.1,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [ 
						'{{WRAPPER}} .image-wrap' => 'opacity: {{SIZE}};',
					],
				]
			);
	        
	        $this->end_controls_tab();

	        $this->start_controls_tab(
	            'image_hover_hover',
	            [
	                'label' => __( 'Hover', 'masterlayer' ),
	            ]
	        );

	        $this->add_control(
				'opacity_hover',
				[
					'label' => __( 'Opacity', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1,
							'step' => 0.1,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [ 
						'{{WRAPPER}}:hover .image-wrap' => 'opacity: {{SIZE}};',
					],
				]
			);
	        
	        $this->end_controls_tab();
	        $this->end_controls_tabs();

			$this->end_controls_section();

		// Style - Icon
			$this->start_controls_section(
				'section__style_video_icon',
				[
					'label' => __( 'Video Icon', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
					'condition' => [ 'video_icon' => 'yes' ]
				]
			);

			$this->add_responsive_control(
	            'video_icon_size',
	            [
	                'label'      => __( 'Icon Size', 'masterlayer' ),
	                'type'       => Controls_Manager::SLIDER,
	                'size_units' => [ 'px', '%' ],
	                'range'      => [
	                    'px' => [
	                        'min' => 10,
	                        'max' => 50,
	                    ],
	                    '%' => [
	                        'min' => 50,
	                        'max' => 150,
	                    ],
	                ],
	                'default' => [
	                    'unit' => 'px',
	                    'size' => 22,
	                ],
	                'selectors'  => [
	                    '{{WRAPPER}} .master-video-icon a' => 'font-size: {{SIZE}}{{UNIT}};',
	                ],
	                50,
	            ]
	        );

	        $this->add_responsive_control(
	            'video_icon_width',
	            [
	                'label'      => __( 'Width', 'masterlayer' ),
	                'type'       => Controls_Manager::SLIDER,
	                'size_units' => [ 'px', '%' ],
	                'range'      => [
	                    'px' => [
	                        'min' => 10,
	                        'max' => 50,
	                    ],
	                    '%' => [
	                        'min' => 50,
	                        'max' => 150,
	                    ],
	                ],
	                'default' => [
	                    'unit' => 'px',
	                    'size' => 96,
	                ],
	                'selectors'  => [
	                    '{{WRAPPER}} .master-video-icon a' => 'width: {{SIZE}}{{UNIT}};',
	                ],
	                50
	            ]
	        );

	        $this->add_responsive_control(
	            'video_icon_height',
	            [
	                'label'      => __( 'Height', 'masterlayer' ),
	                'type'       => Controls_Manager::SLIDER,
	                'size_units' => [ 'px', '%' ],
	                'range'      => [
	                    'px' => [
	                        'min' => 10,
	                        'max' => 50,
	                    ],
	                    '%' => [
	                        'min' => 50,
	                        'max' => 150,
	                    ],
	                ],
	                'default' => [
	                    'unit' => 'px',
	                    'size' => 96,
	                ],
	                'selectors'  => [
	                    '{{WRAPPER}} .master-video-icon a' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
	                ],
	                50
	            ]
	        );

	        $this->add_responsive_control(
				'video_border_radius',
				[
					'label' => __( 'Rounded', 'masterlayer' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .master-video-icon a, {{WRAPPER}} .master-video-icon a .p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

	        $this->start_controls_tabs( 'button_video' );
	        $this->start_controls_tab(
	            'video_icon_normal',
	            [
	                'label' => __( 'Normal', 'masterlayer' ),
	            ]
	        );
	        $this->add_control(
	            'video_icon_color',
	            [
	                'label' => __( 'Color', 'masterlayer' ),
	                'type' => Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .master-video-icon a' => 'color: {{VALUE}};',
	                ]
	            ]
	        );
	        $this->add_control(
	            'video_icon_bg',
	            [
	                'label' => __( 'Background Color', 'masterlayer' ),
	                'type' => Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .master-video-icon a' => 'background-color: {{VALUE}};',
	                    '{{WRAPPER}} .master-video-icon .circle-1' => 'border-color: {{VALUE}};',
	                    '{{WRAPPER}} .master-video-icon .circle-2' => 'border-color: {{VALUE}};',
	                ]
	            ]
	        );
	        $this->end_controls_tab();

	        $this->start_controls_tab(
	            'video_icon_hover',
	            [
	                'label' => __( 'Hover', 'masterlayer' ),
	            ]
	        );
	        $this->add_control(
	            'video_icon_color_hover',
	            [
	                'label' => __( 'Color', 'masterlayer' ),
	                'type' => Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .master-video-icon:hover a' => 'color: {{VALUE}};',
	                ]
	            ]
	        );
	        $this->add_control(
	            'video_icon_bg_hover',
	            [
	                'label' => __( 'Background Color', 'masterlayer' ),
	                'type' => Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .master-video-icon:hover a' => 'background-color: {{VALUE}};',
	                    '{{WRAPPER}} .master-video-icon:hover .circle-1' => 'border-color: {{VALUE}};',
	                    '{{WRAPPER}} .master-video-icon:hover .circle-2' => 'border-color: {{VALUE}};',
	                ]
	            ]
	        );
	        $this->end_controls_tab();
	        $this->end_controls_tabs();

			$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Fancy Image
		?>
			<div class="master-fancy-image">
				<div class="image-wrap">
					<?php if ( $settings['image']['id'] ) {
						echo wp_get_attachment_image( $settings['image']['id'], 'full' );
					} else {
						echo '<img alt="Image" src="' . esc_url($settings['image']['url']) . '" />';
					} ?>

					<?php if ( $settings['video_icon'] == 'yes' ) { ?>
						<?php 
						wp_enqueue_style('magnific-popup'); 
						wp_enqueue_script('magnific-popup'); 
						?>
						<div class="master-video-icon">
							<div class="inner">
								<a class="popup-video" aria-label="video" href="<?php echo esc_url( $settings['video_url'] ); ?>">
									<i class="ci-play-button"></i>
									<span class="p p1"></span>
									<span class="p p2"></span>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php
	}

    protected function content_template() {}
}

