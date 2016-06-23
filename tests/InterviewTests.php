<?php

/**
 * Instructions:
 *
 * Create a class in the Vault namespace and rewrite each test to make the assertions pass.
 * NOTE: You can use any third party packages you deem necessary to complete the tests. 
 */

use \Vault\Vault\InterviewAnswers;

class InterviewTests extends phpunit\framework\TestCase {

    /**
     * Create a class that turns the below string into an array and reverse the words.
     */
    public function testReverseArray()
    {
        $data = "I want this job.";

        // Code here
        $data = InterviewAnswers::reverseWords($data);

        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    /**
     * Create a class that sorts the below array
     */
    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        // Code here
        $data = InterviewAnswers::orderArray($data);

        $this->assertEquals(1, $data[0]);
        $this->assertEquals(2, $data[1]);
        $this->assertEquals(2.5, $data[2]);
        $this->assertEquals(200, $data[3]);
        $this->assertEquals(450, $data[4]);
        $this->assertEquals(505.5, $data[5]);

        foreach($data as $number)
        {
            if(is_int($number)) {
                $this->assertTrue((int)$number === $number);
            }

            if(is_float($number)) {
                $this->assertTrue((float)$number === $number);
            }

        }
    }

    /**
     * Create a class to determine array differences
     */
    public function testGetDiffArray()
    {
        $data1 = [1, 2, 3, 4, 5, 6, 7];
        $data2 = [2, 4, 5, 7, 8, 9, 10];

        $data = InterviewAnswers::diffArrays($data2, $data1);

        // Code here
        $this->assertEquals([8, 9, 10], $data);

        $data = InterviewAnswers::diffArrays($data1, $data2);

        // Code here
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
        $distance = InterviewAnswers::getDistance($place1, $place2);

        // Convert meters to miles, round to pass test
        $distance = round($distance * 0.001 * 0.6214, 2);

        // Note that I'd prefer a test with a minimum delta instead here
        // e.g. $this->assertEquals(36.91, $distance, null, 0.01)
        $this->assertEquals(36.91, $distance);
    }

    /**
     * Create a class that will generate a human readable time difference
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        $timeDiff = InterviewAnswers::getHumanTimeDiff($time1, $time2);

        $this->assertEquals("3 hours ago", $timeDiff);
    }

    /*
    public function testGetHumanTimeDiffFuture()
    {
        $time1 = "2016-06-05T17:00:00";
        $time2 = "2016-06-05T15:00:00";

        $timeDiff = InterviewAnswers::getHumanTimeDiff($time1, $time2);

        $this->assertEquals("2 hours from now", $timeDiff);
    }

    public function testGetHumanTimeDiffYear()
    {
        $time1 = "2015-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        $timeDiff = InterviewAnswers::getHumanTimeDiff($time1, $time2);

        $this->assertEquals("1 year and 3 hours ago", $timeDiff);
    }

    public function testGetHumanTimeDiffMonthYear()
    {
        $time1 = "2015-06-05T12:00:00";
        $time2 = "2016-07-05T15:00:00";

        $timeDiff = InterviewAnswers::getHumanTimeDiff($time1, $time2);

        $this->assertEquals("1 year, 1 month, and 3 hours ago", $timeDiff);
    }
    */
}
