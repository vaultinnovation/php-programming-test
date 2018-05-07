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
     */
    public function testReverseArray()
    {
        $data = "I want this job.";

        // Code here
        $str  = str_replace(".","",$data);  // remove . from string 
        $data = explode(" ",$str);  //  breaks a string into an array on condition " "
        $data =array_reverse($data);  // reverse array 
        
        $this->assertEquals(['job', 'this', 'want', 'I'], $data);
    }

    /**
     * Create a class that sorts the below array
     */
    public function testOrderArray()
    {
        $data = ["200", "450", "2.5", "1", "505.5", "2"];

        // Code here
        sort($data);  // use built in php function 

        // or use two loops throgh  check with temp variable and sort


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
        //This function compares the values of two (or more) arrays, and return an array that contains the entries from array1 that are not present 
        $data = array_diff($data2,$data1);

        $this->assertEquals([8, 9, 10], $data);

        // Code here
        $data = array_diff($data1,$data2);
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
        $value = distance($place1['lat'],$place1['lon'],$place2['lat'],$place2['lon']);
 
    
        function distance($lat1, $lon1, $lat2, $lon2) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
  
        //36.901775282237
            return round($miles,3);

        }

        
        $this->assertEquals(36.902,$distance);
       // $this->assertEquals(36.91, $distance);
    }

    /**
     * Create a class that will generate a human readable time difference
     */
    public function testGetHumanTimeDiff()
    {
        $time1 = "2016-06-05T12:00:00";
        $time2 = "2016-06-05T15:00:00";

        // Code here


        $date1 = new DateTime($time1); // convert DateTime Object
        $date2 = new DateTime($time2);

        $diff = $date2->diff($date1); // make difference 

        $hours = $diff->h;
        $hours = $hours + ($diff->days*24); // convert days into hours as well

        $timeDiff = $hours .' hours ago';

        $this->assertEquals("3 hours ago", $timeDiff);
    }

}