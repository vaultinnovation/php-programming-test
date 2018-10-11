<?php namespace Vault\Vault;

/**
 * Class Interview
 * @package Vault\Vault
 */
class Interview {

    /**
     * Convert a string to an array and reverse the order of the words.
     * @param array $data
     *
     * @return array
     */
    public function reverseArray($data = null)
    {
        // clean any non-word characters and explode into array
        $parts = explode(' ', preg_replace('/[^\w\s]/', '', $data));
        // reverse the parts
        $new_parts = array_reverse($parts);
        // return new array
        return $new_parts;
    }

    /**
     * Order the elements of an array
     * @param array $data
     *
     * @return array
     */
    public function orderArray($data = [])
    {
        // convert array elements to either int or float
        $data = array_map(function($value) {
            return $value == (int) $value ? (int) $value : (float) $value;
        }, $data);
        // sort our array element numerically
        sort($data, SORT_NUMERIC);
        // return sorted array
        return $data;
    }

    /**
     * Determine the difference between two arrays
     * @param array $data1
     * @param array $data2
     *
     * @return array
     */
    public function getDiffArray($data1 = [], $data2 = [])
    {
        // find the diff between data set 1 and data set 1
        $diff = array_values(array_diff($data2, $data1));
        // return resulting array
        return $diff;
    }

    /**
     * Calculate the distance (in miles) between to given geo points
     * @param array $place1
     * @param array $place2
     *
     * @return float
     */
    public function getDistance($place1 = [], $place2 = [])
    {
        // declare our lat/lon variables
        $lat1 = $place1['lat'];
        $lat2 = $place2['lat'];
        $lon1 = $place1['lon'];
        $lon2 = $place2['lon'];
        $theta = $lon1 - $lon2;
        // do our distance calculations
        $dist1 = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist2 = acos($dist1);
        $dist3 = rad2deg($dist2);
        $distance = $this->roundUp($dist3 * 1.1515 * 60, 2);
        // return the final calculated distance
        return $distance;
    }


    /**
     * Return a human friendly string for the date/time difference between two dates
     * @param null $time1
     * @param null $time2
     *
     * @return string
     */
    public function getHumanTimeDiff($time1 = null, $time2 = null)
    {
        // calculate interval between our two dates
        $t1_obj = new \DateTime($time1);
        $t2_obj = new \DateTime($time2);
        $interval = $t1_obj->diff($t2_obj);
        // delcare our date/time indicators
        $years = '';
        $months = '';
        $days = '';
        $hours = '';
        $minutes = '';
        $seconds = '';
        // populate date/time indicators with correct values based on our interval
        if ( $interval->y > 0 ) {
            $years = $this->pluralize('year', $interval->y);
        } elseif ( $interval->m > 0 ) {
            $months = $this->pluralize('month', $interval->m);
        } else if ( $interval->d > 0 ) {
            $days = $this->pluralize('day', $interval->d);
        } else if ( $interval->h > 0 ) {
            $hours = $this->pluralize('hour', $interval->h);
        } else if ( $interval->i > 0 ) {
            $minutes = $this->pluralize('minute', $interval->i);
        } else {
            $seconds = $this->pluralize('second', $interval->s);
        }
        // build our diff string
        $diff = $years . $months . $days . $hours . $minutes . $seconds;
        // make sure we have valid value for our diff string
        if ( !empty($diff) ) {
            $diff_string = $diff . ' ago';
        } else {
            $diff_string = 'Unable to determine difference between dates.';
        }
        // return our diff string
        return $diff_string;
    }

    /**
     * Custom method to round a decimal number up
     * @param $value
     * @param $precision
     *
     * @return float|int
     */
    protected function roundUp($value, $precision) {
        $pow = pow ( 10, $precision );
        return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;
    }

    /**
     * Custom method to pluralize a word based on the count value
     * @param $word
     * @param $count
     *
     * @return string
     */
    protected function pluralize($word, $count)
    {
        return $count . ' ' . $word . ($count > 1 ? 's' : '');
    }

}