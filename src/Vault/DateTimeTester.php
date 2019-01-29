<?php

namespace Vault;

use Carbon\Carbon;

class DateTimeTester
{
  /**
   * Returns the time difference between two times in human-readable format.
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
    $time_array = [$time1,$time2];
    for($i = 0; $i < 2; $i++){
      try {
        Carbon::parse($time_array[$i]);
      }
      catch(Exception $e) {
        return false;
      }
    }
    $carbon_time1 = Carbon::parse($time1);
    $carbon_diff = Carbon::now()->diffInSeconds($carbon_time1);
    $carbon_time2 = Carbon::parse($time2)->addSeconds($carbon_diff);
    $diff = $carbon_time2->diffForHumans();
    return $diff;
  }
}
