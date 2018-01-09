<?php //Answers.php

namespace Vault;
use \Datetime;

class Answers {
	public function reverseArray($data) {
		$data = str_replace('.', '', $data); //remove period
		$dataArray = explode(' ', $data); //turn it into an array
		return array_reverse($dataArray); //reverse and return
	}
	
	public function orderStringNumbers($data) {
		foreach ($data as $key => $number) {
			$data[$key] = $number+0; //this casts our string to an int or float, puts it back into the array
		}
		sort($data); //sort ascending
		return $data;
	}
	
	public function arrayDifferences($d1, $d2) {
		$difference = array_values(array_diff($d1,$d2)); //array_values to reset the keys
		return $difference;
	}
	
	public function calcDistance($lat1, $lon1, $lat2, $lon2) {
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = ceil($dist * 60 * 1.1515*100)/100;
	return $miles;
	}
	
	public function getTimeDiff($t1, $t2) {		
	
		$datetime1 = new DateTime($t1);
		$datetime2 = new DateTime($t2);
		
		$interval = $datetime1->diff($datetime2);
		
		$timeDiff = $interval->format('%h hours ago');
		
		return $timeDiff;
	}
}