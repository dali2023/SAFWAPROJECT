<?php
/*
Widget Name: Cart_Icon
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

class MAE_Cart_Icon_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-cart-icon';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Cart Icon', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-cart';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Cart Icon', 'masterlayer' ),
                ]
            );

            if ( class_exists( 'woocommerce' ) ) {
                $this->add_control(
                    'cart_icon',
                    [
                        'label' => __( 'Icon Cart', 'masterlayer' ),
                        'type' => Controls_Manager::ICONS,
                        'fa4compatibility' => 'icon',
                        'label_block'      => false,
                        'skin'             => 'inline',
                        'default' => [
                            'value' => 'ci-shopping-cart',
                            'library' => 'core',
                        ],
                    ]
                );
            } else {
                $this->add_control(
                    'no_cart',
                    [
                        'label'     => __( 'Please install Woocommerce Plugin!', 'masterlayer'),
                        'type'      => Controls_Manager::HEADING,
                    ]
                );
            }

            $this->add_responsive_control(
                'cart_height',
                [
                    'label'      => __( 'Cart Height', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 50,
                            'max' => 400,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .agrios-cart .nav-cart-trigger' => 'line-height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __( 'Icon Size', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .agrios-cart i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .agrios-cart svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'cart_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .agrios-cart .nav-cart-trigger' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'cart_color_hover',
                [
                    'label' => __( 'Hover Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .agrios-cart:hover .nav-cart-trigger' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display(); 

        if ( class_exists( 'woocommerce' ) ) {
            if ( $settings['cart_icon'] ) { ?>
                <div class="agrios-cart">
                    <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['cart_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php if ( WC()->cart ) { ?>
                            <span class="shopping-cart-items-count">
                                <?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
                            </span>
                        <?php } else { ?>
                            <span class="shopping-cart-items-count">0</span>
                        <?php } ?>
                    </a>

                    <div class="nav-shop-cart">
                        <div class="widget_shopping_cart_content">          
                            <?php if ( WC()->cart ) woocommerce_mini_cart() ?>
                        </div>
                    </div>
                </div>
            <?php }
        } 
        
    }

    protected function content_template() {}
}

