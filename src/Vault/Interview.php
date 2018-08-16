

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

    public function getHumanTimeDiff($time1, $time2)
    {

        //$time1 = "2016-06-05T12:00:00";
        //$time2 = "2016-06-05T15:00:00";

        //First Date:
        $date1 = explode("-", $time1);
        $year1 = $date1[0];
        $month1 = $date1[1];
        $date1 = explode("T", $date1[2]);
        $day1 = $date1[0];
        $date1 = explode(':', $date1[1]);
        $hour1 = $date1[0];
        $minute1 = $date1[1];
        $second1 = $date1[2];

        //Second Date:
        $date2 = explode("-", $time2);
        $year2 = $date2[0];
        $month2 = $date2[1];
        $date2 = explode("T", $date2[2]);
        $day2 = $date2[0];
        $date2 = explode(':', $date2[1]);
        $hour2 = $date2[0];
        $minute2 = $date2[1];
        $second2 = $date2[2];

        //Vars:
        $years;
        $strYears;
        $months;
        $strMonths;
        $days;
        $strDays;
        $hours;
        $strHours;
        $minutes;
        $strMinutes;
        $seconds;
        $strSeconds;

        //Compute differences:
        if (abs($year1 - $year2)> 0) {
            $years = abs($year1 - $year2);
            $strYears = $years . " years ";
        }
        if (abs($month1 - $month2)> 0) {
            $months = abs($month1 - $month2);
            $strMonths = $months . " months ";
        }

        if (abs($day1 - $day2) > 0) {
            $days = $day1 - $day2;
            $strDays = $days . " days ";
        }

        if (abs($hour1 - $hour2) > 0) {
            $hours = abs($hour1 - $hour2);
            $strHours = $hours . " hours ";
        }

        if (abs($minute1 - $minute2) > 0) {
            $minutes = abs($minute1 - $minute2);
            $strMinutes = $minutes . " minutes ";
        }

        if (abs($second1 - $econd2) > 0) {
            $seconds = abs($second1 - $second2);
            $strSeconds = $seconds . " seconds ";
        }

        $time = $strYears . $strMonths . $strDays . $strHours . $strMinutes . $strSeconds . "ago";

        return $time;
    }
}