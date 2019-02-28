<?php
namespace Vault;

class TestTaker {

	// return a sentance as a reverse-array of words
	static public function ReverseArray($array) {
        $array = preg_replace("/[^A-Za-z ]/", '', $array);   // strip non-alpha chars
		$array = explode(' ', $array);   // explode into array by spaces

		return array_reverse($array);   // reverse order of array and return
	}

	// return a list of numbers sorted and typecast
	static public function OrderArray($array) {
		$array = array_map(   // with each element
			function($v){ return $v+0; },   // add zero so PHP typecasts as int/float
			$array
		);
		sort($array); // sort array ascending

		return $array; // return array
	}
	
	// get difference between two arrays as a new array
	static public function GetDiffArray($array1, $array2) {
		$temp = array_diff($array1, $array2); // get array difference
		
		return array_values($temp); // re-key and return
	}

	// return distance in miles from two lat/lon pairs
	static public function GetDistance($location1, $location2, $percision) {
		
		$theta = $location1['lon'] - $location2['lon'];   // calc thea from longitudes
		$distance = sin(deg2rad($location1['lat'])) * sin(deg2rad($location2['lat'])) +  cos(deg2rad($location1['lat'])) * cos(deg2rad($location2['lat'])) * cos(deg2rad($theta));   // calc dist from lats and theta
		$distance = acos($distance);   // get arc cosine
		$distance = rad2deg($distance);   // convert to degrees
		$distance = $distance * 69.09;   // convert to miles (1 deg = 69.09 mi)
		
		$percision = pow(10, $percision); // calc percision in powers of 10
		$distance = ceil($distance * $percision) / $percision;   // round so that least significant didget is always rounded up

		return $distance; // return distance
	}

	// return a formatted time differential given two time values
	static public function GetHumanTimeDiff($time1, $time2, $format) {
		$datetime1 = date_create($time1);   // convert to date object
		$datetime2 = date_create($time2);   // convert to date object
		$interval = date_diff($datetime1, $datetime2);   // get interval between them

		return $interval->format($format); // format and return
	}

}