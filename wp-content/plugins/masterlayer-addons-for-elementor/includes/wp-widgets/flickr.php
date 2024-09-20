<?php
class WPRT_flickr extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> 'Flickr Feed',
            'flickrID' => '130700496@N03',
            'count'     => '9',
            'type'      => 'user',
            'display'   => 'lastest',
            'item_column' => '3',
            'gutter'    => '1'
        );

        parent::__construct(
            'widget_flickr',
            esc_html__( 'Flickr Feed', 'masterlayer' ),
            array(
                'classname'   => 'widget_flickr',
                'description' => esc_html__( 'Display images from Flickr.', 'masterlayer' )
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

        $cls = 'col'. $item_column. ' g'. $gutter; ?>

        <div class="flickr-wrap clearfix <?php echo esc_attr( $cls ); ?>">
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo esc_html( $count ); ?>&amp;display=<?php echo esc_html( $display ); ?>&amp;size=s&amp;layout=x&amp;size=s&amp;source=<?php echo esc_html( $type ); ?>&amp;<?php echo esc_html( $type ); ?>=<?php echo esc_html( $flickrID ); ?>"></script>
        </div>

		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['flickrID']   = strip_tags( $new_instance['flickrID'] );
        $instance['count']      = intval( $new_instance['count'] );
        $instance['type']       = $new_instance['type'];
        $instance['display']    = $new_instance['display'];
        $instance['item_column']      = $new_instance['item_column'];
        $instance['gutter']      = $new_instance['gutter'];
        
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
        <label for="<?php echo esc_attr( $this->get_field_id( 'flickrID' ) ); ?>"><?php esc_html_e( 'Flickr ID:', 'masterlayer' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickrID' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickrID' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['flickrID'] ); ?>" />
        </p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'masterlayer' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php esc_html_e( 'Type (user or group):', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>">
                <option value="user" <?php selected( 'user', $instance['type'] ); ?>><?php esc_html_e( 'User', 'masterlayer' ) ?></option>
                <option value="group" <?php selected( 'group', $instance['type'] ); ?>><?php esc_html_e( 'Group', 'masterlayer' ) ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>"><?php esc_html_e( 'Display (random or latest):', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'display' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display' ) ); ?>">
                <option value="random" <?php selected( 'random', $instance['display'] ); ?>><?php esc_html_e( 'Random', 'masterlayer' ) ?></option>
                <option value="latest" <?php selected( 'latest', $instance['display'] ); ?>><?php esc_html_e( 'Latest', 'masterlayer' ) ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item_column' ) ); ?>"><?php esc_html_e( 'Number of column?', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'item_column' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item_column' ) ); ?>">
                <option value="3" <?php selected( '3', $instance['item_column'] ); ?>><?php esc_html_e( '3', 'masterlayer' ) ?></option>
                <option value="4" <?php selected( '4', $instance['item_column'] ); ?>><?php esc_html_e( '4', 'masterlayer' ) ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'gutter' ) ); ?>"><?php esc_html_e( 'Gutter', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'gutter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gutter' ) ); ?>">
                <option value="0" <?php selected( '0', $instance['gutter'] ); ?>><?php esc_html_e( '0', 'masterlayer' ) ?></option>
                <option value="1" <?php selected( '1', $instance['gutter'] ); ?>><?php esc_html_e( '1', 'masterlayer' ) ?></option>
                <option value="5" <?php selected( '5', $instance['gutter'] ); ?>><?php esc_html_e( '5', 'masterlayer' ) ?></option>
                <option value="9" <?php selected( '9', $instance['gutter'] ); ?>><?php esc_html_e( '9', 'masterlayer' ) ?></option>
                <option value="12" <?php selected( '12', $instance['gutter'] ); ?>><?php esc_html_e( '12', 'masterlayer' ) ?></option>
                <option value="15" <?php selected( '15', $instance['gutter'] ); ?>><?php esc_html_e( '15', 'masterlayer' ) ?></option>
            </select>
        </p>
    <?php
    }
}
add_action( 'widgets_init', 'register_masterlayer_flickr' );

// Register widget
function register_masterlayer_flickr() {
    register_widget( 'WPRT_flickr' );
}


