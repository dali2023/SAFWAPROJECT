<?php
/*
Widget Name: Hover Box
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
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
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Hover_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-hover-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Hover Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-info-box';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        // Content Section
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' )
                ]
            );

            $this->add_control(
                'image',
                [
                    'label'   => __( 'Image', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src() ]
                ]
            );

            $this->add_control(
                'box_icon',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'fa-solid'
                    ]
                ]
            );

            $this->add_control(
                'title',
                [
                    'label'   => __( 'Title', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'Box Title', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true
                    ],
                    'label_block' => true
                ]
            );

            $this->add_control(
                'desc',
                [
                    'label'      => __( 'Description', 'masterlayer' ),
                    'type'       => Controls_Manager::WYSIWYG,
                    'default'    => __( 'There are many variations of passages of Lorem Ipsum but the majority have alteration.', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true
                    ]
                ]
            );

            $this->add_control(
                'url',
                [
                    'label'      => __( 'URL', 'masterlayer'),
                    'type'       => Controls_Manager::URL,
                    'dynamic'    => [
                        'active'        => true,
                        'categories'    => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::URL_CATEGORY
                        ]
                    ],
                    'placeholder'       => 'https://www.your-link.com',
                    'default'           => [
                        'url' => '#'
                    ]
                ]
            );

            $this->end_controls_section();

        // Style - General
            $this->start_controls_section( 'style_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE
                ]
            );

            $this->add_control(
                'active',
                [
                    'label' => __( 'Active', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Yes', 'your-plugin' ),
                    'label_off' => __( 'No', 'your-plugin' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'icon_view',
                [
                    'label'     => __( 'Icon View', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'has-bg',
                    'options'   => [
                        'default'            => __( 'Default', 'masterlayer'),
                        'has-bg'      => __( 'Has background', 'masterlayer')
                    ],
                    'prefix_class' => 'icon-'
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label'      => __( 'Icon Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 20,
                            'max' => 200
                        ]
                    ],
                    'default' => [
                        'unit' => 'px'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .master-icon > svg' => 'width: {{SIZE}}{{UNIT}}'
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'icon_bg_size',
                [
                    'label'      => __( 'Background Icon Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 20,
                            'max' => 400
                        ]
                    ],
                    'default' => [
                        'unit' => 'px'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                    ],
                    50,
                    'condition' => [ 'icon_view' => 'has-bg' ]
                ]
            );

            $this->end_controls_section();

        // Style - Color
            $this->start_controls_section( 'style_color_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE
                ]
            );

            $this->add_control(
                'icon_bg_color',
                [
                    'label' => __( 'Icon Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-hover-box .master-icon' => 'background-color: {{VALUE}};'
                    ],
                    'condition' => [ 'icon_view' => 'has-bg' ]
                ]
            );

            $this->add_control(
                'icon_color',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-hover-box .master-icon' => 'color: {{VALUE}}'
                    ]
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Title', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-hover-box .headline-2' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'desc_color',
                [
                    'label' => __( 'Description', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-hover-box .desc' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'arrow_color',
                [
                    'label' => __( 'Arrow', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-hover-box .arrow' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'arrow_bg_color',
                [
                    'label' => __( 'Arrow Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-hover-box .arrow' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->end_controls_section();

        // Spacing
            $this->start_controls_section( 'setting_spacing_section',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE
                ]
            );

            $this->add_control(
                'padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-hover-box .content-wrap, .master-hover-box .hover-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
                'icon_spacing',
                [
                    'label'      => __( 'Icon', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 50,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}'
                    ],
                    50
                ]
            );

            $this->add_responsive_control(
                'title_spacing',
                [
                    'label'      => __( 'Title', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 50
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-hover-box .hover-content-wrap .headline-2' => 'margin-bottom: {{SIZE}}{{UNIT}}'
                    ],
                    50,
                ]
            );

            $this->end_controls_section();

        // Typography
            $this->start_controls_section( 'setting_typography_section',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'headline_typography',
                    'label' => __('Heading', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .headline-2'
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'label' => __('Description', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .desc'
                ]
            );

            $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();

        $html = $title = $content = $image = $url = "";
        
        // Title
        if ($settings['title'])
            $title = sprintf('<h3 class="headline-2">%1$s</h3>', 
                $settings['title'] );

        // Description
        if ($settings['desc'])
            $content = sprintf('<div class="desc">%1$s</div>', 
                $settings['desc'] );

        // Image URL
        if ($settings['image']['url'])
            $image = sprintf('<div class="thumb">%1$s</div>', 
                wp_get_attachment_image( $settings['image']['id'], 'full' ));

        // URL
        if ($settings['url']['url'])
            $url = sprintf('<a aria-label="button" class="arrow" href="%1$s"><i class="ci-right-arrow2"></i></a>', $settings['url']['url']);
    
        if ( $settings['active'] == 'yes' ) $cls .= 'active';
        // HTML render

        ?>
        <div class="master-hover-box <?php echo esc_attr($cls); ?>">
            <?php echo $image; ?>

            <div class="content-wrap">
                <?php if ($settings['box_icon']['library']) { ?>
                    <div class="icon-wrap">
                        <div class="master-icon">
                            <?php Icons_Manager::render_icon( $settings['box_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                    </div>
                <?php } ?>

                <?php
                echo $title;
                ?>
            </div>

            <div class="hover-content-wrap">
                <?php
                echo $title;
                echo $content;
                ?>
            </div>

            <?php echo $url; ?>
        </div>

        <?php
    }

    protected function content_template() {}
}

