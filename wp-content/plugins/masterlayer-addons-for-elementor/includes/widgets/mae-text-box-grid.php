<?php
/*
Widget Name: Text Box Grid
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
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Text_Box_Grid_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-text-box-grid';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Text Box Grid', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-gallery-grid';
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

			// $this->add_control(
			// 	'column',
			// 	[
			// 		'label' => __( 'Columns', 'masterlayer' ),
			// 		'type' => Controls_Manager::SELECT,
			// 		'default' => '4',
			// 		'options' => [
			// 			'2'  	 => __( '2', 'masterlayer' ),
			// 			'3'  	 => __( '3', 'masterlayer' ),
			// 			'4'  	 => __( '4', 'masterlayer' ),
			// 			'5'  	 => __( '5', 'masterlayer' ),
			// 		],
			// 		'prefix_class' => 'grid-cols-'
			// 	]
			// );

			// $this->add_control(
			// 	'gap',
			// 	[
			// 		'label' => __( 'Columns Gap', 'masterlayer' ),
			// 		'type' => Controls_Manager::SELECT,
			// 		'default' => '0px',
			// 		'options' => [
			// 			'0px'  	 => __( '0px', 'masterlayer' ),
			// 			'10px'  	 => __( '10px', 'masterlayer' ),
			// 			'20px'  	 => __( '20px', 'masterlayer' ),
			// 			'30px'  	 => __( '30px', 'masterlayer' ),
			// 			'40px'  	 => __( '40px', 'masterlayer' ),
			// 			'50px'  	 => __( '50px', 'masterlayer' ),
			// 			'60px'  	 => __( '60px', 'masterlayer' ),
			// 		],
			// 		'prefix_class' => 'gap-'
			// 	]
			// );

			$repeater = new Repeater();

			$repeater->start_controls_tabs( 'tabs_content' );

				$repeater->start_controls_tab(
					'tab_content_content',
					[
						'label' => __( 'Content', 'masterlayer' ),
					]
				);

				$repeater->add_control(
					'icon_font',
					[
						'label' => __( 'Icon', 'masterlayer' ),
						'type' => Controls_Manager::ICONS,
						'label_block' => false,
						'fa4compatibility' => 'icon',
						'default' => [
							'value' => 'ci-tick',
							'library' => 'core',
						],
						'skin' => 'inline'
					]
				);

				$repeater->add_control(
					'title',
					[
						'label' => __( 'Title', 'masterlayer' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Construction Technology', 'masterlayer' ),
						'label_block' => true,
						'label_block' => true,
					]
				);

				$repeater->add_control(
					'text',
					[
						'label' => __( 'Text', 'masterlayer' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => __( 'We work on a wide range of building typologies and projects', 'masterlayer' ),
						'placeholder' => __( 'Enter your sub-heading', 'masterlayer' ),
						'label_block' => true,
					]
				);

				$repeater->end_controls_tab();

				$repeater->start_controls_tab(
					'tab_content_column',
					[
						'label' => __( 'Column', 'masterlayer' ),
					]
				);

				$repeater->add_responsive_control(
		            'column_width',
		            [
		                'label'      => __( 'Column Width', 'masterlayer' ),
		                'type'       => Controls_Manager::SLIDER,
		                'size_units' => [ 'px', '%' ],
		                'default' => [
		                    'unit' => '%',
		                ],
		                'selectors'  => [
		                    '{{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
		                ],
		                50,
		            ]
		        );

		        $repeater->add_control(
		            'column_margin',
		            [
		                'label' => __('Margin', 'masterlayer'),
		                'type' => Controls_Manager::DIMENSIONS,
		                'size_units' => ['px', '%'],
		                'default' => [
		                    'unit' => 'px',
		                ],
		                'selectors' => [
		                    '{{CURRENT_ITEM}} > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

				$repeater->end_controls_tab();

			$repeater->end_controls_tabs();

			$this->add_control(
				'boxes',
				[
					'label' => __( 'Items', 'masterlayer' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'title' => __( 'Box #1', 'masterlayer' ),
							'text' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'masterlayer' ),
						],
						[
							'title' => __( 'Box #2', 'masterlayer' ),
							'text' => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'masterlayer' ),
						],
						[
							'title' => __( 'Box #3', 'masterlayer' ),
							'text' => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'masterlayer' ),
						],
						[
							'title' => __( 'Box #4', 'masterlayer' ),
							'text' => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'masterlayer' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

			$this->end_controls_section();


		// General
			$this->start_controls_section(
				'section__style',
				[
					'label' => __( 'General', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
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
				'active',
				[
					'label' => __( 'Active Item', 'masterlayer' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'none',
					'options' => [
						'none'  	 => __( 'none', 'masterlayer' ),
						'1'  	 => __( '1', 'masterlayer' ),
						'2'  	 => __( '2', 'masterlayer' ),
						'3'  	 => __( '3', 'masterlayer' ),
						'4'  	 => __( '4', 'masterlayer' ),
						'5'  	 => __( '5', 'masterlayer' ),
					],
				]
			);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' => __( 'Icon Size', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .icon-wrap' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};
						 height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_top_offset',
				[
					'label' => __( 'Icon: Top Offset', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -20,
							'max' => 20,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .icon-wrap i' => 'transform: translateY({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_control(
				'icon_view',
				[
					'label' => __( 'Icon View', 'masterlayer' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default' 	 => __( 'Default', 'masterlayer' ),
						'has-bg'  => __( 'Has Background', 'masterlayer' ),
					],
					'prefix_class' => 'icon-'
				]
			);

			$this->add_responsive_control(
				'icon_bg_size',
				[
					'label' => __( 'Icon Background Size', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 10,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .icon-wrap' => 'width: {{SIZE}}{{UNIT}};
						 height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'icon_view' => 'has-bg']
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

			$this->start_controls_tabs( 'tabs_hover' );

				$this->start_controls_tab(
					'tab_hover_normal',
					[
						'label' => __( 'Normal', 'masterlayer' ),
					]
				);

				$this->add_control(
					'box_bg',
					[
						'label' => __( 'Box Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-text-box' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'icon_color',
					[
						'label' => __( 'Icon', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .icon-wrap' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'icon_bg',
					[
						'label' => __( 'Icon Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .icon-wrap' => 'background-color: {{VALUE}};',
						],
						'condition' => [ 'icon_view' => 'has-bg']
					]
				);

				$this->add_control(
					'title_color',
					[
						'label' => __( 'Title', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-text-box .title' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'text_color',
					[
						'label' => __( 'Text', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-text-box .text' => 'color: {{VALUE}};',
						]
					]
				);

				$this->end_controls_tab();

				// Active
				$this->start_controls_tab(
					'tab_hover_active',
					[
						'label' => __( 'Active', 'masterlayer' ),
					]
				);

				$this->add_control(
					'box_bg_active',
					[
						'label' => __( 'Box Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-text-box.active' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'icon_color_active',
					[
						'label' => __( 'Icon', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-text-box.active .icon-wrap' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'icon_bg_active',
					[
						'label' => __( 'Icon Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-text-box.active .icon-wrap' => 'background-color: {{VALUE}};',
						],
						'condition' => [ 'icon_view' => 'has-bg']
					]
				);

				$this->add_control(
					'title_color_active',
					[
						'label' => __( 'Title', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-text-box.active .title' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'text_color_active',
					[
						'label' => __( 'Text', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-text-box.active .text' => 'color: {{VALUE}};',
						]
					]
				);

				$this->end_controls_tab();
			$this->end_controls_tabs();
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
				'box_padding',
				[
					'label' => __( 'Padding', 'masterlayer' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .master-text-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			if ( is_rtl() ) {
				$this->add_responsive_control(
					'icon_right_spacing',
					[
						'label' => __( 'Icon: Right Spacing', 'masterlayer' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 50,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .icon-wrap' => 'margin-right: {{SIZE}}{{UNIT}};',
						],
					]
				);
			} else {
				$this->add_responsive_control(
					'icon_right_spacing',
					[
						'label' => __( 'Icon: Left Spacing', 'masterlayer' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 50,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .icon-wrap' => 'margin-left: {{SIZE}}{{UNIT}};',
						],
					]
				);
			}

			$this->add_responsive_control(
				'title_bottom_spacing',
				[
					'label' => __( 'Title: Bottom Spacing', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

		// Typo
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
					'name' => 'title_typography',
					'label' => __( 'Title', 'masterlayer' ),
					'selector' => '{{WRAPPER}} .master-text-box .title',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'text_typography',
					'label' => __( 'Text', 'masterlayer' ),
					'selector' => '{{WRAPPER}} .master-text-box .text',
				]
			);

			$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$boxes = $this->get_settings_for_display('boxes');
		?>

		<div class="master-text-box-grid grid-container" data-active="<?php echo esc_attr($settings['active']) ?>">
			<?php foreach ( $boxes as $box ) { ?>
				<div class="column elementor-repeater-item-<?php echo esc_attr($box['_id']); ?>">
					<div class="master-text-box">
						<h3 class="title">
							<?php if ( $box['icon_font']['library'] ) { ?>
								<span class="icon-wrap">
							        <?php Icons_Manager::render_icon( $box['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
						        </span> 
							<?php } ?>

							<?php echo $box['title']; ?>
						</h3>
				        
				        <?php if ( $box['text'] ) echo '<div class="text">' . $box['text'] . '</div>'; ?>
				    </div>
				</div>
		    <?php } ?>
		</div>
		<?php
	}

    protected function content_template() {}
}

