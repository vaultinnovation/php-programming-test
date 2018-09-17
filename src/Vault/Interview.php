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
     * castSortArray
     * 
     * Set each array value to the proper type and sort the values numerically.
     * 
     * @param array $array  The array of strings to cast and sort.
     *
     * @return array  Numerically indexed array of sorted values wiht proper types.
     *
     * @access public
     */
    public function castSortArray($array)
    {

        // Loop through each array value
        for( $i = 0; $i < count( $array ); $i++ )
        {
            // If there is a . assume float type, otherwise assume integer
            if (strpos($array[$i], '.')) {
                settype($array[$i], "float");
            } else {
                settype($array[$i], "integer");
            }
        }
        
        // Sort the array numericly
        sort($array, SORT_NUMERIC);

        return $array;
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
    
    
    /**
     * getDistance
     * 
     * Calculates the great-circle distance between two points, with the Haversine formula.
     * Original formula by Martin Stoeckli https://www.martinstoeckli.ch/php/php.html#great_circle_dist
     * 
     * @param float $latFrom Latitude of start point in [deg decimal].
     * @param float $lonFrom Longitude of start point in [deg decimal].
     * @param float $latTo Latitude of target point in [deg decimal].
     * @param float $lonTo Longitude of target point in [deg decimal].
     * @param integer $precision Optional number of decimal digits to round to. Default two decimal places.
     * @param float $earthRadius Mean earth radius. Earth radius unit determines output unit. Default in miles.
     * 
     * @return float Distance between points. Default in miles. (Same unit as earthRadius.)
     *
     * @access public
     */
    public function getDistance($latFrom, $lonFrom, $latTo, $lonTo, $precision = 2, $earthRadius = 3959)
    {   
        // Convert lat/lon degrees to radians
        $latFrom = deg2rad($latFrom);
        $lonFrom = deg2rad($lonFrom);
        $latTo = deg2rad($latTo);
        $lonTo = deg2rad($lonTo);

        // Calculate lat/lon deltas
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        // Calculate angles of spherical triangle
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        
        // Calculate distance with anlge and sphere radius then return (rounded) result.
        return round($angle * $earthRadius, $precision);
    }
    
    
}