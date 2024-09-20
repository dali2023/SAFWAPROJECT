<?php
class WPRT_Information extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title'                 => 'Contact',
            'hour'            => '',
            'address'            => '',
            'phone'            => '',
            'email'            => '',
            'icon_color' => '',
            'icon_size' => '',
            'text_color' => '',
            'text_left_pad' => '',
            'bottom_margin' => '5px',
            'margin' => ''
        );

        parent::__construct(
            'widget_information',
            esc_html__( 'Information', 'masterlayer' ),
            array(
                'classname'   => 'widget_information',
                'description' => esc_html__( 'Display Information', 'masterlayer' )
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

        $bottom_margin = intval( $bottom_margin );
        $text_left_pad = intval( $text_left_pad );
        
        $wrap_css = $css = $cls = $icon = $icon_css = $text_css = '';

        if ( ! empty( $margin ) ) $wrap_css .= 'margin:'. $margin .';';
        if ( ! empty( $bottom_margin ) ) $css .= 'margin-bottom:'. $bottom_margin .'px;';

        if ( $icon_color == '#eddd5e' ) {
            $cls .= ' accent-icon';
        } else {
            if ( ! empty( $icon_color ) ) $icon_css .= 'color:'. $icon_color .';';
        }

        if ( ! empty( $icon_size ) ) $icon_css .= 'font-size:'. $icon_size .';';
        if ( ! empty( $text_color ) ) $text_css .= 'color:'. $text_color .';';
        if ( ! empty( $text_left_pad ) ) $icon_css .= 'padding-right:'. $text_left_pad .'px;';
        ?>

        <ul class="clearfix" style="<?php echo esc_attr( $wrap_css ); ?>">
            <?php
            if ( $hour ) 
                printf( '<li class="hour %5$s" style="%1$s"><i class="ci-clock" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $hour ), esc_attr( $cls ) );

            if ( $phone ) 
                printf( '<li class="phone %5$s" style="%1$s"><i class="ci-telephone-1" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $phone ), esc_attr( $cls ) );

            if ( $address ) 
                printf( '<li class="address %5$s" style="%1$s"><i class="ci-location" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), $address, esc_attr( $cls ) );

            if ( $email ) 
                printf( '<li class="email %5$s" style="%1$s"><i class="ci-email1" style="%2$s"></i><span style="%3$s">%4$s</span></li>', esc_attr( $css ), esc_attr( $icon_css ), esc_attr( $text_css ), esc_html( $email ), esc_attr( $cls ) );

            ?>
        </ul>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;

        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['hour']         = strip_tags( $new_instance['hour'] );
        $instance['address']         =  $new_instance['address'];
        $instance['phone']         = strip_tags( $new_instance['phone'] );
        $instance['email']         = strip_tags( $new_instance['email'] );
        $instance['icon_color']         = strip_tags( $new_instance['icon_color'] );
        $instance['icon_size']         = strip_tags( $new_instance['icon_size'] );       
        $instance['text_color']         = strip_tags( $new_instance['text_color'] );
        $instance['text_left_pad']         = strip_tags( $new_instance['text_left_pad'] );       
        $instance['bottom_margin']         = strip_tags( $new_instance['bottom_margin'] );
        $instance['margin']         = strip_tags( $new_instance['margin'] );
        
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );       
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'masterlayer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'hour' ) ); ?>"><?php esc_html_e('Hour:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hour' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hour' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['hour'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e('Phone:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['phone'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e('Address:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['address'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e('Email:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['email'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>"><?php esc_html_e('Icon Color (ex: #ffb600):', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['icon_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>"><?php esc_html_e('Icon: Font Size (ex: 18px):', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_size' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['icon_size'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>"><?php esc_html_e('Text Color (ex: #e3e3e3):', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['text_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'text_left_pad' ) ); ?>"><?php esc_html_e('Text: Left Padding (ex: 10px):', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_left_pad' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_left_pad' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['text_left_pad'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>"><?php esc_html_e('Item Bottom Margin (ex: 15px):', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'bottom_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bottom_margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['bottom_margin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'margin' ) ); ?>"><?php esc_html_e('Wrap Margin: (ex: 0px 50px 0px 0px)', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['margin'] ); ?>">
        </p>
    <?php
    }
}
add_action( 'widgets_init', 'register_wprt_information' );

// Register widget
function register_wprt_information() {
    register_widget( 'WPRT_Information' );
}


