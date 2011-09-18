<?php
/**
 * Return the page title, fudging the title if needed.
 */
function vt_page_title($title) {
    if (trim($title) == 'New Event') {
        $event_submission = bfc_event_submission();
        switch ($event_submission->page_to_show()) {
            case 'edit-event':
                $title = 'Edit Event';
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

    return $title;
}


?>