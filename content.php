<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.0
 */

namespace VigilantMedia\WordPress\Themes\VexVox;
?>
						<div class="row">
							<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12'); ?>>
								<header class="source-label">
								<?php if ( is_single() ) : ?>
									<?php the_title( '<h3 class="source-title">', '</h3>' ); ?>
								<?php else : ?>
									<?php the_title( '<h3 class="source-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
								<?php endif; ?>
								</header>

								<div class="row">
									<div class="col-md-4">
									<?php if ('post' == get_post_type()): ?>
										<?php TemplateTags::posted_on(); ?>
									<?php endif; ?>

									<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && TemplateTags::categorized_blog() ) : ?>
										<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', WP_TEXT_DOMAIN ) ); ?></span>
									<?php endif; ?>

										<ul class="meta">
										<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
											<li><?php comments_popup_link( __( 'Leave a comment', WP_TEXT_DOMAIN ), __( '1 Comment', WP_TEXT_DOMAIN ), __( '% Comments', WP_TEXT_DOMAIN ) ); ?>
										<?php endif; ?></li>
											<li><?php edit_post_link( __( 'Edit', WP_TEXT_DOMAIN ), '', '' ); ?></li>
										</ul>
									</div>
									<div class="col-md-8 article-body">
									<?php if ( is_search() ) : ?>
										<div class="entry-summary">
										<?php the_excerpt(); ?>
										</div><!-- .entry-summary -->
									<?php else : ?>
										<div class="entry-content">
										<?php
											the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', WP_TEXT_DOMAIN ) );
											wp_link_pages( array(
												'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', WP_TEXT_DOMAIN ) . '</span>',
												'after'       => '</div>',
												'link_before' => '<span>',
												'link_after'  => '</span>',
											) );
										?>
										</div><!-- .entry-content -->
									<?php endif; ?>

									</div>
								</div>
							</article><!-- #post-## -->
						</div>
