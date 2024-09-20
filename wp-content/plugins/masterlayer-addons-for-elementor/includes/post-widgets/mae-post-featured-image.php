<?php
/*
Widget Name: Post Featured Image
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

class MAE_Post_Featured_Image_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-post-featured_image';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Post Featured Image', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-image';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
        // Style  
        $this->start_controls_section(
            'section__style_general',
            [
                'label' => __( 'General', 'masterlayer' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__( 'Featured Image. Go to Settings (Gear Icon on bottom left) > General Settings > Featured Image to change your image', 'masterlayer' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
                'show_label' => true,
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
            'thumbnail',
            [
                'label' => __( 'Image Size', 'masterlayer' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'agrios-post-standard',
                'options' => [
                    'full'  => __( 'Default', 'masterlayer' ),
                    'agrios-post-standard'   => __( 'Post Standard', 'masterlayer' ),
                    'agrios-project-standard'  => __( 'Project Standard', 'masterlayer' ),
                ],
                'prefix_class' => 'shake-'
            ]
        );

        $this->add_control(
            'image_rounded',
            [
                'label' => __('Rounded', 'masterlayer'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-media img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ]
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

        if ( get_post_type() == 'elementor_library' ) { 
            $url = MAE_URL . 'assets/img/sample-featured-image.jpg';
            ?>
            <div class="post-media clearfix"><img alt="Image" src="<?php echo esc_url($url); ?>" /></div>
        <?php } else {
            $html = '';
            switch ( get_post_format() ) {
                case 'gallery':
                    $icon = 'post-gallery';
                    $size = $settings['thumbnail'];

                    if ( is_single() )
                        $size = 'agrios-post-single';
                    $images = agrios_get_elementor_option( 'gallery_images' );

                    if ( empty( $images ) ) {
                        break;
                    }

                    $html = '<div class="blog-gallery">';
              
                    foreach ( $images as $image ) {
                        $html .= sprintf(
                            '<div>%1$s</div>',
                            wp_get_attachment_image( $image['id'], $size )
                        );
                    }

                    $html .= '</div>';
                    break;
                case 'video':
                    $icon = 'post-video';
                    $video = agrios_get_elementor_option( 'video_url' );
                    if ( ! $video )
                        break;

                    if ( filter_var( $video, FILTER_VALIDATE_URL ) ) {
                        // If URL: show oEmbed HTML
                        if ( $oembed = @wp_oembed_get( $video ) )
                            $html .= $oembed;
                    } else {
                        // If embed code: just display
                        $html .= $video;
                    }
                    break;
                default:
                    $icon = 'post-standard';
                    $size = $settings['thumbnail'];

                    $thumb = get_the_post_thumbnail( get_the_ID(), $size );
                    if ( empty( $thumb ) ) {
                        return;
                    }

                    if ( is_single() ) {
                        $html .= $thumb;
                    } else {
                        $html .= '<a href="'. esc_url( get_permalink() ) .'">';
                        $html .= $thumb;
                        $html .= '</a>';
                    }
            }

            if ( $html )
                printf( '<div class="post-media">%1$s</div>', $html );
        }
	}
}

