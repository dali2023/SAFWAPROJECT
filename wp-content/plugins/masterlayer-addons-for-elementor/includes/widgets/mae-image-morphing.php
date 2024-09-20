<?php
/*
Widget Name: Image Morphing
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Core\Schemes\Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class MAE_Image_Morphing_Widget extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_script_depends() {
        return [ 'snapSVG', 'gsap', 'appear' ];
    }

    public function get_name() {
        return 'mae-image-morphing';
    }

    public function get_title() {
        return __( 'MAE - Image Morphing', 'masterlayer' );
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
		// Content
		$this->start_controls_section(
			'section__image',
			[
				'label' => __( 'Image', 'masterlayer' )
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
                        ]
                    ],
                    'default' => '',
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
                        ]
                    ],
                    'default' => '',
                    'prefix_class' => 'align-%s'
                ]
            );
        }

        $this->add_control(
            'heading_image',
            [
                'label' => esc_html__( 'Images', 'masterlayer' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ]
            ]
        );

        $this->add_control(
            'thumbs',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'  => __( 'Image #01', 'masterlayer' )
                    ]
                ],
                'title_field' => 'Image'
            ]
        );

        $this->add_control(
            'heading_path',
            [
                'label' => esc_html__( 'Paths', 'masterlayer' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'viewport',
            [   
                'label' => __( 'SVG Viewport', 'elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( '0 0 140 140', 'masterlayer' ),
                'placeholder' => __( '0 0 width height', 'masterlayer' ),
                'dynamic' => [ 'active' => true ],
                'label_block' => true
            ]
        );

        $repeater2 = new Repeater();

        $repeater2->add_control(
            'path',
            [
                'type'    => Controls_Manager::TEXTAREA,
                'default' => __( 'M 60.2019 139.968C 10.0264 141.87 -15.9066 59.2741 10.4905 15.8247C 36.8876 -27.6246 60.2019 30.8118 74.8044 43.5304C 89.4069 56.2491 129.333 5.46655 138.59 26.0864C 147.847 46.7062 110.377 138.065 60.2019 139.968Z', 'masterlayer' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'paths',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater2->get_controls(),
                'default'     => [
                    [
                        'path'     => __( 'M 60.2019 139.968C 10.0264 141.87 -15.9066 59.2741 10.4905 15.8247C 36.8876 -27.6246 60.2019 30.8118 74.8044 43.5304C 89.4069 56.2491 129.333 5.46655 138.59 26.0864C 147.847 46.7062 110.377 138.065 60.2019 139.968Z', 'masterlayer' ) 
                    ],
                    [
                        'path'     => __( 'M 94.7303 124.45C 37.6879 145.918 39.743 147.892 33.2237 112.891C 26.7044 77.8904 -20.0016 75.3768 9.914 28.6733C 39.8296 -18.0302 145.625 -3.39022 139.766 41.766C 133.907 86.9223 151.773 102.983 94.7303 124.45Z', 'masterlayer' ) 
                    ],
                    [
                        'path'     => __( 'M 140 70C 140 108.66 108.66 140 70 140C 31.3401 140 0 108.66 0 70C 0 31.3401 31.3401 0 70 0C 108.66 0 140 31.3401 140 70Z', 'masterlayer' ) 
                    ],
                ],
                'title_field' => 'Path'
            ]
        );

		$this->end_controls_section();

        // Video Icon
        $this->start_controls_section(
            'section__video',
            [
                'label' => __( 'Video Icon', 'masterlayer' )
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

        // Decoration
        $this->start_controls_section(
            'section__decor',
            [
                'label' => __( 'Decoration', 'masterlayer' )
            ]
        );

        $rd = new Repeater();

        $rd->start_controls_tabs( 'tab_decor' );
        $rd->start_controls_tab( 
            'tab_content',
            [
                'label' => __( 'Content', 'masterlayer' ),
            ] 
        );

        $rd->add_control(
            'decor_title', [
                'label' => esc_html__( 'Title', 'masterlayer' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Decoration Item' , 'masterlayer' ),
                'label_block' => true,
            ]
        );

        $rd->add_control(
            'decor_type',
            [
                'label' => __( 'Item Type', 'masterlayer' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'none'    => [
                        'title' => __( 'None', 'masterlayer' ),
                        'icon' => 'eicon-ban',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'masterlayer' ),
                        'icon' => 'eicon-image',
                    ],
                    'html' => [
                        'title' => __( 'HTML', 'masterlayer' ),
                        'icon' => 'eicon-editor-code',
                    ],
                ],
                'default' => 'none'
            ]
        );

        $rd->add_control(
            'decor_image',
            [
                'label'   => __( 'Image', 'masterlayer' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [ 'url' => Utils::get_placeholder_image_src(), ],
                'condition' => [ 'decor_type' => 'image' ]
            ]
        );

        $rd->add_control(
            'decor_image_rounded',
            [
                'label' => __('Image Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
                'condition' => [ 'decor_type' => 'image' ]
            ]
        );

        $rd->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'decor_image_shadow',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                'condition' => [ 'decor_type' => 'image' ]
            ]
        );

        $rd->add_control(
            'decor_html',
            [
                'label' => __( 'HTML', 'masterlayer' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your HTML', 'masterlayer' ),
                'label_block' => true,
                'condition' => [ 'decor_type' => 'html' ]
            ]
        );

        $rd->end_controls_tab();

        $rd->start_controls_tab( 
            'tab_style',
            [
                'label' => __( 'Style', 'masterlayer' ),
            ] 
        );

        $rd->add_control(
            'decor_width',
            [
                'label' => __( 'Width', 'masterlayer' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [ 
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'template'
            ]
        );


        $rd->add_responsive_control(
            'decor_visibility',
            [
                'label'     => __( 'Visibility', 'masterlayer'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'visible',
                'options'   => [
                    'visible' =>  __( 'Visible', 'masterlayer'),
                    'hidden' =>  __( 'Hidden', 'masterlayer'),
                ],
                'selectors' => [
                    '{{CURRENT_ITEM}}.master-decor' => 'visibility: {{VALUE}};',
                ],
            ]
        );

        $rd->add_control(
            'decor_index',
            [
                'label' => __( 'Z-index', 'masterlayer' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -10,
                'max' => 100,
                'step' => 1,
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'z-index: {{VALUE}}',
                ],
            ]
        ); 

        $rd->add_responsive_control(
            'decor_align',
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
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $rd->add_responsive_control(
            'decor_left_offset',
            [
                'label'      => __( 'Left Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'left: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_align' => 'left', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_responsive_control(
            'decor_right_offset',
            [
                'label'      => __( 'Right Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'right: {{SIZE}}{{UNIT}}; left: unset;',
                ],
                50,
                'condition' => [ 'decor_align' => 'right', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_responsive_control(
            'decor_valign',
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

        $rd->add_responsive_control(
            'decor_top_offset',
            [
                'label'      => __( 'Top Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'top: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_valign' => 'top', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_responsive_control(
            'decor_bottom_offset',
            [
                'label'      => __( 'Bottom Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{CURRENT_ITEM}}.master-decor' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                50,
                'condition' => [ 'decor_valign' => 'bottom', ],
                'render_type' => 'template'
            ]
        );

        $rd->add_control(
            'decor_class',
            [
                'label' => __( 'CSS Classes', 'masterlayer' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $rd->end_controls_tab();
        $rd->end_controls_tabs();

        $this->add_control(
            'decors',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $rd->get_controls(),
                'default'     => [
                    [
                        'decor_title'  => __( 'Decoration Item #01', 'masterlayer' )
                    ]
                ],
                'title_field' => '{{{ decor_title }}}'
            ]
        );

        $this->end_controls_section();

        // Style - Icon
            $this->start_controls_section(
                'section__style_general_icon',
                [
                    'label' => __( 'Settings', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE
                ]
            );

            $this->add_control(
                'heading_animate',
                [
                    'label' => esc_html__( 'Animation', 'masterlayer' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'repeat',
                [
                    'label' => __( 'Repeat', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'default' => 3,
                ]
            );

            $this->add_control(
                'duration',
                [
                    'label' => __( 'Duration', 'masterlayer' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1000,
                    'max' => 10000,
                    'step' => 100,
                    'default' => 5000,
                ]
            );

            $this->end_controls_section();

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
                        '{{WRAPPER}} .master-image-morphing .master-video-icon a' => 'font-size: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-image-morphing .master-video-icon a' => 'width: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-image-morphing .master-video-icon a' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-image-morphing .master-video-icon a, {{WRAPPER}} .master-video-icon a .p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .master-image-morphing .master-video-icon a' => 'color: {{VALUE}};',
                    ]
                ]
            );
            $this->add_control(
                'video_icon_bg',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-morphing .master-video-icon a' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .master-image-morphing .master-video-icon .circle-1' => 'border-color: {{VALUE}};',
                        '{{WRAPPER}} .master-image-morphing .master-video-icon .circle-2' => 'border-color: {{VALUE}};',
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
                        '{{WRAPPER}} .master-image-morphing .master-video-icon:hover a' => 'color: {{VALUE}};',
                    ]
                ]
            );
            $this->add_control(
                'video_icon_bg_hover',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-morphing .master-video-icon:hover a' => 'background-color: {{VALUE}};',
                        '{{WRAPPER}} .master-image-morphing .master-video-icon:hover .circle-1' => 'border-color: {{VALUE}};',
                        '{{WRAPPER}} .master-image-morphing .master-video-icon:hover .circle-2' => 'border-color: {{VALUE}};',
                    ]
                ]
            );
            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->end_controls_section();
	}

	protected function render() {
        $config = array();
        $data = '';

		$settings = $this->get_settings_for_display();
        $paths = $this->get_settings_for_display( 'paths' );
        $images = $this->get_settings_for_display( 'thumbs' );
        
        $config['repeat'] = $settings['repeat'];
        $config['duration'] = $settings['duration'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        $id = 'clip' . rand();
		?>

        <?php if ( $settings['decors'][0]['decor_type'] !== 'none' ) echo $this->render_decor(); ?>

		<div class="master-image-morphing" <?php echo $data; ?>>
			<svg viewBox="<?php echo $settings['viewport']; ?>">
                <?php foreach ( $paths as $index => $item ) { ?>
                    <clipPath <?php if ($index == 0) echo 'id="' . $id . '"'; ?>>
                        <path d="<?php echo $item['path']; ?>"></path>
                    </clipPath>        
                <?php } ?>
                <g clip-path="url(<?php echo '#' . $id; ?>)">
                    <?php foreach ( $images as $index => $item ) { 
                    $attr = wp_get_attachment_image_src( $item['image']['id'], 'full' );
                    ?>
                        <image xlink:href="<?php echo $item['image']['url']; ?>" width="<?php echo esc_attr($attr[1]); ?>" height="<?php echo esc_attr($attr[2]); ?>"></image>       
                    <?php } ?>
                </g>
            </svg>

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
		<?php if ( $settings['decors'][0]['decor_type'] !== 'none' ) echo '</div>';
	}

    public function render_decor() {
        $settings = $this->get_settings_for_display( 'decors' );

        ob_start(); ?>
        <div class="master-wrap">
            <?php foreach ($settings as $item) {
                $cls = 'elementor-repeater-item-' . $item['_id'] . ' ' . $item['decor_class'];

                if ( $item['decor_type'] == 'image' ) { ?>
                    <div class="master-decor image <?php echo $cls; ?>">
                        <?php echo wp_get_attachment_image( $item['decor_image']['id'], 'full' ); ?>
                    </div>
                <?php }

                if ( $item['decor_type'] == 'html' ) { ?>
                    <div class="master-decor html <?php echo $cls; ?>">
                        <?php echo $item['decor_html']; ?>
                    </div>
                <?php }
            }

        $return = ob_get_clean();
        return $return;
    }
}