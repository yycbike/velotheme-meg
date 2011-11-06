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


?>