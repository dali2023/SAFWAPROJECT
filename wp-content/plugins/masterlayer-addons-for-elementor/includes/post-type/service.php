<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Register service post type
function mae_register_service_post_type() {
    $service_slug = 'service';

    $labels = array(
        'name'               => esc_html__( 'Services', 'masterlayer' ),
        'singular_name'      => esc_html__( 'Service Item', 'masterlayer' ),
        'add_new'            => esc_html__( 'Add New', 'masterlayer' ),
        'add_new_item'       => esc_html__( 'Add New Item', 'masterlayer' ),
        'new_item'           => esc_html__( 'New Item', 'masterlayer' ),
        'edit_item'          => esc_html__( 'Edit Item', 'masterlayer' ),
        'view_item'          => esc_html__( 'View Item', 'masterlayer' ),
        'all_items'          => esc_html__( 'All Items', 'masterlayer' ),
        'search_items'       => esc_html__( 'Search Items', 'masterlayer' ),
        'parent_item_colon'  => esc_html__( 'Parent Items:', 'masterlayer' ),
        'not_found'          => esc_html__( 'No items found.', 'masterlayer' ),
        'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'masterlayer' )
    );

    $permalinks = get_option('mae_service_permalink_settings');
    if(!$permalinks) $permalinks = array(); 

    $permalinks['service_permalink_base'] = empty($permalinks['service_permalink_base']) ? __('service', 'masterlayer') : $permalinks['service_permalink_base'];

    $args = array(
        'labels'            => $labels,
        'rewrite'           => array('slug'=>_x($permalinks['service_permalink_base'],'URL slug','masterlayer'), 'with_front'=>true),
        'supports'          => array( 'title', 'editor', 'thumbnail' ),
        'public'            => true,
        'menu_icon'         => 'dashicons-tag',
        'show_ui'           => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'query_var'         => true,
        'show_in_nav_menus' => true
    );

    register_post_type( 'service', $args );
}

add_action('init', 'mae_register_service_post_type');

// Service update messages.
function mae_service_updated_messages( $messages ) {
    $post             = get_post();
    $post_type        = get_post_type( $post );
    $post_type_object = get_post_type_object( $post_type );

    $messages['service'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => esc_html__( 'Service updated.', 'masterlayer' ),
        2  => esc_html__( 'Custom field updated.', 'masterlayer' ),
        3  => esc_html__( 'Custom field deleted.', 'masterlayer' ),
        4  => esc_html__( 'Service updated.', 'masterlayer' ),
        5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Service restored to revision from %s', 'masterlayer' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => esc_html__( 'Service published.', 'masterlayer' ),
        7  => esc_html__( 'Service saved.', 'masterlayer' ),
        8  => esc_html__( 'Service submitted.', 'masterlayer' ),
        9  => sprintf(
            esc_html__( 'Service scheduled for: <strong>%1$s</strong>.', 'masterlayer' ),
            date_i18n( esc_html__( 'M j, Y @ G:i', 'masterlayer' ), strtotime( $post->post_date ) )
        ),
        10 => esc_html__( 'Service draft updated.', 'masterlayer' )
    );
    return $messages;
}

add_filter( 'post_updated_messages', 'mae_service_updated_messages' );

// Register service taxonomy
function mae_register_service_taxonomy() {
    $cat_slug = 'service_category';

    $labels = array(
        'name'                       => esc_html__( 'Service Categories', 'masterlayer' ),
        'singular_name'              => esc_html__( 'Category', 'masterlayer' ),
        'search_items'               => esc_html__( 'Search Categories', 'masterlayer' ),
        'menu_name'                  => esc_html__( 'Categories', 'masterlayer' ),
        'all_items'                  => esc_html__( 'All Categories', 'masterlayer' ),
        'parent_item'                => esc_html__( 'Parent Category', 'masterlayer' ),
        'parent_item_colon'          => esc_html__( 'Parent Category:', 'masterlayer' ),
        'new_item_name'              => esc_html__( 'New Category Name', 'masterlayer' ),
        'add_new_item'               => esc_html__( 'Add New Category', 'masterlayer' ),
        'edit_item'                  => esc_html__( 'Edit Category', 'masterlayer' ),
        'update_item'                => esc_html__( 'Update Category', 'masterlayer' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'masterlayer' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'masterlayer' ),
        'not_found'                  => esc_html__( 'No Category found.', 'masterlayer' ),
        'menu_name'                  => esc_html__( 'Categories', 'masterlayer' )
    );
    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug'=>$cat_slug ),
        'hierarchical'  => true,
    );
    register_taxonomy( 'service_category', 'service', $args );
}

add_action( 'init', 'mae_register_service_taxonomy' );

// Init Settings
function mae_service_permalink_settings_init() {
    add_settings_section( 'mae-permalink-service',  esc_html__( 'Service permalinks', 'masterlayer' ), 'mae_service_permalink_settings', 'permalink' );
}
add_action( 'admin_init', 'mae_service_permalink_settings_init' );

function mae_service_permalink_settings( $section ) {
    echo wpautop( __( 'If you like, you may enter custom structures for your service URLs here. For example, using <code>service</code> would make your product links like <code>' . esc_url(get_home_url()) .'/service/sample-service/</code>. This setting affects service URLs only, not things such as service categories.', 'masterlayer' ));

    $permalinks = get_option('mae_service_permalink_settings');
    if(!$permalinks) $permalinks = array();
    $permalinks['service_permalink_base'] = empty($permalinks['service_permalink_base']) ? __('service', 'masterlayer') : $permalinks['service_permalink_base'];
    ?>

    <table class="form-table">
        <tbody>
        <tr>
            <th><?php echo __('Custom Base', 'masterlayer'); ?></th>
            <td>
                <?php $option_id = 'service_permalink_base'; ?>
                <input name="<?php echo $option_id; ?>" id="<?php echo $option_id; ?>" type="text" value="<?php echo esc_attr($permalinks[$option_id]); ?>" class="regular-text code"> <span class="description"><?php _e( 'Enter a custom base to use. A base must be set or WordPress will use default instead.', 'masterlayer' ); ?></span>
            </td>
        </tr>
        </tbody>
    </table>
    
    <?php
}

// Save Settings
function mae_service_permalink_settings_save() {
    if (defined('DOING_AJAX') && DOING_AJAX) return;

    $permalinks = get_option('mae_service_permalink_settings');
    if(!$permalinks) $permalinks = array();

    if(isset($_POST['service_permalink_base'])) {
        $permalinks['service_permalink_base'] = untrailingslashit(esc_html($_POST['service_permalink_base']));
    }

    update_option('mae_service_permalink_settings', $permalinks);
}   
add_action('admin_init', 'mae_service_permalink_settings_save');