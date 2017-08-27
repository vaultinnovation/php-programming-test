<?php
/**
 * Created by IntelliJ IDEA.
 * User: wv
 * Date: 27/08/2017
 * Time: 20:01
 */
require 'vendor/autoload.php';

use Carbon\Carbon;

class TestClass
{
    private $charToReplace = array(".");
    private $replaceBy = "";

    public function reverseArray($stringToReverse)
    {
        $string = str_replace($this->charToReplace, $this->replaceBy, $stringToReverse);
        $arrayOfString = explode(" ", $string);
        $reverseArray = array_reverse($arrayOfString);
        return $reverseArray;
    }

    public function orderArray($table)
    {
        sort($table, SORT_NUMERIC);
        return $table;
    }

    public function getDiffArray($table1, $table2)
    {
        return array_diff($table2, $table1);
    }


    public function getDistance($from, $to, $earthRadius = 6371000)
    {

        $rad = M_PI / 180;
        $dis = acos(sin($to['lat'] * $rad) * sin($from['lat'] * $rad) + cos($to['lat'] * $rad) * cos($from['lat'] * $rad) * cos($to['lon'] * $rad - $from['lon'] * $rad)) * 6371;// Kilometers
        $dis /= 1.609;
        $dis = round($dis, 2, PHP_ROUND_HALF_UP);
        return $dis;
    }

    public function getHumanTimeDiff($date1, $date2)
    {
        $dt1 = explode('T', $date1);
        $dt2 = explode('T', $date2);
        $dat1 = Carbon::parse($dt1[0] . ' ' . $dt1[1]);
        $dat2 = Carbon::parse($dt2[0] . ' ' . $dt2[1]);

        return $dat1->diffForHumans($dat2);

    }


}