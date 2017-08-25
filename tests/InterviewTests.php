<?php

/**
 * Instructions:
 *
 * Create a class in the Vault namespace and rewrite each test to make the assertions pass.
 * NOTE: You can use any third party packages you deem necessary to complete the tests. 
 */

class InterviewTests extends PHPUnit\Framework\TestCase {

    /**
     * Create a class that turns the below string into an array and reverse the words.
     */
    public function testReverseArray()
    {
        $data = "I want this job.";

        // Code here
		$pieces = explode(" ", $pizza);
		$data = array_reverse($pieces);

        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    /**
     * Create a class that sorts the below array
     */
    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        // Code here
		
		class Arrays {
			public function sortArray($arr)
			{
				$newarray = sort($arr);
				
				return $newarray;
			}
		}

		$arraysObj = new Arrays; 

		$data = $arraysObj->sortArray($data);
		
        $this->assertTrue(1 === $data[0]);
        $this->assertTrue(2 === $data[1]);
        $this->assertTrue(2.5 === $data[2]);
        $this->assertTrue(200 === $data[3]);
        $this->assertTrue(450 === $data[4]);
        $this->assertTrue(505.5 === $data[5]);
    }
	
	

    /**
     * Create a class to determine array differences
     */
    public function testGetDiffArray()
    {
        $data1 = [1, 2, 3, 4, 5, 6, 7];
        $data2 = [2, 4, 5, 7, 8, 9, 10];

        // Code here
		class Arrays {
			public function getDifferences($arr1, $arr2)
			{
				$found = False;
				$foundArray = [];
				foreach ($arr1 as &$value1) {
					foreach ($arr2 as &$value2) {
						if ($value1 == $value2) {
							$found = True;
						}
					}
					if ($found == True){
						array_push($foundArray,$value1);
					}
				}
				
				return $foundArray;
			}
		}
		
		$arraysObj = new Arrays; 

		$data = $arraysObj->getDifferences($data2, $data1);

        $this->assertEquals([8, 9, 10], $data);

        // Code here
		
		$data = $arraysObj->getDifferences($data1, $data2);

        $this->assertEquals([1, 3, 6], $data);
    }

    /**
     * Create a class that will get the distance between two geo points
     */
    public function testGetDistance()
    {
        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

        // Code here
		class Distance {
			public function getDistance($cord1, $cord2)
			{
				
				$lat1 = $cord1['lat']
				$lon1 = $cord1['lon']
				$lat2 = $cord2['lat']
				$lon2 = $cord2['lon']

				$radius = M_PI / 180;
				return acos(sin($lat2*$radius) * sin($lat1*$radius) + cos($lat2*$radius) * cos($lat1*$radius) * cos($lon2*$radius - $lon1*$radius)) * 6371;// Kilometers

			}
		}
		
		$distanceObj = new Distance; 
		$distance = $distanceObj->getDistance($place1, $place2);

        $this->assertEquals(36.91, $distance);
    }

    /**
     * Create a class that will generate a human readable time difference
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        // Code here
		class Time {
			public function getTimeDifference($tim1, $tim2)
			{
				$to_time = strtotime($tim1);
				$from_time = strtotime($tim2);
				return round(abs($to_time - $from_time),2). " hours ago";
			}
		}
		$timeObj = new Time; 
		$timeDiff = $timeObj->getTimeDifference($time1, $time2);
		
        $this->assertEquals("3 hours ago", $timeDiff);
    }

}