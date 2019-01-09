<?php
namespace Vault\Vault;

/**
 * Class in the Vault namespace for Interview tests.
 */

class Interview {

    /**
     * Input: String, Optional Bool to reverse
     * Output: Splits string into a word array (word being an alphabet character)
     */
    public static function stringToWordArray(string $string, bool $reverse = FALSE)
    {
	// Split words based on localized strings
        $result = preg_match_all('/[\p{L}]+/', $string, $matches);

        // No words found
        if($result === 0) {
            return array();
        } else
        // Unexpected error, throw exception
        if($result === FALSE) {
            throw new Exception("string to word array regex failed on " . $string);
        }

        $return = $matches[0];

        if($reverse)
            $return = array_reverse($return);

        return $return;
    }

    /**
     * Input: Array of Values that are numeric to be converted and ordered
     * Output: An array of floats ordered low to high
     */
    public static function sortNumericArray(array $numberArray)
    {
        // Normalize the array if keys are weird and give
        // predictable behavior for errors
        $numberArray =  array_values($numberArray);

        foreach($numberArray as $k => $v) {
            if( !is_numeric($v) )
                throw new Exception("Input array has non-numeric " . $v);
            else
                $numberArray[$k] = $v + 0; // Dislike this hack, but it lets PHP deal with its formats in a way PHP developers are used to
        }

        sort($numberArray);

        return $numberArray;
    }
}
