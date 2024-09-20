<?php
/*
Widget Name: Gallery Grid
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Gallery_Grid_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'cubeportfolio', 'waitforimages', 'magnific-popup' ];
    }

    public function get_style_depends() {
        return [ 'cubeportfolio', 'magnific-popup' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-gallery-grid';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Gallery Grid', 'masterlayer' );
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
        // General
            $this->start_controls_section( 'setting_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'image',
                [
                    'label'   => __( 'Image', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
                ]
            );

            $repeater->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    //'exclude' => [ 'custom' ],
                    'include' => [],
                    'default' => 'large',
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'galleries',
                [
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => [
                        [
                            'title'  => __( 'Image #1', 'masterlayer' ),
                        ],
                        [
                            'title'  => __( 'Image #2', 'masterlayer' ),
                        ],
                        [
                            'title'  => __( 'Image #3', 'masterlayer' ),
                        ]
                    ]
                ]
            );

            $this->add_control(
                'image_rounded',
                [
                    'label' => __('Image Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-gallery .thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->end_controls_section();

        // Grid
            $this->start_controls_section( 'setting_grid_section',
                [
                    'label' => __( 'Grid', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_control(
                'layout',
                [
                    'label'     => __( 'Layout', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'grid',
                    'options'   => [
                        'grid'          => __( 'Grid', 'masterlayer'),
                        'mosaic'        => __( 'Mosaic', 'masterlayer'),
                    ],
                ]
            );

            $this->add_responsive_control(
                'columns',
                [
                    'label' => __( 'Column', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 10,
                        ],
                    ],
                    'default' => [ 'size' => 3 ],
                    'render_type' => 'template'
                ]
            );

            $this->add_control(
                'gapHorizontal',
                [
                    'label'     => __( 'Gap Horizontal', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 30,
                    'min'     => 0,
                    'max'     => 100,
                    'step'    => 1
                ]
            );

            $this->add_control(
                'gapVertical',
                [
                    'label'     => __( 'Gap Vertical', 'masterlayer'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 30,
                    'min'     => 0,
                    'max'     => 100,
                    'step'    => 1
                ]
            );

            $this->end_controls_section(); 

        // Button
            $this->start_controls_section( 'setting_button_section',
                [
                    'label' => __( 'Button', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_SETTINGS,
                ]
            );

            $this->add_responsive_control(
                'btn_size',
                [
                    'label' => __( 'Button Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 50,
                            'max' => 200,
                        ],
                    ],
                    'render_type' => 'template',
                    'selectors' => [ '{{WRAPPER}} .master-gallery .zoom-popup-mfp' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ]
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __( 'Icon Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 200,
                        ],
                    ],
                    'render_type' => 'template',
                    'selectors' => [ 
                        '{{WRAPPER}} .master-gallery .zoom-popup-mfp::after' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .master-gallery .zoom-popup-mfp::before' => 'height: {{SIZE}}{{UNIT}};' 
                    ]
                ]
            );

            $this->add_control(
                'overlay_bg',
                [
                    'label' => __( 'Overlay Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-gallery .thumb::before' => 'background-color: {{VALUE}}; opacity: 1;',
                    ]
                ]
            );

            $this->start_controls_tabs( 'button_hover_tabs' );

            // Normal
                $this->start_controls_tab(
                    'button_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'button_bg',
                    [
                        'label' => __( 'Background', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-gallery .zoom-popup-mfp' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'button_color',
                    [
                        'label' => __( 'Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-gallery .zoom-popup-mfp:after, {{WRAPPER}} .master-gallery .zoom-popup-mfp:before' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();

            // Hover
                $this->start_controls_tab(
                    'button_hover',
                    [
                        'label' => __( 'Hover', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'button_bg_hover',
                    [
                        'label' => __( 'Background', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-gallery .zoom-popup-mfp:hover' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'button_color_hover',
                    [
                        'label' => __( 'Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-gallery .zoom-popup-mfp:hover:after, 
                            {{WRAPPER}} .master-gallery .zoom-popup-mfp:hover:before' => 'background-color: {{VALUE}};',
                        ]
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_section(); 
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();
        $galleries = $this->get_settings_for_display( 'galleries' );  

        // Data config for grid
        if ( isset($settings['columns']) )
            $config['columns'] = $settings['columns']['size'];
        if ( isset($settings['columns_tablet']) )
            $config['columnsTablet'] = $settings['columns_tablet']['size'];
        if ( isset($settings['columns_mobile']) )
            $config['columnsMobile'] = $settings['columns_mobile']['size'];
        $config['gapHorizontal'] = $settings['gapHorizontal'];
        $config['gapVertical'] = $settings['gapVertical'];
        $config['layoutMode'] = $settings['layout'];

        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        ?>

        <div class="master-portfolio master-galleries" <?php echo $data; ?>>
            <div class="galleries cbp">
                <?php foreach ( $galleries as $index => $item ) { 
                    $image = $cls1 = ""; ?>
                    <div class="master-gallery cbp-item">
                        <div class="thumb">
                            <a class="zoom-popup-mfp" href="<?php echo esc_url($item['image']['url']) ?>"></a>
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'image_size', 'image' ); ?>
                        </div>
                    </div>
                <?php } ?>
            </div><!-- galleries -->
        </div><!-- master-portfolio -->
    <?php }

    
}

