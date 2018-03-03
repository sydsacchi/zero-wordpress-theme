<?php get_header(); ?>
<section id="content" role="main">
	<div class="wrapper">
		<div class="homeWrapper">
			<header class="header">
				<h1 class="entry-title author"><?php _e( 'Author Archives', 'blankslate' ); ?>: <?php the_author_link(); ?></h1>
			</header>
			<div class="homePosts col-lg-6">
					<?php the_post(); ?>
					<?php if ( '' != get_the_author_meta( 'user_description' ) ) echo apply_filters( 'archive_meta', '<div class="author-image">' . get_avatar( get_the_author_meta('user_email'), $size = '100') . '</div><div class="archive-meta"><p>' . get_the_author_meta( 'user_description' ) . '</p></div>' ); ?>
					<?php rewind_posts(); ?>
					<div class="clearfix"></div>
					<hr />
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
				<hr>
				<?php endwhile; ?>
				<?php get_template_part( 'nav', 'below' ); ?>
			</div>
			<div class="homeSidebar col-lg-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>	
	<div class="clearfix"></div>
</section>
<?php get_footer(); ?>