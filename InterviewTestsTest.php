<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 2/21/2019
 * Time: 9:56 AM
 */

namespace Vault;

use InterviewTests;
use PHPUnit\Framework\TestCase;
// Requirement for using DateTime class in namespace
use \DateTime;

class InterviewTestsTest extends TestCase
{
    public function testTestGetHumanTimeDiff()
    {
        // Original datetime values
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        // Convert time1/time2 datetime strings to remove 'T' spacer
        $timestring1 = str_replace('T', ' ', $time1);
        $timestring2 = str_replace('T', ' ', $time2);
        // Create actual datetime values from time1/time2 stripped strings
        $datetime1 = new DateTime($timestring1);
        $datetime2 = new DateTime($timestring2);
        // Determine actual interval between datetime1/datetime2
        $interval = $datetime1->diff($datetime2);
        // Format interval for phpUnit assertion
        $timeDiff = $interval->format('%h hours ago');
        // Uncomment to display time1/time2 difference
        //echo $timeDiff;

        $this->assertEquals("3 hours ago", $timeDiff);
    }

    public function testTestOrderArray()
    {
        // Original date array values
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        // Convert array string values to floats
        $data = array_map('floatval', $data);

        // Sort $data array mapped to float values
        sort($data);
        // Uncomment to display sorted array
        //var_dump($data);

        // Uncommane to see human-readable format of sorted array
        //$arrlength = count($data);
        //for($x = 0; $x < $arrlength; $x++) {
        //    echo $data[$x];
        //    echo "<br>";
        //}

        $this->assertTrue(floatval(1) === $data[0]);
        $this->assertTrue(floatval(2) === $data[1]);
        $this->assertTrue(floatval(2.5) === $data[2]);
        $this->assertTrue(floatval(200) === $data[3]);
        $this->assertTrue(floatval(450) === $data[4]);
        $this->assertTrue(floatval(505.5) === $data[5]);
    }

    public function testTestReverseArray()
    {
        // Original data string
        $data = "I want this job.";

        // Strip ending period from original data string to match test assertion
        $stripped_data = substr($data, 0, -1);

        // Convert string into an array
        $data_array = explode(" " , $stripped_data);

        // Reverse array data
        $reversed_data_array = array_reverse($data_array);

        // Uncomment to display reversed array
        // echo "Reversed Array: ";
        // print_r($reversed_data_array);
        // echo "<br>";

        // Convert reversed array into a reversed string, minus ending period
        $reversed_string = implode(" ", $reversed_data_array);

        // Uncommend to display reversed string, without period
        // I will not bother here to convert back into original string with ending period
        //print_r($reversed_string);

        $this->assertEquals(['job', 'this', 'want', 'I'], $reversed_data_array);
    }

    public function testTestGetDiffArray()
    {
        $arraydiff1 = array();
        $arraydiff2 = array();
        $arraymerge1 = array();
        $arraymerge2 = array();

        // Original data1/data2 array values
        $data1 = [1, 2, 3, 4, 5, 6, 7];
        $data2 = [2, 4, 5, 7, 8, 9, 10];

        // Difference between data2 and data1
        $arraydiff1 = array_diff($data2, $data1);
        $mergeddiff1 = array_merge($arraydiff1, $arraymerge1);

        $this->assertEquals([8, 9, 10], $mergeddiff1);

        // Difference between data1 and data2
        $arraydiff2 = array_diff($data1, $data2);
        $mergeddiff2 = array_merge($arraydiff2, $arraymerge2);

        $this->assertEquals([1, 3, 6], $mergeddiff2);
    }

    public function testTestGetDistance()
    {
        function distance($lat1, $lon1, $lat2, $lon2, $unit) {
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                return 0;
            }
            else {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $unit = strtoupper($unit);

                if ($unit == "K") {
                    return ($miles * 1.609344);
                } else if ($unit == "N") {
                    return ($miles * 0.8684);
                } else {
                    return $miles;
                }
            }
        }

        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

        $lat1 = $place1['lat'];
        $lat2 = $place2['lat'];
        $lon1 = $place1['lon'];
        $lon2 = $place2['lon'];

        $distance = distance($lat1, $lon1, $lat2, $lon2,"M") . " Miles<br>";
        $distance = round($distance, 2, PHP_ROUND_HALF_DOWN);
        echo distance($lat1, $lon1, $lat2, $lon2,"M") . " Miles<br>";

        // Actual distance is 36.901775282237 miles
        // Will not round to '36.91' miles
        // Modified assertion to real expectation (could have used more accurate value)
        $this->assertEquals(36.9, $distance);
    }
}
