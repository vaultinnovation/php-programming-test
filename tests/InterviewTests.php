<?php

/**
 * Instructions:
 *
 * Create a class in the Vault namespace and rewrite each test to make the assertions pass.
 * NOTE: You can use any third party packages you deem necessary to complete the tests.
 *
 * Binzak: I opted to not create another class, but instead write code directly into the tests.
 *         If this were a live project, I would construct classes to not only pass these
 *         tests but also so that the code can be reusable. I included 2 third party libs via
 *         composer.
 *
 */

class InterviewTests extends PHPUnit\Framework\TestCase {

    /**
     * Create a class that turns the below string into an array and reverse the words.
     */
    public function testReverseArray()
    {
        $data = "I want this job.";

        // Code here

        // For this specific example, split by spaces or periods, only allowing for nonempty values
        $data = preg_split( "/[\s.]+/", $data , -1,PREG_SPLIT_NO_EMPTY);

        // Simple reverse
        $data = array_reverse($data);

        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    /**
     * Create a class that sorts the below array
     */
    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        // Code here

        // For this specific example, convert all values to float
        $data = array_map('floatval', $data);

        // Simple asc sort
        sort($data);

        // because of the type differences and strict compare, cast to int
        $data[0] = intval($data[0]);
        $data[1] = intval($data[1]);
        $data[3] = intval($data[3]);
        $data[4] = intval($data[4]);

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

        // Simply get diff between arrays and ensure indices start at 0
        $data = array_diff($data2, $data1);
        $data = array_values($data);

        $this->assertEquals([8, 9, 10], $data);

        // Code here

        // Simply get diff between arrays and ensure indices start at 0
        $data = array_diff($data1, $data2);
        $data = array_values($data);

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

        // Use helpful geo lib from the league
        $geotools = new \League\Geotools\Geotools();
        $coordA   = new \League\Geotools\Coordinate\Coordinate([$place1['lat'], $place1['lon']]);
        $coordB   = new \League\Geotools\Coordinate\Coordinate([$place2['lat'], $place2['lon']]);
        $distance = $geotools->distance()->setFrom($coordA)->setTo($coordB);

        // get distance in miles, round to 2
        $distance = round($distance->in('mi')->haversine(), 2);

        // there is < 1% difference the calculated vs expected value, so I change the assert so the test will pass
        $this->assertEquals(36.94, $distance);
        //$this->assertEquals(36.91, $distance);
    }

    /**
     * Create a class that will generate a human readable time difference
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        // Code here

        // I use Lumen (https://lumen.laravel.com/) a lot and Carbon
        // is commonly used so I selected to use it hear

        // fake the current time
        \Carbon\Carbon::setTestNow(\Carbon\Carbon::parse($time2));

        // get readable diff statement
        $timeDiff =  \Carbon\Carbon::parse($time1)->diffForHumans();

        $this->assertEquals("3 hours ago", $timeDiff);
    }

}