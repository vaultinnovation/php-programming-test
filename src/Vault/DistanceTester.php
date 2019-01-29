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

  /**
   * Returns a float value equal to the distance between two places with given latitudes and longitudes in a specified unit of measurement.
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
   * @param string $unit Optional parameter that accepts a string specifying the unit of measurement to return.
   *                     Accepted values are: "mm", "millimeter", "millimeters", "cm", "centimeter", "centimeters", "m", "meter", "meters", "km", "kilometer", "kilometers", "in", "inch", "inches", "ft", "feet", "yd", "yard", "yards", "mi", "mile" and "miles".
   * @param int $precision Optional parameter specifying the number of decimal places to return.
   * @param int $round Optional parameter that accepts a rounding mode to use with round().
   *                   Accepted values are detailed in the "mode" parameter of the round() functon: http://php.net/manual/en/function.round.php#refsect1-function.round-parameters
   * @return float|bool Returns a float value on success, false on fail.
   */
  public function getDistanceComplex($place1,$place2,$unit = null,$precision = null, $round = null){
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
      // Define the radius of the earth in millimeters.
      // Calculations are done in mm then scaled up as it is the smallest and therefore most accurate unit of measurement.
      $earth_radius = 6371000000;
      // Calculate distance between $place1 and $place2 using the Haversine Formula.
      $dLat = deg2rad($place2['lat'] - $place1['lat']);
      $dLon = deg2rad($place2['lon'] - $place1['lon']);
      $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($place1['lat'])) * cos(deg2rad($place2['lat'])) * sin($dLon/2) * sin($dLon/2);
      $c = 2 * asin(sqrt($a));
      $dist = $earth_radius * $c;
      // Define distance modifiers for accepted units of measurement.
      $dist_modifiers = [
        'mm' => 1,
        'millimeter' => 1,
        'millimeters' => 1,
        'cm' => 10,
        'centimeter' => 10,
        'centimeters' => 10,
        'm' => 1000,
        'meter' => 1000,
        'meters' => 1000,
        'km' => 1000000,
        'kilometer' => 1000000,
        'kilometers' => 1000000,
        'in' => 25.4,
        'inch' => 25.4,
        'inches' => 25.4,
        'ft' => 304.8,
        'feet' => 304.8,
        'yd' => 914.4,
        'yard' => 914.4,
        'yards' => 914.4,
        'mi' => 1609344,
        'mile' => 1609344,
        'miles' => 1609344
      ];
      // Define default modifier as miles conversion value.
      $modifier = 1609344;
      // Check if $unit not empty and is an accepted unit of measurement. If not, $modifier is not changed and thus defaults to miles.
      if(!empty($unit) && array_key_exists($unit,$dist_modifiers)){
        // Set $modifier value to matching $unit conversion value.
        $modifier = $dist_modifiers[$unit];
      }
      // Convert $dist to proper unit format by dividing the distance in millimeters by the modifier value.
      $dist = $dist / $modifier;
      // Check if $dist is a whole number and if $precision is not empty and is numeric.
      // If $dist is a whole number, no decimals will be returned so it's not necessary to calculate precision.
      if((int)$dist != $dist && !empty($precision) && is_numeric($precision)){
        // Ensure $precision is a valid integer for use as precision value in round() by first rounding the provided numerical value, then casting to an integer, then returning the absolute value (in the event that a negative value was provided).
        $precision = abs(intval(round($precision)));
        // Trim $dist to one decimal place longer than $precision. This ensures that round() will function appropriately.
        // Without this, round() would attempt to round up/down/even/odd on the last decimal place even if it is returning fewer decimal places.
        $dist = (float)(explode('.',$dist)[0].'.'.substr(explode('.',$dist)[1],0,$precision+1));
        // Check if $round is a flag/integer. If not, set to PHP default (PHP_ROUND_HALF_UP);
        if(gettype($round) !== 'integer'){
          $round = PHP_ROUND_HALF_UP;
        }
        // Round $dist using the calculated precision value and round mode.
        $dist = round($dist,$precision,$round);
      }
      // Return a float equal to the distance between $place1 and $place2.
      return $dist;
    }
    return false;
  }
}
