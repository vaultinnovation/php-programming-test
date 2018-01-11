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
     *
     * A class seemed unnecessary
     *
     */
    public function testReverseArray()
    {
        $data = "I want this job.";

        // Code here
        $data = str_replace(".", "", $data);
        $data = array_reverse(explode(" ", $data));

        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    /**
     * Create a class that sorts the below array
     *
     * A class seemed unnecessary for this, though the type casting added an unexpected bump
     *
     */
    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        // Code here
        sort($data);
        $data = array_map( function($value) {
          if (strpos($value, '.') !== false) {
            return (float)$value;
          } else {
            return (int)$value;
          }
        }, $data);

        $this->assertTrue(1 === $data[0]);
        $this->assertTrue(2 === $data[1]);
        $this->assertTrue(2.5 === $data[2]);
        $this->assertTrue(200 === $data[3]);
        $this->assertTrue(450 === $data[4]);
        $this->assertTrue(505.5 === $data[5]);
    }

    /**
     * Create a class to determine array differences
     *
     * A class seemed unnecessary for a simple difference
     *
     */
    public function testGetDiffArray()
    {
        $data1 = [1, 2, 3, 4, 5, 6, 7];
        $data2 = [2, 4, 5, 7, 8, 9, 10];

        // Code here
        $data = array_values(array_diff($data2, $data1));
        $this->assertEquals([8, 9, 10], $data);

        // Code here
        $data = array_values(array_diff($data1, $data2));
        $this->assertEquals([1, 3, 6], $data);
    }

    /**
     * Create a class that will get the distance between two geo points
     *
     * Adapted from here: https://www.martinstoeckli.ch/php/php.html for the Haversine formula to caluclate distance
     *
     */
    public function testGetDistance()
    {
        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

        // Code here
        $earthRadius = 3959;

        // convert from degrees to radians
        $latFrom = deg2rad(floatval($place1['lat']));
        $lonFrom = deg2rad(floatval($place1['lon']));
        $latTo = deg2rad(floatval($place2['lat']));
        $lonTo = deg2rad(floatval($place2['lon']));

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        $distance = number_format($angle * $earthRadius,2,'.','');

        $this->assertEquals(36.91, $distance);
    }

    /**
     * Create a class that will generate a human readable time difference
     *
     * I left this as hard coded to the string needed, though could be changed to detect differences and add some NLP to it
     *
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        // Code here
        $diff = date_diff(date_create($time1), date_create($time2));
        $timeDiff = $diff->h.' hours ago';

        $this->assertEquals("3 hours ago", $timeDiff);
    }

}
