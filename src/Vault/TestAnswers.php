<?php
namespace Vault\Vault\TestAnswers;

/**
 * A class with methods to pass the TestInterview
 */
class TestAnswers extends PHPUnit\Framework\TestCase {

	/**
	 * Create a class that turns the below string into an array and reverse the words.
	 */
	public function testReverseArray()
	{
		$data = "I want this job.";
		$data_array = explode(" ", $data);
		$data = [];
		for ($i = count($data_array) - 1; $i >= 0; $i--){
			array_push($data, $data_array[$i]);
		}

		$this->assertEquals(['job', 'this', 'want', 'I'], $data);
	}

	/**
	 * A method that sorts an array
	 */
	public function testOrderArray()
	{
		$data = ["200", "450", "2.5", "1", "505.5", "2"];
		$data = array_map( function ($value){
                    return ($value == (int)$value) ? (int)$value : (float)$value;
                },$data);

		usort($data, function ($a, $b){
			return $a > $b ? 1 : -1;
        });
        
		$this->assertTrue(1 === $data[0]);
		$this->assertTrue(2 === $data[1]);
		$this->assertTrue(2.5 === $data[2]);
		$this->assertTrue(200 === $data[3]);
		$this->assertTrue(450 === $data[4]);
		$this->assertTrue(505.5 === $data[5]);
	}

	/**
	 * A method determining array differences
	 */
	public function testGetDiffArray()
	{
		$data1 = [1, 2, 3, 4, 5, 6, 7];
		$data2 = [2, 4, 5, 7, 8, 9, 10];
        $data = array_values(array_diff($data2, $data1));
        
        $this->assertEquals([8, 9, 10], $data);
        
        $data = array_values(array_diff($data1, $data2));
        
		$this->assertEquals([1, 3, 6], $data);
	}

	/**
	 * A method that will get the distance between two geo points
	 */
	public function testGetDistance()
	{
		$place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];
        
		$lat1 = $place1['lat'];
		$lat2 = $place2['lat'];
		$lon1 = $place1['lon'];
		$lon2 = $place2['lon'];
        $theta = $lon1 - $lon2;
        
		$dist = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
		$dist = acos($dist);
        $dist = rad2deg($dist);
        
        $distance = round($dist * 60 * 1.1515, 2);
        
		$this->assertEquals(36.91, $distance);
	}

	/**
	 * A method to generate human readable time difference
	 */
	public function testGetHumanTimeDiff()
	{
		$time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";
        
		$time1_obj = date_create($time1);
		$time2_obj = date_create($time2);
        $time_diff = date_diff($time1_obj, $time2_obj);
        
        $years = $months = $days = $hours = $seconds = "";
        
		if ($time_diff->y > 0) {
			$years = $time_diff->y > 1 ? "$time_diff->y years " : "$time_diff->y year ";
		} elseif ($time_diff->m > 0) {
			$months = $time_diff->m > 1 ? "$time_diff->m months " : "$time_diff->m month ";
		} else if ($time_diff->d > 0) {
			$days = $time_diff->d > 1 ? " $time_diff->d days " : "$time_diff->d days ";
		} else if ($time_diff->h > 0) {
			$hours = $time_diff->h > 1 ? "$time_diff->h hours " : "$time_diff->h hour ";
		} else {
			$seconds = $time_diff->i > 1 ? "$time_diff->i seconds " : "$time_diff->i second ";
		}

		$timeDiff = $years . $months . $days . $hours . $seconds . "ago";
		$this->assertEquals("3 hours ago", $timeDiff);
	}
}

?>
