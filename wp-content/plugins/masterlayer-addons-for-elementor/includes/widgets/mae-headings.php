<?php
/*
Widget Name: Link
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
use Elementor\Scheme_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Headings_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-headings';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Headings', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-heading';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		// Content 
			$this->start_controls_section(
				'content_section',
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
	            'sep',
	            [
	                'label'     => __( 'Separator', 'masterlayer'),
	                'type'      => Controls_Manager::SELECT,
	                'default'   => 'none',
	                'options'   => [
	                    'none'         => __( 'None', 'masterlayer'),
	                    'top'          => __( 'Top', 'masterlayer'),
	                    'before'       => __( 'Before Title', 'masterlayer'),
	                    'after'        => __( 'After Title', 'masterlayer'),
	                ],
	            ]
	        );

	        $this->add_control(
	            'style',
	            [
	                'label'     => __( 'Heading Style', 'masterlayer'),
	                'type'      => Controls_Manager::SELECT,
	                'default'   => 'default',
	                'options'   => [
	                    'default'          => __( 'Default', 'masterlayer'),
	                    'style-1'          => __( 'Style 1', 'masterlayer'),
	                ],
	                'prefix_class' => 'heading-'
	            ]
	        );

			$this->add_control(
				'pre',
				[
					'label' => __( 'Pre Heading', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Our Service', 'masterlayer' ),
					'placeholder' => __( 'Enter your pre-heading', 'masterlayer' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'heading',
				[
					'label' => __( 'Main Heading', 'masterlayer' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => __( 'What we focus', 'masterlayer' ),
					'placeholder' => __( 'Enter your heading', 'masterlayer' ),
					'label_block' => true,
				]
			);

			$this->add_control(
				'sub',
				[
					'label' => __( 'Sub Heading', 'masterlayer' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => __( 'We work on a wide range of building typologies and projects', 'masterlayer' ),
					'placeholder' => __( 'Enter your sub-heading', 'masterlayer' ),
					'label_block' => true,
				]
			);

			$this->end_controls_section();

		// Style - General
			$this->start_controls_section(
				'section__style_general',
				[
					'label' => __( 'Generals', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);	

			$this->add_responsive_control(
				'sep_width',
				[
					'label' => __( 'Separator Width', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-heading .sep' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'sep!' => 'none'
					]
				]
			);

			$this->add_responsive_control(
				'pre_heading_max_width',
				[
					'label' => __( 'Pre Heading Max Width', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 300,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-heading .pre-heading' => 'max-width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'pre!' => '' ]
				]
			);

			$this->add_responsive_control(
				'heading_max_width',
				[
					'label' => __( 'Main Heading Max Width', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 300,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-heading .main-heading' => 'max-width: {{SIZE}}{{UNIT}};',
					'condition' => [ 'heading!' => '' ]],
				]
			);

			$this->add_responsive_control(
				'sub_heading_max_width',
				[
					'label' => __( 'Sub Heading Max Width', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 300,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-heading .sub-heading' => 'max-width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'sub!' => '' ]
				]
			);

			$this->end_controls_section();

		// Color
			$this->start_controls_section(
				'section__style_color',
				[
					'label' => __( 'Color', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'sep_bg_color',
				[
					'label' => __( 'Separator', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .master-heading .sep' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'sep!' => 'none'
					]
				]
			);

			$this->add_control(
				'pre-heading_color',
				[
					'label' => __( 'Pre Heading', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .master-heading .pre-heading' => 'color: {{VALUE}};',
					],
				'condition' => [ 'pre!' => '' ]
				]
			);

			$this->add_control(
				'heading_color',
				[
					'label' => __( 'Main Heading', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .master-heading .main-heading' => 'color: {{VALUE}};',
					],
					'condition' => [ 'heading!' => '' ]
				]
			);

			$this->add_control(
				'sub_heading_color',
				[
					'label' => __( 'Sub Heading', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .master-heading .sub-heading' => 'color: {{VALUE}};',
					],
					'condition' => [ 'sub!' => '' ]
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

			$this->add_responsive_control(
				'sep_bottom_space',
				[
					'label' => __( 'Separator', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-heading .sep' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'sep!' => 'none'
					]
				]
			);

			$this->add_responsive_control(
				'pre_heading_bottom_space',
				[
					'label' => __( 'Pre Heading', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-heading .pre-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'pre!' => '' ]
				]
			);

			$this->add_responsive_control(
				'heading_bottom_space',
				[
					'label' => __( 'Main Heading', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-heading .main-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'heading!' => '' ]
				]
			);

			$this->add_responsive_control(
				'sub_heading_bottom_space',
				[
					'label' => __( 'Sub Heading', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .master-heading .sub-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'sub!' => '' ]
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
					'name' => 'pre_heading_typography',
					'label' => __( 'Pre Heading', 'masterlayer' ),
					'selector' => '{{WRAPPER}} .master-heading .pre-heading',
					'condition' => [ 'pre!' => '' ]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'heading_typography',
					'label' => __( 'Main Heading', 'masterlayer' ),
					'selector' => '{{WRAPPER}} .master-heading h2',
					'condition' => [ 'heading!' => '' ]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'sub_heading_typography',
					'label' => __( 'Sub Heading', 'masterlayer' ),
					'selector' => '{{WRAPPER}} .master-heading .sub-heading',
					'condition' => [ 'sub!' => '' ]
				]
			);

			$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$sep = '<div class="sep"></div>'
		?>
		<div class="master-heading sep-<?php echo esc_attr($settings['sep']); ?>">
			<?php if ( $settings['sep'] == 'top' ) echo $sep; ?>
	        <?php if ( ! empty( $settings['pre'] ) ) { ?>
	        	<div class="pre-heading"><span class="line"><span class="inner"></span></span><?php echo $settings['pre']; ?></div>
	        <?php } ?>

	        <?php if ( $settings['sep'] == 'before' ) echo $sep; ?>

	        <?php if ( ! empty( $settings['heading'] ) ) { ?>
	        <h2 class="main-heading"><?php echo $settings['heading']; ?></h2>
	        <?php } ?>

	        <?php if ( $settings['sep'] == 'after' ) echo $sep; ?>

	        <?php if ( ! empty( $settings['sub'] ) ) { ?>
	            <div class="sub-heading"><?php echo $settings['sub']; ?></div>
	        <?php } ?>
	    </div>
	    <?php
	}

    protected function content_template() {}
}

