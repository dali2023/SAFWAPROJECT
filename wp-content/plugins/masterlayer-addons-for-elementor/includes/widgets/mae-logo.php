<?php
/*
Widget Name: Logo
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
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Logo_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-logo';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Site Logo', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-site-logo';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Logo', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'logo_type',
                [
                    'label'     => __( 'Logo Type', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'text',
                    'options'   => [
                        'text'      => __( 'Text', 'masterlayer'),
                        'image'       => __( 'Image', 'masterlayer'),
                    ]
                ]
            );

            $this->add_control(
                'logo_text',
                [
                    'label'     => __( 'Logo Text', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => __( 'Logo', 'masterlayer'),
                    'condition' => [
                        'logo_type' => 'text'
                    ]
                ]
            );

            $this->add_control(
                'logo_image',
                [
                    'label' => __( 'Logo Image', 'masterlayer' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'logo_type' => 'image'
                    ]
                ]
            );

            $this->end_controls_section();

        // Style
            $this->start_controls_section(
                'section__style',
                [
                    'label' => __( 'Style', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'max_width',
                [
                    'label' => __( 'Max Width', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .master-logo' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['logo_type'] == 'text') { ?>
            <div class="master-logo logo-text"><a aria-label="logo" href="<?php echo esc_url(get_home_url()); ?>"><?php echo $settings['logo_text']; ?></a></div>
        <?php } else { ?>
            <div class="master-logo logo-image"><a aria-label="logo" href="<?php echo esc_url(get_home_url()); ?>">
                <?php echo wp_get_attachment_image( $settings['logo_image']['id'], 'full' ); ?>
            </a></div>
        <?php }
        
    }

    protected function content_template() {}
}

