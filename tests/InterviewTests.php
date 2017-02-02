<?php
	class Reverse 
	{
		public function breakApart($text)
		{
			$indevidual = array();
			$index = 0;
			for ($i = 0; $i < $text.count; $i++)
			{
				if ($indevidual[index] == ' ')
				{
					$indevidual[] = $text[i];
				}
				else
				{
					$indevidual[index] = $indevidual[index] . $text[$i];
				}
			}
			return $indevidual;
		}
		
		public function flip($text)
		{
			$reverse = array();
			for ($i = 0; $i < $text.count; $i++)
			{
				$reverse[] = $text[$text.count - $i - 1];
			}
			return $reverse;
		}
	}
	
	class Group
	{
		private $data1;
		private $data2;
		private $union;
		private $result;
		
		public function getData1($element){
			$data1 = $element;
		}
		public function getData2($element){
			$data2 = $element;
		}
		
		public function union()
		{
			for ($i = 0; $i < $data1.count; $i++)
			{
				if(in_array($data1[$i], $data2)){
					$union[] = $data1;
				}
			}
		}
		
		public function difference($differ)
		{
			for ($i = 0; $i < $differ; $i++)
			{
				if(!in_array($differ[$i], $union))
				{
					$result[] = $differ[$i];
				}
			}
		}
	}

	class geoDistance
	{
		private $lat1 = 0.0;
		private $lon1 = 0.0;
		private $lat2 = 0.0;
		private $lon2 = 0.0;
		
		public function getLatOne($cord)
		{
			$lat1 = (int)$cord;
		}
		public function getLonOne($cord)
		{
			$lon1 = (int)$cord;
		}
		
		public function getLattwo($cord)
		{
			$lat2 = (int)$cord;
		}
		public function getLonTwo($cord)
		{
			$lon2 = (int)$cord;
		}
		
		public function distance()
		{
			$xDistance = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(degr2rad($lat2)) * cos(deg2rad($xDistance));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			return $miles;
		}
	}
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
		$reverse = Reverse();
        $data = "I want this job.";
		$data = $reverse.breakApart($data);
		$data = $reverse.flip($data);
        

        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    /**
     * Create a class that sorts the below array
     */
	private function sorting($sort)
	{
		for($i = 0; $i < $sort.count; $i++)
		{
			for ($j = $i; $j + 1 < $sort.count; $j++)
			{
				if($sort[$j] > $sort[$j + 1])
				{
					$hold = $sort[$j];
					$sort[$j] = $sort[$j + 1];
					$sort[$j + 1] = $hold; 
				}
			}
		}
		return $sort;
	}
	
    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        // Code here
		$data = sorting($sort);

		//did not use a class
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
		$group = Group();
		$group.getData1($data1);
		$group.getData2($data2);
		$group.union();
		$data = $group.differ($data2);
		

        $this->assertEquals([8, 9, 10], $data);

        // Code here
		$data = $group.differ($data1);
		
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
		$dist = geoDistance();
		$dist.getLatOne($place1['lat']);
		$dist.getLonOne($place1['lon']);
		$dist.getLatTwo($place2['lat']);
		$dist.getLonTwo($place2['lon']);
		$distance = $dist.distance();

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
		$start = new DateTime($time1);
		$end = new DateTime($time2);
		$timeDiff = (string)date_diff($start, $end) . "hours ago";
		//no class used
        $this->assertEquals("3 hours ago", $timeDiff);
    }

}?>
