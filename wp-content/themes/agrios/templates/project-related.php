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

if ( ! is_singular( 'project' ) )
    return;

if ( !agrios_get_mod( 'project_related', false ) )
    return;

global $post;

$terms = get_the_terms( $post->ID, 'project_category' );

// Dont have category
if ( ! $terms ) return;

$related_pre_title = agrios_get_mod( 'related_pre_title', 'EXPLORE PROJECTS' );
$related_title = agrios_get_mod( 'related_title', 'OUR RECENT PROJECTS' );
$project_related_query = agrios_get_mod( 'project_related_query', 7 );
$project_related_column = agrios_get_mod( 'project_related_column', 3 );

$args = array(
    'post_type' => 'project',
    'show_post' => intval( $project_related_query ),
    'post__not_in' => array( $post->ID ),
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'project_category',
            'field'    => 'slug',
            'terms'    => $terms[0]->slug
        ),
    ),
);

$query = new WP_Query( $args );

if ( ! $query->have_posts() ) return; 

wp_enqueue_script( 'flickity' );
?>
<div class="related-projects">
    <div class="heading-wrap">
        <?php
        if ( $related_pre_title ) echo '<div class="pre-title"><span class="line"><span class="inner"></span></span>' . esc_attr( $related_pre_title ) . '</div>';
        if ( $related_title ) echo '<h2 class="title">' . esc_attr( $related_title ) . '</h2>';
        ?>
    </div>

    <div class="projects" data-column="<?php echo esc_attr($project_related_column); ?>">
        <?php if ( $query->have_posts() ) : ?>
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    $cats = '';
                    // Category
                    $terms = get_the_terms( get_the_ID() , 'project_category' );

                ?>
                <div class="master-project style-2">
                    <a class="thumb" href="<?php echo esc_url(get_the_permalink()); ?>">
                        <span class="inner">
                            <?php echo get_the_post_thumbnail( get_the_ID(), 'mae-std2' ); ?>  
                        </span>
                    </a>

                    <div class="content-wrap">
                        <?php 
                        if ($terms) { ?>
                            <div class="cat-wrap">
                            <?php if (array_key_exists(0, $terms)) { ?>
                                <a class="cat-item" href="<?php echo esc_url( get_term_link( $terms[0]->slug, 'project_category' ) ); ?> "> 
                                    <?php echo esc_html( $terms[0]->name); ?> </a>
                            <?php } ?>    
                                    
                            <?php if (array_key_exists(1, $terms)) { ?> 
                                <span class="cat-sep">/</span><a class="cat-item" href="<?php 
                                    echo esc_url( get_term_link( $terms[1]->slug, 'project_category' ) ); ?> ">
                                    <?php echo esc_html( $terms[1]->name); ?> </a>
                            <?php } ?>
                            </div>
                        <?php } ?>

                        <h3 class="headline-2">
                            <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>    

                        <a aria-label="button" class="arrow" href="<?php echo esc_url(get_the_permalink()); ?>">
                            <i aria-hidden="true" class="ci ci-arrow-pointing-to-right"></i>        
                        </a>
                    </div>        
                </div>
            <?php endwhile; ?>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div><!-- /.related-projects -->
