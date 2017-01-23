<?php 
namespace Vault;

/*
 * Code created by Kevin O'Riley -> for Vault Innovations
 * 
 * This class is to show aptitude, in php/phpUnit/git/gitHub
 */



class Interview {

    /**
     * Create a class that turns the below string into an array and reverse the words.
     * @param string $data Words to reverse
     * 
     * @return array The words in reverse also removes (.)
     */
    public function ReverseArray($data) {

        //$data = (string)"I want this job.";
        $data = str_replace(".", "", $data);

        $split = explode(" ", $data);
        $splitCount = count($split) - 1;
        for ($i = 0; $i < ($splitCount / 2); $i++) {
            $temp = $split[$i];
            $split[$i] = $split[$splitCount - $i];
            $split[$splitCount - $i] = $temp;
        }


        return $split;
    }

    /**
     * Create a class that sorts the below array
     *
     * @param array $data Just a list of numbers
     * @return array returns the numbers in assending order
     */
    public function OrderArray(array $data) {
        //$data = ["200", "450", "2.5", "1", "505.5", "2"];

        sort($data);
        foreach ($data as $key => $val) {
            $data[$key] = $val;
        }

        return $data;
    }

    /**
     * Create a class to determine array differences
     * 
     * @parm data1 = first array of number
     * @parm data2 = second array of numbers
     * 
     * returns the difference in the first one, re-setting the array keys.
     */
    public function GetDiffArray($data1, $data2) {


        $data = array_diff($data1, $data2);

        $data = array_values($data);
        return $data;
    }

    /**
     * Create a class that will get the distance between two geo points
     * geodatasource.com/developers/php
     * 
     * @param array $place1 This is an array that holds the lat and lon of a destination
     * @param array $place2 The same as place 1, only also different (maybe)
     * 
     * @return float This will be the distance in miles between the two places.
     */
    public function GetDistance($place1, $place2) {


        $theta = $place1['lon'] - $place2['lon'];
        $dist = sin(deg2rad($place1['lat'])) * sin(deg2rad($place2['lat'])) + cos(deg2rad($place1['lat'])) * cos(deg2rad($place2['lat'])) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = round($dist * 60 * 1.1515, 3);
        //echo "miles = $miles";
        return $miles;
    }

    /**
     * Create a class that will generate a human readable time difference
     * 
     * @param string $time1 First time to compair
     * @param string $time2 Second time to compair
     * 
     * @return string human readable time
     * 
     * todo: right now this only works in the hours +/- would like to see it work with days/months/years
     */
    public function GetHumanTimeDiff($time1, $time2) {
        $time1 = date_create($time1);
        $time2 = date_create($time2);

        $interval = date_diff($time1, $time2);

        $ago = $interval->format('%R');
        $hours = $interval->format('%h');

        if ($ago == '-') {
            $diff = $hours . " hours till";
        } else {
            $diff = $hours . " hours ago";
        }

        return $diff;
    }

}
