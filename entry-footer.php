<?php if ( is_singular() ) { ?>	
	<div class="author-box clearfix">
		<h3><?php _e( "About author ", "zero" ); ?></h3>
		<div class="author-avatar">
			<div class="author-description">
			
				<div class="author-image"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '100') ; ?></div>
				<span><strong><?php the_author_meta( 'user_firstname'); ?> <?php the_author_meta( 'user_lastname'); ?> <em>(<?php the_author_meta( 'display_name'); ?>)</em></strong><br>
				<?php the_author_meta( 'description'); ?></span>
			</div>
		</div>
	</div>
<?php } else { } ?>