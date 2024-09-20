<?php
/**
 * Entry Content / Prev Next Link
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// // Exit if disabled via Customizer
if ( is_single() && ! agrios_get_mod( 'project_prev_next_links', false ) )
	return;

$prev = get_permalink(get_adjacent_post(false,'',false));
$next = get_permalink(get_adjacent_post(false,'',true));
$prev_text = agrios_get_mod('project_prev_text', 'Previous');
$next_text = agrios_get_mod('project_next_text', 'Next');
?>

<div class="nav-links">
	<div class="prev">
		<a href="<?php echo esc_url($prev); ?>"><?php echo esc_html($prev_text); ?></a> 
	</div>

	<div class="next">
		<a href="<?php echo esc_url($next); ?>"><?php echo esc_html($next_text); ?></a> 
	</div>
</div>
