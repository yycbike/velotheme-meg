<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( 'footer' );
			?>

			<div id="site-generator">
				<ul>
				<li><strong>Disclaimer:</strong> The Cyclepalooza calendar is presented as a convenience for cyclists. <br>Cyclepalooza is neither responsible for nor endorses the activities listed, except where otherwise indicated.<br><br></li>
<li>
Cyclepalooza would like to acknowledge that all events hosted take place on the traditional territories of the Blackfoot and the people of the Treaty 7 region in Southern Alberta, which includes the Siksika, the Piikuni, the Kainai, the Tsuut’ina and the Stoney Nakoda First Nations, including Chiniki, Bearspaw, and Wesley First Nation. The City of Calgary is also home to Métis Nation of Alberta, Region III.
<br><br>
</li>
				<li>
                <a href="/previous-events/">Previous Cyclepalooza Events</a>
				</li>
				</ul>

			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
