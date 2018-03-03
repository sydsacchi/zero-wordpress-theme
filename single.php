<?php get_header(); ?>

<section id="content" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'entry' ); ?>
	<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
	<?php endwhile; endif; ?>
</section>

<div class="prefooter">
	<div class="wrapper">

<?php 
	$orig_post = $post;
	global $post;
	$categories = get_the_category($post->ID);
	if ($categories) {
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> 4, // Number of related posts that will be shown.
			'caller_get_posts'=>1
		);
		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {
			echo '<div id="relatedposts"><h3>' , _e( "Related posts on ", "zero" ) , the_category ( ' ' ) , '</h3>';
			while( $my_query->have_posts() ) {
		$my_query->the_post();?>

		<div class="relatedcontent">
			<a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<?php the_time('M j, Y') ?> <?php the_excerpt(); ?>
		</div>

	<?php
			}
		echo '</div>';
		}
	}
	
	$post = $orig_post;
	wp_reset_query(); ?>

	</div>
</div>
<?php get_footer(); ?>