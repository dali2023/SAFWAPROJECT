<?php
/*
Widget Name: Video Icon
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
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Video_Icon_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'magnific-popup' ];
    }

    public function get_style_depends() {
        return [ 'magnific-popup' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-video-icon';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Video Icon', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-youtube';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section__content',
			[
				'label' => __( 'Button', 'masterlayer' ),
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
			'url',
			[
				'label' => __( 'Youtube/Video URL', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'https://www.youtube.com/watch?v=nEntUzCFXv4',
			]
		);

		$this->add_control(
			'caption',
			[
				'label' => __( 'Caption', 'masterlayer' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'new_tab',
			[
				'label' => __( 'Open New Tab?', 'masterlayer' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'masterlayer' ),
				'label_off' => __( 'No', 'masterlayer' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'effect',
			[
				'label' => __( 'Effect', 'masterlayer' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'masterlayer' ),
				'label_off' => __( 'No', 'masterlayer' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'section__style',
			[
				'label' => __( 'Button', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Button
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __( 'Width', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-video-icon a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_line_height',
			[
				'label' => __( 'Line Height', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-video-icon a' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_size',
			[
				'label' => __( 'Size', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-video-icon a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'selector' => '{{WRAPPER}} .master-video-icon .btn-inner',
			]
		);

		$this->add_control(
			'btn_rounded',
			[
				'label' => __( 'Rounded', 'masterlayer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .master-video-icon a, {{WRAPPER}} .master-video-icon a .p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_icon_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'masterlayer' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-video-icon a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_bg',
			[
				'label' => __( 'Background Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-video-icon a' => 'background: {{VALUE}};',
					'{{WRAPPER}} .master-video-icon a span' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'masterlayer' ),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-video-icon a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_hover_bg',
			[
				'label' => __( 'Background Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-video-icon a:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .master-video-icon a:hover span' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'masterlayer' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'default' => 'pulse-shrink'
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->end_controls_section();

		$this->start_controls_section(
			'section__caption',
			[
				'label' => __( 'Caption', 'masterlayer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'caption_color',
			[
				'label' => __( 'Color', 'masterlayer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .master-video-icon > span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .master-video-icon > span',
			]
		);
		$this->add_responsive_control(
			'caption_space',
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
					'{{WRAPPER}} .master-video-icon > span' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        
        if ($settings['new_tab'] !== 'yes') {
            $this->add_render_attribute( 'btn', 'class', 'btn-play popup-video', );
        } else {
            $this->add_render_attribute( 'btn', 'class', 'btn-play', );
        }
		
		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'btn', 'class', 'elementor-animation-'. $settings['hover_animation'] );
		}

		?>
		<div class="master-video-icon">
			<div class="btn-inner">
		        <a aria-label="video" <?php echo $this->get_render_attribute_string( 'btn' ); ?> 
		        <?php if ($settings['new_tab'] == 'yes') echo 'target="_blank"'; ?>
		        href="<?php echo esc_url( $settings['url'] ); ?>">
		        	<i class="ci-play-button"></i>

		        	<?php if ( $settings['effect'] ) { ?>
		        	<span class="p p1"></span>
					<span class="p p2"></span>
					<?php } ?>
		        </a>
	        </div>
	        <?php if ( $settings['caption'] ) echo '<span>'. $settings['caption'] .'</span>'; ?>
	    </div>
	    <?php
	}

    protected function content_template() {}
}

