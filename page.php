<?php get_header(); ?>

	<div id="primary" class="content-area container">
	<div class="row">
		<article id="main" class="site-main column column-70" role="main">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<h2><?php the_title();?></h2>	
				<?php the_content();?>	
				
			<?php endwhile; ?>
		</article>
		<?php get_sidebar(); ?>
	</div>
	</div>


<?php get_footer(); ?>
