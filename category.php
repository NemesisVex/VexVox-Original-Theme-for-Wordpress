<?php
/**
 * The template for displaying Category pages
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
				<h2><?php printf( __( 'Category: %s', 'vexvox' ), single_cat_title( '', false ) ); ?></h2>
			</header><!-- .archive-header -->

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

<?php get_sidebar( 'vexvox' ); ?>
<?php get_footer();
