<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.2
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : // Start the Loop. ?>
		<?php the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); // Include the post format-specific template for the content. If you want to use this in a child theme, then include a file called called content-___.php (where ___ is the post format) and that will be used instead. ?>
		<?php if ( comments_open() || get_comments_number() ) : ?>
			<?php comments_template(); ?>
		<?php endif; ?>
	<?php endwhile; ?>
	<?php VexVox_Template_Tags::post_nav(); // Previous/next post navigation. ?>
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); // If no content, include the "No posts found" template. ?>
<?php endif; ?>
<?php get_sidebar( 'vexvox' ); ?>
<?php get_footer();
