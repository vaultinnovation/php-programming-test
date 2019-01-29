<?php

use PHPUnit\Framework\TestCase;
use Vault\ArrayTester;
use Vault\DistanceTester;
use Vault\DateTimeTester;

/**
 * Instructions:
 *
 * Create a class in the Vault namespace and rewrite each test to make the assertions pass.
 * NOTE: You can use any third party packages you deem necessary to complete the tests.
 */

class InterviewTests extends TestCase {

  /**
   * Create a class that turns the below string into an array and reverse the words.
   */
  public function testReverseArray()
  {
    $data = "I want this job.";
    $data = ArrayTester::reverseArray($data);

    $this->assertEquals(['job', 'this', 'want', 'I'], $data);
  }

  /**
   * Create a class that sorts the below array
   */
  public function testOrderArray()
  {
    $data = ["200", "450", "2.5", "1", "505.5", "2"];

    $data = ArrayTester::orderArray($data);

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

    $data = ArrayTester::getDiffArray($data2,$data1);
    $this->assertEquals([8, 9, 10], $data);
    $data = ArrayTester::getDiffArray($data1,$data2);
    $this->assertEquals([1, 3, 6], $data);
  }

  /**
   * Create a class that will get the distance between two geo points
   *
   * The 36.91 value is returned when using miles to calculate via Haversine Formula, but when using km->mi, the value is off a bit.
   * Using a smaller unit of measurement and calculating larger units would be a more accurate measurement.
   * The provided lat/lon values have 7 degrees of precision (decimals) which makes them accurate to millimeters as detailed here: https://en.wikipedia.org/wiki/Decimal_degrees
   * Once I pass all tests I'm going to return to this and rewrite a more complex tester function.
   */
  public function testGetDistance()
  {
    $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
    $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

    $distance = DistanceTester::getDistance($place1,$place2);

    $this->assertEquals(36.91, $distance);
  }

  /**
   * Create a class that will generate a human readable time difference
   *
   * The "3 hours ago" value is misleading, since that block of time is not "X UNITS ago" but an unchanging measurement of time between two defined points in time.
   * I'm leaving it as-is for the sake of passing the test, but I'd like to modify the function to return the appropriate value without the "ago".
   *
   */
  public function testGetHumanTimeDiff()
  {
    $time1 = "2016-06-05T12:00:00";
    $time2 = "2016-06-05T15:00:00";

    $timeDiff = DateTimeTester::getHumanTimeDiff($time2,$time1);

    $this->assertEquals("3 hours ago", $timeDiff);
  }

}
