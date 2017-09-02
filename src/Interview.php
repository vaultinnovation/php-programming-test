<?php
namespace Vault;

class Interview {

  public function reverseArray($string){
    $string = preg_replace("#[[:punct:]]#","", $string);
    $stringArray = explode(" ", $string);

    $reverse = array_reverse($stringArray);

    return $reverse;
  }


}
