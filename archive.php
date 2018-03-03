<?php get_header(); ?>
<section id="content" role="main">
	<div class="wrapper">
		<div class="homeWrapper">
			<div class="homePosts">
				<header class="header">
					<h1 class="entry-title">
					<?php 
						if ( is_day() ) { printf( __( 'Daily Archives: %s', 'zero' ), get_the_time( get_option( 'date_format' ) ) ); }
						elseif ( is_month() ) { printf( __( 'Monthly Archives: %s', 'zero' ), get_the_time( 'F Y' ) ); }
						elseif ( is_year() ) { printf( __( 'Yearly Archives: %s', 'zero' ), get_the_time( 'Y' ) ); }
						else { _e( 'Archives', 'zero' ); }
					?>
					</h1>
				</header>
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

				<?php endwhile; endif; ?>
			</div>
			<div class="homeSidebar">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<div class="wrapper">
		<div class="mainContentWrapper">
			<div class="mainContent">
				<hr />
				<?php get_template_part( 'nav', 'below' ); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>