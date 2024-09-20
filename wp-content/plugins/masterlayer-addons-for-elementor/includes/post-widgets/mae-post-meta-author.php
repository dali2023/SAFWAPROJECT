<?php
/*
Widget Name: Post Author
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

class MAE_Post_Meta_Author_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-post-meta-author';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Post Meta (Author)', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-person';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {

        // Content  
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'masterlayer' )
            ]
        );

        $this->add_control(
            'meta_icon',
            [
                'label' => __( 'Icon', 'masterlayer' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block'      => false,
                'skin'             => 'inline'
            ]
        );

        $this->add_control(
            'prefix_text',
            [
                'label'     => __( 'Prefix Text', 'masterlayer'),
                'type'      => Controls_Manager::TEXT,
                'default' => __('By', 'masterlayer')
            ]
        );

        $this->add_control(
            'show_avatar',
            [
                'label' => esc_html__( 'Show Avatar', 'masterlayer' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'masterlayer' ),
                'label_off' => esc_html__( 'Hide', 'masterlayer' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_responsive_control(
            'avatar_size',
            [
                'label'      => __( 'Avatar Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                50,
                'default' => [
                    'unit' => 'px',
                    'size' => 160,
                ],
                'condition' => [ 'show_avatar' => 'yes' ]
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
            'icon_color',
            [
                'label' => __( 'Icon Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-post-meta .icon' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .master-post-meta' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => __( 'Text Hover Color', 'masterlayer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .master-post-meta:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [   
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .master-post-meta a',
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => __( 'Icon Size', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                50
            ]
        );

        $this->add_responsive_control(
            'icon_top_offset',
            [
                'label'      => __( 'Icon Top Offset', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .icon' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                50
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label'      => __( 'Icon Spacing', 'masterlayer' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                50
            ]
        );

        $this->end_controls_section();
	}


	protected function render() {
        $settings = $this->get_settings_for_display();
        $prefix = $url = $title = $name = $avatar = '';
        $icon = '';

        // Icon
        if ( $settings['meta_icon']['value'] )
            $icon = sprintf('<span class="icon %1$s"></span>', $settings['meta_icon']['value']);

        // Prefix Text
        if ( $settings['prefix_text'] )
            $prefix = sprintf('<span class="prefix">%1$s</span>', $settings['prefix_text']);

        // URL
        $url = get_author_posts_url( get_the_author_meta( 'ID' ) );

        // Title
        $title = sprintf( esc_html__( 'View all posts by %s', 'masterlayer' ), get_the_author() );

        // Name
        $name = get_the_author();

        // Avatar 
        if ( $settings['show_avatar'] == 'yes' )
            $avatar = '<span class="author-avatar">' . get_avatar( get_the_author_meta( 'user_email' ), $size = $settings['avatar_size']['sizes'] ) . '</span>';

        ?>
        <span class="master-post-meta post-by-author item">
            <span class="line"></span>
            <?php echo $icon; ?>
            <?php echo $avatar; ?>
            <a class="name" href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>"><?php echo $prefix; ?> <?php echo $name ?></a>
        </span>
	<?php }
}

