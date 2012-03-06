<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
                        if (get_post_type($post->ID) == 'bfc-event') {
                            $type = 'single-bfc-event';
                        }
                        else {
                            $type = 'single';
                        }
                        

                        get_template_part( 'content', $type );

                    ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>
                
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>