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

  /**
   * Orders provided array from smallest value to largest value and casts array items to numerical values.
   *
   */
  public function orderArray($array){
    if(gettype($array) === 'array'){
      $array = array_map(function($x){
        if(is_numeric($x)){
          if(is_float($x + 0)){
            return (float)$x;
          }
          elseif(is_int($x + 0)){
            return (int)$x;
          }
        }
        return $x;
      },$array);
      sort($array);
      return $array;
    }
    return false;
  }
}
