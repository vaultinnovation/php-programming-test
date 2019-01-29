<?php

namespace Vault;

class ArrayTester
{
  /**
   * Removes special characters and reverses an array.
   *
   * If the provided $array is a string, remove special characters, remove duplicate whitespace and then explode into an array.
   * Before reversing $array, remove special characters (again if original type was string) and reverse.
   *
   * @param string|array $array The array to be reversed or string to be converted into an array.
   * @return array|bool Returns reversed array on success, false on fail.
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
   * @param array $array The array to be ordered.
   * @return array|bool Returns ordered array on success, false on fail.
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

  /**
   * Calculates and returns the difference between two provided arrays.
   *
   * This function is simple and the test could be solved without defining a new function, but I'm defining it within the ArrayTester class for consistency's sake.
   * Values that are present in $array1 but not $array2 will be returned.
   *
   * @param array $array1 An array that will be compared against $array2. Values that are present in this array but not $array2 will be returned.
   * @param array $array2 An array that will be compared against $array1.
   * @return array|bool Returns array of differences on success, false on fail.
   */
  public function getDiffArray($array1,$array2){
    if(gettype($array1) === 'array' && gettype($array2) === 'array'){
      $diff = array_values(array_diff($array1,$array2));
      return $diff;
    }
    return false;
  }
}
