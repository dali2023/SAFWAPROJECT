<?php
class WPRT_cf7 extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> 'Contact Us',
            'texts' => '',
            'form' => ''
        );

        parent::__construct(
            'widget_cf7',
            esc_html__( 'Contact Form 7', 'masterlayer' ),
            array(
                'classname'   => 'widget_cf7',
                'description' => esc_html__( 'Display Contact Form 7 for Widgets.', 'masterlayer' )
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

        <div class="clearfix">
            <?php
            if ( ! empty ($texts) )
                echo '<p class="contact-texts">'. esc_html( $texts ) .'</p>';

            $widget_text = empty($instance['form']) ? '' : stripslashes($instance['form']);
            echo apply_filters('widget_text','[contact-form-7 id="' . $widget_text . '"]');
            ?>
        </div>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['form']      = strip_tags( $new_instance['form'] );
        $instance['texts']      = strip_tags( $new_instance['texts'] );
        
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

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'texts' ) ); ?>"><?php esc_html_e('Some Texts:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'texts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'texts' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['texts'] ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'form' ) ); ?>"><?php esc_html_e( 'Form:', 'masterlayer' ); ?></label>
        <?php
        $cf7posts = new WP_Query( array( 'post_type' => 'wpcf7_contact_form' ));

        if ( $cf7posts->have_posts() ) { ?>
            <select class="widefat" name="<?php echo esc_attr( $this->get_field_name('form') ); ?>" id="<?php echo esc_attr( $this->get_field_id('form') ); ?>">
            <?php while( $cf7posts->have_posts() ) : $cf7posts->the_post(); ?>
                <option value="<?php the_id(); ?>"<?php selected(get_the_id(), $instance['form']); ?>><?php the_title(); ?></option>
            <?php endwhile;
        } else { ?>
            <select class="widefat" disabled>
            <option disabled="disabled">No Forms Found</option>
        <?php } ?>      
        </select></p> 
        <?php
    }
}
add_action( 'widgets_init', 'register_masterlayer_cf7' );

// Register widget
function register_masterlayer_cf7() {
    register_widget( 'WPRT_cf7' );
}


