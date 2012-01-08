<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage velotheme
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
            
            		<div id="calendar-header">
				<div class="calendar-title">
				<h1>Velopalooza 2012 Event Calendar</h1>
				<h4>June 15th to July 2nd</h4>
				</div>
				<div class="calendar-switch">
				<h3>Can't wait for bike fun?</h3>
				<a href="#current-cal">See events happening now.</a>
				</div>
			</div>
			<div id="main-calendar">
			<form><input type="submit" name="go" value="Add Event" class="submit"></form>
			<?php 
				//display current calendar
				echo do_shortcode('[bfc_overview_calendar for=palooza start=2011-06-02 end=2011-06-19]'); 
			?>
			</div><!--CALENDAR-->
			<div id="sponsors"></div>

			<?php 
				//OLD TWENTY ELEVEN CODE
				/*
					if ( have_posts() ) :

					twentyeleven_content_nav( 'nav-above' );

					// Start the Loop
					while ( have_posts() ) : the_post();

						get_template_part( 'content', get_post_format() );

					endwhile;

					twentyeleven_content_nav( 'nav-below' );

					else : */ ?>

				<!--<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php //_e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header>

					<div class="entry-content">
						<p><?php //_e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php //get_search_form(); ?>
					</div>
				</article><!-- #post-0 -->

			<?php //endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>