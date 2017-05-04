<?php
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
}

?>
