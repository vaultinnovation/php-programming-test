<?php

class InterviewAnswers extends PHPUnit\Framework\TestCase {

    public function testReverseArray()
    {
        $data = "I want this job.";

        $data = str_replace(".", "", $data);

        $data = explode(' ', $data);

        $data = array_reverse($data);

        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        foreach ($data as $key => $value) {
            if (strpos($value, '.') !== false) {
                $data[$key] = (float)$value;
            } else {
                $data[$key] = (int)$value;
            }
        }

        sort($data);

        $this->assertTrue(1 === $data[0]);
        $this->assertTrue(2 === $data[1]);
        $this->assertTrue(2.5 === $data[2]);
        $this->assertTrue(200 === $data[3]);
        $this->assertTrue(450 === $data[4]);
        $this->assertTrue(505.5 === $data[5]);
    }

    public function testGetDiffArray()
    {
        $data1 = [1, 2, 3, 4, 5, 6, 7];
        $data2 = [2, 4, 5, 7, 8, 9, 10];

        $data = array();

        foreach ($data2 as $value) {
            foreach ($data1 as $value2) {
                if ($value === $value2) {
                    break;
                }
                if (end($data1) === $value2) {
                    $data[] = $value;
                }
            }
        }

        $this->assertEquals([8, 9, 10], $data);

        $data = array();

        foreach ($data1 as $value) {
            foreach ($data2 as $value2) {
                if ($value === $value2) {
                    break;
                }
                if (end($data2) === $value2) {
                    $data[] = $value;
                }
            }
        }

        $this->assertEquals([1, 3, 6], $data);
    }

    public function testGetDistance()
    {
        $place1 = ['lat' => '41.9641684', 'lon' => '-87.6859726'];
        $place2 = ['lat' => '42.1820210', 'lon' => '-88.3429465'];

        $latFrom = deg2rad(41.9641684);
        $lonFrom = deg2rad(-87.6859726);
        $latTo = deg2rad(42.1820210);
        $lonTo = deg2rad(-88.3429465);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        $distance = round($angle * 3959, 2);

        $this->assertEquals(36.91, $distance);
    }

    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        $date1 = new DateTime('2016-06-05T12:00:00');
        $date2 = new DateTime('2016-06-05T15:00:00');

        $diff = $date2->diff($date1);

        $timeDiff = $diff->format('%h hours ago');

        $this->assertEquals("3 hours ago", $timeDiff);
    }



}
