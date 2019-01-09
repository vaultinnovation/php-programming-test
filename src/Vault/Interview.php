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
    public function stringToWordArray(string $string, bool $reverse = FALSE)
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
}
