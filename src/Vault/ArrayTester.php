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
    // Check if $array is a string.
    if(gettype($array) === 'string'){
      // Check if $array can be decoded into an array using json_decode.
      if(json_decode($array) && gettype(json_decode($array)) === 'array'){
        $array = json_decode($array);
      }
      else{
        // $array can't be decoded into an array.
        // Remove all special characters EXCEPT for whitespace, then remove consecutive whitespace characters.
        // Redefine $array as an array by exploding string value on space.
        $array = preg_replace('/[^A-Za-z0-9\s]/','',$array);
        $array = preg_replace('!\s+!',' ',$array);
        $array = explode(' ',$array);
      }
    }
    // Check if $array was or is now an array.
    if(gettype($array) === 'array'){
      // Remove special characters EXCEPT for whitespace from array items then return $array.
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
    // Check if $array is an array.
    if(gettype($array) === 'array'){
      // Use array_map() to convert numerical values to integer or float values depending on the array item value.
      $array = array_map(function($x){
        if(is_numeric($x)){
          // Use addition operator to add 0 to $x and see if PHP type-casts $x to a float, then return array item as a float if true.
          if(is_float($x + 0)){
            return (float)$x;
          }
          // Use addition operator to add 0 to $x and see if PHP type-casts $x to an integer, then return array item as an integer if true.
          elseif(is_int($x + 0)){
            return (int)$x;
          }
        }
        return $x;
      },$array);
      // Sort $array with sort().
      sort($array);
      return $array;
    }
    return false;
  }

  /**
   * Orders provided array from smallest value to largest value and casts array items to numerical values.
   *
   * I don't normally code my if() statements on multiple lines or indentation levels, but did so in this function for verbosity.
   *
   * @param array $array The array to be ordered.
   * @param string|array $custom_sort Optional parameter that can can accept either a string or array.
   *                                  If $custom_sort is a string, it must be the function name of a simple PHP-standard sorting function that does not need extra parameters to run (ex. "sort", "rsort", etc.).
   *                                  If $custom_sort is an array, $custom_sort[0] must be the function name of a PHP-standard sorting function (ex. "sort", "usort", etc.). $custom_sort[1] can be either a flag (integer) or anonymous function. orderArrayComplex() will determine which to look for based on the sort function referenced in $custom_sort[0].
   * @param object $custom_map Optional object parameter that must be a callable anonymous function to be passsed as the callback function in array_map() as defined here: http://php.net/manual/en/function.array-map.php
   * @return array|bool Returns ordered array on success, false on fail.
   */
  public function orderArrayComplex($array,$custom_sort = null, $custom_map = null){
    // Check if $array is an array.
    if(gettype($array) === 'array'){
      // Check if $custom_map is not empty and is a callable function.
      if(!empty($custom_map) && is_callable($custom_map)){
        // Map $array by calling $custom_map function on $array.
        $array = array_map($custom_map,$array);
      }
      // Define valid sort functions as keys.
      // Define valid sort function types as arrays in associated values.
      $sort_options = [
        'asort' => ['simple','flags'],
        'arsort' => ['simple','flags'],
        'ksort' => ['simple','flags'],
        'krsort' => ['simple','flags'],
        'natsort' => ['simple'],
        'natcasesort' => ['simple'],
        'rsort' => ['simple','flags'],
        'shuffle' => ['simple'],
        'sort' => ['simple','flags'],
        'usort' => ['user'],
        'uasort' => ['user'],
        'uksort' => ['user']
      ];
      // Check if $custom_sort is not empty, is a string, is an accepted sort function, and can be run without flags or user-defined functions (type: "simple").
      // OR
      // $custom_sort is an array that has only one item and that one item is a string, an accepted sort function and can be run without flags or user-defined functions (type: "simple").
      if(
        !empty($custom_sort)
        && (
          gettype($custom_sort) === 'string'
          && array_key_exists(strtolower($custom_sort),$sort_options)
          && in_array('simple',$sort_options[strtolower($custom_sort)])
        )
        || (
          gettype($custom_sort) === 'array'
          && count($custom_sort) === 1
          && gettype($custom_sort[0]) === 'string'
          && array_key_exists(strtolower($custom_sort[0]),$sort_options)
          && in_array('simple',$sort_options[strtolower($custom_sort[0])])
        )
      ){
        // Sort $array by calling $custom_sort function on $array.
        $custom_sort($array);
      }
      // ELSE Check if $custom_sort is not empty, is an array, has at least two items (only the first two are used), and the first array item is a string, an accepted sort function and can be can be run with flags as long as the second array item is a valid flag (integer) OR can be run with user-defined functions as long as the second array item is a callable function.
      elseif(
        !empty($custom_sort)
        && gettype($custom_sort) === 'array'
        && count($custom_sort) > 1
        && gettype($custom_sort[0]) === 'string'
        && array_key_exists(strtolower($custom_sort[0]),$sort_options)
        && (
            (
              in_array('flags',$sort_options[strtolower($custom_sort[0])])
              && gettype($custom_sort[1]) === 'integer'
            )
            || (
              in_array('user',$sort_options[strtolower($custom_sort[0])])
              && is_callable($custom_sort[1])
            )
        )
      ){
        // Sort $array by calling $custom_sort[0] function on $array with custom parameters $custom_sort[1].
        $custom_sort[0]($array,$custom_sort[1]);
      }
      // Return mapped & sorted array.
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
    // Check if $array1 and $array2 are arrays.
    if(gettype($array1) === 'array' && gettype($array2) === 'array'){
      // Use array_diff() to return an array of values that are present in $array1 but not $array2.
      // Use array_values() on the result of array_diff() to reset the indexes of the returned array then define and return $diff.
      $diff = array_values(array_diff($array1,$array2));
      return $diff;
    }
    return false;
  }
}
