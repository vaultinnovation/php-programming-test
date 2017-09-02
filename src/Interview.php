<?php
namespace Vault;

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
}
