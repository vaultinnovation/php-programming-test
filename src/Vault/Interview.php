<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 06.10.2018
 * Time: 3:38
 */
namespace Vault;
use AnthonyMartin\GeoLocation\GeoLocation as GeoLocation;

class Interview
{
    public static function reverseArrayFromStr($str)
    {
        return array_reverse(explode(' ', $str));
    }

    public static function sortArray($data)
    {
        return asort($data);
    }

    public static function arrayDiff($data1, $data2)
    {
        return array_values(array_diff($data1, $data2));
    }

    public static function getDistance($place1, $place2)
    {
        $point1 = GeoLocation::fromDegrees($place1['lat'], $place1['lon']);
        $point2 = GeoLocation::fromDegrees($place2['lat'], $place2['lon']);

        return round($point1->distanceTo($point2, 'miles'), 2);
    }

    public function getHumanTimeDiff($date1, $date2)
    {
        $dh = new \Date_HumanDiff();
        return  $dh->get(strtotime($date1), strtotime($date2));
    }
}