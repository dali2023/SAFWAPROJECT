<?php
/*
Widget Name: Text Box
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

class MAE_Text_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-text-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Text Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-text';
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

			$this->add_control(
				'icon_font',
				[
					'label' => __( 'Icon', 'masterlayer' ),
					'type' => Controls_Manager::ICONS,
					'label_block' => true,
					'fa4compatibility' => 'icon',
					'default' => [
						'value' => 'ci-tick',
						'library' => 'core',
					],
				]
			);

			$this->add_control(
				'title',
				[
					'label' => __( 'Title', 'masterlayer' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Construction Technology', 'masterlayer' ),
					'label_block' => true,
					'label_block' => true,
				]
			);

			$this->add_control(
				'text',
				[
					'label' => __( 'Text', 'masterlayer' ),
					'type' => Controls_Manager::TEXTAREA,
					'default' => __( 'We work on a wide range of building typologies and projects', 'masterlayer' ),
					'placeholder' => __( 'Enter your sub-heading', 'masterlayer' ),
					'label_block' => true,
				]
			);

			$this->end_controls_section();

		// Style
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
		?>

		<div class="master-text-box">
			<h3 class="title">
				<?php if ( $settings['icon_font'] ) { ?>
					<span class="icon-wrap">
				        <?php Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
			        </span> 
				<?php } ?>

				<?php echo $settings['title']; ?>
			</h3>
	        
	        <?php if ( $settings['text'] ) echo '<div class="text">' . $settings['text'] . '</div>'; ?>
	    </div>

	    <?php
	}

    protected function content_template() {}
}

