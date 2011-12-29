<?php
/**
 * Return the page title, fudging the title if needed.
 */
function vt_page_title($title) {
    if (trim($title) == 'New Event') {
        $event_submission = bfc_event_submission();
        switch ($event_submission->page_to_show()) {
            case 'edit-event':
                if ($event_submission->current_action() == 'edit') {
                    $title = 'Edit Event';
                }
                else {
                    $title = 'New Event';
                }
                break;
                
            case 'event-updated':
                $title = 'Event Updated';
                break;
                
            case 'event-deleted':
                $title = 'Event Deleted';
                break;
                
            default:
                die();
                break;
        }
    }
    else if (trim($title) == 'Monthly Calendar') {
        list($startdate, $enddate) = bfc_get_cal_dates(array('for' => 'month'));
        $title = sprintf('%s Bike Fun', date('F Y', $startdate));
    }

    return $title;
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

?>