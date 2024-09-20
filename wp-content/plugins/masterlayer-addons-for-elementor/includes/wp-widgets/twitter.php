<?php 
/*
Plugin Name: WPRT Lastest Tweets
Plugin URI: http://rollthemes.com/plugins
Description: Display Lastest Tweets.
Version: 3.8
Author: RollThemes
Author URI: http://RollThemes.com
*/

if ( ! class_exists( 'Lastest_Tweets' ) ) :
class Lastest_Tweets extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title'                 => 'Latest Tweets',
            'username'              => '',
            'count'                 => '3',
            'consumer_key'          => '',
            'consumer_secret'       => '',
            'access_token'          => '',
            'access_token_secret'   => '',
            'cachetime'             => '1',
            'dtime'                 => 'date'
        );

        parent::__construct(
            'widget_twitter',
            esc_html__( 'Lastest Tweets', 'masterlayer' ),
            array(
                'classname'   => 'widget_twitter',
                'description' => esc_html__( 'Display Lastest Tweets.', 'masterlayer' )
            )
        );
    }

    function parseTweet( $text ) {
        $text = preg_replace( '#http://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text ); 
        $text = preg_replace( '#@([a-z0-9_]+)#i', '@<a  target="_blank" href="http://twitter.com/$1">$1</a>', $text ); 
        $text = preg_replace( '# \#([a-z0-9_-]+)#i', ' #<a target="_blank" href="http://twitter.com/search?q=%23$1">$1</a>', $text ); 
        $text = preg_replace( '#https://[a-z0-9._/-]+#i', '<a  target="_blank" href="$0">$0</a>', $text ); 
        
        return $text;
    }

    function twitterTime( $a ) {
        $b = strtotime( 'now' ); 
        $c = strtotime( $a );
        $d = $b - $c;

        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;
            
        if ( is_numeric( $d ) && $d > 0 ) {
            //if less then 3 seconds
            if ( $d < 3 ) return 'Right now';
            //if less then minute
            if ( $d < $minute ) return floor( $d ) . ' seconds ago';
            //if less then 2 minutes
            if ( $d < $minute * 2 ) return 'About 1 minute ago';
            //if less then hour
            if ( $d < $hour ) return floor($d / $minute) . ' minutes ago';
            //if less then 2 hours
            if ( $d < $hour * 2 ) return 'About 1 hour ago';
            //if less then day
            if ( $d < $day ) return floor( $d / $hour ) . ' hours ago';
            //if more then day, but less then 2 days
            if ( $d > $day && $d < $day * 2 ) return 'Yesterday';
            //if less then year
            if ( $d < $day * 365 ) return floor( $d / $day ) . ' days ago';
            //else return more than a year
            return 'Over a year ago';
        }
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );        

        echo $before_widget;

        if ( ! empty($title) ) { echo  $before_title.$title.$after_title; }

       	$count = intval( $count );

        if ( ! empty( $consumer_key ) ) $consumer_key = trim( $consumer_key );
        if ( ! empty( $consumer_secret ) ) $consumer_secret = trim( $consumer_secret );
        if ( ! empty( $access_token ) ) $access_token = trim( $access_token );
        if ( ! empty( $access_token_secret ) ) $access_token_secret = trim( $access_token_secret );

        if ( empty( $consumer_key ) || empty( $consumer_secret ) || empty( $access_token ) || empty( $access_token_secret ) )
            return;

        /* Cache */
        $cache = dirname( __FILE__ ) .'/cache/twitter.txt';
        if ( time() - filemtime( $cache ) > $cachetime ) {
            /* Require Twitter OAuth class */
            if ( ! class_exists('TwitterOAuth') )
                require_once 'twitter/twitteroauth.php';

            /* Twitter connection */
            $twitterConnection = new TwitterOAuth(
                $consumer_key,
                $consumer_secret,
                $access_token,
                $access_token_secret
            );

            /* Get tweets */
            $tweets = $twitterConnection->get(
                'statuses/user_timeline', array(
                'screen_name' => $username,
                'count' => $count
            ) );

            file_put_contents( $cache, serialize( $tweets ) );

        } else {
            $tweets = unserialize( file_get_contents( $cache ) );
        }

        /* Show message if errors */
        if ( isset( $tweets->errors ) ) {
        	echo 'No tweets available or bad configuration...';
        	return;
        }

        /* Output */
        if ( $tweets ) {

            echo '<div class="tweets-wrap">';
	        foreach ( $tweets as $tweet ) {
                $retweet        = $tweet->id_str;
                $text           = $this->parseTweet( $tweet->text );
                $screen_name    = $tweet->user->screen_name;
                $time           = date( 'd M Y', strtotime( $tweet->created_at ) );
                if ( $dtime == 'timeago' )
                    $time = $this->twitterTime( $tweet->created_at );

                echo '<div class="tweet-item">';
                echo '<div class="tweet-text">'. $text .'</div>';
                echo '</div>';
	        }

            echo '<div class="authorstamp"><div class="author"><a href="https://twitter.com/'. $screen_name .'/status/'. $retweet .'" target="_blank">'. $screen_name .'</a></div><div class="time">'. $time .'</div></div>';

	        echo '</div>';
	    }

        echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['username']   = strip_tags( $new_instance['username'] );
        $instance['count']      = intval( $new_instance['count'] );
        $instance['consumer_key']      = strip_tags( $new_instance['consumer_key'] );
        $instance['consumer_secret']      = strip_tags( $new_instance['consumer_secret'] );
        $instance['access_token']      = strip_tags( $new_instance['access_token'] );
        $instance['access_token_secret']      = strip_tags( $new_instance['access_token_secret'] );
        $instance['cachetime']   = strip_tags( $new_instance['cachetime'] );
        $instance['dtime']   = $new_instance['dtime'];

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

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'masterlayer' ); ?></label>
        <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'consumer_key' ) ); ?>"><?php esc_html_e( 'Consumer Key:', 'masterlayer' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'consumer_key' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'consumer_key' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['consumer_key'] ); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'consumer_secret' ) ); ?>"><?php esc_html_e( 'Consumer Secret:', 'masterlayer' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'consumer_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'consumer_secret' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['consumer_secret'] ); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>"><?php esc_html_e( 'Access Token:', 'masterlayer' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['access_token'] ); ?>" />
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'access_token_secret' ) ); ?>"><?php esc_html_e( 'Access Token Secret:', 'masterlayer' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token_secret' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['access_token_secret'] ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'dtime' ) ); ?>"><?php esc_html_e( 'Date Type:', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'dtime' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dtime' ) ); ?>">
                <option value="date" <?php selected( 'date', $instance['dtime'] ); ?>><?php esc_html_e( 'Date', 'masterlayer' ) ?></option>
                <option value="timeago" <?php selected( 'timeago', $instance['dtime'] ); ?>><?php esc_html_e( 'Time Ago', 'masterlayer' ) ?></option>
            </select>
        </p>
        
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'cachetime' ) ); ?>"><?php esc_html_e( 'Time of cache : (in second)', 'masterlayer' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'cachetime' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'cachetime' )); ?>" type="text" value="<?php echo esc_attr( $instance['cachetime'] ); ?>" />
        </p>
    <?php
    }
}
endif;
add_action( 'widgets_init', 'register_agrios_lastest_tweets' );

// Register widget
function register_agrios_lastest_tweets() {
    register_widget( 'Lastest_Tweets' );
}
