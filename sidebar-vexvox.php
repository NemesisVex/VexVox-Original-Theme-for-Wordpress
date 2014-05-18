				</div><!--vexvox-main-->
			</div><!--vexvox-frame-1-->

			<div id="frame-2" class="span-8 prepend-top last">

				<h3>About this weblog</h3>

				<p>First, there was 「日々の本」, an online journal I kept for 10 years. Six months after I retired that site, I felt the urge to start keeping a journal again. So I signed up for a Vox account. Then Vox shut down in 2010. I moved those entries back here.</p>

				<p>Notice I don't call it a weblog. This site is a journal in the traditional sense.</p>

				<nav>
					<ul>
						<li> <a href="/index.php/gb/contact/">Contact</a></li>
						<li> <a href="/">Gregbueno.com</a></li>
					</ul>
				</nav>

				<hr />

				<h3>Search</h3>
				
				<?php get_search_form() ?>
				
				<hr>

				<h3>Calendar</h3>
				
				<ul>
				<?php wp_get_archives( array( 'type' => 'yearly' ) ); ?>
				</ul>


				<hr />

				<?php the_widget('WP_Widget_Meta', array( 'title' => __( 'Meta' )), array('before_title' => '<h3>', 'after_title' => '</h3>') ); ?>