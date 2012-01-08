<?php

	// Enqueue showcase script for the slider
	wp_enqueue_script( 'twentyeleven-showcase', get_stylesheet_directory_uri() . '/js/showcase.js', array( 'jquery' ), '2011-04-28' );

?>

	<?php
        /**
         * Begin the featured posts section.
         *
         * See if we have any sticky posts and use them to create our featured posts.
         * We limit the featured posts at ten.
         */
        $sticky = get_option( 'sticky_posts' );

        // Proceed only if sticky posts exist.
        if ( ! empty( $sticky ) ) :

        $featured_args = array(
            'post__in' => $sticky,
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'no_found_rows' => true,
        );

        // The Featured Posts query.
        $featured = new WP_Query( $featured_args );

        // Proceed only if published posts exist
        if ( $featured->have_posts() ) :

        /**
         * We will need to count featured posts starting from zero
         * to create the slider navigation.
         */
        $counter_slider = 0;

        ?>

    <div id="billboard" class="featured-posts">
    <?php
        // Let's roll.
        while ( $featured->have_posts() ) : $featured->the_post();

        // Increase the counter.
        $counter_slider++;

        /**
         * We're going to add a class to our featured post for featured images
         * by default it'll have the feature-text class.
         */
        $feature_class = 'feature-text';
		if ( has_post_thumbnail() ) {
            $feature_class = 'feature-image large';
			$thumbnail_size = 'large-feature';
        }
	?>
		
		<section class="featured-post <?php echo $feature_class; ?>" id="featured-post-<?php echo $counter_slider; ?>">

	<?php 
		if ( has_post_thumbnail() ) the_post_thumbnail( $thumbnail_size );
		get_template_part( 'content', 'featured' ); 
	?>
		</section>
	<?php endwhile;	?>

				<?php
					// Show slider only if we have more than one featured post.
					if ( $featured->post_count > 1 ) :
				?>
				<nav class="feature-slider">
					<ul>
					<?php

						// Reset the counter so that we end up with matching elements
				    	$counter_slider = 0;

						// Begin from zero
				    	rewind_posts();

						// Let's roll again.
				    	while ( $featured->have_posts() ) : $featured->the_post();
				    		$counter_slider++;
							if ( 1 == $counter_slider )
								$class = 'class="active"';
							else
								$class = '';
				    	?>
						<li><a href="#featured-post-<?php echo $counter_slider; ?>" title="<?php printf( esc_attr__( 'Featuring: %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" <?php echo $class; ?>></a></li>
					<?php endwhile;	?>
					</ul>
				</nav-->
				<?php endif; // End check for more than one sticky post. ?>
				</div><!-- .featured-posts -->
				<?php endif; // End check for published posts. ?>
				<?php endif; // End check for sticky posts. ?>