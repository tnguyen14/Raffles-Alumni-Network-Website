<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<aside id="subscribe-widget" class="widget">
			<h3 class="widget-title">Stay updated with us!</h3>
			<div>
				<a class="button" href="http://eepurl.com/qDNpH" target="_blank"><i class="icon-envelope-alt icon-large"></i> Subscribe to our mailing list!</a>
			</div>
		</aside>
	
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		
	<?php endif; ?>
	
	</div><!-- #secondary -->