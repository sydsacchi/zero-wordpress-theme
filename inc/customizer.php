<?php
function wptutsplus_customize_register( $wp_customize ) {

/*******************************************
Color scheme
********************************************/

// add the section to contain the settings
$wp_customize->add_section( 'textcolors' , array(
    'title' =>  'Color Scheme',
) );

// main color ( site title, h1, h2, h4. h6, widget headings, nav links, footer headings )
$txtcolors[] = array(
    'slug'=>'color_scheme_1', 
    'default' => '#000',
    'label' => 'Main Color'
);
 
// secondary color ( site description, sidebar headings, h3, h5, nav links on hover )
$txtcolors[] = array(
    'slug'=>'color_scheme_2', 
    'default' => '#666',
    'label' => 'Secondary Color'
);
 
// link color
$txtcolors[] = array(
    'slug'=>'link_color', 
    'default' => '#008AB7',
    'label' => 'Link Color'
);
 
// link color ( hover, active )
$txtcolors[] = array(
    'slug'=>'hover_link_color', 
    'default' => '#9e4059',
    'label' => 'Link Color (on hover)'
);

// footer background
$txtcolors[] = array(
    'slug'=>'footer_background', 
    'default' => '#013012',
    'label' => 'Footer Background'
);

// footer text
$txtcolors[] = array(
    'slug'=>'footer_text', 
    'default' => '#fff',
    'label' => 'Footer Text'
);

// footer links
$txtcolors[] = array(
    'slug'=>'footer_links', 
    'default' => '#0000EE',
    'label' => 'Footer Links'
);

$txtcolors[] = array(
    'slug'=>'footer_widgets', 
    'default' => '#000',
    'label' => 'Footer Widgets'
);

// add the settings and controls for each color
foreach( $txtcolors as $txtcolor ) {
 
    // SETTINGS
    $wp_customize->add_setting(
        $txtcolor['slug'], array(
            'default' => $txtcolor['default'],
            'type' => 'option', 
            'capability' => 
            'edit_theme_options'
        )
    );
    // CONTROLS
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            $txtcolor['slug'], 
            array('label' => $txtcolor['label'], 
            'section' => 'textcolors',
            'settings' => $txtcolor['slug'])
        )
    );
}

}
add_action( 'customize_register', 'wptutsplus_customize_register' );

function wptutsplus_customize_colors() {

/**********************
text colors
**********************/
// main color
$color_scheme_1 = get_option( 'color_scheme_1' );
 
// secondary color
$color_scheme_2 = get_option( 'color_scheme_2' );
 
// link color
$link_color = get_option( 'link_color' );
 
// hover or active link color
$hover_link_color = get_option( 'hover_link_color' );

// footer background color
$footer_background = get_option( 'footer_background' );

// footer text color
$footer_text = get_option( 'footer_text' );

// footer links color
$footer_links = get_option( 'footer_links' );

// footer widgets title color
$footer_widgets = get_option( 'footer_widgets' );

/****************************************
styling
****************************************/
?>
<style>
 
 
/* color scheme */
 
/* main color */
#site-title a, h1, h2, h2.page-title, h2.post-title, h2 a:link, h2 a:visited, .menu.main a:link, .menu.main a:visited, footer h3 { 
    color:  <?php echo $color_scheme_1; ?>; 
}
 
/* secondary color */
#site-description, .sidebar h3, h3, h5, .menu.main a:active, .menu.main a:hover {
    color:  <?php echo $color_scheme_2; ?>; 
}
.menu.main,
.fatfooter {
    border-top: 1px solid <?php echo $color_scheme_2; ?>;
}
.menu.main {
    border-bottom: 1px solid <?php echo $color_scheme_2; ?>;  
}
.fatfooter {
    border-bottom: 1px solid <?php echo $color_scheme_2; ?>;
}
 
/* links color */
a:link, a:visited { 
    color:  <?php echo $link_color; ?>; 
}
 
/* hover links color */
a:hover, a:active {
    color:  <?php echo $hover_link_color; ?>; 
}
 

#footer {
	background-color: <?php echo $footer_background; ?>;
	color: <?php echo $footer_text; ?>;
}
#footer a {
	color: <?php echo $footer_links; ?>;
}

#footer h3.widget-title {
	color: <?php echo $footer_widgets; ?>;
}

</style>
<?php 
}

add_action( 'wp_head', 'wptutsplus_customize_colors' );

function zero_customize_register($wp_customize) {
	$wp_customize->add_section('typography', array (
		'title' => __('Typography', 'zero'),
		'priority' => 130
	));
	
	$wp_customize->add_setting('typography_font', array(
		'default' => 'courier',		
		'type' => 'theme_mod',
	));
	
	$wp_customize->add_control('typography_font', array(
		'label' => __('Font', 'zero'),
		'section' => 'typography',
		'type' => 'radio',
		'choices' => array(
			'arial' => 'Arial',
			'georgia' => 'Georgia',
			'times' => 'Times',			
			'"Lucida Sans Unicode"' => 'Lucida Sans',
			'Tahoma' => 'Tahoma',
			'Verdana' => 'Verdana',
			'"Courier New"' => 'Courier',
			'"Lucida Console"' => 'Lucida Console',
			'"Comic Sans MS"' => 'Comic ^_^',
			
		),
		'priority' => 1
	));
	
	$wp_customize->add_section('header_background_image', array (
		'title' => __('Header Background Image', 'zero'),
		'priority' => 120
	));
	
	$wp_customize->add_setting('post_background_image', array(
		'default' => get_bloginfo('template_directory').'/img/placeholder.jpg',
		'type' => 'theme_mod'
	));
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'post_placeholder', array(
		'label' => __('Post Placeholder Image', 'zero'),
		'section' => 'header_background_image',
		'settings' => 'post_background_image',
		'priority' => 1
	)));
	
	$wp_customize->add_section('footer_credits', array (
		'title' => __('Footer Text/Credits', 'zero'),
		'priority' => 500
	));
	
	$wp_customize->add_setting('footer_text_block', array(
		'default' => 'Copyright &copy; 2017 · Zero Theme · By: <a href="https://www.sidneysacchi.com" target="_blank" title="Web Design &amp; Web Consulting">Sidney Sacchi</a>',
		'sanitize_callback' => 'sanitize_text'		
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'custom_footer_text', array( 
		'label' => __( 'Footer Text/Credits', 'zero' ), 
		'section' => 'footer_credits', 
		'settings' => 'footer_text_block', 
		'type' => 'text'
		))); 
		
	
	$wp_customize->add_section('social_profiles', array (
		'title' => __('Social Profiles', 'zero'),
		'priority' => 500
	));
	
	$wp_customize->add_setting('facebook_profile_block', array(
		'default' => __('Paste your Facebook Profile URL here', 'zero'),
		'sanitize_callback' => 'sanitize_text'
	));
	
	$wp_customize->add_setting('twitter_profile_block', array(
		'default' => __('Write/Paste your Twitter username here', 'zero'),
		'sanitize_callback' => 'sanitize_text'
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_profile_url', array( 
		'label' => __( 'Facebook Profile Link', 'zero' ), 
		'section' => 'social_profiles', 
		'settings' => 'facebook_profile_block', 
		'type' => 'text'
		))); 
		
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_profile_url', array( 
		'label' => __( 'Twitter Username', 'zero' ), 
		'section' => 'social_profiles', 
		'settings' => 'twitter_profile_block', 
		'type' => 'text'
		))); 
	
		// Sanitize text 
		function sanitize_text( $text ) {
		return sanitize_text_field( $text ); 
		}
}

add_action ('customize_register', 'zero_customize_register');

function zero_customize_family() {
	$body_family = get_option( 'typography_font' );
?>
<style>
	body {
		font-family: <?php echo get_theme_mod('typography_font'); ?>;
	}
</style>
<?php 
}

add_action( 'wp_head', 'zero_customize_family' );
?>