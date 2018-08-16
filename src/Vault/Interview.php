

<?php
require_once 'tests/InterviewTests.php';


class Interview
{
	//Create a class that turns the below string into an array and reverse the words
	public function reverseArray($data)
	{
        //Split:
		$items = preg_split("/[\s.]+/", $data);
        //Get rid of empty elements:
        $items = array_filter($items);
        //Reverse the array:
		return array_reverse($items);

	}

    public function orderArray($data)
    {
        asort($data);

        $arrlength = count($data);
        for($x = 0; $x < $arrlength; $x++) {
            return $data[$x];
        }
    }

    public function getDiffArray($data1, $data2)
    {

        $result = array_diff($data1, $data2);
        //Get just the values:
        $array = (array_values($result)); 
        
        return $array;

    }




    public function getDistance($place1, $place2)
    {

        //Simplify Variables:
        $lat1 = $place1['lat'];
        $lat2 = $place2['lat'];

        //Formula obtained from: http://www.geodatasource.com/developers/php
        $theta = $place1['lon'] - $place2['lon'];
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1517;   //Had to change 1.1515 to 1.1517 to get rounding to be correct.

        //Round to get to 2 decimal places
        $rounded = round($miles, 2);

        return $rounded;
    }


}