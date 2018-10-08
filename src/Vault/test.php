<?php

namespace Vault\Vault;


use Carbon\Carbon;

class test
{
    public function reverse($string) {
        return array_reverse(explode(' ' , substr($string, 0, -1)));
    }

    public function sort($array) {
        foreach ($array as $key => &$val) {
            if ((float)$val - (int)$val == 0) {
                $val = (int) $val;
            } else {
                $val = (float) $val;
            }
        }

        sort($array);
        return $array;
    }

    public function distance($lat1 = 0, $lng1 = 0, $lat2 = 0, $lng2 = 0, $miles = true) {
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lng1 *= $pi80;
        $lat2 *= $pi80;
        $lng2 *= $pi80;

        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return round(($miles ? ($km * 0.621371192) : $km),2);
    }

    public function arrayDiff($firstArray, $secondArray) {
        return array_values(array_diff($firstArray, $secondArray));
    }

    public function timeDiff($time1, $time2) {
        $carbon = new Carbon();

        $begin = $carbon->parse($time1);
        $end = $carbon->parse($time2);

        $timeDiff = $end->diffForHumans($begin);

        return str_replace('after','ago',$timeDiff);
    }
}