<?php
/**
 * Entry Content / Related Post
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_single() || ! agrios_get_mod( 'agrios_blog_single_related', false ) )
    return;

if ( ! has_tag() ) { return; }
$tags = wp_get_post_tags( $post->ID );
$first_tag = $tags[0]->term_id;

$query_args = array(
    'tag__in' => array( $first_tag ),
    'post__not_in' => array( $post->ID ),
    'posts_per_page' => -1
);

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) : ?>
    
    <div class="related-news">
        <h3 class="related-title"><?php echo esc_html( agrios_get_mod( 'agrios_blog_single_related_header' ) ); ?></h3>
        
        <div class="related-post">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="post-item">
                <div class="inner">
                    <?php
                    $the_cat = get_the_category();
                    $category_name = $the_cat[0]->cat_name;
                    $category_link = get_category_link( $the_cat[0]->cat_ID );

                    $size = 'agrios-post-widget';
                    $thumb = get_the_post_thumbnail( get_the_ID(), $size );

                    if ( $thumb ) echo '<div class="thumb-wrap"><a href="' . esc_url( get_permalink() ) . '">'. $thumb .'</a></div>';
                    ?>

                    <div class="text-wrap">
                        <div class="post-categories"><?php echo the_category( ', ', get_the_ID() ); ?></div>

                        <h3><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h3>

                        <div class="post-date"><?php echo esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) ); ?></div>
                    </div><!-- .text-wrap -->
                </div>
                </div>
            <?php endwhile; ?>
        </div><!-- /.post-related -->
    </div><!-- /.related-news -->

<?php endif; wp_reset_postdata(); ?>



