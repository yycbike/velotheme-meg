<?php
/**
 *
 * The site's front page
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
				<a href="current-calendar">See events happening now.</a>
				</div>
			</div>
			<div id="main-calendar">
                        <a href='add-event' class='add-event-button'>Add Event</a>
			<?php 
				//display current calendar
				echo do_shortcode('[bfc_overview_calendar for=palooza]'); 
			?>
			</div><!--CALENDAR-->
			<div id="sponsors">
				<ul class="sponsor-list">
					<?php echo adrotate_block(2); ?>
				</ul>
			</div>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>