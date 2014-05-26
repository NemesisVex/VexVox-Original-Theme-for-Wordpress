<?php
/**
 * Custom template tags for Twenty Fourteen
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.0
 */

if ( ! function_exists( 'vexvox_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since VexVox 1.0
 */
function vexvox_paging_nav() {
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
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&laquo; Previous', 'vexvox' ),
		'next_text' => __( 'Next &raquo;', 'vexvox' ),
		'type' => 'list',
		'list_class' => 'pagination',
	) );

	if ( $links ) :

	?>
	<div class="row">
		<nav class="navigation paging-navigation col-md-12" role="navigation">
			<h4 class="screen-reader-text sr-only"><?php _e( 'Posts navigation', 'vexvox' ); ?></h4>
			<p class="loop-pagination centered">
			<?php echo $links; ?>
			</p><!-- .pagination -->
		</nav><!-- .navigation -->
	</div>
	<?php
	endif;
}
endif;

if ( ! function_exists( 'vexvox_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since VexVox 1.0
 */
function vexvox_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation entry-nav col-md-12" role="navigation">
		<h4 class="screen-reader-text sr-only"><?php _e( 'Post navigation', 'vexvox' ); ?></h4>
		<div class="nav-links entry-nav">
			<ul class="pager">
			<?php if ( is_attachment() ) : ?>
				<li><?php previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'vexovx' ) ); ?></li>
			<?php else : ?>
				<li class="previous"><?php previous_post_link( '%link', __( '<span class="meta-nav" title="Previous Post: %title">Previous</span>', 'vexvox' ) ); ?></li>
				<li class="next"><?php next_post_link( '%link', __( '<span class="meta-nav" title="Next Post: %title">Next</span>', 'vexvox' ) ); ?></li>
			<?php endif; ?>
			</ul>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'vexvox_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since VexVox 1.0
 */
function vexvox_posted_on() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '' . __( 'Sticky', 'vexvox' ) . '';
	}

	// Set up and print post meta information.
		printf( '<ul class="meta"><li><em>By <a class="url fn n" href="%1$s" rel="author">%2$s</a></em></li><li><time class="entry-date" datetime="%3$s">%4$s</time></li></ul>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author(),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}
endif;

/**
 * Find out if blog has more than one category.
 *
 * @since VexVox 1.0
 *
 * @return boolean true if blog has more than 1 category
 */
function vexvox_categorized_blog() {
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

/**
 * Flush out the transients used in vexvox_categorized_blog.
 *
 * @since VexVox 1.0
 */
function vexvox_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'vexvox_category_count' );
}
add_action( 'edit_category', 'vexvox_category_transient_flusher' );
add_action( 'save_post',     'vexvox_category_transient_flusher' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since VexVox 1.0
 */
function vexvox_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'vexvox-full-width' );
		} else {
			the_post_thumbnail();
		}
	?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php
		if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'page-templates/full-width.php' ) ) ) {
			the_post_thumbnail( 'vexvox-full-width' );
		} else {
			the_post_thumbnail();
		}
	?>
	</a>

	<?php endif; // End is_singular()
}
