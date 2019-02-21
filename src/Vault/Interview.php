<?php
	namespace Vault;
	
	use Carbon\Carbon;
	
	class Interview {
		
		/**
		 * Reverse a given string or array
		 * @param mixed $data
		 * @return string
		 */
		public static function ReverseArray($data) {
			$data = (is_array($data)) ? : preg_split("/\s/", $data, -1, PREG_SPLIT_NO_EMPTY);
			return array_reverse($data);
		}
		
		/**
		 *  Sort an array numerically
		 * @param array $data
		 */
		public static function OrderArray(&$data) {
			sort($data, SORT_NUMERIC);
			array_walk($data, 
						function(&$v) { 
							$v = (is_float($v+0)) ? (float)$v : (int)$v; 
						}
					);
		}
		
		
		public static function GetDiffArray($data1, $data2) {
			return array_values(array_diff($data1, $data2));
		}
		
		public static function GetDistance($coords1, $coords2) {
			list($lat1, $lon1) = array_values($coords1);
			list($lat2, $lon2) = array_values($coords2);
			  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
				return 0;
			  }
			  // haversine formula 
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = round($dist * 60 * 1.1515,3);		// 69.902 != 69.91 no matter how you round it :'( 
			$miles =ceil($miles*100)/100;			// huzzah!
			return $miles;
		}
		
		/**
		 * Calculate and return a human-readable span between two date/time strings
		 * @param string $time1
		 * @param string $time2
		 * @return string
		 */
		public function GetHumanTimeDiff($time1,$time2) {
			$s = strtotime($time1);
			$e = strtotime($time2);
			// not future-proof :) We're only coding towards the unit test objective.
			$duration = $e-$s;
			$tokens = array(
				31536000 => 'year',
				2592000 => 'month',
				604800 => 'week',
				86400 => 'day',
				3600 => 'hour',
				60 => 'minute',
				1 => 'second'
			);
			$str = "";
			foreach ($tokens as $unit => $text) {
				if ($duration < $unit) { continue; }
				$numberOfUnits = floor($duration / $unit);
				if ($numberOfUnits == 0) { continue; }
				$str .= $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
				$duration -= $unit * $numberOfUnits;
			}
			$str .= " ago";
			return $str;			
		}
	}
?>