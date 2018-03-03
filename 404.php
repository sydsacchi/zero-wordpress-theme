<?php get_header(); ?>
<section id="content" role="main">
	<article id="post-0" class="post not-found">
		<div class="wrapper">
			<div class="mainContentWrapper">				
				<section class="entry-content">
					<div class="mainContent col-lg-6">
						<section class="entry-content">
							<h1 class="entry-title"><?php _e( 'Not Found', 'zero' ); ?></h1>
							<p><?php _e( 'Nothing found for the requested page. Try a search instead?', 'zero' ); ?></p>
						<?php get_search_form(); ?>
						</section>
					</div>
					<div class="asideContent col-lg-3">
						<?php get_sidebar(); ?>
					</div>
				</section>
			</div>
		</div>
	</article>
</section>
<?php get_footer(); ?>
