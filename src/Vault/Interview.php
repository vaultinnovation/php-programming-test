<?php

namespace Vault\Vault;

use Carbon\Carbon;
use AnthonyMartin\GeoLocation\GeoLocation as GeoLocation;

class Interview {

    public function orderArray(&$data)
    {
        $data = array_map('floatval', $data);

        foreach ($data as $k => $value) {

            if ((int)$value == $value) {
                $data[$k] = (int)$value;
            }

        }

        sort($data);
    }

    public function reverseArray(&$data)
    {
        $data = array_reverse(explode(" ", rtrim($data, '.')));
    }

    public function getDiffArray($data1, $data2)
    {
        return array_values(array_diff($data1, $data2));
    }

    public function getDistance($place1, $place2)
    {
        $p1 = GeoLocation::fromDegrees((float)$place1['lat'], (float)$place1['lon']);
        $p2 = GeoLocation::fromDegrees((float)$place2['lat'], (float)$place2['lon']);

        return ceil(($p1->distanceTo($p2, 'miles') * 100)) / 100;
    }

    public function getHumanTimeDiff($time1, $time2)
    {
        $t2 = Carbon::parse($time2);
        Carbon::setTestNow($t2);

        $t1 = Carbon::parse($time1);

        return  $t1->diffForHumans();
    }

}
