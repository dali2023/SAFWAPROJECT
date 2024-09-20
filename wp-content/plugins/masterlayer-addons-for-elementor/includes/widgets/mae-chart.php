<?php
/*
Widget Name: Chart
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Chart_Widget extends Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
 
		wp_enqueue_script( 'chart', plugin_dir_url( __FILE__ ) .'chart.js' );
	}

	protected function generateRandomString($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-chart';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Chart', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-text';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'section__content',
			[
				'label' => __( 'Content', 'masterlayer' ),
			]
		);

		$this->add_control(
			'chart_type',
			[
				'label' => __( 'Type', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'line',
				'options' => [
					'line'  => __( 'Line', 'masterlayer' ),
					'bar' => __( 'Bar', 'masterlayer' ),
					'horizontalBar' => __( 'Horizontal Bar', 'masterlayer' ),
					'pie' => __( 'Pie', 'masterlayer' ),
					'doughnut' => __( 'Doughnut', 'masterlayer' ),
					'polarArea' => __( 'Polar Area', 'masterlayer' ),
				],
			]
		);

		$this->add_control(
			'show_lable',
			[
				'label' => __( 'Show Label', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'masterlayer' ),
				'label_off' => __( 'Hide', 'masterlayer' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'chart_label_line',
			[
				'label' => __( 'Label', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'masterlayer' ),
				'condition' => [
					'chart_type' => 'line',
				]
			]
		);

		$this->add_control(
			'chart_label_bar',
			[
				'label' => __( 'Label', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'masterlayer' ),
				'condition' => [
					'chart_type' => 'bar',
				]
			]
		);

		$this->add_control(
			'chart_label_horizontalBar',
			[
				'label' => __( 'Label', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'masterlayer' ),
				'condition' => [
					'chart_type' => 'horizontalBar',
				]
			]
		);

		$this->add_control(
			'chart_label_pie',
			[
				'label' => __( 'Label', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'masterlayer' ),
				'condition' => [
					'chart_type' => 'pie',
				]
			]
		);

		$this->add_control(
			'chart_label_doughnut',
			[
				'label' => __( 'Label', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'masterlayer' ),
				'condition' => [
					'chart_type' => 'doughnut',
				]
			]
		);

		$this->add_control(
			'chart_label_polarArea',
			[
				'label' => __( 'Label', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '# of Votes', 'masterlayer' ),
				'condition' => [
					'chart_type' => 'polarArea',
				]
			]
		);
		
		
		$this->add_control(
			'background_color_line',
			[
				'label' => __( 'Background Color', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
                'condition' => [
					'chart_type' => 'line',
                ],
			]
		);

        $this->add_control(
			'border_color_line',
			[
				'label' => __( 'Border Color', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
					'chart_type' => 'line',
                ],
			]
		);

		$this->add_control(
			'pointRadius',
			[
				'label' => __( 'Point Radius', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'condition' => [
					'chart_type' => 'line',
                ],
			]
		);

		$this->add_control(
			'pointHoverRadius',
			[
				'label' => __( 'Point Hover Radius', 'masterlayer' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'condition' => [
					'chart_type' => 'line',
                ],
			]
		);

		$repeater_line = new \Elementor\repeater();
		
		$repeater_line->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'masterlayer' ),
				'placeholder' => __( 'Type your title here', 'masterlayer' ),
			]
		);

		$repeater_line->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_line->add_control(
			'point_background',
			[
				'label' => __( 'Point Background', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_line->add_control(
			'point_border',
			[
				'label' => __( 'Point Border Color', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'list_line',
			[
				'label' => __( 'Chart Sections', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'line',
                ],
				'fields' => $repeater_line->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'masterlayer' ),
						'section_value' => 5,
						'point_background' => '#FF0000',
						'point_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'masterlayer' ),
						'section_value' => 2,
						'point_background' => '#FFC100',
						'point_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'masterlayer' ),
						'section_value' => 10,
						'point_background' => '#09FF5E',
						'point_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'masterlayer' ),
						'section_value' => 15,
						'point_background' => '#8130F5',
						'point_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_bar = new \Elementor\repeater();
		
		$repeater_bar->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'masterlayer' ),
				'placeholder' => __( 'Type your title here', 'masterlayer' ),
			]
		);

		$repeater_bar->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_bar->add_control(
			'bar_background',
			[
				'label' => __( 'Bar Background', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_bar->add_control(
			'bar_border',
			[
				'label' => __( 'Bar Border Color', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_bar',
			[
				'label' => __( 'Chart Sections', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'bar',
                ],
				'fields' => $repeater_bar->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'masterlayer' ),
						'section_value' => 5,
						'bar_background' => '#f5ad0d',
						'bar_border' => '#d4e4f0',
					],
					[
						'section_title' => __( 'February', 'masterlayer' ),
						'section_value' => 2,
						'bar_background' => '#f5ad0d',
						'bar_border' => '#d4e4f0',
					],
					[
						'section_title' => __( 'March', 'masterlayer' ),
						'section_value' => 10,
						'bar_background' => '#f5ad0d',
						'bar_border' => '#d4e4f0',
					],
					[
						'section_title' => __( 'April', 'masterlayer' ),
						'section_value' => 15,
						'bar_background' => '#f5ad0d',
						'bar_border' => '#d4e4f0',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_horizontalBar = new \Elementor\repeater();
		
		$repeater_horizontalBar->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'masterlayer' ),
				'placeholder' => __( 'Type your title here', 'masterlayer' ),
			]
		);

		$repeater_horizontalBar->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_horizontalBar->add_control(
			'bar_background',
			[
				'label' => __( 'Bar Background', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_horizontalBar->add_control(
			'bar_border',
			[
				'label' => __( 'Bar Border Color', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_horizontalBar',
			[
				'label' => __( 'Chart Sections', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'horizontalBar',
                ],
				'fields' => $repeater_horizontalBar->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'masterlayer' ),
						'section_value' => 5,
						'bar_background' => '#FF0000',
						'bar_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'masterlayer' ),
						'section_value' => 2,
						'bar_background' => '#FFC100',
						'bar_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'masterlayer' ),
						'section_value' => 10,
						'bar_background' => '#09FF5E',
						'bar_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'masterlayer' ),
						'section_value' => 15,
						'bar_background' => '#8130F5',
						'bar_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_pie = new \Elementor\repeater();
		
		$repeater_pie->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'masterlayer' ),
				'placeholder' => __( 'Type your title here', 'masterlayer' ),
			]
		);

		$repeater_pie->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_pie->add_control(
			'pie_background',
			[
				'label' => __( 'Pie Background', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_pie->add_control(
			'pie_border',
			[
				'label' => __( 'Pie Border Color', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_pie',
			[
				'label' => __( 'Chart Sections', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'pie',
                ],
				'fields' => $repeater_pie->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'masterlayer' ),
						'section_value' => 5,
						'pie_background' => '#FF0000',
						'pie_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'masterlayer' ),
						'section_value' => 2,
						'pie_background' => '#FFC100',
						'pie_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'masterlayer' ),
						'section_value' => 10,
						'pie_background' => '#09FF5E',
						'pie_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'masterlayer' ),
						'section_value' => 15,
						'pie_background' => '#8130F5',
						'pie_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_doughnut = new \Elementor\repeater();
		
		$repeater_doughnut->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'masterlayer' ),
				'placeholder' => __( 'Type your title here', 'masterlayer' ),
			]
		);

		$repeater_doughnut->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$repeater_doughnut->add_control(
			'doughnut_background',
			[
				'label' => __( 'Pie Background', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_doughnut->add_control(
			'doughnut_border',
			[
				'label' => __( 'Pie Border Color', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_doughnut',
			[
				'label' => __( 'Chart Sections', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'doughnut',
                ],
				'fields' => $repeater_doughnut->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'masterlayer' ),
						'section_value' => 5,
						'doughnut_background' => '#FF0000',
						'doughnut_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'masterlayer' ),
						'section_value' => 2,
						'doughnut_background' => '#FFC100',
						'doughnut_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'masterlayer' ),
						'section_value' => 10,
						'doughnut_background' => '#09FF5E',
						'doughnut_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'masterlayer' ),
						'section_value' => 15,
						'doughnut_background' => '#8130F5',
						'doughnut_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);

		$repeater_polarArea = new \Elementor\repeater();
		
		$repeater_polarArea->add_control(
			'section_title',
			[
				'label' => __( 'Title', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Default title', 'masterlayer' ),
				'placeholder' => __( 'Type your title here', 'masterlayer' ),
			]
		);

		$repeater_polarArea->add_control(
			'section_value',
			[
				'label' => __( 'Value', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);


		$repeater_polarArea->add_control(
			'polarArea_background',
			[
				'label' => __( 'Background', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
			]
		);

		$repeater_polarArea->add_control(
			'polarArea_border',
			[
				'label' => __( 'Border Color', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list_polarArea',
			[
				'label' => __( 'Chart Sections', 'masterlayer' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => false,
                'condition' => [
					'chart_type' => 'polarArea',
                ],
				'fields' => $repeater_polarArea->get_controls(),
				'default' => [
					[
						'section_title' => __( 'January', 'masterlayer' ),
						'section_value' => 5,
						'polarArea_background' => '#FF0000',
						'polarArea_border' => '#E619BE',
					],
					[
						'section_title' => __( 'February', 'masterlayer' ),
						'section_value' => 2,
						'polarArea_background' => '#FFC100',
						'polarArea_border' => '#FF7800',
					],
					[
						'section_title' => __( 'March', 'masterlayer' ),
						'section_value' => 10,
						'polarArea_background' => '#09FF5E',
						'polarArea_border' => '#028800',
					],
					[
						'section_title' => __( 'April', 'masterlayer' ),
						'section_value' => 15,
						'polarArea_background' => '#8130F5',
						'polarArea_border' => '#E420FF',
					],
				],
				'title_field' => '{{section_title}}',
			]
		);
		

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id_gen = $this->generateRandomString();
		$chart_type = $settings['chart_type'];
		$show_lable = $settings['show_lable']; 
		

		if ($show_lable == 'yes') {
			$top_lable = 'true';
		}
		if (empty($show_lable)) {
			$top_lable = 'false';
		}
		
		if ($chart_type == 'line') {
			$pointRadius = $settings['pointRadius']['size'];
			$pointHoverRadius = $settings['pointHoverRadius']['size'];
			$chart_label_line = $settings['chart_label_line'];
			$background_line = $settings['background_color_line'];
			$border_color_line = $settings['border_color_line'];
			foreach ($settings['list_line'] as $key => $value) {
				$pointer_color[] = $value['point_background'];
				$border_pointer[] = $value['point_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'bar') {
			$chart_label_bar = $settings['chart_label_bar'];
			foreach ($settings['list_bar'] as $key => $value) {
				$bar_background[] = $value['bar_background'];
				$bar_border[] = $value['bar_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'horizontalBar') {
			$chart_label_bar = $settings['chart_label_horizontalBar'];
			foreach ($settings['list_horizontalBar'] as $key => $value) {
				$bar_background[] = $value['bar_background'];
				$bar_border[] = $value['bar_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'pie') {
			$chart_label_pie = $settings['chart_label_pie'];
			foreach ($settings['list_pie'] as $key => $value) {
				$pie_background[] = $value['pie_background'];
				$pie_border[] = $value['pie_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'doughnut') {
			$chart_label_doughnut = $settings['chart_label_doughnut'];
			foreach ($settings['list_doughnut'] as $key => $value) {
				$doughnut_background[] = $value['doughnut_background'];
				$doughnut_border[] = $value['doughnut_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		if ($chart_type == 'polarArea') {
			$chart_label_polarArea = $settings['chart_label_polarArea'];
			foreach ($settings['list_polarArea'] as $key => $value) {
				$polarArea_background[] = $value['polarArea_background'];
				$polarArea_border[] = $value['polarArea_border'];
				$title[] = $value['section_title'];
				$date[] = $value['section_value'];
			}
		}
		
		
		?>
		<canvas id='myChart-<?php echo $id_gen ?>'></canvas>
		<?php
		switch ($chart_type) {
			case 'line':
				?>
				<script>
				var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
				var chart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: <?php echo json_encode($title) ?>,
						datasets: [{
							label: '<?php echo $chart_label_line ?>',
							data: <?php echo json_encode($date) ?>,
							backgroundColor: '<?php echo $background_line ?>',
							borderColor: '<?php echo $border_color_line ?>',
							pointBackgroundColor: <?php echo json_encode($pointer_color) ?>,
							pointBorderColor: <?php echo json_encode($border_pointer) ?>,
							pointRadius: <?php echo $pointRadius ?>,
							pointHoverRadius: <?php echo $pointHoverRadius ?>,
						}]
					},

					options: {
						legend: {
								display: <?php echo $top_lable ?>,
							},
					}
				});
				</script>				
				<?php
				break;
			case 'bar':
				?>
				<script>
				var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
				var chart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: <?php echo json_encode($title) ?>,
						datasets: [{
							label: '<?php echo $chart_label_bar ?>',
							data: <?php echo json_encode($date) ?>,
							backgroundColor: <?php echo json_encode($bar_background) ?>,
							borderColor: <?php echo json_encode($bar_border) ?>,
							/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
							hoverBackgroundColor: ,
							hoverBorderColor: ,
							hoverBorderWidth: ,*/
						}, 
						]
					},

					options: {
						legend: {
								display: <?php echo $top_lable ?>,
							},
					}
				});
				</script>				
				<?php
				break;
			case 'horizontalBar':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'horizontalBar',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_bar ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($bar_background) ?>,
								borderColor: <?php echo json_encode($bar_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {
							legend: {
								display: <?php echo $top_lable ?>,
							},
						}
					});
					</script>				
					<?php
				break;
			case 'pie':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'pie',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_pie ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($pie_background) ?>,
								borderColor: <?php echo json_encode($pie_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {
							legend: {
								display: <?php echo $top_lable ?>,
							},
						}
					});
					</script>				
					<?php
				break;
			case 'doughnut':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'doughnut',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_doughnut ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($doughnut_background) ?>,
								borderColor: <?php echo json_encode($doughnut_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {
							legend: {
								display: <?php echo $top_lable ?>,
							},
						}
					});
					</script>				
					<?php
				break;
			case 'doughnut':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'doughnut',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_doughnut ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($doughnut_background) ?>,
								borderColor: <?php echo json_encode($doughnut_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {
							legend: {
								display: <?php echo $top_lable ?>,
							},
						}
					});
					</script>				
					<?php
				break;
			case 'polarArea':
					?>
					<script>
					var ctx = document.getElementById('myChart-<?php echo $id_gen ?>').getContext('2d');
					var chart = new Chart(ctx, {
						type: 'polarArea',
						data: {
							labels: <?php echo json_encode($title) ?>,
							datasets: [{
								label: '<?php echo $chart_label_polarArea ?>',
								data: <?php echo json_encode($date) ?>,
								backgroundColor: <?php echo json_encode($polarArea_background) ?>,
								borderColor: <?php echo json_encode($polarArea_border) ?>,
								/*borderWidth: <?php #echo json_encode($pointer_color) ?>,
								hoverBackgroundColor: ,
								hoverBorderColor: ,
								hoverBorderWidth: ,*/
							}]
						},
	
						options: {
							legend: {
								display: <?php echo $top_lable ?>,
							},
						}
					});
					</script>				
					<?php
				break;
		}
	}

	protected function content_template() {}
}

