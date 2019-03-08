<?php

namespace Vault\Vault;

class Helpers
{

    /**
     * Transform a sentence into a reversed array of the words. Removes any
     * periods from the end of the sentence. Useful for coding tests ;)
     *
     * @param  string  $sentence  the sentence to reverse
     * @return array
     */
    public static function reverseSentence(string $sentence): array
    {
        
        // Remove any periods from the end of the sentence
        $sentence = preg_replace("/\.$/", "", $sentence);
        
        // Split into an array by spaces
        $words = explode(" ", $sentence);
        
        // Reverse the words
        $reverseWords = array_reverse($words);
        
        return $reverseWords;
    }
    
    
    /**
     * Sorts an array of numbers in ascending order
     *
     * @param  array  $numbers  numbers to sort
     * @return array
     */
    public static function sortNumbers(array $numbers): array
    {
        
        // Convert numbers into numeric formats for comparison
        $numbers = array_map(function ($number) {
            
            // Use the identity operator to convert to a float or an int
            // https://secure.php.net/manual/en/language.operators.arithmetic.php
            return +$number;
            
        }, $numbers);
        
        // Sort the numbers
        sort($numbers);
        
        return $numbers;
    }

    
    /**
     * Find the difference between two arrays, optionally removing any keys
     * 
     * @param  array   $a             first array
     * @param  array   $b             second array
     * @param  boolean $preserveKeys  whether to keep keys or reindex the result
     * @return array                  difference between arrays
     */
    public static function arrayDifference(array $a, array $b, bool $preserveKeys = false): array
    {
        
        // Find the difference between the arrays
        $difference = array_diff($a, $b);
        
        // If preserve keys is false, then remove any keys
        if (!$preserveKeys) {
            $difference = array_values($difference);
        }
        
        return $difference;
    }
}
