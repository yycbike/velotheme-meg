<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

global $wp_query;
if(get_post_type($wp_query->post->ID)=='bfc-event') {
	$sidebar_type = 'event-sidebar';
} else {
	$sidebar_type = get_post_meta($post->ID, 'sidebar_type', true);
}

if($sidebar_type != '') :

?>
<ul id="sidebar">    
        <div id="secondary" class="widget-area" role="complementary">
        	
			<?php if ( ! dynamic_sidebar( $sidebar_type ) ) :?>
                
			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
</ul>

<?php endif; ?>