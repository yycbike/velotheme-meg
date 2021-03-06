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
<?php if ( true ) {
   // Standard calendar front page ?>
	<div class="calendar-title">
		<h1>Bike Fun Calendar</h1>
		<h4>The Bike Fun Calendar is up all year round!</h4>
	</div>

	<div class="calendar-switch">
		<p>Have an idea for bike fun?</p>
		<a href="add-event">Add your event to the calendar</a>
	</div>

<div id="main-calendar">
	<?php
		//display current calendar
		echo do_shortcode('[bfc_cal_date_navigation for=current]');
		echo do_shortcode('[bfc_overview_calendar for=current]');
	?>
</div><!-- #main-calendar -->

<?php } else {
  // Cyclepalooza festival content
?>
						<div class="calendar-title">
							<h1>Cyclepalooza 2018 Event Calendar</h1>
							<h4>July 13 &ndash; July 22</h4>
						</div>

						<div class="calendar-switch">
							<p>Can't wait for bike fun?</p>
							<a href="current-calendar">View the current calendar...</a>
						</div>

					<div id="main-calendar">

						<a href='add-event' class='add-event-button'>Add Event</a>
						<div class="calendar-legend">FF=Family Friendly, 18+=Adults Only, $$=Bring some money</div>

						<?php
							echo do_shortcode('
							[bfc_overview_cal_padding for=before]
							<div class="overview-calendar-padding">

								<h2 style="font-size: 18px;">Ride With Us! The Calendar is Open</h2>
								<p>
									Anyone can lead a ride during Cyclepalooza! Let your creativity run wild and be a part of the most diverse bike festival in Calgary.
									<br /> Not sure how to lead a ride? <a href="/the-ride-guide">We can help you get started.</a>
								</p>
							</div>
							[/bfc_overview_cal_padding]
							');
							echo do_shortcode('[bfc_overview_calendar for=palooza] ');
						?>
					</div><!-- #main-calendar -->
					<p><img src="https://cyclepalooza.ca/wp-content/themes/velotheme-meg/images/footer-image.jpg" width="960" height="236" alt="Cyclepalooza Footer Image"/></p>
<?php } ?>
				</div><!-- #calendar-header -->
			</div><!-- #content -->
		</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
