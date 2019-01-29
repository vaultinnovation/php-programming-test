<?php

namespace Vault;

class ArrayTester
{
  /**
   * Removes special characters and reverses an array.
   *
   * If the provided $array var is not an array already, attempt to cast it properly before proceeding.
   *
   */
  public function reverseArray($array){
    if(gettype($array) === 'string'){
      $array = preg_replace('/[^A-Za-z0-9\s]/','',$array);
      $array = preg_replace('!\s+!',' ',$array);
      $array = explode(' ',$array);
    }
    if(gettype($array) === 'array'){
      $array = preg_replace('/[^A-Za-z0-9\s]/','',$array);
      $array = array_reverse($array);
      return $array;
    }
    return false;
  }
}
