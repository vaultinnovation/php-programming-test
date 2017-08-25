<?php

namespace Vault;

class Vault extends InterviewQuestions
{
    use InterviewCheats;
    function __construct()
    {
        //Constructor code here... if I had any!
    }


    /**
     * Turns a string into an array using the provided delimiter. Removes punctuation
     * @param $string String
     */
    static function stringToReverseArray($string, $delimeter=" "){
        $array = explode($delimeter, preg_replace("/[^a-zA-Z ]+/", "", $string));
        $array = array_reverse($array);
        return $array;
    }

    /**
     * Returns an array of floats sorted min to max
     * @param $array
     */
    static function orderNumericalArray($array){
        $arrayWithNumbers = Vault::makeMeRealNumbers($array);
        sort($arrayWithNumbers);
        return $arrayWithNumbers;
    }

    /**
     * Returns the elements that are contained in the second array that are not in the first array.
     * @param $arr1 array
     * @param $arr2 array
     * @return array
     */
    static function arrayDiff($arr1, $arr2){
        $response = array_diff($arr1, $arr2);
        return array_values($response);
    }


    /**
     * @param $lat1 String First point latitude
     * @param $lon1 String First point longitude
     * @param $lat2 String Second point latitude
     * @param $lon2 String Second point longitude
     * @return float precision 2
     */
    static function getDistance($lat1, $lon1, $lat2, $lon2){
        $distance = self::vincentyGreatCircleDistance(floatval($lat1), floatval($lon1), floatval($lat2), floatval($lon2));
        return self::roundUp(($distance/1609.344), 2);
    }

    static function getHumanTimeDiff($time1, $time2){
        $totalHours = self::getHoursDifference($time1, $time2);
        $readableTime = "$totalHours hours";
        if(strtotime($time1) >= strtotime($time2)){
            $readableTime .= ' from now';
        }elseif(strtotime($time1) < strtotime($time2)){
            $readableTime .= ' ago';
        }
        return $readableTime;
    }
}


class InterviewQuestions{
    //Just because, does nothing

}

trait InterviewCheats{
    protected static function reverseArray(&$array){
        array_reverse($array);
    }

    /**
     * @param $array array the array to convert
     * @return string concatenated string
     */
    protected static function arrayToString($array){
        return implode("", $array);
    }

    /**
     * Note -- Copied from stackoverflow
     * Calculates the great-circle distance between two points, with
     * the Vincenty formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    protected static function vincentyGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

    /**
     * @param $time1 string First time -- provided in datetime readable format
     * @param $time2 string Second time -- provided in datetime readable format
     * @return int rounded(ceil) total number of hours difference between the two provided time strings
     */
    protected static function getHoursDifference($time1, $time2){
        $dateTime1 = (new \DateTime())->setTimestamp(strtotime($time1));
        $dateTime2 = (new \DateTime())->setTimestamp(strtotime($time2));
        $diff = $dateTime2->diff($dateTime1);
        $totalHours = ceil($diff->h + ($diff->days*24));
        return $totalHours;
    }

    /**
     * This turns an array of strings into an array of floats.. .
     * @param $array array now with floats!
     */
    protected static function makeMeRealNumbers($array){
        $result = array();
        foreach($array as $key=>$val){
            $result[$key] = ($val == intval($val))?(intval($val)):(floatval($val));
        }
        return $result;
    }

    /**
     * Decimal rounding, always rounds up
     * @param $number double
     * @param $decimalPrecision
     * @return float|string
     */
    protected static function roundUp($number, $decimalPrecision){
        $multiplicationFactor = pow(10, $decimalPrecision);
        $beforeDecimal = floor($number);
        $afterDecimal = ceil(($number-floor($number))*($multiplicationFactor));
        if($beforeDecimal == $number){
            return $beforeDecimal;
        }else{
            return $beforeDecimal.".".$afterDecimal;
        }
    }

}