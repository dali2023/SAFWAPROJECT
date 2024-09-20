<?php
class WPRT_Spacer extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'desktop'   => '40',
            'mobi'   => '30',
        );

        parent::__construct(
            'widget_spacer',
            esc_html__( 'Empty Space', 'masterlayer' ),
            array(
                'classname'   => 'widget_spacer',
                'description' => esc_html__( 'Blank space with custom height.', 'masterlayer' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );        

        echo $before_widget;

        if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; } ?>

        <div class="spacer clearfix" data-desktop="<?php echo esc_attr( $desktop ); ?>" data-mobi="<?php echo esc_attr( $mobi ); ?>">
        </div>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['desktop']    = intval( $new_instance['desktop'] );
        $instance['mobi']       = intval( $new_instance['mobi'] );
        
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'desktop' ) ); ?>"><?php esc_html_e( 'Desktop screen:', 'masterlayer' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'desktop' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desktop' ) ); ?>" value="<?php echo esc_attr( $instance['desktop'] ); ?>">
        </p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'mobi' ) ); ?>"><?php esc_html_e( 'Mobile screen:', 'masterlayer' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'mobi' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mobi' ) ); ?>" value="<?php echo esc_attr( $instance['mobi'] ); ?>">
        </p>
    <?php
    }
}
add_action( 'widgets_init', 'register_masterlayer_spacer' );

// Register widget
function register_masterlayer_spacer() {
    register_widget( 'WPRT_Spacer' );
}


