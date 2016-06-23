<?php
namespace Vault\Vault;

class InterviewAnswers {
    const EARTH_RADIUS = 6371000; // Radius of earth in meters
    /**
     * Reverse words as delimited by spaces. Removes puncturation.
     */
    public static function reverseWords($string) {
        // Remove punctuation
        $string = preg_replace('/[^a-zA-Z0-9 ]+/', '', $string);

        return array_reverse(explode(' ', $string));
    }

    /**
     * Sorts the given array.
     */
    public static function sortArray($array) {
        sort($array);
        return $array;
    }

    /**
     * 
     */
    public static function diffArrays($array1, $array2) {
        // Equivalent to array_diff($array1, $array2)
        return array_values(array_diff($array1, $array2));
    }

    private static function haversine($theta) {
        $t = sin($theta / 2);
        return $t * $t;
    }

    /**
     * Find distance in meters between two points using the haversine formula
     */
    public static function getDistance($placeA, $placeB) {
        $thetaA = deg2rad($placeA['lat']);
        $thetaB = deg2rad($placeB['lat']);
        $deltaTheta = deg2rad($placeB['lat'] - $placeA['lat']);
        $deltaLambda = deg2rad($placeB['lon'] - $placeA['lon']);

        $a = InterviewAnswers::haversine($deltaTheta) +
            (cos($thetaA) * cos($thetaB) 
            * InterviewAnswers::haversine($deltaLambda));
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return InterviewAnswers::EARTH_RADIUS * $c;

    }
}
