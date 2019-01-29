<?php

namespace Vault;

/**
 * DEFINE NON-CLASS HELPER FUNCTIONS
 */

/**
 * Converts the provided value into a float value if possible.
 *
 * This function modifies the provided value when it is called and returns true if the conversion was successful, false if unsuccessful.
 *
 * @param mixed $input An input value to be checked to see if it is numeric.
 * @return bool
 */
function numericToFloat(&$input){
  // Check that $input is numeric.
  if(is_numeric($input)){
    // Cast $input to float and return it.
    $input = (float)$input;
    return true;
  }
  return false;
}

class DistanceTester
{
  /**
   * Returns a float value rounded to two decimal points equal to the distance in miles between two places with given latitudes and longitudes.
   *
   * This function is based on the getDistance() Haversine Formula function located here: http://www.codecodex.com/wiki/
   *
   * I don't normally code my if() statements on multiple lines or indentation levels, but did so in this function for verbosity.
   *
   * @param array $place1 Associative array with two key => value pairs.
   *                      The key "lat" should be a float, integer or string with a value between -90 and 90 representing a latitude point.
   *                      The key "lon" should be a float, integer or string with a value between -180 and 180 representing a longitude point.
   * @param array $place2 Associative array with two key => value pairs.
   *                      The key "lat" should be a float, integer or string with a value between -90 and 90 representing a latitude point.
   *                      The key "lon" should be a float, integer or string with a value between -180 and 180 representing a longitude point.
   * @return float|bool Returns a float value on success, false on fail.
   */
  public function getDistance($place1,$place2){
    // Check that all conditions match:
    // $place1 and $place2 are arrays.
    // $place1 and $place2 have properties named "lat" and "lon".
    // The "lat" and "lon" properies of $place1 and $place2 pass the numericToFloat() function (this function casts the values to float in the process).
    // The "lat" values for $place1 and $place2 are between -90 and 90.
    // // The "lon" values for $place1 and $place2 are between -180 and 180.
    if(
      (
        gettype($place1) === 'array'
        && array_key_exists('lat',$place1)
        && numericToFloat($place1['lat'])
        && (
          $place1['lat'] >= -90
          && $place1['lat'] <= 90
        )
        && array_key_exists('lon',$place1)
        && numericToFloat($place1['lon'])
        && (
          $place1['lon'] >= -180
          && $place1['lon'] <= 180
        )
      )
      && (
        gettype($place2) === 'array'
        && array_key_exists('lat',$place2)
        && numericToFloat($place2['lat'])
        && (
          $place2['lat'] >= -90
          && $place2['lat'] <= 90
        )
        && array_key_exists('lon',$place2)
        && numericToFloat($place2['lon'])
        && (
          $place2['lon'] >= -180
          && $place2['lon'] <= 180
        )
      )
    ){
      // Define the radius of the earth in miles.
      $earth_radius = 3959;
      // Calculate distance in miles between $place1 and $place2 using the Haversine Formula.
      $dLat = deg2rad($place2['lat'] - $place1['lat']);
      $dLon = deg2rad($place2['lon'] - $place1['lon']);
      $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($place1['lat'])) * cos(deg2rad($place2['lat'])) * sin($dLon/2) * sin($dLon/2);
      $c = 2 * asin(sqrt($a));
      $dist = $earth_radius * $c;
      // Round $dist to a precision of two decimal places and return it.
      $dist = round($dist,2);
      return $dist;
    }
    return false;
  }
}
