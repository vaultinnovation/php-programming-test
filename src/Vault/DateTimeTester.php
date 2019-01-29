<?php

namespace Vault;

use Carbon\Carbon;

class DateTimeTester
{
  /**
   * Returns the time difference between two times in human-readable format.
   *
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
