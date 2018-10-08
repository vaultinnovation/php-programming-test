<?php

namespace Vault;

class Distance
{
    public static function getDistance($place1, $place2, $miles = true)
    {
        $pi80 = M_PI / 180;
        $place1['lat'] *= $pi80;
        $place1['lon'] *= $pi80;
        $place2['lat'] *= $pi80;
        $place2['lon'] *= $pi80;

        $r = 6372.797; // radius of Earth in km
        $dlat = $place2['lat'] - $place1['lat'];
        $dlng = $place2['lon'] - $place1['lon'];
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($place1['lat']) * cos($place2['lat']) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return round(($miles ? ($km * 0.621371192) : $km), 2);
    }
}