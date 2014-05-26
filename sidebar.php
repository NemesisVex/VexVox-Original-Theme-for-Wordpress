<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.0
 */
?>
				</div>

				<aside id="frame-2" class="col-md-4">
					<?php /*if ( has_nav_menu( 'secondary' ) ) : ?>
					<nav role="navigation" class="navigation site-navigation secondary-navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
					</nav>
					<?php endif;*/ ?>

					<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</div><!-- #primary-sidebar -->
					<?php endif; ?>

					<?php 
						get_sidebar( 'content' );
						get_sidebar();
					?>
				</aside><!-- #secondary -->
