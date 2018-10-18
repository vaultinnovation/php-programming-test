<?php
/**
 * Created by PhpStorm.
 * User: Ruben
 * Date: 10/18/2018
 * Time: 9:20 AM
 */

namespace src\Vault;

class Vault
{
    public function reverseArray($string){
        $reversedArray = [];

        $string = preg_replace('/[.]/', '',$string);
        $array = preg_split('/\s+/',$string);

        for($i = count($array) - 1; $i >= 0; --$i){
            array_push($reversedArray, $array[$i]);
        }

        return $reversedArray;
    }

    public function sortArray($array){
        $sortedArray = [];


        if(count($array) == 0){
            return [];
        }
        else{
            foreach($array as $item){
                $found = strpos($item, '.');
                if($found) {
                    array_push($sortedArray, doubleval($item));
                }
                else{
                    array_push($sortedArray, intval($item));
                }

            }

            sort($sortedArray);
        }
        return $sortedArray;
    }

    public function getDifferenceArray($array1, $array2){
        $diffArray = [];

        while(count($array1) !== 0){
            $value = $array1[0];
            array_splice($array1, 0,1);

            if(!in_array($value, $array2)){
                array_push($diffArray, $value);
            }
        }

        return $diffArray;
    }

    public function getDistanceGeoLocation($location1, $location2){
        $distance = 0;
        return $distance;
    }

    public function getTimeDifference($time1, $time2){
        $beginningTime = new \DateTime($time1);
        $endTime = new \DateTime($time2);

        $timediff = $endTime->diff($beginningTime);


        return $timediff->h." hours ago";
    }
}