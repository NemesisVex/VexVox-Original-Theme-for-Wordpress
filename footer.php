<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage VexVox
 * @since VexVox 1.0
 */
?>

		</div><!-- #main -->

		<footer id="colophon" class="site-footer span-24 prepend-top" role="contentinfo">

			<?php get_sidebar( 'footer' ); ?>

			<div class="site-info">
				<?php do_action( 'vexvox_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'vexvox' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'vexvox' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>