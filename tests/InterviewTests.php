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
    $data = 'I want this job.';
    $data = ArrayTester::reverseArray($data);

    $this->assertEquals(['job', 'this', 'want', 'I'], $data);
  }

  /**
   * Create a class that sorts the below array
   */
  public function testOrderArray()
  {
    $data = ['200', '450', '2.5', '1', '505.5', '2'];

    $data = ArrayTester::orderArray($data);

    $this->assertTrue(1 === $data[0]);
    $this->assertTrue(2 === $data[1]);
    $this->assertTrue(2.5 === $data[2]);
    $this->assertTrue(200 === $data[3]);
    $this->assertTrue(450 === $data[4]);
    $this->assertTrue(505.5 === $data[5]);
  }

  /**
   * Create a class that sorts the below array
   *
   * The testOrderArrayComplex() method allows for more flexible definitions when defining how to sort arrays.
   *
   * I duplicated the original test above by passing along the sort function and map function used in the original testOrderArray() funtion explicitly.
   */
  public function testOrderArrayComplex()
  {
    $data = ['200', '450', '2.5', '1', '505.5', '2'];

    $data1 = ArrayTester::orderArrayComplex($data,'sort',function($x){
      if(is_numeric($x)){
        if(is_float($x + 0)){
          return (float)$x;
        }
        elseif(is_int($x + 0)){
          return (int)$x;
        }
      }
      return $x;
    });
    $this->assertSame([1, 2, 2.5, 200, 450, 505.5],$data1);

    $data2 = ArrayTester::orderArrayComplex($data,'rsort');
    $this->assertSame(['505.5', '450', '200', '2.5', '2', '1'],$data2);
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
   */
  public function testGetDistance()
  {
    $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
    $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

    $distance = DistanceTester::getDistance($place1,$place2);

    $this->assertEquals(36.91, $distance);
  }

  /**
   * Create a class that will get the distance between two geo points
   *
   * The 36.91 value returned when using miles to calculate via Haversine Formula above is not as accurate as possible.
   * Using a smaller unit of measurement and calculating larger units is a more accurate measurement.
   * The new getDistanceComplex() method of the DistanceTester should be more accurate.
   */
  public function testGetDistanceComplex()
  {
    $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
    $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

    $distance = DistanceTester::getDistanceComplex($place1,$place2);
    $this->assertEquals(36.9035507441607, $distance);

    $distance = DistanceTester::getDistanceComplex($place1,$place2,'km');
    $this->assertEquals(59.39050796881055, $distance);

    $distance = DistanceTester::getDistanceComplex($place1,$place2,null,'3');
    $this->assertEquals(36.904, $distance);

    $distance = DistanceTester::getDistanceComplex($place1,$place2,'km',3);
    $this->assertEquals(59.391, $distance);

    $distance = DistanceTester::getDistanceComplex($place1,$place2,'km',3,PHP_ROUND_HALF_DOWN);
    $this->assertEquals(59.390, $distance);

    $distance = DistanceTester::getDistanceComplex($place1,$place2,'yards',5);
    $this->assertEquals(64950.24931, $distance);
  }

  /**
   * Create a class that will generate a human readable time difference
   *
   * I've changed the assert to expect an absolute value (no "ago").
   *
   */
  public function testGetHumanTimeDiff()
  {
    $time1 = '2016-06-05T12:00:00';
    $time2 = '2016-06-05T15:00:00';
    $time3 = '2017-06-15T12:00:00';
    $time4 = '2018-11-25T16:30:29';

    $timeDiff = DateTimeTester::getHumanTimeDiff($time1,$time2);
    $this->assertEquals('3 hours', $timeDiff);

    $timeDiff = DateTimeTester::getHumanTimeDiff($time3,$time4);
    $this->assertEquals('1 year', $timeDiff);

  }

}
