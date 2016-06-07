<?php

/*
 * Code created by Kevin O'Riley -> for Vault Innovations
 * 
 * This class is to show aptitude, in php/phpUnit/git/gitHub
 */

namespace Vault;

class Interview {

    /**
     * Create a class that turns the below string into an array and reverse the words.
     * @param string $data Words to reverse
     * 
     * @return array The words in reverse also removes (.)
     */
    public function ReverseArray($data) {
       
 //$data = (string)"I want this job.";
 $data = str_replace(".","", $data);

        $split = explode(" ",$data);
$splitCount = count($split)-1;
for($i=0;$i<($splitCount /2); $i++){
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
    public function OrderArray(array $data)
    {
        //$data = ["200", "450", "2.5", "1", "505.5", "2"];

        sort($data);
        foreach($data as $key =>$val){
            $data[$key]= $val;
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
    public function GetDiffArray($data1, $data2)
    {
      
        
         $data = array_diff($data1, $data2);
         
         $data = array_values( $data );
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
    public function GetDistance($place1, $place2)
    {
        

        $theta = $place1['lon'] - $place2['lon']; 
        $dist = sin(deg2rad($place1['lat'])) * sin(deg2rad($place2['lat'])) + cos(deg2rad($place1['lat'])) * cos(deg2rad($place2['lat'])) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = round($dist *60 *1.1515,3);
        //echo "miles = $miles";
        return $miles;

        
    }
    
}
