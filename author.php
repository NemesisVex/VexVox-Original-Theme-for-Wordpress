<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.2
 */
?>
<?php get_header(); ?>

	<section id="primary" class="row">
		<div id="content" class="col-md-12" role="main">

		<?php if ( have_posts() ) : ?>

			<header>
				<h2>
					<?php the_post(); // Queue the first post, that way we know what author we're dealing with (if that is the case). We reset this later so we can run the loop properly with a call to rewind_posts(). ?>
					<?php printf( __( 'All posts by %s', 'vexvox' ), get_the_author() ); ?>
				</h2>
			</header><!-- .archive-header -->

			<?php rewind_posts(); // Since we called the_post() above, we need to rewind the loop back to the beginning that way we can run the loop properly, in full. ?>
			<?php while ( have_posts() ) : // Start the Loop. ?>
				<?php the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); // Include the post format-specific template for the content. If you want to use this in a child theme, then include a file called called content-___.php (where ___ is the post format) and that will be used instead. ?>
			<?php endwhile; ?>
			<?php VexVox_Template_Tags::paging_nav(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); // If no content, include the "No posts found" template. ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer();
