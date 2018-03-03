<?php get_header(); ?>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( has_post_thumbnail()) {    
			echo '<div class="mainWrapper col-lg-12" style="background-image:url(' . get_the_post_thumbnail_url() . ');">';
		} else { 
		echo '<div class="mainWrapper col-lg-12" style="background-size:cover!important;background:url(' . get_theme_mod('post_placeholder', get_bloginfo('template_url').'/img/placeholder.jpg') . ') no-repeat center center;">'; 
		}
	?>

		<div class="darken"></div>

		<header class="header">
			<div class="title-description">
				<h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
				<footer class="byline">
					<?php edit_post_link(); ?>
					<span class="author vcard"><?php the_author_posts_link(); ?></span>
				</footer>
			</div>
		</header>
	</div>
	<div class="wrapper">
		<div class="mainContentWrapper">
			<div class="mainContent col-lg-6">
				<section class="entry-content">
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
					<?php the_content(); ?>
					<div class="entry-links"><?php wp_link_pages(); ?></div>
				</section>
			</div>
			<div class="asideContent col-lg-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</article>
<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>