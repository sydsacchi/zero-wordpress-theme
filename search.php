<?php get_header(); ?>
<section id="content" role="main">
	<div class="wrapper">
		<div class="homeWrapper">
			<header class="header">
				<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'zero' ), get_search_query() ); ?></h1>
			</header>
			<div class="homePosts col-lg-6">
<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

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
				<hr />
				<?php get_template_part( 'nav', 'below' ); ?>
					<?php endwhile; ?>
			</div>
			<div class="homeSidebar col-lg-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

<?php else : ?>
	
				<header class="header">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'zero' ); ?></h2>
				</header>
				<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'zero' ); ?></p>
				<?php get_search_form(); ?>
			</div>
			<div class="homeSidebar col-lg-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
<?php endif; ?>
</section>

<?php get_footer(); ?>