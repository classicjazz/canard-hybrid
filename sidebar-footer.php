<?php
declare( strict_types = 1 );

/**
 * The Sidebar containing the footer widget area.
 *
 * @package Canard
 */

if ( is_active_sidebar( 'sidebar-2' ) === false ) {
	return;
}
?>

<div id="tertiary" class="footer-widget" role="complementary">
	<div class="footer-widget-inner">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- div.footer-widget-inner -->
</div><!-- div#tertiary -->
