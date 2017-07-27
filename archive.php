<?php get_header(); ?>
	<div id="primary" class="content-area container">
	<div class="row">
		<main id="main" class="site-main column column-75" role="main">
		<?php
		if ( have_posts() ) :

			if ( is_home() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			while ( have_posts() ) : the_post();

				get_template_part( 'parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'parts/content', 'none' );

		endif;  ?>
		</main><!-- #main -->
		<?php get_sidebar(); ?>
		</div>
	</div><!-- #primary -->

<?php

get_footer();