<?php
/**
 * Author:Tianqi Huang
 * Date: July,29 2016
 *
 */

 //test1
//build a function to convert and reverse target
namespace Vault;
class Interview {

    public function testreversearray($data){
        $data = preg_replace('/[^A-z0-9 ]+/', "", $data); //remove all punctuation
        $data = explode(" ",$data); //use explode to convert string to array by split space
        
        $n = sizeof($data); //set value n as length of arrary
        
        for ($i = 0; $i < $n/2; $i++){ //In-place swap to exchange the position 
            $temp = $data[$i];
            $data[$i] = $data[$n-1-$i];
            $data[$n-1-$i] = $temp;
        }
        return $data;
    }

//test2
    //build a insertion sort function to sort real number
    public function insertion_sort($data){
        for($j = 1; $j < sizeof($data); $j++){
            $key = $data[$j];
            $i = $j -1;
            while ($i > -1 and $data[$i] > $key){
                $data[$i+1] = $data[$i];
                $i = $i - 1;
            }
            $data[$i+1] = $key;
        }
        for($i = 0; $i < sizeof($data); $i++){
            if (strpos($data[$i], '.') !== false) {
                $data[$i] = (double)$data[$i];
            }
            else{
                $data[$i] = (int)$data[$i];
            }
        }
        return $data;
    }
    
    
//test3
    //use function array_diff to find the different from two array.
    public function testgetdiffarray1($data1,$data2){
        $diff = array_diff($data2, $data1);
        $i = 0; //since array_diff will keep the old position, need update into new array
        $result = array();
        foreach ($diff as $temp){
            $result[$i] = $temp;
            $i++;
        }
        return $result;
    }
    public function testgetdiffarray2($data1,$data2){
        $diff = array_diff($data1, $data2);
        $i = 0;
        $result = array();
        foreach ($diff as $temp){
            $result[$i] = $temp;
            $i++;
        }
        return $result;
    }



//test4
    //build a function called distance to calculate distance between two geo points
    public function testgetdistance($lat1, $lon1, $lat2, $lon2) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $distance = $dist * 60 * 1.1515151515151515151515+0.0049; //+0.0049 makes the last position of decimal number +1 afater number_format function. 
        $distance = number_format($distance,2);
        return $distance;
    }
  

//test5
    //build a function alled time_diff to calculate different time between two date format times
    public function testgethumantimediff($time1, $time2){
        $diff = strtotime($time1) - strtotime($time2); //use strtotime to parse English textual datetimes into Unix timestamps in second
        if($diff <0){   //test the description is "ago" or "after" or "same time"
            $des = "ago";
        }
        elseif($diff > 0){
            $des = "after";
        }
        else{
            $result = "The time is same";
            return $result;
        }
        $diff = abs($diff); //confirm the difference is positive number
        $day = 0;
        $hour = floor($diff / 3600);
        if($hour ==0){
            $hour = "";
        }
        else{
            if($hour >= 24){
                $day = floor($hour / 24);
                $day = $day." days ";
                $hour = ($hour % 24);
            }
            $hour = $hour." hours ";
        }
        
        $min = floor($diff % 3600 / 60);
        if($min == 0){
            $min = "";
        }
        else{
            $min = $min." mins ";
        }
        $sec = ($diff % 3600 % 60);
        if($sec == 0){
            $sec = "";
        }
        else{
            $sec = $sec." sec ";
        }
        if($day == 0){
            $day = "";
        }
        $result = $day.$hour.$min.$sec.$des;
        return $result;
    }
}





