<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 9:28 PM
 */

namespace VigilantMedia\WordPress\Themes\VexVox;


class TemplateTags {
	public static function get_cdn_uri() {
		return VIGILANTMEDIA_CDN_BASE_URI;
	}

	public static function paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$pagination_args = array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', WP_TEXT_DOMAIN ),
			'next_text' => __( 'Next &rarr;', WP_TEXT_DOMAIN ),
			'type' => 'list',
			'list_class' => 'pagination',
		);
		$links = ( function_exists( 'bootstrap_paginate_links' ) === true ) ? bootstrap_paginate_links( $pagination_args ) : paginate_links( $pagination_args );

		if ( $links ) :

			?>
			<nav role="navigation">
				<h1 class="sr-only"><?php _e( 'Posts navigation', WP_TEXT_DOMAIN ); ?></h1>
				<?php echo $links; ?>
			</nav><!-- .navigation -->
		<?php
		endif;
	}

	public static function post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<nav class="post-navigation" role="navigation">
			<h4 class="sr-only"><?php _e( 'Post navigation', WP_TEXT_DOMAIN ); ?></h4>
			<div class="nav-links entry-nav">
				<p>
					<?php if ( is_attachment() ) : ?>
				<p><?php previous_post_link( '%link', __( '<span title="Published In %title">Published In</span> %title', WP_TEXT_DOMAIN ) ); ?></p>
				<?php else : ?>
					<?php previous_post_link( '%link', __( '<span title="Previous Post: %title">PREVIOUS</span>', WP_TEXT_DOMAIN ) ); ?>
					<?php if ((get_previous_post_link() != "") && (get_next_post_link() != "")): ?>&#149;<?php endif; ?>
					<?php next_post_link( '%link', __( '<span title="Next Post: %title">NEXT</span>', WP_TEXT_DOMAIN ) ); ?>
				<?php endif; ?>
				</p>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
	<?php
	}

	public static function posted_on() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '' . __( 'Sticky', WP_TEXT_DOMAIN ) . '';
		}

		// Set up and print post meta information.
		printf( '<ul class="meta">
	<li>
		<em>By <a class="url fn n" href="%1$s" rel="author">%2$s</a></em>
	</li>
	<li>
		<time class="entry-date" datetime="%3$s">%4$s</time>
	</li>
</ul>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author(),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	}

	public static function categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'vexvox_category_count' ) ) ) {
			// Create an array of all the categories that are attached to posts
			$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

			// Count the number of categories that are attached to the posts
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'vexvox_category_count', $all_the_cool_cats );
		}

		if ( 1 !== (int) $all_the_cool_cats ) {
			// This blog has more than 1 category so vexvox_categorized_blog should return true
			return true;
		} else {
			// This blog has only 1 category so vexvox_categorized_blog should return false
			return false;
		}
	}

}