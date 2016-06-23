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
     *
     * In actual practice would of course use sort($array) instead.
     */
    public static function orderArray($array) {
        return InterviewAnswers::mergeSortImp($array);
    }

    private static function mergeSortImp($a) {
        // Implements simple merge-sort algorithm, this implementation isn't likely to 
        // be ideal in php due to memory allocation, but it's an interesting way to do it.
        if (count($a) <= 1) {
            return $a;
        }

        $left = InterviewAnswers::mergeSortImp(array_slice($a, 0, count($a) / 2));
        $right = InterviewAnswers::mergeSortImp(array_slice($a, count($a) / 2));
        return InterviewAnswers::merge($left, $right);
    }

    private static function merge($a, $b) {
        $merged = [];
        $i = 0;
        $j = 0;
        while(True) {
            if ($i >= count($a) && $j >= count($b)) {
                break;
            }

            if (!isset($a[$i])) {
                $merged[] = $b[$j];
                $j++;
            } else if (!isset($b[$j])) {
                $merged[] = $a[$i];
                $i++;
            } else if ($a[$i] <= $b[$j]) {
                $merged[] = $a[$i];
                $i++;
            } else {
                $merged[] = $b[$j];
                $j++;
            }
        }

        return $merged;
    }


    /**
     * Returns list of values in $array1 that are not in $array2
     *
     * Equivalent to array_values(array_diff($array1, $array2))
     */
    public static function diffArrays($array1, $array2) {
        $result = [];

        // Build hash lookups for O(n) complexity
        $lookup = [];
        foreach ($array2 as $val) {
            $lookup[$val] = true;
        }

        foreach ($array1 as $val) {
            if (!isset($lookup[$val])) {
                $results[] = $val;
            }
        }
        return $results;
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

    /**
     * Get human readable time difference
     */
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

        // Put them together into an english sentance
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

        // Is date in future or past
        if ($diff->invert) {
            return "$verbose_delta from now";
        } else {
            return "$verbose_delta ago";
        }
    }
}
