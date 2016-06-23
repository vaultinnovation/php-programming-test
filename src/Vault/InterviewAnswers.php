<?php
namespace Vault\Vault;

class InterviewAnswers {
    const EARTH_RADIUS = 6371000; // Radius of earth in meters
    const TIME_COMPONENTS = [
        'y' => 'year',
        'm' => 'month',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'seconds',
    ];
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

    public static function getHumanTimeDiff($time1, $time2) {
        $dt1 = new \DateTime($time1);
        $dt2 = new \DateTime($time2);
        $diff = $dt1->diff($dt2);
        $verbose_components = [];

        // Format non-zero components
        foreach (InterviewAnswers::TIME_COMPONENTS as $key => $label) {
            $val = $diff->$key;
            if ($val !== 0) {
                // Pluralize
                if ($val === 1) {
                    $component = $val . ' ' . $label;
                } else {
                    $component = $val . ' ' . $label . 's';
                }
                $verbose_components[] = $component;
            }
        }

        $verbose_delta = '';
        if (count($verbose_components) === 1) {
            $verbose_delta = $verbose_components[0];
        } else if (count($verbose_components) === 2) {
            $verbose_delta = $verbose_components[0] . 
                ' and ' . $verbose_components[1];
        } else {
            $leading = array_slice($verbose_components, 0, -1);
            $verbose_delta = implode(', ', $leading) . ', and ' . end($verbose_components);
        }

        if ($diff->invert) {
            return "$verbose_delta from now";
        } else {
            return "$verbose_delta ago";
        }
    }
}
