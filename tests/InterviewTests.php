<?php
use Vault\Interview;

/**
 * Instructions:
 *
 * Create a class in the Vault namespace and rewrite each test to make the assertions pass.
 * NOTE: You can use any third party packages you deem necessary to complete the tests. 
 */

class InterviewTests extends phpunit\framework\TestCase {

    /**
     * @var Interview
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Interview;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    /**
     * Create a class that turns the below string into an array and reverse the words.
     */
    public function testTestReverseArray() {
        $data = "I want this job.";
        $data = $this->object->ReverseArray($data);
        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    public function testOrderArray() {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        $data = $this->object->OrderArray($data);

        $this->assertEquals(1, $data[0]);
        $this->assertEquals(2, $data[1]);
        $this->assertEquals(2.5, $data[2]);
        $this->assertEquals(200, $data[3]);
        $this->assertEquals(450, $data[4]);
        $this->assertEquals(505.5, $data[5]);
    }

    /**
     * Create a class to determine array differences
     */
    public function testGetDiffArray() {
        $data1 = [1, 2, 3, 4, 5, 6, 7];
        $data2 = [2, 4, 5, 7, 8, 9, 10];

        $res1 = $this->object->GetDiffArray($data2, $data1);

        $this->assertEquals([8, 9, 10], $res1);


        $res2 = $this->object->GetDiffArray($data1, $data2);

        $this->assertEquals([1, 3, 6], $res2);
    }

    /**
     * Create a class that will get the distance between two geo points
     * 
     **/
    public function testGetDistance() {
        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

        $distance = $this->object->GetDistance($place1, $place2);

        $this->assertEquals(36.902, $distance);
    }

    /**
     * Create a class that will generate a human readable time difference
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        $timeDiff = $this->object->GetHumanTimeDiff($time1, $time2);

        $this->assertEquals("3 hours ago", $timeDiff);
    }

}