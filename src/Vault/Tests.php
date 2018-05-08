<?php 
namespace Vault;

use Carbon\Carbon;

// class for testing function testReverseArray() in InterviewTest.php
class Reverse {
	
	/**
	 * Function to turn string into an array and reverse it.
	 * @param array $data
	 * @return reversed array
	 */
	public static function reverse_data (string $data): array {		
		
		$data = str_replace('.' ,'', $data); // remove period

		$data = explode(' ', $data); // turn the string into an array using spaces as the separator
		
		$data =  array_reverse($data); // reverse the array

		return $data; // return reversed array		
		
	}	
}


// class for testing function testOrderArray() in InterviewTest.php
class Sort {

	/**
	 * Function to sort an array
	 * @param array $data
	 * @return sorted array
	 */
	public static function sort_data(array $data): array  {
		
		$data = array_map(function($string){ 
			$number = strpos($string,'.') ? (float)	$string : (int) $string; 
			return $number; 
		}, $data);  // make all the values a float or int

		sort($data); // do a natural case sort on the array
	
		return  $data;  // return sorted array
	}
}


// class for testing function testGetDiffArray() in InterviewTest.php
class Difference {

	/**
	 * Function to get the difference between 2 arrays
	 * @param array $return_array
	 * @param array $compare_array
	 * @return sorted array
	 */
	public static function diff_data(array $return_array, $compare_array): array  {
		
		$data = array(); // declare empty array

		foreach ($return_array as $return_index) { // loop through and see if return_array matches any elements in compare array

			if (!in_array($return_index, $compare_array)) { // add element to array to be returned
				$data[] = $return_index;
			}
		}

		return $data; // return diff array
	}
}


// class for testing function testGetDiffArray() in InterviewTest.php
class Distance {

	/**
	 * Function to get the difference between time strings
	 * @param string $time1
	 * @param string $time2
	 * @return time diff string in hours 
	 */
	public static function distance(array $place1, array $place2): float  {
		
		// set needed vars
		$lat1 = $place1['lat'];
		$lon1 = $place1['lon'];
		$lat2 = $place2['lat'];
		$lon2 = $place2['lon'];

		// do math stuff
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		
		$fig = (int) str_pad('1', 3, '0'); // to meet the requirement I need to round up with precision
		
		return (ceil($miles * $fig) / $fig); // return distance from 2 points in miles
	}
}


// class for testing function testGetDiffArray() in InterviewTest.php
class TimeDifference {

	/**
	 * Function to get the difference between time strings
	 * @param string $time1
	 * @param string $time2
	 * @return time diff string in hours 
	 */
	public static function time_diff(string $time1, string $time2): string  {
		
		$date1 = new Carbon($time1); // new carbon object for first parameter
		$date2 = new Carbon($time2); // new carbon object for second parameter
		
		$time_diff =  $date1->diffInHours($date2); // get the difference between the 2 objects
		
		return sprintf('%d hours ago', $time_diff); // return the time difference string in hours
	}
}
