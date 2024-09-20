<?php
/*
Widget Name: Tabs
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

class MAE_Tabs_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-tabs';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Tabs', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-tabs';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		//Content Service box
			$this->start_controls_section(
				'section__content',
				[
					'label' => __( 'Tabs', 'masterlayer' ),
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'tab_title',
				[
					'label' => __( 'Title & Description', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Tab Title', 'masterlayer' ),
					'placeholder' => __( 'Tab Title', 'masterlayer' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
	            'content_type',
	            [
	                'label'     => __( 'Content Type', 'masterlayer'),
	                'type'      => Controls_Manager::SELECT,
	                'default'   => 'content',
	                'options'   => [
	                    'content'         => __( 'Content', 'masterlayer'),
	                    'template'        => __( 'Template', 'masterlayer'),
	                ]
	            ]
	        );

			$repeater->add_control(
				'tab_content',
				[
					'label' => __( 'Content', 'masterlayer' ),
					'default' => __( 'Tab Content', 'masterlayer' ),
					'placeholder' => __( 'Tab Content', 'masterlayer' ),
					'type' => Controls_Manager::WYSIWYG,
					'show_label' => true,
					'condition' => [ 'content_type' => 'content' ]
				]
			);

			$repeater->add_control(
	            'tab_template',
	            [
	                'label'     => __( 'Choose Templates', 'masterlayer'),
	                'type'      => Controls_Manager::SELECT,
	                'default'   => '',
	                'options'   => mae_get_templates(),
	                'condition' => [ 'content_type' => 'template' ]
	            ]
	        );

			$this->add_control(
				'tabs',
				[
					'label' => __( 'Tabs Items', 'masterlayer' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'tab_title' => __( 'Tab #1', 'masterlayer' ),
							'tab_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'masterlayer' ),
						],
						[
							'tab_title' => __( 'Tab #2', 'masterlayer' ),
							'tab_content' => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'masterlayer' ),
						],
						[
							'tab_title' => __( 'Tab #3', 'masterlayer' ),
							'tab_content' => __( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'masterlayer' ),
						],
					],
					'title_field' => '{{{ tab_title }}}',
				]
			);


			$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'section__style_button',
			[
				'label' => __( 'Button', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		if ( is_rtl() ) {
			$this->add_control(
	            'btn_align',
	            [
	                'label'     => __( 'Button Align', 'masterlayer'),
	                'type'      => Controls_Manager::SELECT,
	                'default'   => 'stretch',
	                'options'   => [
	                    'stretch'          	  => __( 'Stretch', 'masterlayer'),
	                    'left'          	  => __( 'Right', 'masterlayer'),
	                    'right'               => __( 'Left', 'masterlayer'),
	                    'center'              => __( 'Center', 'masterlayer'),
	                    'space-between'       => __( 'Space Between', 'masterlayer'),
	                    'space-around'       => __( 'Space Around', 'masterlayer'),
	                    'space-evenly'       => __( 'Space Evenly', 'masterlayer'),
	                ],
	                'prefix_class' => 'btn-align-'
	            ]
	        );
		} else {
			$this->add_control(
	            'btn_align',
	            [
	                'label'     => __( 'Button Align', 'masterlayer'),
	                'type'      => Controls_Manager::SELECT,
	                'default'   => 'stretch',
	                'options'   => [
	                    'stretch'          	  => __( 'Stretch', 'masterlayer'),
	                    'left'          	  => __( 'Left', 'masterlayer'),
	                    'right'               => __( 'Right', 'masterlayer'),
	                    'center'              => __( 'Center', 'masterlayer'),
	                    'space-between'       => __( 'Space Between', 'masterlayer'),
	                    'space-around'       => __( 'Space Around', 'masterlayer'),
	                    'space-evenly'       => __( 'Space Evenly', 'masterlayer'),
	                ],
	                'prefix_class' => 'btn-align-'
	            ]
	        );
		}
		

		$this->add_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'masterlayer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'masterlayer' ),
			]
		);

		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'Background', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-link:not(.active)' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-link:not(.active)' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => 
					'{{WRAPPER}} .master-tabs .tab-link:not(.active), {{WRAPPER}} .master-tabs .tab-link.active:after, {{WRAPPER}} .master-tabs .tab-link.active:before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'masterlayer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-link:not(.active)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active', 'masterlayer' ),
			]
		);

		$this->add_control(
			'title_bg_active',
			[
				'label' => __( 'Background', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-link.active' => 'background: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'title_color_active',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-link.active' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_active',
				'selector' => '{{WRAPPER}} .master-tabs .tab-link.active',
			]
		);

		$this->add_control(
			'button_border_radius_active',
			[
				'label' => __( 'Border Radius', 'masterlayer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-link.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();



		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .master-tabs .tab-link',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_box_shadow',
				'selector' => '{{WRAPPER}} .master-tabs .tab-link.active',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section__style_content',
			[
				'label' => __( 'Content', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_space',
			[
				'label' => __( 'Spacing', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-content-wrap' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_bgcolor',
			[
				'label' => __( 'Background', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-content' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-content' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .master-tabs .tab-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .master-tabs .tab-content',
			]
		);

		$this->add_control(
			'content_radius',
			[
				'label' => __( 'Border Radius', 'masterlayer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'masterlayer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .master-tabs .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="master-tabs">
			<?php $rand = rand(1,1000); if ( $settings['tabs'] ) : ?>
			<ul class="tab-link-wrap">
				<?php $i = 1; foreach ( $settings['tabs'] as $tab ) { ?>
				<li class="tab-link" data-tab="tab-<?php echo esc_attr( $i.$rand ); ?>"><?php echo $tab['tab_title']; ?></li>
				<?php $i++; } ?>
			</ul>
			
			<div class="tab-content-wrap">
				<?php $j = 1; foreach ( $settings['tabs'] as $tab ) { ?>
				<div id="tab-<?php echo esc_attr( $j.$rand ); ?>" class="tab-content">
					<?php if ($tab['content_type'] == 'content') {
						echo $tab['tab_content']; 
					} else {
						if (!empty($tab['tab_template'])) {
		                    echo Plugin::$instance->frontend->get_builder_content($tab['tab_template'], false);
		                }
					} ?>
				</div>
				<?php $j++; } endif; ?>
			</div>
	    </div>

	    <?php
	}

	protected function content_template() {}
}

