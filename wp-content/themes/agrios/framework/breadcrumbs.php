<?php
/**
 * Breadcrumbs
 *
 * @package agrios
 * @version 3.8.9
 */

function agrios_breadcrumbs() {

    global $post;

    $home_text     = esc_html__( 'Home','agrios' );
    $category_text = esc_html__( 'Archive by Category "%s"','agrios' );
    $tax_text      = esc_html__( 'Archive by "%s"','agrios' );
    $tag_text      = esc_html__( 'Posts Tagged "%s"','agrios' );
    $author_text   = esc_html__( 'Articles Posted by %s','agrios' );
    $error_text    = esc_html__( 'Error 404','agrios');
    $search_text   = esc_html__( 'Search Results for "%s" Query','agrios' );

    $blog_text     = esc_html__( 'Blog','agrios' );
    $project_text  = esc_html__( 'Projects','agrios' );
    $service_text  = esc_html__( 'Services','agrios' );
    $product_text  = esc_html__( 'Shop','agrios' );

    $home_link = esc_url( home_url('/') );
    $blog_link = esc_url( get_post_type_archive_link( 'post' ) );

    if ( is_home() && is_front_page() ) {
        // Post is frontpage
        echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';
        echo '<span class="home">'. $blog_text .'</span>';
    } elseif ( is_home() && !is_front_page() ) {
        // Post is separate page
        echo '<a  class="home" href="'. $home_link .'">'. $home_text .'</a>';
        echo '<span>'. $blog_text . '</span>';
    } elseif ( is_front_page() && !is_home() ) {
        // Front page and not post page
        echo '<span class="home">'. $home_text .'</span>';
    } else {

        /* Page */
        if ( is_page() ) {
            echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';

            if ( $post->post_parent ) {
                $this_parents = get_post_ancestors( $post->ID );

                foreach ( array_reverse( $this_parents ) as $parent_ID ) {
                    echo '<a href="'. esc_url( get_page_link( $parent_ID, false, false ) ) .'">'. esc_html( get_the_title( $parent_ID ) ) .'</a>';
                }

                echo '<span>'. esc_html( get_the_title() ) .'</span>';
            } else {
                echo '<span>'. esc_html( get_the_title() ) .'</span>';
            }
        }

        /* Single Post */
        if ( is_singular( 'post' ) ) {

            $this_cats         = get_the_category();
            $first_cat         = $this_cats[0];
            $first_cat_link    = get_category_link( $first_cat->cat_ID );
        
            echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';

            if ( $first_cat->parent )
                echo esc_html( get_category_parents( $first_cat->parent, true, '' ) );

            echo '<span>'. esc_html( get_the_title() ) .'</span>';
        }

        /* Category / Tag / Taxonomy */
        if ( is_category() ) {

            $this_cat = get_category( get_query_var( 'cat' ), false );

            echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';
            echo '<a href="'. $blog_link .'">'. $blog_text .'</a>';

            if ( $this_cat->parent != 0 ) {
                echo get_category_parents( $this_cat->parent, true, '' );
                echo '<span>'. sprintf( $category_text, esc_html( single_cat_title( '', false ) ) ) .'</span>';
            } else {
                echo '<span>'. sprintf( $category_text, esc_html( single_cat_title( '', false ) ) ) .'</span>';
            }
        }

        if ( is_tag() ) {
            echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';
            echo '<a href="'. $blog_link .'">'. $blog_text .'</a>';
            echo '<span>'. sprintf( $tag_text, esc_html( single_tag_title( '', false ) ) ) .'</span>';
        }

        /* Date */
        if ( is_day() ) {
            echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';
            echo '<a href="'. esc_url( get_year_link( get_the_time( 'Y' ), get_the_time( 'Y' ) ) ) .'">'. esc_html( get_the_time( 'Y' ) ) .'</a>';
            echo '<a href="'. esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) .'">'. esc_html( get_the_time( 'F' ) ) .'</a>';
            echo '<span>'. esc_html( get_the_time( 'd' ) ) .'</span>';
        }

        if ( is_month() ) {
            echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';
            echo '<a href="'. esc_url( get_year_link( get_the_time( 'Y' ),get_the_time( 'Y' ) ) ) .'">'. esc_html( get_the_time( 'Y' ) ) .'</a>';
            echo '<span>'. esc_html( get_the_time( 'F' ) ) .'</span>';
        }

        if ( is_year() ) {
            echo '<a href="'. $home_link . '">'. $home_text .'</a>';
            echo '<span>'. esc_html( get_the_time('Y') ) .'</span>';
        }

        /* Misc */
        if ( is_search() ) {
            echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';
            echo '<span>'. sprintf( $search_text, get_search_query() ) .'</span>';
        }

        if ( is_author() ) {
            global $author;
            $userdata = get_userdata( $author );
            echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';
            echo '<span>'. sprintf( $author_text, esc_html( $userdata->display_name ) ) .'</span>';
        }

        if ( is_404() ) {
            echo '<a href="'. $home_link .'">'. $home_text .'</a>';
            echo '<span>'. $error_text .'</span>';
        }

        /* Custom Post Type */
        $cpt_list = get_post_types( array(
            'public' => true,
            'publicly_queryable' => true,
            '_builtin' => false
        ), 'objects', 'and' );

        if ( is_array( $cpt_list ) ) {
            foreach ( $cpt_list as $cpt ) {

                $cpt_title = $cpt->labels->name;

                switch ( $cpt->name ) {
                    case 'project':
                        $cpt_title = $project_text;
                        break;
                    case 'product':
                        $cpt_title = $product_text;
                        break;
                }

                /* Archive */
                if ( is_post_type_archive( $cpt->name ) ) {
                    echo '<a href="'. $home_link .'">'. $home_text .'</a>';
                    echo '<span>'. esc_html( $cpt_title ) .'</span>';
                }

                /* Taxonomy */
                $cpt_taxonomies = get_object_taxonomies( $cpt->name );
                if ( is_array( $cpt_taxonomies ) ) {
                    foreach ( $cpt_taxonomies as $cpt_tax ) {
                        if ( is_tax( $cpt_tax ) ) {

                            $this_tax    = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
                            $this_parents = get_ancestors( $this_tax->term_id, get_query_var('taxonomy') );

                            echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';

                            if ( is_array( $this_parents ) ) {
                                foreach ( array_reverse( $this_parents ) as $this_parent_ID ) {
                                    $this_parent = get_term( $this_parent_ID, get_query_var('taxonomy') );
                                    echo '<a href="'. get_term_link( $this_parent->slug, get_query_var('taxonomy') ) .'">'. $this_parent->name .'</a>';
                                }
                                echo '<span>'. sprintf( $tax_text, esc_html( single_cat_title( '', false ) ) ) .'</span>';
                            } else {
                                echo '<span>'. sprintf( $tax_text, esc_html( single_cat_title( '', false ) ) ) .'</span>';
                            }
                        }
                    }
                } else {
                    if ( is_tax() ) {
                        echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';
                        echo '<span>'. sprintf( $tax_text, esc_html( single_cat_title( '', false ) ) ) .'</span>';
                    }
                }

                /* Single Post */
                if ( $cpt->name == 'project' ) {
                    if ( is_singular( 'project' ) ) {

                        echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';

                        if ( $page_id = agrios_parse_obj_id( agrios_get_mod( 'portfolio_page' ), 'page' ) ) {
                            $page_permalink = get_permalink( $page_id );
                            $page_name      = get_the_title( $page_id );
                            if ( $page_permalink && $page_name ) {
                                echo '<a href="'. esc_url( $page_permalink ) .'" title="'. esc_attr( $page_name ) .'">'. esc_html( $page_name ) .'</a>';
                            }
                        }

                        if ( $this_terms = get_the_terms( $post->ID, 'project_category' ) ) {
                            $first_term         = $this_terms[0];
                            $first_term_link    = get_term_link( $first_term->term_id, 'project_category' );

                            echo '<a href="'. esc_url( $first_term_link ) .'">'. esc_html( $first_term->name ) .'</a>';
                        }

                        echo '<span>'. esc_html( get_the_title() ) .'</span>';
                    }
                } elseif ( $cpt->name == 'service' ) {
                    if ( is_singular( 'service' ) ) {

                        echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';

                        if ( $page_id = agrios_parse_obj_id( agrios_get_mod( 'service_page' ), 'page' ) ) {
                            $page_permalink = get_permalink( $page_id );
                            $page_name      = get_the_title( $page_id );
                            if ( $page_permalink && $page_name ) {
                                echo '<a href="'. esc_url( $page_permalink ) .'" title="'. esc_attr( $page_name ) .'">'. esc_html( $page_name ) .'</a>';
                            }
                        }

                        echo '<span>'. esc_html( get_the_title() ) .'</span>';
                    }
                }
                elseif ( $cpt->name == 'product' ) {
                    if ( is_singular( 'product' ) ) {
                        echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';

                        $shop_page_url = get_permalink( get_option( 'woocommerce_shop_page_id' ) );
                        echo '<a href="'. esc_url( $shop_page_url ) .'">'. esc_html( $product_text ) .'</a>';

                        if ( $this_terms = get_the_terms( $post->ID, 'product_cat' ) ) {
                            $first_term         = $this_terms[0];
                            $first_term_link    = get_term_link( $first_term->term_id, 'product_cat' );

                            echo '<a href="'. esc_url( $first_term_link ) .'">'. esc_html( $first_term->name ) .'</a>';
                        }

                        echo '<span>'. esc_html( get_the_title() ) .'</span>';
                    }
                } elseif ( $cpt->name == 'footer' ) {
                    if ( is_singular( 'footer' ) ) {

                        echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';

                        if ( $this_terms = get_the_terms( $post->ID, 'footer_category' ) ) {
                            $first_term         = $this_terms[0];
                            $first_term_link    = get_term_link( $first_term->term_id, 'footer_category' );

                            echo '<a href="'. esc_url( $first_term_link ) .'">'. esc_html( $first_term->name ) .'</a>';
                        }

                        echo '<span>'. esc_html( get_the_title() ) .'</span>';
                    }
                } elseif ( $cpt->name == 'elementor_library' ) {
                    if ( is_singular( 'elementor_library' ) ) {

                        echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';

                        echo '<span>'. esc_html( get_the_title() ) .'</span>';
                    }
                } 
            }
        } else {
            if ( is_tax() ) {
                echo '<a class="home" href="'. $home_link .'">'. $home_text .'</a>';
                echo '<span>'. sprintf( $tax_text, esc_html( single_cat_title( '', false ) ) ) .'</span>';
            }
        }
        
    }
}