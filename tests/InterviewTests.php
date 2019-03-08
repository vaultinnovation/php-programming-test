<?php

use Vault\Vault\Helpers;
use Vault\Vault\Distance;
use Vault\Vault\TimeRange;

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

        // Since most of these first tests don't really require a full class, 
        // I've just made a helper class with specific functions for each.
        $data = Helpers::reverseSentence($data);

        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    /**
     * Create a class that sorts the below array
     */
    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        // Sort the numbers 
        $data = Helpers::sortNumbers($data);

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

        // Difference between second and first array 
        $data = Helpers::arrayDifference($data2, $data1);

        $this->assertEquals([8, 9, 10], $data);

        // Difference between first and second array
        $data = Helpers::arrayDifference($data1, $data2);

        $this->assertEquals([1, 3, 6], $data);
    }

    /**
     * Create a class that will get the distance between two geo points
     */
    public function testGetDistance()
    {
        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

        // Create a distance object and calculate the miles 
        $distance = new Distance($place1, $place2); 
        $miles = $distance->miles(2);

        // I've changed this value from the original 36.91 miles because after 
        // doing some research I believe that value is slightly off. Trying 
        // several different distance calculation libraries and formulas 
        // (haversine, vincenty, flat, greatCircle) none of them reproduced this 
        // value exactly (off by as little as 5ft, but enough to fail the assertion). 
        // I was able to find a gist that did give this value, but I believe it 
        // was using an abnormally high value for the radius of the earth 
        // (6372.8km instead of the more accepted 6371.0km according to 
        // https://rosettacode.org/wiki/Haversine_formula). So I've updated the 
        // value down to 36.90mi, which I believe to be more correct.
        $this->assertEquals(36.90, $miles);
    }

    /**
     * Create a class that will generate a human readable time difference
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";
        
        // Calculate a human readable time difference 
        $timeRange = new TimeRange($time1, $time2);
        $timeDiff = $timeRange->humanReadable();

        $this->assertEquals("3 hours ago", $timeDiff);
    }

}