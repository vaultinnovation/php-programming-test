<?php
namespace Vault;

class TestSolutions {
    protected $name;

    public function reverseArray($a)
	{
		$a = str_replace('.','',$a);
		$b = explode(' ',$a);
        return array_reverse($b);
    }

    public function orderArray($a)
	{
		sort($a);
        return $a;
    }

	/**
     * return an array of elements contained in B not contained in A
     */
    public function getDiffArray($a,$b)
	{
        $c = array();
		$l1 = count($a);
		$l2 = count($b);
		for($i=0;$i<$l1;$i++)
		{
			$flag = true;
			for($j=0;$j<$l2;$j++)
			{
				if($a[$i] == $b[$j])
				{
					$flag = false;
				}
			}
			if($flag == true)
			{
				array_push($c,$a[$i]);
			}
		}
		return $c;
    }
	
	/**
     * use haversine formula to find geopoint distance
     */
	public function getDistance($point1,$point2)
	{
		$lat1 = $point1['lat'];
		$lon1 = $point1['lon'];
		$lat2 = $point2['lat'];
		$lon2 = $point2['lon'];
		
		$R = 3959; //radius of the earth
		$delta1 = deg2rad($lat1);
		$delta2 = deg2rad($lat2);
		$latDiff = deg2rad($lat2-$lat1);
		$lonDiff = deg2rad($lon2-$lon1);

		$a = sin($latDiff/2)*sin($latDiff/2) + cos($delta1)*cos($delta2)*sin($lonDiff/2)*sin($lonDiff/2);
		$b = 2*atan2(sqrt($a),sqrt(1-$a));
		$c = $R*$b;
		return round($c,2);
    }
	
	public function getHumanTimeDiff($a,$b)
	{
		//b = "now"
		//a = the other time

        $a = str_replace('-',':',$a);
		$a = str_replace('T',':',$a);
		$a = explode(':',$a);
		$a[2] = substr_replace($a[2],"",0,3);
		
		$b = str_replace('-',':',$b);
		$b = str_replace('T',':',$b);
		$b = explode(':',$b);
		$b[2] = substr_replace($b[2],"",0,3);
		
		$c = array();
		
		$output = "";
		
		$months = array(31,29,31,30,31,30,31,31,30,31,30,31);
		$labels_plural = array(" years"," months"," days"," hours"," minutes"," seconds");
		$labels_singular = array(" year"," month"," day"," hour"," minute"," second");
		$maximum = array("",0,365,24,60,60);
		$relation = 0;
		$component_count = 0;
		
		//convert months to days
		$l = $a[1];
		for($i=0;$i<$l;$i++){
			$a[2] += $months[$i];
		}
		$a[1] = 0;
		
		$l = $b[1];
		for($i=0;$i<$l;$i++){
			$b[2] += $months[$i];
		}
		$b[1] = 0;
		
		//get absolute differences
		for($i=0;$i<6;$i++)
		{
			if ($relation == 0)
			{
				$relation = $a[$i] - $b[$i];
			}
			array_push($c,$a[$i]-$b[$i]);
		}
		
		//carry values
		for($i=5;$i>=3;$i--)
		{
			if ($c[$i] < 0)
			{
				$c[$i-1] -= 1;
				$c[$i] = $maximum[$i] - $c[$i];
			}
		}
		if ($c[2] < 0)
		{
			$c[0] -= 1;
			$c[2] = $maximum[2] - $c[2];
		}
		
		//format with commas, spaces and "and"
		for($i=0;$i<6;$i++)
		{
			if($output != "" && $c[$i] != 0){
				$output = substr_replace($output,", ",strlen($output)-4);
			}
			if ($c[$i] == 1)
			{
				$output = $output.$c[$i];
				$output = $output.$labels_singular[$i];
				$output = $output." and";
			}
			else if($c[$i] > 0)
			{
				$output = $output.$c[$i];
				$output = $output.$labels_plural[$i];
				$output = $output." and";
			}
		}
		
		
		//specify temporal relationship
		if ($relation == 0){
			$output = "now";
		}else if($relation > 0){
			$output = substr_replace($output,"",strlen($output)-4);
			$output = $output." ago";
		}else{
			$output = substr_replace($output,"",strlen($output)-4);
			$output = $output." later";
		}
		
		return $output;
    }
}
