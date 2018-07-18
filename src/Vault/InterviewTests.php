<?php
// Classes were not needed. 

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

        // Get rid of the period!
        $data = str_replace(".", "", $data);
        $data = explode(" ", $data);
        $data = array_reverse($data);

        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    /**
     * Create a class that sorts the below array
     */
    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        sort($data);

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

        $data = array_diff($data2, $data1);

        $this->assertEquals([8, 9, 10], $data);

        $data = array_diff($data1, $data2);

        $this->assertEquals([1, 3, 6], $data);
    }

    /**
     * Create a class that will get the distance between two geo points
     */
    public function testGetDistance()
    {
        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];
        $lonFrom = deg2rad($place1['lon']);
        $lonTo = deg2rad($place2['lon']);
        $latFrom = deg2rad($place1['lat']);
        $latTo = deg2rad($place2['lat']);
        
        //Haversine Formula
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        $earthRadius = 3958.756;
             
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        $distance = $angle * $earthRadius;
        $distance = $this->ceiling($distance, 0.01);
        
        $this->assertEquals(36.91, $distance);
    }

    /**
     * Create a class that will generate a human readable time difference
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";
        $timeDiff = $this->helpTheHumans($time1, $time2);

        $this->assertEquals("3 hours ago", $timeDiff);
    }
    
    /*
     * Utility function that rounds up the hundredths decimal : http://php.net/manual/en/function.ceil.php
     */
	function ceiling($number, $significance)
    {
        return (is_numeric($number) && is_numeric($significance)) ? (ceil($number / $significance) * $significance) : false;
    }
    
    /*
     * Utility function that takes two datetimes & one precision (minutes, hours, etc) to show the difference between times : https://gist.github.com/ozh/8169202
     */
    public function helpTheHumans($time1, $time2, $precision = 2)
    {

    // If not numeric then convert timestamps

    if (!is_int($time1))
        {
        $time1 = strtotime($time1);
        }

    if (!is_int($time2))
        {
        $time2 = strtotime($time2);
        }

    // If time1 > time2 then swap the 2 values

    if ($time1 > $time2)
        {
        list($time1, $time2) = array(
            $time2,
            $time1
        );
        }

    // Set up intervals and diffs arrays

    $intervals = array(
        'year',
        'month',
        'day',
        'hour',
        'minute',
        'second'
    );
    $diffs = array();
    foreach($intervals as $interval)
        {

        // Create temp time from time1 and interval

        $ttime = strtotime('+1 ' . $interval, $time1);

        // Set initial values

        $add = 1;
        $looped = 0;

        // Loop until temp time is smaller than time2

        while ($time2 >= $ttime)
            {

            // Create new temp time from time1 and interval

            $add++;
            $ttime = strtotime("+" . $add . " " . $interval, $time1);
            $looped++;
            }

        $time1 = strtotime("+" . $looped . " " . $interval, $time1);
        $diffs[$interval] = $looped;
        }

    $count = 0;
    $times = array();
    foreach($diffs as $interval => $value)
        {

        // Break if we have needed precission

        if ($count >= $precision)
            {
            break;
            }

        // Add value and interval if value is bigger than 0

        if ($value > 0)
            {
            if ($value != 1)
                {
                $interval.= "s ago";
                }

            // Add value and interval to times array

            $times[] = $value . " " . $interval;
            $count++;
            }
        }

    // Return string with times

    return implode(", ", $times);
    }
}