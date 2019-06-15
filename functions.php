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
            'url' => "$theme_dir/images/headers/cyclepalooza-2012.png",
            'thumbnail_url' => "$theme_dir/images/headers/cyclepalooza-2012-thumbnail.png", // 150 x 219px
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
    // We're using the no-sidebar layout, so keep the classes the
    // way they are (i.e., for a full-width layout).
    if (is_page_template('page-no-sidebar.php')) {
        return $classes;
    }

    // Change from a one-column layout to a two-column layout.
    // This depends on having the theme's options set to a one-column
    // layout by default. (It's a bit weird: we set the default to a
    // one-column layout, then nearly always override that to add a
    // sidebar in.)
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
    // startdate, enddate = days as Unix timestamp

    // The filter doesn't do anything now, but it could...
    return $content;
}
?>
