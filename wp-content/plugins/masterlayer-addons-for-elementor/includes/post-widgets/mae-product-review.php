<?php
/*
Widget Name: Product Review
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use \Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Product_Review_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-product-review';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Product Review', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-star-o';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

	protected function register_controls() {
        $this->start_controls_section(
                'section__image',
                [
                    'label' => __( 'Content', 'masterlayer' ),
                ]
            );

        $this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();

		if ( get_post_type() == 'shopengine-template' ) { ?>
            <?php $img = MAE_URL . '/assets/img/sample-avatar.webp'; ?>
            <div class="woocommerce-page">
                <h2 class="woocommerce-Reviews-title">2 reviews for <span>Grapes</span> (Dummy Review (only for previews))</h2>
                <div id="reviews" class="woocommerce-Reviews">
                    <div id="comments">
                        
                            <ol class="commentlist">
                                <li class="review byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-2">

                                    <div id="comment-2" class="comment_container">

                                        <!-- <img alt="" src="/wp-content/plugins/masterlayer-addons-for-elementor/assets/img/sample-avatar.webp" class="avatar" loading="lazy"> -->
                                        <img alt="" src="<?php echo esc_url($img); ?>" class="avatar" loading="lazy">
                                        <div class="comment-text">

                                            <div class="star-rating" role="img" aria-label="Rated 5 out of 5"><span style="width:100%">Rated <strong class="rating">5</strong> out of 5</span></div>
                                                <p class="meta">
                                                    <strong class="woocommerce-review__author">Kevin Martin </strong>
                                                            <span class="woocommerce-review__dash">–</span> <time class="woocommerce-review__published-date" datetime="2022-07-08T10:02:46+00:00">July 8, 2022</time>
                                                </p>

                                                <div class="description"><p>It has survived not only five centuries, but also the leap into electronic typesetting unchanged. It was popularised in the sheets containing lorem ipsum is simply free text. sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum. Vivaus sed delly molestie sapien.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li><!-- #comment-## -->

                                <li class="review byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-2">

                                    <div id="comment-2" class="comment_container">

                                        <!-- <img alt="" src="/wp-content/plugins/masterlayer-addons-for-elementor/assets/img/sample-avatar.webp" class="avatar" loading="lazy"> -->
                                        <img alt="" src="<?php echo esc_url($img); ?>" class="avatar" loading="lazy">
                                        <div class="comment-text">

                                            <div class="star-rating" role="img" aria-label="Rated 5 out of 5"><span style="width:100%">Rated <strong class="rating">5</strong> out of 5</span></div>
                                                <p class="meta">
                                                    <strong class="woocommerce-review__author">Kevin Martin </strong>
                                                            <span class="woocommerce-review__dash">–</span> <time class="woocommerce-review__published-date" datetime="2022-07-08T10:02:46+00:00">July 8, 2022</time>
                                                </p>

                                                <div class="description"><p>It has survived not only five centuries, but also the leap into electronic typesetting unchanged. It was popularised in the sheets containing lorem ipsum is simply free text. sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum. Vivaus sed delly molestie sapien.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li><!-- #comment-## -->
                            </ol>

                            
                            </div>

                    
                        <div id="review_form_wrapper">
                            <div id="review_form">
                                    <div id="respond" class="comment-respond">
                        <span id="reply-title" class="comment-reply-title">Add a review <small><a rel="nofollow" id="cancel-comment-reply-link" href="/agrios/product/grapes/?shopengine_template_id=2007&amp;preview_nonce=e77dc17138&amp;change_template=1#respond" style="display:none;">Cancel reply</a></small></span><form action="http://localhost/agrios/wp-comments-post.php" method="post" id="commentform" class="comment-form" novalidate=""><p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"> <label for="wp-comment-cookies-consent">Save my name, email, and website in this browser for the next time I comment.</label></p>
                <p class="comment-form-author"><input id="author" name="author" type="text" value="" size="30" aria-required="true" required="" placeholder="Your Name"></p>
                <p class="comment-form-email"><input id="email" name="email" type="email" value="" size="30" aria-required="true" required="" placeholder="Email Address"></p>
                <div class="comment-form-rating"><label for="rating">Your rating</label><p class="stars">                       <span>                          <a class="star-1" href="#">1</a>                            <a class="star-2" href="#">2</a>                            <a class="star-3" href="#">3</a>                            <a class="star-4" href="#">4</a>                            <a class="star-5" href="#">5</a>                        </span>                 </p><select name="rating" id="rating" aria-required="true" required="" style="display: none;">
                                            <option value="">Rate…</option>
                                            <option value="5">Perfect</option>
                                            <option value="4">Good</option>
                                            <option value="3">Average</option>
                                            <option value="2">Not that bad</option>
                                            <option value="1">Very poor</option>
                                        </select></div><p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required="" placeholder="Your Review..."></textarea></p><p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="Submit Review"> <input type="hidden" name="comment_post_ID" value="2004" id="comment_post_ID">
                <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                </p></form> </div><!-- #respond -->
                                </div>
                        </div>

                    
                    <div class="clear"></div>
                </div>
            </div>
		<?php } else { ?>
            <h2 class="woocommerce-Reviews-title">
                <?php
                    global $product;
                    $count = $product->get_review_count();
                    if ( $count && wc_review_ratings_enabled() ) {
                        /* translators: 1: reviews count 2: product name */
                        $reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
                        echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
                    } else {
                        esc_html_e( 'Reviews', 'woocommerce' );
                    }
                ?>
            </h2>
            <?php
            comments_template();
        }
	}
}

