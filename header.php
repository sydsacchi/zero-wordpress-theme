<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<meta property="og:title" content="<?php echo get_the_title(); ?>"/>
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php echo get_permalink(); ?>" />
		<meta property="article:author" content="<?php echo get_theme_mod( 'facebook_profile_block'); ?>" />
		<meta property="article:publisher" content="<?php echo get_theme_mod( 'facebook_profile_block'); ?>" />
		<meta property="article:publisher" content="<?php echo get_theme_mod( 'facebook_profile_block'); ?>" />
		
		<?php
		if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $default_image="http://z.sidneysacchi.com/wp-content/themes/zero/img/placeholder.jpg"; //replace this with a default image on your server or an image in your media library
        echo '<meta property="og:image" content="' . $default_image . '"/>';
		} else{
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
		}
		echo "";
		
		// Retrieves the stored value from the database
		$meta_value = get_post_meta( get_the_ID(), 'meta-text', true );
	 
		// Checks and displays the retrieved value
		if( !empty( $meta_value ) ) {
			echo '<meta property="og:description" content="' . $meta_value . '" />';
		} else { } 
		?>		
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />		
		<?php wp_head(); ?>		
 
	</head>
	<body <?php body_class(); ?>>
		<div id="wrapper" class="hfeed">
			<header id="header" role="banner" class="main-navigation hidden-xs">	
				<section class="top-bar">
					<div class="top-bar-inner">
						<div class="logo-container">
							<section id="branding">

								<?php
									if( get_custom_logo() ) {
										the_custom_logo();
									} elseif ( is_front_page() && is_home() ) {
										?>

										<div id="site-title"><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; } ?><strong><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></strong><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } ?></div>
										<?php 
										$description = get_bloginfo( 'description', 'display' );
									} else {
										?>
										<div id="site-title"><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; } ?><strong><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a></strong><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } ?></div>
										<?php
										$description = get_bloginfo( 'description', 'display' );
									}

									if ( ( isset($description) && $description) || is_customize_preview() ) {
										?>
										<div id="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></div>
										<?php
									}
								?>
							</section>					
						</div>
						<div class="global-header">
							<nav id="menu" role="navigation" class="local-navigation">
								<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>								
							</nav>
						</div>
						<div class="search-nav">
							<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
								<label>
									<span class="screen-reader-text"><?php _e('Search for: ' , 'zero'); ?></span>
									<span class="glyphicon glyphicon-search"></span>
									<input type="search" class="search-field" placeholder="Search …" value="" name="s" title="<?php _e('Search for: ' , 'zero'); ?>" />
								</label>
								<input type="submit" class="search-submit" value="Search" />
							</form>

						</div>
					</div>
				</section>
				<div class="nav-right">

					
				</div>
			</header>

			<nav class="navbar navbar-default visible-xs">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <?php wp_nav_menu( array( 'menu_class' => 'nav navbar-nav', 'theme_location' => 'main-menu' ) ); ?>
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>

			<div id="container">