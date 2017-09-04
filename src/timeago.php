<?php
/**
 * Calculates a human-friendly string describing how long ago a timestamp occurred.
 *
 * @link http://stackoverflow.com/a/2916189/3923505
 *
 * @param int $timestamp The timestamp to check.
 * @param int $now       The current time reference point.
 *
 * @return string The time ago in a human-friendly format.
 *
 * @throws \Exception if the timestamp is in the future.
 */
function time_ago( $timestamp = 0, $now = 0 ) {

    // Set up an array of time intervals.
    $intervals = array(
        60 * 60 * 24 * 365 => 'year',
        60 * 60 * 24 * 30  => 'month',
        60 * 60 * 24 * 7   => 'week',
        60 * 60 * 24       => 'day',
        60 * 60            => 'hour',
        60                 => 'minute',
        1                  => 'second',
    );

    // Get the current time if a reference point has not been provided.
    if ( 0 === $now ) {
        $now = time();
    }

    // Make sure the timestamp to check predates the current time reference point.
    if ( $timestamp > $now ) {
        throw new \Exception( 'Timestamp postdates the current time reference point' );
    }

    // Calculate the time difference between the current time reference point and the timestamp we're comparing.
    $time_difference = (int) abs( $now - $timestamp );

    // Check the time difference against each item in our $intervals array. When we find an applicable interval,
    // calculate the amount of intervals represented by the the time difference and return it in a human-friendly
    // format.
    foreach ( $intervals as $interval => $label ) {

        // If the current interval is larger than our time difference, move on to the next smaller interval.
        if ( $time_difference < $interval ) {
            continue;
        }

        // Our time difference is smaller than the interval. Find the number of times our time difference will fit into
        // the interval.
        $time_difference_in_units = round( $time_difference / $interval );

        if ( $time_difference_in_units <= 1 ) {
            $time_ago = sprintf( 'one %s ago',
                $label
            );
        } else {
            $time_ago = sprintf( '%s %ss ago',
                $time_difference_in_units,
                $label
            );
        }

        return $time_ago;
    }
}
