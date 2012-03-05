<?php

/**
 * Header poster (modified from twenty eleven header images.
 */

// The height and width of the Velopalooza poster space.
add_filter('twentyeleven_header_image_width', 'velotheme_header_image_width');
function velotheme_header_image_width() { return 330; }
add_filter('twentyeleven_header_image_height', 'velotheme_header_image_height');
function velotheme_header_image_height() { return 455; }

// REMOVE TWENTY ELEVEN DEFAULT HEADER IMAGES
function velo_remove_header_images() {
    unregister_default_headers( array('wheel','shore','trolley','pine-cone','chessboard','lanterns','willow','hanoi')
    );
}
add_action( 'after_setup_theme', 'velo_remove_header_images', 11 );

//ADD NEW DEFAULT HEADER IMAGES
function velo_new_default_header_images() {
    $theme_dir = get_bloginfo('stylesheet_directory');
    register_default_headers( array (
        'velo2011' => array (
            'url' => "$theme_dir/images/headers/velo2011.jpg",
            'thumbnail_url' => "$theme_dir/images/headers/velo2011-thumbnail.jpg", // 150 x 219px
            'description' => __( 'Velopalooza 2011 Poster', 'velotheme-meg' )
        )
    ));
}
add_action( 'after_setup_theme', 'velo_new_default_header_images' );

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 500px;
		height: auto;
		width: 30%;
	}
	</style>
<?php
}

//add_action('admin_head', 'velo_admin_header_image');

/**
 * Register more sidebars widgetized areas.
 */
function vt_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Event Page Sidebar', 'velotheme' ),
		'description' => __( 'Sidebar for Event pages', 'velotheme' ),
		'id' => 'event-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'About Page Sidebar', 'velotheme' ),
		'id' => 'about-sidebar',
		'description' => __( 'Sidebar for the About page', 'velotheme' ),
	) );

	register_sidebar( array(
		'name' => __( 'Volunteer Page Sidebar', 'velotheme' ),
		'id' => 'volunteer-sidebar',
		'description' => __( 'Sidebar for the Volunteer page', 'velotheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Supporters Page Sidebar', 'velotheme' ),
		'id' => 'supporters-sidebar',
		'description' => __( 'Sidebar for the Supporters Page', 'velotheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'vt_widgets_init' );


add_filter( 'body_class', 'vt_body_class', 20, 2);
/**
 * Adds classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 */
function vt_body_class( $classes ) {
	if( is_single() || is_page() ) :
		// List of the classes to remove from the WP generated classes
		$blacklist = array('singular', 'one-column');
		// Filter the body classes
  		foreach( $blacklist as $val ) {
    			if (!in_array($val, $classes)) : continue;
    			else:
     				foreach($classes as $key => $value) {
      					if ($value == $val) unset($classes[$key]);
      				}
    			endif;
 		}
	endif;   // Add the extra classes back untouched
	$extra_classes = array('two-column', 'right-sidebar');
	return array_merge($classes, $extra_classes);
}

// 10 = default priority; 2 = pass in 2 arguments
add_filter('bfc-overview-cal-padding', 'vt_overview_cal_padding_filter', 10, 2);
function vt_overview_cal_padding_filter($content, $args) {
    // Arguments:
    // for = palooza or cal (regular calendar, not palooza)
    // cols = number of columns (days) that this spans
    // location = 'before' or 'after' -- is this before the first day with events
    //            or after the last day.
    if ($args['for'] === 'palooza' &&
        $args['location'] === 'before') {

        return '<p>The theme can customize this area to discuss the palooza</p>';
    }
    else {
        return $content;
    }
}

/**
 * Velopalooza Meta widget class
 *
 * Displays log in/out links
 *
 */
class Velo_Widget_Meta extends WP_Widget {

	function Velo_Widget_Meta() {
		$widget_ops = array('classname' => 'velo_widget_meta', 'description' => __( "Displays log in/out links") );
		parent::WP_Widget(false, 'Velopalooza Meta Widget');
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Velopalooza Site Meta') : $instance['title'], $instance, $this->id_base);

		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		echo $before_widget;
		//if ( $title )
			//echo $before_title . $title . $after_title;
?>
			<ul>
			<?php if ( $nav_menu ) wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'items_wrap' => '%3$s' ) ); ?>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php //wp_meta(); ?>
			</ul>
<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		
		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
			<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
			}
		?>
			</select>
			</p>
<?php
	}
}

register_widget('Velo_Widget_Meta');

/**
 * Velopalooza Stay Connected widget class
 *
 * Displays email newsletter sign up form and links to Facebook and Twitter
 *
 */
class Velo_Widget_StayConnected extends WP_Widget {

	function Velo_Widget_StayConnected() {
		$widget_ops = array('classname' => 'velo_widget_stayconnected', 'description' => __( "Displays email newsletter sign up form and links to Facebook and Twitter") );
		parent::WP_Widget(false, 'Velopalooza Stay Connected Widget');
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Velopalooza Stay Connected Footer') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>
			<ul>
            <li>Sign up for the email newsletter:</li>
            <li>
            	<form id="newsletter" name="ccoptin" action="http://visitor.r20.constantcontact.com/d.jsp" target="_blank" method="post">
        			<input type="hidden" name="llr" value="xltcqeeab">
        			<input type="hidden" name="m" value="1103957675383">
        			<input type="hidden" name="p" value="oi">
        			<input type="text" name="ea" id="email" value="" value placeholder="you@yours.com" >
        			<input type="submit" name="go" value="Subscribe" class="submit">
        		</form>
            </li>
            <li> Or join us on <a href="http://www.facebook.com/velopalooza">Facebook</a>
            </ul>
<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
	}
}

/* Register the stay connected widget */
register_widget('Velo_Widget_StayConnected');

?>