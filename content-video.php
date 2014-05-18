<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="span-14 append-bottom">
		<header>
			<div class="span-14 last source-label">
				<div class="span-13">
				<?php
				if ( is_single() ) :
					the_title( '<h3 class="source-title">', '</h3>' );
				else :
					the_title( '<h3 class="source-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				endif;
				?>
			</div>
				<div class="span-1 last">
					<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>" title="<?php echo get_post_format_string( 'video' ); ?>"><span class="genericon genericon-video" /></a>
				</div>
			</div>
			<div class="span-4">
			<?php vexvox_posted_on(); ?>
				
				<ul class="meta">
			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<li><?php comments_popup_link( __( 'Leave a comment', 'vexvox' ), __( '1 Comment', 'vexvox' ), __( '% Comments', 'vexvox' ) ); ?>
			<?php endif; ?></li>
					<li><?php edit_post_link( __( 'Edit', 'vexvox' ), '', '' ); ?></li>
				</ul>
			</div>
		</header>
		<div class="span-10 prepend-top last">
			<?php if ( is_search() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php else : ?>
			<div class="entry-content">
				<?php
					the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'vexvox' ) );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'vexvox' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php endif; ?>

			<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' ); ?>

		</div>
	</div>
</article><!-- #post-## -->
