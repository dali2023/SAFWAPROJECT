<?php
/*
Widget Name: Project Grid
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
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Project_Grid_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    public function get_script_depends() {
        return [ 'cubeportfolio', 'waitforimages' ];
    }

    public function get_style_depends() {
        return [ 'cubeportfolio' ];
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-project-grid';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Project Grid', 'masterlayer' );
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

        $this->add_control(
            'posts_per_page',
            [
                'label'     => __( 'Posts to show', 'masterlayer'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 6,
                'min'     => 2,
                'max'     => 20,
                'step'    => 1
            ]
        );

        $this->add_control(
            'cat_slug',
            [
                'label'   => __( 'Category Slug (optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'exclude_cat_slug',
            [
                'label'   => __( 'Exclude Cat Slug (Optional)', 'masterlayer' ),
                'type'    => Controls_Manager::TEXT,
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

        $this->start_controls_section( 'setting_project1_section',
            [
                'label' => __( 'Project', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $this->add_control(
            'arrow_icon',
            [
                'label' => __( 'Arrow Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'ci-right-arrow2',
                    'library' => 'core',
                ],
                'label_block'      => false,
                'skin'             => 'inline',
            ]
        );

        $this->add_control(
            'show_cat',
            [
                'label'        => __( 'Show Categories', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'false',
            ]
        );

        $this->add_control(
            'show_desc',
            [
                'label'        => __( 'Show Description', 'masterlayer' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'On', 'masterlayer' ),
                'label_off'    => __( 'Off', 'masterlayer' ),
                'return_value' => 'true',
                'default'      => 'true',
            ]
        );

        $this->end_controls_section();


    // Color
        $this->start_controls_section( 'setting_style_section',
            [
                'label' => __( 'Color', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );  

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_bg',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .master-project .content-wrap',
                'fields_options' => [
                    'background' => [ 'label' => __( 'Content Background', 'masterlayer' ) ],
                    'color' => [ 'label' => __( '- Color', 'masterlayer') ],
                    'image' => [ 'label' => __( '- Image', 'masterlayer') ],
                ],
            ]
        );

        $this->add_control(
            'arrow_bg',
            [
                'label' => __( 'Arrow Background', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-project .arrow' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __( 'Arrow Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-project .arrow' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->start_controls_tabs( 'box' );

        // Normal
            $this->start_controls_tab(
                'box_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => __( 'Title', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .headline-2' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'cat_color',
                [
                    'label' => __( 'Category', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .cat-item' => 'color: {{VALUE}};',
                    ]
                ]
            );
            
            $this->add_control(
                'desc_color',
                [
                    'label' => __( 'Description', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .desc' => 'color: {{VALUE}};',
                    ],
                    'condition' => ['show_desc' => 'true']
                ]
            );

            $this->end_controls_tab();
        
        //Hover 
            $this->start_controls_tab(
                'project_box_hover',
                [
                    'label' => __( 'Text Hover', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'title_color_hover',
                [
                    'label' => __( 'Title', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .headline-2:hover' => 'color: {{VALUE}};',
                    ]
                ]
            );

            $this->add_control(
                'cat_color_hover',
                [
                    'label' => __( 'Category', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project .cat-item:hover' => 'color: {{VALUE}};',
                    ]
                ]
            );
            
            $this->add_control(
                'desc_colorh',
                [
                    'label' => __( 'Description', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover .desc' => 'color: {{VALUE}};',
                    ],
                    'condition' => ['show_desc' => 'true']
                ]
            );

            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

    // Border & Shadow   
        $this->start_controls_section( 'border_style_section',
            [
                'label' => __( 'Border & Shadow', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_border_radius',
            [
                'label' => __('Arrow Border Radius', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-project .arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                ],
            ]
        );

        $this->start_controls_tabs( 'box2' );

        // Normal
            $this->start_controls_tab(
                'box2_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'border_heading',
                [
                    'label' => __( 'Border', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'border',
                    'label' => __( 'Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}} .master-project',
                ]
            );

            $this->add_control(
                'rounded_heading',
                [
                    'label' => __( 'Rounded', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_control(
                'border_radius',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-project' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    ],
                ]
            );

            $this->add_control(
                'shadow_heading',
                [
                    'label' => __( 'Box Shadow', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'selector' => '{{WRAPPER}} .master-project',
                ]
            );

            $this->end_controls_tab();

        // Hover
            $this->start_controls_tab(
                'project_box2_hover',
                [
                    'label' => __( 'Active', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'border_heading_hover',
                [
                    'label' => __( 'Border', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'border_hover',
                    'label' => __( 'Border', 'masterlayer' ),
                    'selector' => '{{WRAPPER}} .master-project.active',
                ]
            );

            $this->add_control(
                'rounded_heading_hover',
                [
                    'label' => __( 'Rounded', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_control(
                'border_radius_hover',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors' => [
                        '{{WRAPPER}} .master-project:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                    ],
                ]
            );

            $this->add_control(
                'shadow_heading_hover',
                [
                    'label' => __( 'Box Shadow', 'masterlayer' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow_hover',
                    'selector' => '{{WRAPPER}} .master-project.active',
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    // Spacing
        $this->start_controls_section( 'setting_spacing_section',
            [
                'label' => __( 'Spacing', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => __('Content Padding', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-project .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cat_spacing',
            [
                'label'      => __( 'Category Bottom Spacing', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .master-project .cat-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                50,
            ]
        );

        $this->end_controls_section();

    // Typography
        $this->start_controls_section( 'setting_typography_section',
            [
                'label' => __( 'Typography', 'masterlayer' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'headline_typography',
                'label' => __('Title', 'masterlayer'),
                'selector' => '{{WRAPPER}} .headline-2'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cat_typography',
                'label' => __('Category', 'masterlayer'),
                'selector' => '{{WRAPPER}} .cat-item'
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

        $args = array(
            'post_type' => 'project',
            'posts_per_page' => $settings['posts_per_page']
        );

        if ( $settings['cat_slug'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'project_category',
                    'field'    => 'slug',
                    'terms'    => $settings['cat_slug']
                ),
            );
        }

        if ( $settings['exclude_cat_slug'] ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'project_category',
                    'field' => 'slug',
                    'terms' => $settings['exclude_cat_slug'],
                    'operator' => 'NOT IN'
                ),
            );
        }

        $query = new \WP_Query( $args );
        if ( ! $query->have_posts() ) { esc_html_e( 'Project item not found!', 'masterlayer' ); return; }

        // Data config for grid
        if ( isset($settings['columns']) )
            $config['columns'] = $settings['columns']['size'];
        if ( isset($settings['columns_tablet']) )
            $config['columnsTablet'] = $settings['columns_tablet']['size'];
        if ( isset($settings['columns_mobile']) )
            $config['columnsMobile'] = $settings['columns_mobile']['size'];
        $config['gapHorizontal'] = $settings['gapHorizontal'];
        $config['gapVertical'] = $settings['gapVertical'];
        $config['layoutMode'] = 'grid';

        $data = 'data-config=\'' . json_encode( $config ) . '\'';

        $imageSize = 'mae-std3';

        ?>

        <div class="master-portfolio" <?php echo $data; ?>>
            <div class="galleries cbp">
                <?php
                if ( $query->have_posts() ) : ?>
                    <?php while ( $query->have_posts() ) : $query->the_post(); 
                        $url = $desc = $title = $arrow = $cats = '';

                        // Title
                        $title = sprintf(
                            '<h3 class="headline-2"><a href="%2$s">%1$s</a></h3>',
                            esc_html( get_the_title() ),
                            esc_url( get_the_permalink() ) );  

                        // Desciption
                        if ( mae_get_mod('project_desc') ) {
                            $desc = sprintf('<div class="desc"><div class="inner">%1$s</div></div>', mae_get_mod('project_desc'));
                        } else {
                            $excerpt = get_the_excerpt();
                            $excerpt = substr($excerpt, 0, 50);
                            $desc = sprintf('<div class="desc"><div class="inner">%1$s</div></div>', $excerpt );
                        }

                        // URL
                        $arrow = $this->render_arrow();

                        // Image
                        $image = sprintf(
                            '<a class="thumb" href="%2$s" aria-label="%3$s"><span class="inner">%1$s</span></a>',
                            get_the_post_thumbnail( get_the_ID(), $imageSize ),
                            esc_url( get_the_permalink() ),
                            esc_html( get_the_title() )
                        );
                        

                        // Category
                        $terms = get_the_terms( get_the_ID() , 'project_category' );

                        if ($terms) {
                            $cats .= '<div class="cat-wrap">';
                            if (array_key_exists(0, $terms)) 
                                $cats .= '<a class="cat-item" href="' . 
                                    esc_url( get_term_link( $terms[0]->slug, 'project_category' ) ) . '">' . 
                                    esc_html( $terms[0]->name) . '</a>';
                                    
                             if (array_key_exists(1, $terms)) 
                                $cats .= '<span class="cat-sep">/</span><a class="cat-item" href="' . 
                                    esc_url( get_term_link( $terms[1]->slug, 'project_category' ) ) . '">' . 
                                    esc_html( $terms[1]->name) . '</a>';
                            $cats .= '</div>';
                        }

                        ?>

                        <div class="cbp-item">
                            <div class="master-project">
                                <?php 
                                echo $image;

                                echo '<div class="content-wrap">';
                                    if ( $settings['show_cat'] == 'true' ) echo $cats;
                                    echo $title;
                                    if ( $settings['show_desc'] == 'true' ) echo $desc;
                                    echo $arrow;
                                echo '</div>';
                                echo $arrow;
                                ?>
                            </div>
                        </div>
                    <?php endwhile; 
                endif; wp_reset_postdata(); ?>
            </div><!-- galleries -->
        </div><!-- master-portfolio -->
        <?php 
    }

    public function render_arrow() {
        $settings = $this->get_settings_for_display();

        ob_start(); ?>
        <a aria-label="button" class="arrow" href="<?php echo esc_url( get_the_permalink() ); ?>">
            <?php Icons_Manager::render_icon( $settings['arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </a>
        <?php 
        $return = ob_get_clean();
        return $return;
    }
}

