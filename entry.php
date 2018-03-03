<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( has_post_thumbnail()) {
			echo '<div class="mainWrapper" style="background-image:url(' . get_the_post_thumbnail_url() . ');">';
		} else {
			echo '<div class="mainWrapper" style="background-size:cover!important;background:url(' . get_theme_mod('post_placeholder', get_bloginfo('template_url').'/img/placeholder.jpg') . ') no-repeat center center;">';
		}
	?>	
		<div class="darken"></div>
		<header>
			<?php if ( !is_search() ) get_template_part( 'entry', 'meta' ); ?>
			<div class="title-description">
				<?php if ( is_singular() ) {
					echo '<h1 class="entry-title">';
					} else {
						echo '<h2 class="entry-title">'
				?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">				
				<?php } ?>
				
				<?php the_title(); ?>
				
				<?php if ( is_singular() ) { 
					echo '</h1>'; 
				} else { 
					echo '</a></h2>'; 
				} 
				?>				
				
				<footer class="byline">
					<?php edit_post_link(); ?>
					<span class="author vcard"><?php the_author_posts_link(); ?></span>
				</footer>
			</div>
			<?php if ( is_singular() ) { ?>
				<div class="scrolled">
					<div class="wrapper">
						<h2><?php the_title(); ?></h2>
						<div class="scrolledSocial"><?php echo do_shortcode('[shareIcons]'); ?></div>
					</div>
				</div>
			<?php } else { } ?>
		</header>
	</div>	
	
	<div class="wrapper">
		<div class="mainContentWrapper">
			<div class="mainContent col-lg-6 col-md-8">
				<?php get_template_part( 'entry', ( is_archive() || is_search() || is_home() ? 'summary' : 'content' ) ); ?>
				<?php if ( !is_search() ) get_template_part( 'entry-footer' ); ?>
			</div>
			<?php if ( is_singular() ) { ?>
				<div class="asideContent col-lg-3 col-md-4">
					<?php get_sidebar(); ?>
				</div>
			<?php } else { } ?>
		</div>
	</div>	
</article>