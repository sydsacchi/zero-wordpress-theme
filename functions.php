<?php
add_action( 'after_setup_theme', 'zero_setup' );
function zero_setup()
	{
		load_theme_textdomain( 'zero', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_image_size('zero-logo', 160, 90);
		add_theme_support('custom-logo', array(
			'size' => 'zero-logo'
		));

		add_theme_support('custom-logo');

		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 640;
		register_nav_menus(
			array( 'main-menu' => __( 'Main Menu', 'zero' ) )
		);
	}

add_action( 'wp_enqueue_scripts', 'zero_load_scripts' );

function zero_load_scripts()
	{
		wp_enqueue_script( 'jquery' );
	}

add_action( 'comment_form_before', 'zero_enqueue_comment_reply_script' );

function zero_enqueue_comment_reply_script()
	{
		if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
	}

add_filter( 'the_title', 'zero_title' );

function zero_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'zero_filter_wp_title' );

function zero_filter_wp_title( $title )
	{
		return $title . esc_attr( get_bloginfo( 'name' ) );
	}

add_action( 'widgets_init', 'zero_widgets_init' );

function zero_widgets_init()
	{
	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'zero' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Sidebar 1',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Sidebar 2',
		'id' => 'footer-sidebar-2',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => 'Footer Sidebar 3',
		'id' => 'footer-sidebar-3',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

function zero_custom_pings( $comment )
	{
		$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>

<?php 
	}
	
add_filter( 'get_comments_number', 'zero_comments_number' );

function zero_comments_number( $count )
	{
		if ( !is_admin() ) {
			global $id;
			$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
			return count( $comments_by_type['comment'] );
		} else {
			return $count;
		}
	}

add_theme_support('html5', array('search-form'));

Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
	function widget($args, $instance) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
		$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		*/
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
?>
		<ul>
            <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>" class="widget-post-title"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                <?php if ( $show_date ) : ?>
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                <?php endif; ?>
					<!-- <span class="post-author"><?php echo get_the_author(); ?></span> -->
					<span class="post-category"><?php the_category( ' ' ); ?></span>
                </li>
            <?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
		<?php
            // Reset the global $the_post as this query will have stomped on it
            wp_reset_postdata();

		endif;
	}
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');

add_theme_support( 'post-thumbnails' );

include_once( 'inc/customizer.php' );

/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */

 class MyTheme_Customize {

   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings 
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    * 
    * Used by hook: 'customize_preview_init'
    * 
    * @see add_action('customize_preview_init',$func)
    * @since MyTheme 1.0
    */
   public static function live_preview() {
      wp_enqueue_script( 
           'mytheme-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'MyTheme_Customize' , 'live_preview' ) );


register_sidebar( array(
	'name' => 'Footer Sidebar 1',
	'id' => 'footer-sidebar-1',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array(
	'name' => 'Footer Sidebar 2',
	'id' => 'footer-sidebar-2',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );
register_sidebar( array(
	'name' => 'Footer Sidebar 3',
	'id' => 'footer-sidebar-3',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

function zero_social_sharing_buttons($content) {
	global $post;
	if(is_singular() || is_home()){
	
		// Get current page URL 
		$shareURL = urlencode(get_permalink());
 
		// Get current page title
		$shareTitle = str_replace( ' ', '%20', get_the_title());
		
		// Get Post Thumbnail for pinterest
		$shareThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 
		// Construct sharing URL without using any script		
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$shareTitle.'&amp;url='.$shareURL.'&amp;via='.get_theme_mod( 'twitter_profile_block');'';
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$shareURL;
		$googleURL = 'https://plus.google.com/share?url='.$shareURL;
		$bufferURL = 'https://bufferapp.com/add?url='.$shareURL.'&amp;text='.$shareTitle;
		$whatsappURL = 'whatsapp://send?text='.$shareTitle . ' ' . $shareURL;
		$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$shareURL.'&amp;title='.$shareTitle;
		$printURL = 'javascript:window.print()'; 
		$emailURL = 'mailto:?subject='.$shareTitle.'&amp;body=' . __('Check this post:%0D%0A', 'zero') . $shareTitle.'%0D%0A'.$shareURL;
		// Based on popular demand added Pinterest too
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$shareURL.'&amp;media='.$shareThumbnail[0].'&amp;description='.$shareTitle;
 
		// Add sharing button at the end of page/page content
		$content .= '<div class="zero-social">';
		$content .= '<a class="zero-link zero-twitter" href="'. $twitterURL .'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> ';
		$content .= '<a class="zero-link zero-facebook" href="'.$facebookURL.'" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> ';		
		$content .= '<a class="zero-link zero-linkedin" href="'.$linkedInURL.'" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> ';
		$content .= '<a class="zero-link zero-email" href="'.$emailURL.'" target="_blank" title="' . __('Send to a friend', 'zero') . '"><i class="fa fa-envelope" aria-hidden="true"></i></a> ';
		$content .= '<a class="zero-link zero-print" href="'.$printURL.'" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a> ';
		
		$content .= '</div>';		
		
		return $content;
	}else{
		// if not a post/page then don't include sharing button
		return $content;
	}
};
add_filter( 'the_content', 'zero_social_sharing_buttons');
add_shortcode( 'shareIcons', 'zero_social_sharing_buttons' );

// Changing excerpt more
function new_excerpt_more($more) {
	global $post;
	return '… <p class="readMore"><a class="arrow" href="'. get_permalink($post->ID) . '">' . __('Read more', 'zero') . '</a></p>';
}

add_filter('excerpt_more', 'new_excerpt_more');

add_shortcode( 'lateral', 'blockquote_lateral');
function blockquote_lateral( $atts, $content ) {
	return '<blockquote class="laterale"> ' . '<h6>' . $atts['title'] . '</h6> ' . $content . '</blockquote>';
}

add_shortcode( 'special', 'blockquote_lateral_special');
function blockquote_lateral_special( $atts, $content ) {
	return '<blockquote class="laterale special"> ' . $atts['title'] . '<h3>' . $atts['big'] . '</h3> ' . '<a id="toggle">+</a><div class="toggleContent">' . $content . '</div></blockquote>';
}

function get_first_paragraph(){
	global $post;
	
	$str = wpautop( get_the_content() );
	$str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
	$str = strip_tags($str, '<a><strong><em>');
	return '<p>' . $str . '</p>';
}

function prfx_custom_meta() {
    add_meta_box( 'prfx_meta', __( 'OG Social Description', 'zero' ), 'prfx_meta_callback', 'post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'prfx_custom_meta' );

/**
 * Outputs the content of the meta box
 */
function prfx_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $prfx_stored_meta = get_post_meta( $post->ID );
    ?>
 
    <p>
        <label for="meta-text" class="prfx-row-title"><?php _e( 'Brief Description for Social Share', 'zero' )?></label>
        <input type="text" name="meta-text" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['meta-text'] ) ) echo $prfx_stored_meta['meta-text'][0]; ?>" />
    </p>
 
    <?php
}

/**
 * Saves the custom meta input
 */
function prfx_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }
 
}
add_action( 'save_post', 'prfx_meta_save' );

// init process for registering our button
 add_action('init', 'wpse72394_shortcode_button_init');
 function wpse72394_shortcode_button_init() {

      //Abort early if the user will never see TinyMCE
      if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
           return;

      //Add a callback to regiser our tinymce plugin   
      add_filter("mce_external_plugins", "wpse72394_register_tinymce_plugin"); 

      // Add a callback to add our button to the TinyMCE toolbar
      add_filter('mce_buttons', 'wpse72394_add_tinymce_button');
}


//This callback registers our plug-in
function wpse72394_register_tinymce_plugin($plugin_array) {
    $plugin_array['wpse72394_button'] = '/wp-content/themes/zero/js/blockquote.js';
    return $plugin_array;
}

//This callback adds our button to the toolbar
function wpse72394_add_tinymce_button($buttons) {
            //Add the button ID to the $button array
    $buttons[] = "wpse72394_button";
    return $buttons;
}

// second button
// init process for registering our button
add_action('init', 'wpse72395_shortcode_button_init');
 function wpse72395_shortcode_button_init() {

      //Abort early if the user will never see TinyMCE
      if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
           return;

      //Add a callback to regiser our tinymce plugin   
      add_filter("mce_external_plugins", "wpse72395_register_tinymce_plugin"); 

      // Add a callback to add our button to the TinyMCE toolbar
      add_filter('mce_buttons', 'wpse72395_add_tinymce_button');
}


//This callback registers our plug-in
function wpse72395_register_tinymce_plugin($plugin_array) {
    $plugin_array['wpse72395_button'] = '/wp-content/themes/zero/js/blockquote.js';
    return $plugin_array;
}

//This callback adds our button to the toolbar
function wpse72395_add_tinymce_button($buttons) {
            //Add the button ID to the $button array
    $buttons[] = "wpse72395_button";
    return $buttons;
}