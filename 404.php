<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.0
 */
?>
<?php get_header(); ?>
<header class="page-header">
	<h2 class="page-title"><?php _e( 'Not Found', 'vexvox' ); ?></h2>
</header>

<p>
	<?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'vexvox' ); ?>
</p>

<p>
	<?php get_search_form(); ?>
</p>

<?php get_sidebar(); ?>
<?php get_footer();
