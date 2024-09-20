<?php
/*
Widget Name: Comments
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

class MAE_Post_Comment_Widget extends Widget_Base{

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-post-comment';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'MAE - Post Comments', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-comments';
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

		if ( get_post_type() == 'elementor_library' ) { ?>
            <div id="comments" class="comments-area">
                <h2 class="comments-title">1 Comment </h2>

                <ol class="comment-list">          
                    <li class="comment even thread-even depth-1" id="li-comment-1">
                        <article id="comment-1" class="comment-wrap clearfix">
                            <div class="gravatar"><img alt="" src="http://1.gravatar.com/avatar/d7a973c7dab26985da5f961be7b74480?s=160&amp;d=mm&amp;r=g" srcset="http://1.gravatar.com/avatar/d7a973c7dab26985da5f961be7b74480?s=320&amp;d=mm&amp;r=g 2x" class="avatar avatar-160 photo" height="160" width="160" loading="lazy"></div>            <div class="comment-content">
                                <div class="comment-meta">
                                    <h6 class="comment-author"><a href="https://wordpress.org/" rel="external nofollow ugc" class="url">A WordPress Commenter</a></h6>
                                    <a class="comment-edit-link" href="http://localhost/agrios/wp-admin/comment.php?action=editcomment&amp;c=1">Edit</a>                    <div class="comment-time">June 10, 2022</div>
                                </div>
                                <div class="comment-text">
                                    <p>Hi, this is a comment.<br>
                    To get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.<br>
                    Commenter avatars come from <a href="https://en.gravatar.com/">Gravatar</a>.</p>
                                                    </div>
                                <div class="comment-reply">
                                    <a rel="nofollow" class="comment-reply-link" href="http://localhost/agrios/hello-world/?replytocom=1#respond" data-commentid="1" data-postid="1" data-belowelement="comment-1" data-respondelement="respond" data-replyto="Reply to A WordPress Commenter" aria-label="Reply to A WordPress Commenter">Reply</a>                </div>
                            </div>
                        </article>
                    </li><!-- #comment-## -->
                </ol><!-- /.comment-list -->

                
                    
                <div id="respond" class="comment-respond">
                <h3 id="reply-title" class="comment-reply-title">Leave a Comment <small><a rel="nofollow" id="cancel-comment-reply-link" href="/agrios/hello-world/#respond" style="display:none;">Cancel reply</a></small></h3><form action="http://localhost/agrios/wp-comments-post.php" method="post" id="commentform" class="custom-form" novalidate=""><p class="logged-in-as"><a href="http://localhost/agrios/wp-admin/profile.php" aria-label="Logged in as admin. Edit your profile.">Logged in as admin</a>. <a href="http://localhost/agrios/wp-login.php?action=logout&amp;redirect_to=http%3A%2F%2Flocalhost%2Fagrios%2Fhello-world%2F&amp;_wpnonce=962a66a835">Log out?</a> <span class="required-field-message" aria-hidden="true">Required fields are marked <span class="required" aria-hidden="true">*</span></span></p><fieldset class="message-wrap">
                                                    <textarea id="comment-message" name="comment" rows="8" tabindex="4" placeholder="Write Comment"></textarea>
                                                </fieldset><p class="form-submit"><input name="submit" type="submit" id="comment-reply" class="submit" value="Post Comment"> <input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID">
                <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                </p><input type="hidden" id="_wp_unfiltered_html_comment_disabled" name="_wp_unfiltered_html_comment" value="ce5d94a06d"></form> </div><!-- #respond -->
            <!-- // if comments_open(). -->
            </div>

		<?php } else {
            comments_template();
        }
	}
}

