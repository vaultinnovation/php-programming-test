<?php

namespace src\Vault;

class Utility {
    
    /**
     * Turns a string into an array and reverses the words
     */
    public function reverseArray($data)
    {
        $dataArray = explode($data);
        
        return array_reverse($dataArray);
    }
    
    /**
     * Sorts an array
     */
    public function orderArray($dataArray)
    {
        return sort($dataArray);
    }
    
    /**
     * Determines array differences
     */
    public function getDiffArray($array1, $array2)
    {
        return array_diff($array1, $array2);
    }
    
    /**
     * Determines the distance between two geo points
     */
    public function getDistance($place1, $place2)
    {
        $lat1 = $place1['lat'];
        $lon1 = $place1['lon'];
        $lat2 = $place2['lat'];
        $lon2 = $place2['lon'];
        
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        
        return $miles;
    }
    
    /**
     * Generates a human readable time difference
     */
    public function getHumanTimeDiff($time1, $time2)
    {
        $timeDiff = abs(strtotime($time2) - strtotime($time1));
        $timeDiff = $timeDiff / (60 * 60) . " hours ago";
        
        return $timeDiff;
    }
    
}
