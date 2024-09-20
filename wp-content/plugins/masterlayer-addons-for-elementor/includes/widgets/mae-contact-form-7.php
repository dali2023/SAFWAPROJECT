<?php
/*
Widget Name: Contact Form 7
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

class MAE_Contact_Form_7_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-contact-form-7';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Contact Form 7', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-contact-form';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
			
		$this->start_controls_section(
			'section__content',
			[
				'label' => __( 'Contact Form 7', 'masterlayer' ),
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
            'max_width',
            [
                'label'      => __( 'Max Width', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min' => 200,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wpcf7' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
                ],
                50
            ]
        );

		$this->add_control(
			'cf7',
			[
				'label' => __( 'Select Contact Form', 'masterlayer' ),
                'description' => __( 'Contact form 7 plugin must be installed and there must be some contact forms made with the contact form 7','masterlayer' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => $this->get_cf7(),
			]
		);

		$this->end_controls_section();

        // Style
            $this->start_controls_section( 'setting_style_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );  

            $this->add_control(
                'color',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'typography',
                    'label' => __('typography', 'masterlayer'),
                    'selector' => '{{WRAPPER}}'
                ]
            );

            $this->end_controls_section();


            $this->start_controls_section( 'setting_style_section',
                [
                    'label' => __( 'Input', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            ); 

            $this->add_control(
                'input_bg',
                [
                    'label' => __( 'Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} input, {{WRAPPER}} select, {{WRAPPER}} textarea' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'input_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} input, {{WRAPPER}} select, {{WRAPPER}} textarea' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'input_rounded',
                [
                    'label' => __('Input Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} input, {{WRAPPER}} select, {{WRAPPER}} textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'input_spacing',
                [
                    'label'      => __( 'Input Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} input, {{WRAPPER}} select, {{WRAPPER}} textarea'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

            $this->add_control(
                'input_padding',
                [
                    'label' => __('Input Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} input, {{WRAPPER}} select, {{WRAPPER}} textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'input_typography',
                    'label' => __('typography', 'masterlayer'),
                    'selector' => '{{WRAPPER}} input, {{WRAPPER}} select, {{WRAPPER}} textarea'
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section( 'setting_style_btn_section',
                [
                    'label' => __( 'Button', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            ); 

            $this->add_control(
                'btn_width',
                [
                    'label' => __( 'Button Width', 'masterlayer' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'auto',
                    'options' => [
                        'auto' => __( 'Auto', 'masterlayer' ),
                        '100%' => __( 'Full', 'masterlayer' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-submit' => 'width: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'btn_bg',
                [
                    'label' => __( 'Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-submit' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'btn_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-submit' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'btn_bg_hover',
                [
                    'label' => __( 'Hover Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-submit:hover' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'btn_color_hover',
                [
                    'label' => __( 'Hover Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-submit:hover' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'btn_rounded',
                [
                    'label' => __('Button Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'btn_spacing',
                [
                    'label'      => __( 'Button Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .wpcf7-submit'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

            $this->end_controls_section();

            $this->start_controls_section( 'setting_style_rs_section',
                [
                    'label' => __( 'Range Slider', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            ); 

            $this->add_control(
                'bar_color',
                [
                    'label' => __( 'Bar Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cf7 .uacf7-form-5 input[type=range]' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'thumb_color',
                [
                    'label' => __( 'Button Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-cf7 .uacf7-form-5 .uacf7-slider::-webkit-slider-thumb, 
                        {{WRAPPER}} .master-cf7 .uacf7-form-5 .slider-number, 
                        {{WRAPPER}} .master-cf7 .uacf7-form-5 .uacf7-slider::-moz-range-thumb' => 'background-color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'btn_size',
                [
                    'label'      => __( 'Button Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-cf7 .uacf7-form-5 .uacf7-slider::-webkit-slider-thumb,
                        {{WRAPPER}} .master-cf7 .uacf7-form-5 .uacf7-slider::-moz-range-thumb 
                        {{WRAPPER}} .master-cf7 .uacf7-form-5 .slider-number'  => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'rs_spacing',
                [
                    'label'      => __( 'Range Slider Spacing', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .uacf7-slider'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    50
                ]
            );

            $this->end_controls_section();
	}


	protected function render() {
        wp_enqueue_script('contact-form-7');
        wp_enqueue_style('contact-form-7');
        
		$settings = $this->get_settings_for_display();
		static $i = 0;

        if ( ! empty( $settings['cf7'] ) ) {
    	   echo'<div class="elementor-shortcode master-cf7 master-cf7-'. $i .'" data-thumb-size="' . $settings['btn_size']['size'] . '">';
                echo do_shortcode('[contact-form-7 id="'. $settings['cf7'] .'"]');    
           echo '</div>';  
    	}

 		if ( ! empty( $settings['cf7_redirect_page'] ) ) {  ?>
 			<script>
 			    var f = document.querySelector('.master-cf7-<?php echo $i; ?>');
					f.addEventListener('wpcf7mailsent', function() {
					    <?php echo get_permalink( $settings['cf7_redirect_page'] ); ?>;
					}, false);
			</script>

		<?php  $i++;
 		}
    }

    protected function get_cf7() {
    	$catlist = [];
	 	$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
	    
	    if ( $categories = get_posts( $args ) ) {
	    	foreach ( $categories as $category ) {
	    		(int)$catlist[$category->ID] = $category->post_title;
	    	}
	    } else{
	        (int)$catlist['0'] = __( 'No contact From 7 form found', 'masterlayer' );
	    }

	  	return $catlist;
	}

	protected function content_template() {}
}

