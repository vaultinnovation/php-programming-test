<?php
declare(strict_types=1);
namespace Vault;

const EARTH_RADIUS_IN_MILES = 3959;

class TestAnswers
{
  public static function stringToReverseArray(string $data): array
  {
    // strip out '.' characters
    $data = str_replace(".", "", $data);
    // split string into array and reverse it
    $dataArray = explode(" ", $data);
    return array_reverse($dataArray);
  }

  public static function sortStringArrayNumerically(array $data): array
  {
    // convert values to floating-point numbers or integers as appropriate
    for ($i = 0, $max = count($data); $i < $max; $i++)
    {
      if (strpos($data[$i], '.') !== false)
      {
        $data[$i] = (float)$data[$i];
      }
      else
      {
        $data[$i] = (int)$data[$i];
      }
    }
    // sort in ascending order
    sort($data, SORT_NUMERIC);
    return $data;
  }

  public static function getDiffArray(array $array1, array $array2): array
  {
    // find values in array1 that are not in array2 using set operations
    $array1Set = new \Ds\Set($array1);
    $array2Set = new \Ds\Set($array2);
    $differences = $array1Set->diff($array2Set);
    // convert differences to array, sort, and return
    $differencesArray = $differences->toArray();
    sort($differencesArray, SORT_NUMERIC);
    return $differencesArray;
  }

  public static function getGreatCircleDistance(array $x, array $y): float
  {
    // convert parameters to floating-point numbers and then to radians
    $xLat = deg2rad((float)$x['lat']);
    $yLat = deg2rad((float)$y['lat']);
    $xLon = deg2rad((float)$x['lon']);
    $yLon = deg2rad((float)$y['lon']);
    // calculate central angle between two geo points: x and y
    $deltaLon = abs($xLon - $yLon);
    $centralAngle = acos((sin($xLat) * sin($yLat)) + (cos($xLat) * cos($yLat) * cos($deltaLon)));
    // use central angle to calculate arc length
    $arcLength = EARTH_RADIUS_IN_MILES * $centralAngle;
    // round number to two decimal places
    return round($arcLength, 2);
  }

  public static function getHumanTimeDiff(string $time1, string $time2): string
  {
    // calculate time difference
    $datetime1 = new \DateTime($time1);
    $datetime2 = new \DateTime($time2);
    $interval = $datetime1->diff($datetime2);
    // output in human readable format
    return $interval->format("%h hours ago");
  }
}

?>
