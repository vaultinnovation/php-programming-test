<?php

namespace Vault;

class HumanTime
{
    public static function getHumanTimeDiff($time1, $time2)
    {
        $timestamp = strtotime($time1);
        $now = strtotime($time2);

        $minute_in_seconds = 60;
        $hour_in_seconds = $minute_in_seconds * 60;
        $day_in_seconds = $hour_in_seconds * 24;
        $week_in_seconds = $day_in_seconds * 7;
        $month_in_seconds = $day_in_seconds * 30;
        $year_in_seconds = $day_in_seconds * 365;

        if (0 === $now) {
            $now = time();
        }

        if ($timestamp > $now) {
            throw new Exception('Timestamp is in the future');
        }

        $time_difference = (int)abs($now - $timestamp);

        if ($time_difference < $hour_in_seconds) {
            $difference_value = round($time_difference / $minute_in_seconds);
            $difference_label = 'minute';
        } elseif ($time_difference < $day_in_seconds) {
            $difference_value = round($time_difference / $hour_in_seconds);
            $difference_label = 'hour';
        } elseif ($time_difference < $week_in_seconds) {
            $difference_value = round($time_difference / $day_in_seconds);
            $difference_label = 'day';
        } elseif ($time_difference < $month_in_seconds) {
            $difference_value = round($time_difference / $week_in_seconds);
            $difference_label = 'minute';
        } elseif ($time_difference < $year_in_seconds) {
            $difference_value = round($time_difference / $month_in_seconds);
            $difference_label = 'month';
        } else {
            $difference_value = round($time_difference / $year_in_seconds);
            $difference_label = 'year';
        }

        if ($difference_value <= 1) {
            $time_ago = sprintf('one %s ago',
                $difference_label
            );
        } else {
            $time_ago = sprintf('%s %ss ago',
                $difference_value,
                $difference_label
            );
        }

        return $time_ago;
    }
}