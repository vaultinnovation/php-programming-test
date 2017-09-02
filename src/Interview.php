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


}
