<?php
/**
 *    Lightspeed Development LLC
 *
 * @author    Lightspeed Development Team <admin@lightspeeddev.com>
 * @project   vault
 * @version   ${PROJECT_VERSION}
 * @copyright Copyright (c) 2017 - Present, Lightspeed Development LLC
 * @license   Lightspeed Development License
 */

namespace Vault\Vault;


class Interview
{
	/**
	 * Convert string into a reversed array
	 *
	 * @param string $string
	 *
	 * @return array
	 */
	public function reverseArray(string $string)
	{
		$stringArr = explode(' ', trim($string, ".\t\n\r \v"));
		
		return array_reverse($stringArr);
	}
	
	/**
	 * Sort the given array
	 *
	 * @param array $array
	 *
	 * @return array
	 */
	public function orderArray(array $array)
	{
		sort($array, SORT_NUMERIC);
		return $array;
	}
	
	/**
	 * Return array of array differences
	 *
	 * @param array $array1
	 * @param array $array2
	 *
	 * @return array
	 */
	public function getDiffArray(array $array1, array $array2)
	{
		return array_diff($array1, $array2);
	}
	
	/**
	 * Haversine Formula to calc distance between spherical points
	 *
	 * @param        $point1
	 * @param        $point2
	 * @param string $unit
	 *
	 * @return float|int
	 */
	public function getDistance($point1, $point2, $unit = 'mi')
	{
		$earthRadius = [
			'km' => (float) 6371.009,
			'mi' => (float) 3959,
			'nm' => (float) 3440.069
		];
		
		$r = $earthRadius[$unit]; // metres
		$lat1 = deg2rad($point1['lat']);
		$lat2 = deg2rad($point2['lat']);
		$dLat = $lat2 - $lat1;
		$dLon = deg2rad($point2['lon'] - $point1['lon']);
		
		$a = sin($dLat/2) * sin($dLat/2) +
			cos($lat1) * cos($lat2) *
			sin($dLon/2) * sin($dLon/2);
		
		$c = 2 * atan2(sqrt($a), sqrt(1-$a));
		
		return round($r * $c, 2);
	}
	
	/**
	 * Format Human readable time
	 *
	 * @param $time1
	 * @param $time2
	 *
	 * @return bool|\DateInterval
	 */
	public function getHumanTimeDiff($time1, $time2) {
		$dt1 = new \DateTime($time1);
		$dt2 = new \DateTime($time2);
		
		return $dt1->diff($dt2)->format('%h hours ago');
	}
}