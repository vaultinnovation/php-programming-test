<?php

namespace Vault;

use Carbon\Carbon;

class DateTimeTester
{
  /**
   * Returns the time difference between two dates/times in human-readable format.
   *
   * Both $time1 and $time2 can accept date/time string formats as detailed in the following pages:
   * * http://us3.php.net/manual/en/datetime.formats.time.php
   * * http://us3.php.net/manual/en/datetime.formats.date.php
   * * http://us3.php.net/manual/en/datetime.formats.compound.php
   * * http://us3.php.net/manual/en/datetime.formats.relative.php
   *
   * @param string $time1 A date/time string passed to Carbon's parse method to create a new Carbon instance to compare against $time2.
   * @param string $time2 A date/time string passed to Carbon's parse method to create a new Carbon instance to compare against $time1.
   * @return string|bool Returns a human-readable string on success, false on fail.
   */
  public function getHumanTimeDiff($time1,$time2){
    // Check that both $time1 and $time2 are not empty.
    if(!empty($time1) && !empty($time1)){
      // Create array of $time1 and $time2 to loop through. More concise.
      $time_array = [$time1,$time2];
      // Loop through $time_array to check that Carbon accepts $time1 and $time2 as valid date/time strings. Return false on an exception.
      for($i = 0; $i < 2; $i++){
        try {
          Carbon::parse($time_array[$i]);
        }
        catch(Exception $e) {
          return false;
        }
      }
      // Create Carbon instances for $time1 and $time2.
      $carbon_time1 = Carbon::parse($time1);
      $carbon_time2 = Carbon::parse($time2);
      // Return a human-readable string of the difference between the two provided dates.
      // The second parameter in diffForHumans() is set to true to remove string modifiers such as "after", "before", "ago", "from now", etc.
      $diff = $carbon_time1->diffForHumans($carbon_time2,true);
      return $diff;
    }
    return false;
  }

  /**
   * Returns the time difference between a provided date/time and the current date/time in human-readable format.
   *
   * $time can accept date/time string formats as detailed in the following pages:
   * * http://us3.php.net/manual/en/datetime.formats.time.php
   * * http://us3.php.net/manual/en/datetime.formats.date.php
   * * http://us3.php.net/manual/en/datetime.formats.compound.php
   * * http://us3.php.net/manual/en/datetime.formats.relative.php
   *
   * @param string $time1 A date/time string passed to Carbon's parse method to create a new Carbon instance to compare against $time2.
   * @param bool $absolute Optional boolean indicating whether to return the difference string with a modifier such as "after", "before", etc.
   * @return string|bool Returns a human-readable string on success, false on fail.
   */
  public function getHumanTimeDiffFromNow($time,$absolute = false){
    // Check that $time is not empty.
    if(!empty($time)){
      // Check that Carbon accepts $time as a valid date/time string. Return false on an exception.
      try {
        Carbon::parse($time);
      }
      catch(Exception $e) {
        return false;
      }
      // Create a Carbon instance for $time.
      $carbon_time1 = Carbon::parse($time1);
      $carbon_time2 = Carbon::parse($time2);
      // Return a human-readable string of the difference between the two provided dates.
      // If $absolute is true, string modifiers will be removed from the difference string.
      $diff = Carbon::now()->diffForHumans($carbon_time,$absolute);
      return $diff;
    }
    return false;
  }
}
