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
        //
    }
    
    /**
     * Generates a human readable time difference
     */
    public function getHumanTimeDiff($time1, $time2)
    {
        //
    }
    
}
