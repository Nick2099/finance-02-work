<?php

use Carbon\Carbon;

if (!function_exists('convertToUserTimezone')) {
    /**
     * Convert a datetime to the user's timezone.
     *
     * @param  string|\DateTime  $datetime
     * @param  string|null  $timezone
     * @return \Carbon\Carbon
     */
    function convertToUserTimezone($datetime, $timezone = null)
    {
        // Default to UTC if no timezone is provided
        $timezone = $timezone ?? 'UTC';

        // Convert the datetime to the user's timezone
        return Carbon::parse($datetime)->timezone($timezone);
    }
}