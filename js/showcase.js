// Author: Devon Zara (http://devonzara.com)
// Date: Dec. 11th, 2011
// Description: Rewritten 'showcase.js' for the 'twentyeleven'
// WordPress theme.
// Version: 1.0b201112120044
// ID: DZWPTEASC
//
// For the jQuery fade to function, you must remove, comment, or
// over-rule the CSS3 animations in your stylesheet,
// found next to the selectors:
// 	   .featured-posts section.featured-post
//
// NOTE: All times are in miliseconds
//       1000 miliseconds = 1 second

( function( $ )
{
	
		/*$(document).ready( function() {
	    $('.feature-slider a').click(function(e) {
	        $('.featured-posts section.featured-post').css({
	            opacity: 0,
	            visibility: 'hidden'
	        });
	        $(this.hash).css({
	            opacity: 1,
	            visibility: 'visible'
	        });
	        $('.feature-slider a').removeClass('active');
	        $(this).addClass('active');
	        e.preventDefault();
	    });
	});*/
		
	$( document ).ready( function()
	{
		// Automatic transitioning
		var useFadeshow = true;
		// Time between transitions
		var delay = 10000;
		// Length of transition
		var speed = 1000;
		// Toggle click delay
		var useClickDelay = true;
		// Delay when clicked
		var clickDelay = 5000;

		// System variables
		var timer = null;
		var busy = false;
		var wasClicked = false;
		var queue = null;

		// These next two lines do a few additional
		// resets to the CSS so that jQuery functions
		// properly.
		$( '.featured-posts section.featured-post' ).css({ display: 'none', visibility: 'visible', opacity: 1 });
		$( '.featured-posts #featured-post-1' ).show();

		$('.feature-slider a').click( function( e ) {
			if( !busy )
			{
				transition( e.target, this.hash );
				wasClicked = true;
			}
			else
			{
				queue = e.target;
			}
			e.preventDefault();
		});

		function transition( target, hash )
		{
			busy = true;

			// Stop the timer
			if( useFadeshow )
				clearTimeout( timer );

			// Do nothing if the same slide has been clicked
			if( $( '.feature-slider a.active' ).attr( 'href' ) != hash )
			{
				// Do we have a valid target?
				if( isNull( $( target ).attr( 'href' ) ) )
				{
					target = $( '.feature-slider a.active' ).parent().next().children( 'a:first' );

					// Was there a next sibling? If not, go to the first.
					target = ( isNull( target ) ) ? $( '.feature-slider li:first a:first' ) : target;
					hash = target.attr( 'href' );
				}
				else
				{
					target = $( target );
				}

				prev = $( $( '.feature-slider a.active' ).attr( 'href' ) );

				// Change the buttons
				$( '.feature-slider a.active' ).removeClass( 'active' );
				target.addClass( 'active' );

				// Begin fading...
				prev.fadeOut( speed );
				$( hash ).fadeIn( speed, function() {
					// Restart the timer
					startTimer();
				});
			}
			else
			{
				startTimer();
			}
		}

		function startTimer()
		{
			// Was this a click action and are we to wait?
			var thisDelay = ( wasClicked && useClickDelay ) ? clickDelay : delay;

			if( queue == null )
			{
				if( useFadeshow )
					timer = setTimeout( transition, thisDelay );

				// Reset system vars
				busy = false;
				wasClicked = false;
			}
			else
			{
				var target = queue;

				queue = null;
				transition( target, $( target ).attr( 'href' ) );
			}
		}

		function isNull( param )
		{
			try
			{
				return ( !param || typeof param[0] == 'undefined' || typeof param[0] == 'undefined' || param < 1 ) ? true : false;
			}
			catch( err )
			{
				return true;
			}
		}

		startTimer();
	});
})( jQuery );