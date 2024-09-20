<?php
/**
 * Footer Widgets
 *
 * @package agrios
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer or Metabox
if ( ! agrios_get_mod( 'footer_widgets', true ) )
	return false;

// Get defaults from Customizer
$columns = agrios_get_mod( 'footer_columns', '4' );
$gutter = agrios_get_mod( 'footer_column_gutter', '30' );

// Get options
$cls_grid = ' gutter-'. $gutter;
$grid_cls1 = $grid_cls2 = $grid_cls3 = $grid_cls4 = $grid_cls5 = 'span_1_of_'. $columns;

// Show sidebars if them are active
if ( is_active_sidebar( 'sidebar-footer-1' )
	|| is_active_sidebar( 'sidebar-footer-2' )
	|| is_active_sidebar( 'sidebar-footer-3' )
	|| is_active_sidebar( 'sidebar-footer-4' )
) :

?>
		
<footer id="footer" style="<?php echo agrios_footer_bg(); ?>">	
	<div id="footer-widgets" class="agrios-container">
		<div class="footer-grid <?php echo esc_attr( $cls_grid ); ?>">
			<?php
			// Footer widget 1 ?>
			<div class="<?php echo esc_attr( $grid_cls1 ); ?> col">
				<?php if ( is_active_sidebar( 'sidebar-footer-1' ) ) dynamic_sidebar( 'sidebar-footer-1' ); ?>
			</div>

			<?php
			// Footer widget 2
			if ( $columns > '1' ) : ?>
				<div class="<?php echo esc_attr( $grid_cls2 ); ?> col">
					<?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) dynamic_sidebar( 'sidebar-footer-2' ); ?>
				</div>
			<?php endif; ?>
			
			<?php
			// Footer widget 3
			if ( $columns > '2' ) : ?>
				<div class="<?php echo esc_attr( $grid_cls3 ); ?> col">
					<?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) dynamic_sidebar( 'sidebar-footer-3' ); ?>
				</div>
			<?php endif; ?>

			<?php
			// Footer widget 4
			if ( $columns > '3' && $columns != '5' ) : ?>
				<div class="<?php echo esc_attr( $grid_cls4 ); ?> col">
					<?php if ( is_active_sidebar( 'sidebar-footer-4' ) ) dynamic_sidebar( 'sidebar-footer-4' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</footer>
<?php endif; ?>