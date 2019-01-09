<?php namespace Vault;


class GetHumanTimeDiff {

    //Parse string timestamps into unix integer timestamps, get the difference, and return string representation
    public function time_diff($time1, $time2)
    {
        return strval((strtotime($time2) - strtotime($time1))/3600)." hours ago";
    }

}
