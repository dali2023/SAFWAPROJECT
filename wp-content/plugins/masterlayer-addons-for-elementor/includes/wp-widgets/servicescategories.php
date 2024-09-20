<?php
class WPRT_service_cat extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> 'Service Categories', 
        );

        parent::__construct(
            'widget_service_cat',
            esc_html__( 'Service Categories', 'masterlayer' ),
            array(
                'classname'   => 'widget_service_cat',
                'description' => esc_html__( 'Display Service Categories.', 'masterlayer' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );

        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; }

        $terms = get_terms([
            'taxonomy' => 'service_category',
            'hide_empty' => false,
        ]); ?>    

        <ul class="wp-block-categories-list one-level-cat wp-block-categories">
		<?php foreach ( $terms as $term ) { ?>
				<li class="cat-item">
                    <a href="<?php echo esc_url(get_term_link($term->name, 'service_category')); ?>"><?php echo esc_html($term->name); ?></a>
                </li>
			<?php } ?>        
        </ul>
        
		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance                   = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );

        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'masterlayer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
    <?php
    }
}
add_action( 'widgets_init', 'register_agrios_service_cat' );

// Register widget
function register_agrios_service_cat() {
    register_widget( 'WPRT_service_cat' );
}


