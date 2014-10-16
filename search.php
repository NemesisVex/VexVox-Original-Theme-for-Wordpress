<?php
/**
 * The template for displaying Search Results pages
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

			<header class="">
				<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'vexvox' ), get_search_query() ); ?></h2>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : // Start the Loop. ?>
				<?php the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php VexVox_Template_Tags::paging_nav(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); // If no content, include the "No posts found" template. ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer();
