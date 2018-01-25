<?php

namespace Vault;

use Carbon\Carbon;
use League\Geotools;

class InterviewTests extends \PHPUnit\Framework\TestCase {

    /**
     * Create a class that turns the below string into an array and reverse the words.
     */
    public function testReverseArray()
    {
        $data = "I want this job.";

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

        $floatOrInt = function($value) {
            /**
             * float if str has a period.
             *
             * This is weird, but I'm assuming I shouldn't touch
             * anything outside of the "// Code here" block
             */
            return strpos($value, ".") ? (float) $value : (int) $value;
        };

        $data = array_map($floatOrInt, $data);
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

        $data = array_values(array_diff($data2, $data1));

        $this->assertEquals([8, 9, 10], $data);

        $data = array_values(array_diff($data1, $data2));

        $this->assertEquals([1, 3, 6], $data);
    }

    /**
     * Create a class that will get the distance between two geo points
     */
    public function testGetDistance()
    {
        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

        $geotools = new Geotools\Geotools();
        $coordA   = new Geotools\Coordinate\Coordinate(array_values($place1));
        $coordB   = new Geotools\Coordinate\Coordinate(array_values($place2));
        $distance = $geotools->distance()->setFrom($coordA)->setTo($coordB);

        $distance = $distance->in('mi')->haversine(); // 36.944885501359

        /**
         * Letting this one fail. None of the standard formulas came up with 36.91.
         * Since the goal is to "get the distance between two geo points" and
         * not "guess which formula was used to produce this number", calling this
         * one good. There isn't a "proper" formula anyways, they each have their pros/cons.
         *
         * IRL, if this exact number was needed I'd ask "what formula/library/function did you use?"
         * and use that instead of wasting time guessing.
         *
         * Maybe the Earth grew since this was committed in 2016? ¯\_(ツ)_/¯
         */

        $this->assertEquals(36.91, $distance);
    }

    /**
     * Create a class that will generate a human readable time difference
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        $timeDiff = Carbon::parse($time1)
                    ->diffForHumans(Carbon::parse($time2));

        /**
         *  This is an oversight. Carbon only uses "ago" when based on ::now(),
         *  which was the result when this was committed Jun 6, 2016.
         *
         *  Master branch should be updated to look for "before".
         *  (and maybe mention that this particular output is from Carbon,
         *   other libraries might say it differently while still being
         *   valid and human readable)
         */
        $this->assertEquals("3 hours before", $timeDiff);
    }

}