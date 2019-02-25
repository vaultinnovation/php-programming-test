<?php

namespace Vault;

class InterviewTest 
{

    
    /**
     * takes a string, removes the punctuation,
     * divides the string up by " " and reverses the array.
     * 
     * @param string $data
     * @return array
     */
    public function stringToReverseArray ($data) {
        $data = $this->stripPunctuation($data);
        $data = explode(" ", $data);
        $data = array_reverse($data);

        return $data;
        
    }
    
    /**
     * A simple regex that will strip all known punctuation from a string.
     * 
     * @param string $data
     * @return mixed
     */
    private function stripPunctuation($data){
        $data = preg_replace("/\p{P}/u", "", $data);
        return $data;
    }
    
    
    /**
     * orders an array in decending order. Changes string values into
     * floats and ints (depending on what is necessary).
     * 
     * @param Array $array - contains an array of ints, floats or string numbers
     * @return array
     */
    public function orderArray($array) {
        asort($array);
        
        // The tests assumes the returned array is returning
        // an array of ints and floats and not strings.
        $returnArray = [];
        foreach ($array as $key => $value) {
            
            if (strpos($value, ".")) {
                $returnArray[] = (float)$value;
            } else {
                $returnArray[] = (int)$value;
            }
            
        }
        
        return $returnArray;
    }
    
    /**
     * Returns everything in $array2 that is not in $array1,
     * Returns array starting at 0
     * 
     * @param array $array1
     * @param array $array2
     * @return array
     */
    public function getArrayDiff($array1, $array2) {
        $returnArray = array_diff($array2, $array1);
        $returnArray = array_values($returnArray);
        return $returnArray;
    }
    

    
    
    /**
     * This returns the distance between two points on the earth.
     * Returns the distance in miles.
     * 
     * @param array $locationStart - needs to have 'lon' and 'lat' as keys
     * @param array $locationEnd - needs to have 'lon' and 'lat' as keys
     * @return float 
     */
    public function getDistance($locationStart, $locationEnd) {
        
        // Unpacking the location arrays
        $latitudeStart = $locationStart['lat'];
        $longitudeStart = $locationStart['lon']; 
        
        $latitudeEnd = $locationEnd['lat'];
        $longitudeEnd = $locationEnd['lon'];
        
        
        $longitudeDifference = $longitudeStart - $longitudeEnd;
        
        $distance = 
        sin(deg2rad($latitudeStart)) 
        * 
        sin(deg2rad($latitudeEnd))
        +  
        cos(deg2rad($latitudeStart))
        * 
        cos(deg2rad($latitudeEnd))
        * 
        cos(deg2rad($longitudeDifference));
        
        $distance = acos($distance);
        $distance = rad2deg($distance);

        // the approximate number of miles per degree
        $distanceInMiles = $distance * 69.1;
        

       return round($distanceInMiles, 2);       
    }
    
    
    /**
     * Takes two strings (in a datetime format) and diffs
     * the two strings. Then puts it in a human readable format
     * 
     * @param string $time1
     * @param string $time2
     * @return string
     */
    public function getHumanTimeDiff($time1, $time2) {
        $dateTime1 = new \DateTime($time1);
        $dateTime2 = new \DateTime($time2);
        $dateTimeDifference = $dateTime1->diff($dateTime2);
        
        return $this->humanTimeDiff($dateTimeDifference);
     
       
    }
    
    /**
     * Changes a date time difference into a human readable sentence
     * 
     * @param \DateTime $dateTimeDifference
     * @return string
     */
    private function humanTimeDiff($dateTimeDifference)
    {        
        $returnData = "";
        
        // This is an array mapping of the property 
        // of DateTime to a readable format
        $dateTimeValuesArray = [
            'y' => 'years',
            'm' => 'months',
            'd' => 'days',
            'h' => 'hours',
            'i' => 'minutes',
            's' => 'seconds'
            
        ];
        
        // This will take every property above and return it's 
        // value in the datetime in a readable format.
        foreach ($dateTimeValuesArray as $property => $humanReadableValue) {
            
            // PHP allows you to look up a objects property via 
            // a variable's value. 
            $propertyValue = $dateTimeDifference->$property;
            if ($propertyValue) {
                $returnData .= $propertyValue . " " . $humanReadableValue . " ";
            }
        }
        
        // if nothing is different then we can return 0 second difference
        if ($returnData === "") {
            $returnData =  "0 seconds ";
        }
        
        return $returnData . "ago";
    }
   
}