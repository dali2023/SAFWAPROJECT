<?php
/*
Widget Name: Copyright
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
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Copyright_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }
    
    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-copyright';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Copyright', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-copyright';
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

			$this->add_control(
				'content',
				[
					'label' => __( 'Content', 'masterlayer' ),
					'default' => __( '© All Copyright 2020 by <a href="#" target="_blank" rel="noopener">Company.com</a>', 'masterlayer' ),
					'type' => Controls_Manager::WYSIWYG,
					'show_label' => true,
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
					'default' => 'left',
					'prefix_class' => 'align-%s'
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .master-copyright',
				]
			);

			$this->add_control(
				'text_color',
				[
					'label' => __( 'Text Color', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .master-copyright' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'link_color',
				[
					'label' => __( 'Link Color', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .master-copyright a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'link_color_hover',
				[
					'label' => __( 'Link Color Hover', 'masterlayer' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .master-copyright a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="master-copyright">
			<?php echo $settings['content']; ?>
	    </div>

	    <?php
	}

    protected function content_template() {}
}

