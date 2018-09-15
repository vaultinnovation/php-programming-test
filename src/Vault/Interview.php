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
    

}