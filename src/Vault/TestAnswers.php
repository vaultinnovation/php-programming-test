<?php
declare(strict_types=1);
namespace Vault;

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
}

?>
