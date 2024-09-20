<?php
/*
Widget Name: Accordion
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use \Elementor\Plugin;
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

class MAE_Accordion_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-accordion';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Accordion', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-accordion';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
      
			// Content Accordion 
			$this->start_controls_section(
				'section__content',
				[
					'label' => __( 'Accordion', 'masterlayer' ),
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
	            'accordion_title_heading',
	            [
	                'label' => __( 'Title', 'masterlayer' ),
	                'type' => Controls_Manager::HEADING,
	                'separator' => 'after'
	            ]
	        );

	        $repeater->add_control(
				'accordion_title',
				[
					'label' => __( 'Title', 'masterlayer' ),
					'show_label' => false,
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Accordion Title', 'masterlayer' ),
					'placeholder' => __( 'Accordion Title', 'masterlayer' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
	            'accordion_content_heading',
	            [
	                'label' => __( 'Content', 'masterlayer' ),
	                'default' => __( 'We build everything you annex, from family houses to mega-airports of great
						power, we are ready', 'masterlayer'),
	                'type' => Controls_Manager::HEADING,
	                'separator' => 'after'
	            ]
	        );

	        $repeater->add_control(
				'accordion_content',
				[
					'label' => __( 'Content', 'masterlayer' ),
					'show_label' => false,
					'default' => __( 'Accordion Content', 'masterlayer' ),
					'placeholder' => __( 'Accordion Content', 'masterlayer' ),
					'type' => Controls_Manager::WYSIWYG,
					'show_label' => true,
				]
			);

			$this->add_control(
				'accordions',
				[
					'label' => __( 'Accordions Items', 'masterlayer' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'accordion_title' => __( 'Accordion #1', 'masterlayer' ),
							'accordion_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'masterlayer' ),
						],
						[
							'accordion_title' => __( 'Accordion #2', 'masterlayer' ),
							'accordion_content' => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'masterlayer' ),
						],
						[
							'accordion_title' => __( 'Accordion #3', 'masterlayer' ),
							'accordion_content' => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'masterlayer' ),
						],
					],
					'title_field' => '{{{ accordion_title }}}',
				]
			);


			$this->end_controls_section();

			// Style
			$this->start_controls_section(
				'section__style_general',
				[
					'label' => __( 'General', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
                'style',
                [
                    'label'     => __( 'Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'style-1',
                    'options'   => [
                        'style-1'      => __( 'Style 1', 'masterlayer'),
                        'style-2'      => __( 'Style 2', 'masterlayer'),
                    ],
                    'prefix_class' => 'accordion-'
                ]
            );

            $this->add_control(
                'active',
                [
                    'label'     => __( 'Active Item', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 1,
                    'step'    => 1,
                ]
            );

			if ( is_rtl() ) {
				$this->add_control(
		            'arrow_position',
		            [
		                'label' => __( 'Arrow Position', 'masterlayer' ),
		                'type' => Controls_Manager::CHOOSE,
		                'options' => [
		                	'none' => [
		                        'title' => __( 'None', 'masterlayer' ),
		                        'icon' => 'eicon-ban',
		                    ],
		                    'right' => [
		                        'title' => __( 'Left', 'masterlayer' ),
		                        'icon' => 'eicon-h-align-left',
		                    ],
		                    'left' => [
		                        'title' => __( 'Right', 'masterlayer' ),
		                        'icon' => 'eicon-h-align-right',
		                    ],
		                ],
		                'default' => 'right',
		                'prefix_class' => 'arrow-'
		            ]
		        );
			} else {
				$this->add_control(
		            'arrow_position',
		            [
		                'label' => __( 'Arrow Position', 'masterlayer' ),
		                'type' => Controls_Manager::CHOOSE,
		                'options' => [
		                	'none' => [
		                        'title' => __( 'None', 'masterlayer' ),
		                        'icon' => 'eicon-ban',
		                    ],
		                    'left' => [
		                        'title' => __( 'Left', 'masterlayer' ),
		                        'icon' => 'eicon-h-align-left',
		                    ],
		                    'right' => [
		                        'title' => __( 'Right', 'masterlayer' ),
		                        'icon' => 'eicon-h-align-right',
		                    ],
		                ],
		                'default' => 'right',
		                'prefix_class' => 'arrow-'
		            ]
		        );
			}
			

	        $this->end_controls_section();

	    	// Color
			$this->start_controls_section(
				'section__style_color',
				[
					'label' => __( 'Color & Background', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->start_controls_tabs( 'tabs_title_style' );

				// Normal
				$this->start_controls_tab(
					'accordion_title_normal',
					[
						'label' => __( 'Normal', 'masterlayer' ),
					]
				);

				$this->add_control(
					'title_bg',
					[
						'label' => __( 'Title Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-accordions .title' => 'background-color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'content_bg',
					[
						'label' => __( 'Content Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-accordions .content' => 'background-color: {{VALUE}};',
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
							'{{WRAPPER}} .master-accordions .title h3' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'btn_color',
					[
						'label' => __( 'Button Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-accordions .title .arrow:after, .master-accordions .title .arrow:before' => 'background-color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'desc_color',
					[
						'label' => __( 'Description Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-accordions .title h3' => 'color: {{VALUE}};',
						]
					]
				);

				$this->end_controls_tab();

				// Active
				$this->start_controls_tab(
					'accordion_title_active',
					[
						'label' => __( 'Active', 'masterlayer' ),
					]
				);
				
				$this->add_control(
					'title_bg_active',
					[
						'label' => __( 'Title Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-accordions .item.active .title' => 'background-color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'content_bg_active',
					[
						'label' => __( 'Content Background', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-accordions .item.active .content' => 'background-color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'title_color_active',
					[
						'label' => __( 'Title Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-accordions .item.active .title h3,  .master-accordions .item .title:hover h3' => 'color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'btn_color_active',
					[
						'label' => __( 'Button Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-accordions .item.active .title .arrow:after, .master-accordions .item.active .title .arrow:before' => 'background-color: {{VALUE}};',
						]
					]
				);

				$this->add_control(
					'desc_color_active',
					[
						'label' => __( 'Description Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .master-accordions .item.active .content' => 'color: {{VALUE}};',
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
				'title_padding',
				[
					'label' => __( 'Title Padding', 'masterlayer' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .master-accordions .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'content_padding',
				[
					'label' => __( 'Content Padding', 'masterlayer' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .master-accordions .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
                'item_spacing',
                [
                    'label'      => __( 'Item Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-accordions .item ' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                ]
            );

			$this->end_controls_section();

			// Border & Shadow
			$this->start_controls_section(
				'section__style_border',
				[
					'label' => __( 'Border & Shadow', 'masterlayer' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[	
					'label' => __( 'Title', 'masterlayer' ),
					'name' => 'item_border',
					'selector' => '{{WRAPPER}} .master-accordions',
				]
			);

			$this->add_control(
	            'box_border_radius',
	            [
	                'label' => __('Wrapper Rounded', 'masterlayer'),
	                'type' => Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', '%'],
	                'default' => [
	                    'unit' => 'px',
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .master-accordions' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
	                ],
	            ]
	        );

	        $this->add_control(
	            'item_border_radius',
	            [
	                'label' => __('Item Rounded', 'masterlayer'),
	                'type' => Controls_Manager::DIMENSIONS,
	                'size_units' => ['px', '%'],
	                'default' => [
	                    'unit' => 'px',
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .master-accordions .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
	                ],
	            ]
	        );

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'item_shadow',
					'selector' => '{{WRAPPER}} .master-accordions',
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
					'label' => __( 'Title', 'masterlayer' ),
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .master-accordions .title h3',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	
					'label' => __( 'Content', 'masterlayer' ),
					'name' => 'content_typography',
					'selector' => '{{WRAPPER}} .master-accordions .content',
				]
			);

			$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="master-accordions">
			<?php $i = 0; foreach ( $settings['accordions'] as $item ) { ?>
				<?php 
					$cls = 'elementor-repeater-item-' . $item['_id'];
					if ( $settings['active'] == $i + 1 ) {
						$cls .= ' active';
					} 
					$i++;
				?>
				<div class="item <?php echo $cls; ?>">
					<div class="title">
						<div class="arrow"></div>
						<h3><?php echo $item['accordion_title']; ?></h3>
					</div>

					<div class="content">
						<?php echo $item['accordion_content']; ?>
					</div>
				</div>
			<?php } ?>
	    </div>

	    <?php
	}
}

