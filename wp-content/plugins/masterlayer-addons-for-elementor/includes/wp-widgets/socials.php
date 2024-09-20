<?php
class WPRT_Socials extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> '',
            'width' => '',
            'height' => '',
            'gap' => '',
            'size' => '',
            'rounded' => '',
            'twitter' => '', 
            'facebook-square' => '', 
            'youtube' => '', 
            'vimeo' => '', 
            'tumblr' => '', 
            'pinterest' => '',
            'linkedin' => '',
            'instagram' => '', 
            'github' => '',
            'apple' => '',
            'android' => '',
            'behance' => '',
            'dribbble' => '',
            'flickr' => '',
            'paypal' => '',
            'soundcloud' => '',
            'spotify' => '',
        );

        parent::__construct(
            'widget_socials',
            esc_html__( 'Socials', 'masterlayer' ),
            array(
                'classname'   => 'widget_socials',
                'description' => esc_html__( 'Display the socials.', 'masterlayer' )
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

        $width = intval( $width );
        $height = intval( $height );
        $gap = intval( $gap );
        $size = intval( $size );
        $rounded = intval( $rounded );

        $icon_bottom = 10;
        $css = '';
        $inner_css = '';
        if ( ! empty( $gap ) ) {
            $inner_css = 'padding: 0 '. ($gap/2) .'px;';
            $css = 'margin: 0 -'. ($gap/2) .'px';
            $icon_bottom = $gap/2;
        }

        $icon_css = 'margin-bottom:'. $icon_bottom .'px';
        if ( ! empty( $width ) )
            $icon_css .= ';width:'. $width .'px';

        if ( ! empty( $height ) )
            $icon_css .= ';height:'. $height .'px;line-height:'. ($height+2) .'px';

        if ( ! empty( $size ) )
            $icon_css .= ';font-size:'. $size .'px';

        if ( ! empty( $rounded ) )
            $icon_css .= ';border-radius:'. $rounded .'px';

        $html = '';
        foreach ( $instance as $k => $v ) {
            if ( $v != '' && ! in_array( $k , array( 'title', 'width', 'height', 'size', 'rounded', 'gap' ) ) ) 
                $html .= '<div class="icon" style="'. $inner_css .'"><a target="_blank" title="'. $k .'" href="'. $v .'" style="'. $icon_css .'"><i class="ci-'. $k .'"></i></a></div>';
        }

        if ( $html )
            printf( '<div class="socials clearfix" style="%2$s">%1$s</div>', $html, $css );

		echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['width']         = strip_tags( $new_instance['width'] );
        $instance['height']         = strip_tags( $new_instance['height'] );
        $instance['size']         = strip_tags( $new_instance['size'] );
        $instance['rounded']         = strip_tags( $new_instance['rounded'] );
        $instance['gap']         = strip_tags( $new_instance['gap'] );
        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['twitter'] = strip_tags( $new_instance['twitter'] );
        $instance['facebook-square'] = strip_tags( $new_instance['facebook-square'] );
        $instance['youtube'] = strip_tags( $new_instance['youtube'] );
        $instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
        $instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
        $instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
        $instance['linkedin'] = strip_tags( $new_instance['linkedin-in'] );
        $instance['instagram'] = strip_tags( $new_instance['instagram'] );
        $instance['github'] = strip_tags( $new_instance['github'] );
        $instance['apple'] = strip_tags( $new_instance['apple'] );
        $instance['android'] = strip_tags( $new_instance['android'] );
        $instance['behance'] = strip_tags( $new_instance['behance'] );
        $instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
        $instance['flickr'] = strip_tags( $new_instance['flickr'] );
        $instance['paypal'] = strip_tags( $new_instance['paypal'] );
        $instance['soundcloud'] = strip_tags( $new_instance['soundcloud'] );
        $instance['spotify'] = strip_tags( $new_instance['spotify'] );
                
        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );

        $fields = array(
            'twitter' => esc_html__( 'Twitter URL:', 'masterlayer' ),
            'facebook-square' => esc_html__( 'Facebook URL:', 'masterlayer' ),
            'youtube' => esc_html__( 'Youtube URL:', 'masterlayer' ),
            'vimeo' => esc_html__( 'Vimeo URL:', 'masterlayer' ),
            'tumblr' => esc_html__( 'Tumblr URL:', 'masterlayer' ),
            'pinterest' => esc_html__( 'Pinterest URL:', 'masterlayer' ),
            'linkedin' => esc_html__( 'LinkedIn URL:', 'masterlayer' ),
            'instagram' => esc_html__( 'Instagram URL:', 'masterlayer' ),
            'github' => esc_html__( 'Github URL:', 'masterlayer' ),
            'apple' => esc_html__( 'Apple URL:', 'masterlayer' ),
            'android' => esc_html__( 'Android URL:', 'masterlayer' ),
            'behance' => esc_html__( 'Behance URL:', 'masterlayer' ),
            'dribbble' => esc_html__( 'Dribbble URL:', 'masterlayer' ),    
            'flickr' => esc_html__( 'Flickr URL:', 'masterlayer' ),
            'paypal' => esc_html__( 'Paypal URL:', 'masterlayer' ),
            'soundcloud' => esc_html__( 'Soundcloud URL:', 'masterlayer' ),
            'spotify' => esc_html__( 'Spotify URL:', 'masterlayer' )
        ); ?>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'masterlayer' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"><?php esc_html_e('Width:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['width'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e('Height:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['height'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e('Icon Font Size:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['size'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'rounded' ) ); ?>"><?php esc_html_e('Rounded:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rounded' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rounded' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['rounded'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'gap' ) ); ?>"><?php esc_html_e('Spacing Between Items:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gap' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gap' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['gap'] ); ?>">
        </p>

        <?php
        foreach ( $fields as $k => $v ) {
            printf(
                '<p>
                    <label for="%s">%s</label>
                    <input type="text" class="widefat" id="%s" name="%s" value="%s">
                </p>',
                $this->get_field_id( $k ),
                $v,
                $this->get_field_id( $k ),
                $this->get_field_name( $k ),
                $instance[$k]
            );
        }
        ?>
    <?php
    }

}

add_action( 'widgets_init', 'register_byron_socials' );
// Register widget
function register_byron_socials() {
    register_widget( 'WPRT_Socials' );
}
