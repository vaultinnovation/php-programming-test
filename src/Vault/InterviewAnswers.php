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
}
