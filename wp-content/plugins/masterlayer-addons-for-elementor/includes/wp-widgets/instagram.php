<?php
if ( ! class_exists( 'WPRT_Instagram_Widget' ) ) :
class WPRT_Instagram_Widget extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> 'Instagram Photos',
            'username'  => '', 
            'count'     => '6',
            'item_column' => '3',
            'gutter'    => '1'  
        );

        parent::__construct(
            'widget_instagram',
            esc_html__( 'Instagram Photos', 'masterlayer' ),
            array(
                'classname'   => 'widget_instagram',
                'description' => esc_html__( 'Display images from Instagram.', 'masterlayer' )
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

        $item_column = 'col'. $item_column;
        $gutter = 'g'. $gutter;

        if ( $username != '' ) {
            $media_array = $this->scrape_instagram( $username );

            if ( is_wp_error( $media_array ) ) {
                echo wp_kses_post( $media_array->get_error_message() );
            } else {
                // filter for images only?
                if ( $images_only = apply_filters( 'wpiw_images_only', false ) ) {
                    $media_array = array_filter( $media_array, array( $this, 'images_only' ) );
                }

                // slice list down to required limit.
                $media_array = array_slice( $media_array, 0, $count );
                
                echo '<div class="instagram-wrap clearfix ' . $item_column .' '. $gutter .'">';
                foreach ( $media_array as $item ) {
                    echo '<div class="instagram_badge_image"><a href="'. esc_url( $item['link'] ) .'" target="_blank"><div class="item"><img src="'.esc_url( $item['thumbnail'] ).'"  alt="image" /></div></a></div>';
                }
                echo '</div>';
            }
        }

		echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['username']   = strip_tags( $new_instance['username'] );
        $instance['count']      = intval( $new_instance['count'] );
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
        <label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'masterlayer' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['username'] ); ?>" />
        </p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'masterlayer' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'item_column' ) ); ?>"><?php esc_html_e( 'Number of column?', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'item_column' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'item_column' ) ); ?>">
                <option value="2" <?php selected( '2', $instance['item_column'] ); ?>><?php esc_html_e( '2', 'masterlayer' ) ?></option>
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

    // based on https://gist.github.com/cosmocatalano/4544576.
    function scrape_instagram( $username ) {

        $username = trim( strtolower( $username ) );

        switch ( substr( $username, 0, 1 ) ) {
            case '#':
                $url              = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
                $transient_prefix = 'h';
                break;

            default:
                $url              = 'https://instagram.com/' . str_replace( '@', '', $username );
                $transient_prefix = 'u';
                break;
        }

        if ( false === ( $instagram = get_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ) ) ) ) {

            $remote = wp_remote_get( $url );

            if ( is_wp_error( $remote ) ) {
                return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'masterlayer' ) );
            }

            if ( 200 !== wp_remote_retrieve_response_code( $remote ) ) {
                return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'masterlayer' ) );
            }

            $shards      = explode( 'window._sharedData = ', $remote['body'] );
            $insta_json  = explode( ';</script>', $shards[1] );
            $insta_array = json_decode( $insta_json[0], true );

            if ( ! $insta_array ) {
                return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'masterlayer' ) );
            }

            if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
            } elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
                $images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
            } else {
                return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'masterlayer' ) );
            }

            if ( ! is_array( $images ) ) {
                return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'masterlayer' ) );
            }

            $instagram = array();

            foreach ( $images as $image ) {
                if ( true === $image['node']['is_video'] ) {
                    $type = 'video';
                } else {
                    $type = 'image';
                }

                $caption = __( 'Instagram Image', 'masterlayer' );
                if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
                    $caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
                }

                $instagram[] = array(
                    'description' => $caption,
                    'link'        => trailingslashit( '//instagram.com/p/' . $image['node']['shortcode'] ),
                    'time'        => $image['node']['taken_at_timestamp'],
                    'comments'    => $image['node']['edge_media_to_comment']['count'],
                    'likes'       => $image['node']['edge_liked_by']['count'],
                    'thumbnail'   => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
                    'small'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
                    'large'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
                    'original'    => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
                    'type'        => $type,
                );
            } // End foreach().

            // do not set an empty transient - should help catch private or empty accounts.
            if ( ! empty( $instagram ) ) {
                $instagram = base64_encode( serialize( $instagram ) );
                set_transient( 'insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
            }
        }

        if ( ! empty( $instagram ) ) {

            return unserialize( base64_decode( $instagram ) );

        } else {

            return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'masterlayer' ) );

        }
    }

    function images_only( $media_item ) {

        if ( 'image' === $media_item['type'] ) {
            return true;
        }

        return false;
    }
}
endif;

add_action( 'widgets_init', 'register_agrios_instagram_feed' );

// Register widget
function register_agrios_instagram_feed() {
    register_widget( 'WPRT_Instagram_Widget' );
}