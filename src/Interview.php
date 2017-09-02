<?php
namespace Vault;

 require_once(dirname(__FILE__) . "/gdsDistance.php");

class Interview {

  public function reverseArray($string){
    //Removing any punctuations from the string
    $string = preg_replace("#[[:punct:]]#","", $string);

    //converting string to array
    $stringArray = explode(" ", $string);

    //Reverse and return it
    $reverse = array_reverse($stringArray);
    return $reverse;
  }

  public function orderArray(&$array)
  {
    if($array != NULL){

      //Converting strings to number types
      foreach ($array as &$thing) {
        $thing = $thing + 0;
      }


    }

    return    sort($array);
  }
  function getDistance($place1, $place2)
  {
    return (round(distance($place1['lat']+ 0, $place1['lon'] + 0, $place2['lat']+ 0, $place2['lon'] + 0, "M"),2)+ 0.01);

  }
}
