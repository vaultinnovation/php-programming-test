<?php
namespace Vault\Vault;

//require '../../vendor/nesbot/carbon/src/Carbon/Carbon.php';

/**
 * Class Helper
 * @package Vault\Vault
 */
class Helper
{

    /**
     * @param $str
     * @return array
     */
    public function reverse($str)
    {
        //remove period from string
        $str = str_replace('.', '', $str);
        //convert string to array
        $arr = explode(' ', $str);

        //walk array and reorder the items
        for ($i = count($arr) - 1; $i >= 0; $i--) {
            $arr[] = $arr[$i];
            unset($arr[$i]);
        }

        //array_values resets array keys to start at 0
        return array_values($arr);
    }

    /**
     * @param $array
     * @return array
     */
    public function sortArray($array)
    {
        $data = [];
        foreach ($array as $value) {
            //loop through array to change string to float or int as needed
            if (is_numeric($value)) {
                $data[] = $value + 0;
            } else {
                $data[] = 0;
            }

        }
        //built in function to sort array
        sort($data, SORT_NUMERIC);
        return $data;
    }

    public function arrayDiff($data1, $data2)
    {
        //get difference in array
        $data = array_diff($data1, $data2);
        //reset values
        $data = array_values($data);
        return $data;
    }

    public function getDistance($loc1, $loc2, $unit = 'm')
    {
        //get the difference between loc1 and loc2 longitude
        $theta = $loc1['lon'] - $loc2['lon'];
        //do some math
        $dist = sin( deg2rad( $loc1['lat'] ) ) * sin( deg2rad( $loc2['lat'] ) ) + cos( deg2rad( $loc1['lat'] ) ) * cos( deg2rad( $loc2['lat'] ) ) * cos( deg2rad( $theta ) );
        $dist = acos($dist);
        //convert to degrees
        $dist = rad2deg($dist);
        //get miles with some math
        $miles = $dist * 60 * 1.1515;
        //if unit = m for miles, return miles.
        $unit = strtoupper( $unit );
        if ( $unit === 'M' ) {
            //round to 2 decimal points
            if ( strlen( substr( strrchr( $miles, '.' ), 1 ) ) > 2 ) {
                // round distance
                $miles = round( $miles, 2 ) + .01;
            };
            return $miles;
        }

        return false;
    }

    function getDateDiff( $time1, $time2, $precision = 2 ) {
        // If not numeric then convert timestamps
        if( !is_int( $time1 ) ) {
            $time1 = strtotime( $time1 );
        }
        if( !is_int( $time2 ) ) {
            $time2 = strtotime( $time2 );
        }
        // If time1 > time2 then swap the 2 values
        if( $time1 > $time2 ) {
            list( $time1, $time2 ) = array( $time2, $time1 );
        }
        // Set up intervals and diffs arrays
        $intervals = array( 'year', 'month', 'day', 'hour', 'minute', 'second' );
        $diffs = array();
        foreach( $intervals as $interval ) {
            // Create temp time from time1 and interval
            $ttime = strtotime( '+1 ' . $interval, $time1 );
            // Set initial values
            $add = 1;
            $looped = 0;
            // Loop until temp time is smaller than time2
            while ( $time2 >= $ttime ) {
                // Create new temp time from time1 and interval
                $add++;
                $ttime = strtotime( "+" . $add . " " . $interval, $time1 );
                $looped++;
            }
            $time1 = strtotime( "+" . $looped . " " . $interval, $time1 );
            $diffs[ $interval ] = $looped;
        }
        $count = 0;
        $times = array();
        foreach( $diffs as $interval => $value ) {
            // Break if we have needed precission
            if( $count >= $precision ) {
                break;
            }
            // Add value and interval if value is bigger than 0
            if( $value > 0 ) {
                if( $value != 1 ){
                    $interval .= "s ago";
                }
                // Add value and interval to times array
                $times[] = $value . " " . $interval;
                $count++;
            }
        }
        // Return string with times
        return implode( ", ", $times );
    }
}