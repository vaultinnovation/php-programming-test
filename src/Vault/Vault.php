<?php
/**
 * Description of Vault
 *
 * @author muhammadfahad
 */
class Vault
{
    /**
     * Reverse Array Function.
     *
     * @param String $data
     * @return array
     */
    function reverseArray($data)
    {
        $dataArray = explode(" ", rtrim($data, "."));
        $data      = array_reverse($dataArray);

        return $data;
    }

    /**
     * Order Array Function.
     *
     * @param array $data
     * @return array
     */
    function orderArray($data)
    {
        $castedArray = array();
        foreach ($data as $val) {
            $castedArray[] = $val + 0;
        }
        $data = $castedArray;
        sort($data);

        return $data;
    }

    /**
     * Get Array Difference.
     *
     * @param array $data1
     * @param array $data2
     * @param boolean $reverse
     * @return array
     */
    function getDiffArray($data1, $data2, $reverse = false)
    {
        if ($reverse) $data = array_diff($data2, $data1);
        else $data = array_diff($data1, $data2);

        $data = array_values($data);

        return $data;
    }

    /**
     * Get Distance Between two Points.
     *
     * @param array $place1
     * @param array $place2
     * @return string
     */
    function getDistance($place1, $place2)
    {
        $staticEarthRad = 3959; //miles Earth Rad.
        $latStartPoint  = deg2rad($place1['lat']);
        $lonStartPoint  = deg2rad($place1['lon']);
        $latEndPoint    = deg2rad($place2['lat']);
        $lonEndPoint    = deg2rad($place2['lon']);

        $latDeltaValue = $latEndPoint - $latStartPoint;
        $lonDeltaValue = $lonEndPoint - $lonStartPoint;

        $distance = 2 * asin(sqrt(pow(sin($latDeltaValue / 2), 2) +
                    cos($latStartPoint) * cos($latEndPoint) * pow(sin($lonDeltaValue
                            / 2), 2)));
        $distance = round($staticEarthRad * $distance, 2);

        return $distance;
    }

    /**
     *  Get Date Time Difference in hourse human readable.
     *
     * @param string $time1
     * @param string $time2
     * @return string
     */
    function getHumanTimeDiff($time1, $time2)
    {
        $datetime1 = new DateTime($time1);
        $datetime2 = new DateTime($time2);
        $timeDiff  = $datetime1->diff($datetime2);
        $timeDiff  = $timeDiff->format('%h hours ago');

        return $timeDiff;
    }
}