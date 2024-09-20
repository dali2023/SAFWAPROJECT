<?php
class WPRT_recent_news extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'title' 	=> 'Recent Posts', 
            'category'  => [],
            'count'     => 3,
            'thumb_width' => '80px',
            'thumb_style' => 'show',
            'before_date' => 'hide',
            'before_author' => 'hide',
            'before_comment' => 'show',
            'after_date' => 'hide',
            'after_author' => 'hide',
            'after_comment' => 'hide',
            'thumb_right_margin' => '20px',
            'title_size' => '',
            'title_color' => '',
            'border_color' => '',
            'meta_color' => '',
            'title_length' => ''
        );

        parent::__construct(
            'widget_news_post',
            esc_html__( 'Recent Posts Advanced', 'masterlayer' ),
            array(
                'classname'   => 'widget_recent_posts',
                'description' => esc_html__( 'Display recent blog posts.', 'masterlayer' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );

        echo $before_widget;

        if ( ! empty( $title ) ) { echo '<h2 class="widget-title"><span>' . $title . '</span></h2>'; }

        $thumb_width = intval( $thumb_width );
        $thumb_right_margin = intval( $thumb_right_margin );
        $title_size = intval( $title_size );
        $title_length = intval( $title_length );
        $item_css = '';

        if ( ! empty( $border_color ) )
            $item_css .= ';border-color:'. $border_color;

        $icon_css = $thumb_css = '';
        if ( isset( $thumb_width ) ) {
            $thumb_css .= 'width:'. $thumb_width .'px;height:'. $thumb_width .'px;';
            $icon_css .= 'width:'. $thumb_width .'px;height:'. $thumb_width .'px;line-height:'. $thumb_width .'px;';
        }

        if ( isset( $thumb_right_margin ) )
            $thumb_css .= ';margin-right:'. $thumb_right_margin .'px';

        $title_css = '';
        if ( ! empty( $title_size ) )
            $title_css .= 'font-size:'. $title_size .'px';

        if ( ! empty( $title_color ) )
            $title_css .= ';color:'. $title_color;

        $meta_css = '';
        if ( ! empty( $meta_color ) )
            $meta_css .= 'color:'. $meta_color;

        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => intval($count)
        );

        if ( ! empty( $category ) )
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'terms'    => $category,
                ),
            );             
       
        $query = new WP_Query( $query_args ); ?>

        <ul class="recent-news clearfix">
		<?php $i = 0; if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
				<li class="clearfix" style="<?php echo esc_attr( $item_css ); ?>">
                    <?php if ( $thumb_width ) : ?>
                        <a aria-label="<?php echo esc_attr(get_the_title()); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>" class="thumb <?php echo esc_attr( $thumb_style ); ?>" style="<?php echo esc_attr( $thumb_css ); ?>">
                            <?php
                                $size = 'thumbnail';

                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'thumbnail' );
                                } elseif ( get_post_format() == 'gallery' ) {

                                    $images = agrios_elementor( 'gallery_images' );
                                    if ( ! empty( $images ) ) {
                                        echo wp_get_attachment_image( $images[0]['id'], $size);
                                    }
                                }
                            ?>
                        </a>
                    <?php endif;

                    if ( $title_length > 0 ) {
                        $title = wp_trim_words(get_the_title(), $title_length);
                    } else {
                        $title = get_the_title();
                    }
                    
                    echo '<div class="texts">';

                    if ( $before_author == 'show' ) {
                        printf( '<div class="post-meta"><span class="post-by-author item">%4$s <a class="name" href="%1$s" title="%2$s">%3$s</a></span></div>',
                            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                            esc_attr( sprintf( esc_html__( 'View all posts by %s', 'masterlayer' ), get_the_author() ) ),
                            get_the_author(),
                            esc_html__( agrios_get_mod( 'blog_before_author', 'by' ) )
                        );
                    }

                    if ( $before_comment == 'show' ) {
                        if ( comments_open() || get_comments_number() ) {
                            echo '<div class="post-meta"><span class="post-comment item"><span class="inner">';
                            comments_popup_link( esc_html__( '0 comments', 'masterlayer' ), esc_html__( '1 Comment', 'masterlayer' ), esc_html__( '% Comments', 'masterlayer' ) );
                            echo '</span></span></div>';
                        };
                    }

                    if ( $before_date == 'show' ) {
                        printf( '<span class="post-date item"><span class="entry-date">%1$s</span></span>',
                            get_the_date()
                        );
                    }

                    printf( '
                        <h3><a href="%1$s" style="%3$s">%2$s</a></h3>%3$s',
                        esc_url( get_the_permalink() ),
                        $title,
                        esc_attr( $title_css )
                    );

                    if ( $after_author == 'show' ) {
                        printf( '<div class="post-meta"><span class="post-by-author item">%4$s <a class="name" href="%1$s" title="%2$s">%3$s</a></span></div>',
                            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                            esc_attr( sprintf( esc_html__( 'View all posts by %s', 'masterlayer' ), get_the_author() ) ),
                            get_the_author(),
                            esc_html__( agrios_get_mod( 'blog_before_author', 'by' ) )
                        );
                    }

                    if ( $after_comment == 'show' ) {
                        if ( comments_open() || get_comments_number() ) {
                            echo '<div class="post-meta"><span class="post-comment item"><span class="inner">';
                            comments_popup_link( esc_html__( '0 comments', 'masterlayer' ), esc_html__( '1 Comment', 'masterlayer' ), esc_html__( '% Comments', 'masterlayer' ) );
                            echo '</span></span></div>';
                        };
                    }

                    if ( $after_date == 'show' ) {
                        printf( '<span class="post-date item"><span class="entry-date">%1$s</span></span>',
                            get_the_date()
                        );
                    }

                    echo '</div>';

                    ?>
                </li>
			<?php $i++; endwhile; wp_reset_postdata(); ?>
		<?php endif; ?>        
        </ul>
        
		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance                   = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['thumb_width']         = strip_tags( $new_instance['thumb_width'] );
        $instance['thumb_right_margin'] = strip_tags( $new_instance['thumb_right_margin'] );
        $instance['title_size']         = strip_tags( $new_instance['title_size'] );
        $instance['title_color']         = strip_tags( $new_instance['title_color'] );
        $instance['meta_color']         = strip_tags( $new_instance['meta_color'] );
        $instance['border_color']         = strip_tags( $new_instance['border_color'] );
        $instance['category']       = array_filter( $new_instance['category'] );
        $instance['count']          = intval( $new_instance['count'] );
        $instance['title_length']  = intval( $new_instance['title_length'] );
        $instance[ 'thumb_style' ] = $new_instance[ 'thumb_style' ];
        $instance[ 'before_date' ] = $new_instance[ 'before_date' ];
        $instance[ 'before_author' ] = $new_instance[ 'before_author' ];
        $instance[ 'before_comment' ] = $new_instance[ 'before_comment' ];
        $instance[ 'after_date' ] = $new_instance[ 'after_date' ];
        $instance[ 'after_author' ] = $new_instance[ 'after_author' ];
        $instance[ 'after_comment' ] = $new_instance[ 'after_comment' ];

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
            <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'masterlayer' ); ?></label>
            <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select Category:', 'masterlayer' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>[]">
                <option value=""<?php selected( empty( $instance['category'] ) ); ?>><?php esc_html_e( 'All', 'masterlayer' ); ?></option>
                <?php               
                $categories = get_categories();
                
                foreach ( $categories as $category ) {
                    printf(
                        '<option value="%1$s" %4$s>%2$s (%3$s)</option>',
                        esc_attr( $category->term_id ),
                        $category->name,
                        $category->count,
                        ( in_array( $category->term_id, $instance['category'] ) ) ? 'selected="selected"' : '');
                }               

                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_length' ) ); ?>"><?php esc_html_e( 'Title Word Count Length (ex: 4):', 'masterlayer' ); ?></label>
            <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'title_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_length' ) ); ?>" value="<?php echo esc_attr( $instance['title_length'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumb_style' ) ); ?>"><?php esc_html_e( 'Thumbnail', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'thumb_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_style' ) ); ?>">
                <option value="hide" <?php selected( 'hide', $instance['thumb_style'] ); ?>><?php esc_html_e( 'Hide', 'masterlayer' ) ?></option>
                <option value="show" <?php selected( 'show', $instance['thumb_style'] ); ?>><?php esc_html_e( 'Show', 'masterlayer' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'before_date' ) ); ?>"><?php esc_html_e( 'Before Title: Date', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'before_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'before_date' ) ); ?>">
                <option value="hide" <?php selected( 'hide', $instance['before_date'] ); ?>><?php esc_html_e( 'Hide', 'masterlayer' ) ?></option>
                <option value="show" <?php selected( 'show', $instance['before_date'] ); ?>><?php esc_html_e( 'Show', 'masterlayer' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'before_author' ) ); ?>"><?php esc_html_e( 'Before Title: Author', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'before_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'before_author' ) ); ?>">
                <option value="hide" <?php selected( 'hide', $instance['before_author'] ); ?>><?php esc_html_e( 'Hide', 'masterlayer' ) ?></option>
                <option value="show" <?php selected( 'show', $instance['before_author'] ); ?>><?php esc_html_e( 'Show', 'masterlayer' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'before_comment' ) ); ?>"><?php esc_html_e( 'Before Title: Comment', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'before_comment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'before_comment' ) ); ?>">
                <option value="hide" <?php selected( 'hide', $instance['before_comment'] ); ?>><?php esc_html_e( 'Hide', 'masterlayer' ) ?></option>
                <option value="show" <?php selected( 'show', $instance['before_comment'] ); ?>><?php esc_html_e( 'Show', 'masterlayer' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'after_date' ) ); ?>"><?php esc_html_e( 'After Title: Date', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'after_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'after_date' ) ); ?>">
                <option value="hide" <?php selected( 'hide', $instance['after_date'] ); ?>><?php esc_html_e( 'Hide', 'masterlayer' ) ?></option>
                <option value="show" <?php selected( 'show', $instance['after_date'] ); ?>><?php esc_html_e( 'Show', 'masterlayer' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'after_author' ) ); ?>"><?php esc_html_e( 'After Title: Author', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'after_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'after_author' ) ); ?>">
                <option value="hide" <?php selected( 'hide', $instance['after_author'] ); ?>><?php esc_html_e( 'Hide', 'masterlayer' ) ?></option>
                <option value="show" <?php selected( 'show', $instance['after_author'] ); ?>><?php esc_html_e( 'Show', 'masterlayer' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'after_comment' ) ); ?>"><?php esc_html_e( 'After Title: Comment', 'masterlayer' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'after_comment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'after_comment' ) ); ?>">
                <option value="hide" <?php selected( 'hide', $instance['after_comment'] ); ?>><?php esc_html_e( 'Hide', 'masterlayer' ) ?></option>
                <option value="show" <?php selected( 'show', $instance['after_comment'] ); ?>><?php esc_html_e( 'Show', 'masterlayer' ) ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>"><?php esc_html_e('Thumbnail Width:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumb_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_width' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['thumb_width'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'thumb_right_margin' ) ); ?>"><?php esc_html_e('Thumbnail Right Margin:', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'thumb_right_margin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'thumb_right_margin' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['thumb_right_margin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_size' ) ); ?>"><?php esc_html_e('Title Size (ex: 18px):', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_size' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['title_size'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title_color' ) ); ?>"><?php esc_html_e('Title Color (ex: #e3e3e3):', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['title_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'meta_color' ) ); ?>"><?php esc_html_e('Meta Color (ex: #303030):', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'meta_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'meta_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['meta_color'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>"><?php esc_html_e('Border Color (ex: #303030):', 'masterlayer') ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'border_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border_color' ) ); ?>" type="text" size="2" value="<?php echo esc_attr( $instance['border_color'] ); ?>">
        </p>
    <?php
    }
}
add_action( 'widgets_init', 'register_agrios_recent_news' );

// Register widget
function register_agrios_recent_news() {
    register_widget( 'WPRT_recent_news' );
}


