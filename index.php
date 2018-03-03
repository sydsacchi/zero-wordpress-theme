<?php get_header(); ?>
<section id="content" role="main">
	<div class="wrapper">
		<div class="homeWrapper">
			<div class="homePosts col-md-6">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="homePic">
					<?php
						if ( has_post_thumbnail()) {    
							echo the_post_thumbnail();
						} else { 
						echo '<img src="' . get_theme_mod('post_placeholder', get_bloginfo('template_url').'/img/placeholder.jpg') . '">'; 
						}
					?>
					

				</div>
				<div class="homeMeta">
					<?php the_date(); ?> - <?php the_author(); ?>
				</div>
				<div class="homePost">
					<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
					<?php the_excerpt('summary'); ?>
				</div>
				<hr>
<?php endwhile; endif; ?>
				
				<?php get_template_part( 'nav', 'below' ); ?>
			</div>
			<div class="homeSidebar col-md-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</section>
<?php get_footer(); ?>