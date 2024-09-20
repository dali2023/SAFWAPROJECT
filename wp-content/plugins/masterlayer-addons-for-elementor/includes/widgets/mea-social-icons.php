<?php
/*
Widget Name: Social Icons
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
use Elementor\Repeater;
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

class MAE_Social_Icons_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-social-icons';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Social Icons', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-social-icons';
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

	        $repeater = new Repeater();

			$repeater->add_control(
				'icon_font',
				[
					'label' => __( 'Icon', 'masterlayer' ),
					'type' => Controls_Manager::ICONS,
					'label_block' => true,
					'fa4compatibility' => 'icon',
					'default' => [
						'value' => 'ci-check',
						'library' => 'core',
					]
				]
			);

	        $repeater->add_control(
				'link',
				[
					'label' => __( 'Link', 'masterlayer' ),
					'type' => Controls_Manager::URL,
					'label_block' => true,
					'label_block' => true,
	                'placeholder' => 'https://www.your-link.com',
	                    'default'  => [
	                        'url' => '#',
	                    ]
				]
			);
	    

	        $this->add_control(
				'icons',
				[
					'label' => __( 'Social Icons', 'masterlayer' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[	
							'icon_font' => [
								'value' => 'ci-twitter',
								'library' => 'core',
							],
						],
						[
							'icon_font' => [
								'value' => 'ci-facebook-square',
								'library' => 'core',
							],
						],
						[
							'icon_font' => [
								'value' => 'ci-pinterest-p',
								'library' => 'core',
							],
						],
						[
							'icon_font' => [
								'value' => 'ci-instagram',
								'library' => 'core',
							],
						],
					],
					'title_field' => '{{{ elementor.helpers.renderIcon( this, icon_font, { "aria-hidden": true }, "i", "panel" ) }}}',
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

			$this->add_control(
                'view',
                [
                    'label'     => __( 'View', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'default',
                    'options'   => [
                        'default'        => __( 'Default', 'masterlayer'),
                        'has-bg'         => __( 'Has Background', 'masterlayer'),
                    ],
					'prefix_class' => 'icon-'
                ]
            );

			$this->add_responsive_control(
				'icon_size',
				[
					'label' => __( 'Icon Size', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 18,
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} a' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'bg_size',
				[
					'label' => __( 'Background Size', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'view' => 'has-bg' ]
				]
			);

			$this->add_responsive_control(
				'icon_rounded',
				[
					'label' => __( 'Rounded', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} a' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
					'condition' => [ 'view' => 'has-bg' ]
				]
			);

			$this->add_responsive_control(
				'icon_spacing',
				[
					'label' => __( 'Icon Spacing', 'masterlayer' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} a' => 'margin-left: calc({{SIZE}}{{UNIT}} / 2); margin-right: calc({{SIZE}}{{UNIT}} / 2);',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_icon' );
			// Normal
                $this->start_controls_tab(
                    'tab_icon_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

				$this->add_control(
					'icon_color',
					[
						'label' => __( 'Icon Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} a' => 'color: {{VALUE}};',
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
							'{{WRAPPER}} a' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'icon_border',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} a',
                    ]
                );

				$this->end_controls_tab();

			// Hover
				$this->start_controls_tab(
                    'tab_icon_hover',
                    [
                        'label' => __( 'Hover', 'masterlayer' ),
                    ]
                );

		        $this->add_control(
					'icon_color_hover',
					[
						'label' => __( 'Icon Hover Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} a:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'icon_bg_hover',
					[
						'label' => __( 'Icon Background Color', 'masterlayer' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} a:hover' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'icon_border_hover',
                        'label' => __( 'Border', 'masterlayer' ),
                        'selector' => '{{WRAPPER}} a',
                    ]
                );

        		$this->end_controls_tab();
        	$this->end_controls_tabs();
        	$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();?>

		<div class="master-social-icons">
            <?php $i = 1; foreach ( $settings['icons'] as $icon ) { 
            	$url_attr = "";
                if ( $icon['link']["is_external"] ) {
                    $url_attr .= "target=_blank ";
                }

                if ( ! empty( $icon['link']["nofollow"] ) ) {
                    $url_attr .= "rel=nofollow ";
                }
            	?>
                <a href="<?php echo esc_url($icon['link']['url']) ?>" aria-label="icon" <?php echo esc_attr($url_attr); ?>>
                    <?php Icons_Manager::render_icon( $icon['icon_font'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
			<?php $i++; } ?>
	    </div>

	    <?php
	}

    protected function content_template() {}
}

