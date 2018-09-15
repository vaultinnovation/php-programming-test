<?php 
namespace Vault;


/**
 * Interview class
 * 
 * Methods required for valid assertions in InterviewTests
 * 
 * @author     Josh Campbell <josh.lee.campbell@gmail.com>
 */
class Interview
{
    
    
    /**
     * explodeReverseSentance
     * 
     * Explodes the passed string into an array of strings formed by using space as the delimiter 
     * and reverses the array order thus reversing the words in relation to the original string.
     * 
     * @param string $sentance  The string of words delimited by spaces to reverse.
     * @param string $characterMask  List of characters to be stripped from the beginning and end of $sentance
     *
     * @return array  The array of strings containing words in reverse order from the input sentance.
     *
     * @access public
     */
    public function explodeReverseSentance($sentance, $characterMask)
    {
        // Clean input sentance.
        $sentance = trim($sentance, $characterMask);
        
        // Explode input string into an array of strings on boundaries formed by the "space" delimiter.
        $wordsArray = explode(" ", $sentance);
        
        // Reverse array element order and return the result.
        return array_reverse($wordsArray);
    }
    
    
    /**
     * getArrayDifference
     * 
     * Gets the values in array1 that are not present in array2 and 
     * indexs the array values numerically before returning the result.
     * 
     * @param array $data1  The array to compare from.
     * @param array $data2  An array to compare against.
     *
     * @return array  Numerically indexed array of values in array1 that are not present in array2.
     *
     * @access public
     */
    public function getArrayDifference($array1, $array2)
    {
        // Get values in array1 that are not present in array2.
        $arrayDiff = array_diff($array1, $array2);
        
        // Index the array values numerically and return the result.
        return array_values($arrayDiff);
    }
    
    
}