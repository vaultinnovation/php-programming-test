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
        $earthRad = 6371;

        $del1 = deg2rad(floatval($location1['lat']));
        $del2 = deg2rad(floatval($location2['lat']));

        $sumdel = deg2rad(floatval($location2['lat']) - floatval($location1['lat']));
        $sumlam = deg2rad(floatval($location2['lon']) - floatval($location1['lon']));

        $harvensine = sin($sumdel/2)*sin($sumdel/2) + cos($del1)*cos($del2) * sin($sumlam/2)*sin($sumlam/2);
        $c = 2*atan2(sqrt($harvensine),sqrt(1-$harvensine));

        $distance = $earthRad*$c;

        return round($distance * 0.6214,2);
    }

    public function getTimeDifference($time1, $time2){
        $beginningTime = new \DateTime($time1);
        $endTime = new \DateTime($time2);

        $timediff = $endTime->diff($beginningTime);


        return $timediff->h." hours ago";
    }
}