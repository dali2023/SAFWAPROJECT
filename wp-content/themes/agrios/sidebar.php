<?php
// Get layout position
$layout = agrios_layout_position();
if ( $layout == 'no-sidebar' ) return;

$sidebar = 'sidebar-blog';

if ( is_page() ) $sidebar = 'sidebar-page';
if ( is_singular( 'service' ) ) $sidebar = 'sidebar-service';

if ( agrios_is_woocommerce_page() )
	$sidebar = 'sidebar-shop';

if ( is_active_sidebar( $sidebar ) ) {

	?>

	<div id="sidebar">
		<div id="inner-sidebar" class="inner-content-wrap">
			<?php dynamic_sidebar( $sidebar ); ?>
		</div><!-- /#inner-sidebar -->
	</div><!-- /#sidebar -->

	<?php } ?>