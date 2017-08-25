<?php
namespace Vault;

class InterviewHelper {

    public static function sortArray($data)
    {
        foreach ($data as $key => $value) {
            if (strpos($value, '.') !== false) {
                $data[$key] = (float)$value;
            } else {
                $data[$key] = (int)$value;
            }
        }

        sort($data);

        return $data;
    }

    public static function arrayDifferences($array1, $array2)
    {
        $data = array();

        foreach ($array2 as $value) {
            foreach ($array1 as $value2) {
                if ($value === $value2) {
                    break;
                }
                if (end($array1) === $value2) {
                    $data[] = $value;
                }
            }
        }

        return $data;
    }

    public static function calculateDistance($array1, $array2)
    {
        $latFrom = deg2rad((float)$array1['lat']);
        $lonFrom = deg2rad((float)$array1['lon']);
        $latTo = deg2rad((float)$array2['lat']);
        $lonTo = deg2rad((float)$array2['lon']);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return round($angle * 3959, 2);
    }

}
