<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area row">
		<div id="content" class="site-content col-md-12" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="">
				<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'vexvox' ), get_search_query() ); ?></h2>
			</header><!-- .page-header -->

				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next post navigation.
					vexvox_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'vexvox' );
get_footer();
