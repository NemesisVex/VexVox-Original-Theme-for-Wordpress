<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.0
 */

namespace VigilantMedia\WordPress\Themes\VexVox;
?>
				</div>

				<aside id="frame-2" class="col-md-4">
					<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
					<?php endif; ?>
				</aside><!-- #secondary -->
