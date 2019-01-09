<?php namespace Vault;


class GetDistance {

    //Using Haversines Formula, Calculate the distance between two pairs of lat/long cooridinates
    public function distance($place1, $place2)
    {
        $earth_radius = 3959;

        // convert from degrees to radians
        $lat_1 = deg2rad($place1['lat']);
        $lon_1 = deg2rad($place1['lon']);
        $lat_2 = deg2rad($place2['lat']);
        $lon_2 = deg2rad($place2['lon']);

        $latDelta = $lat_1 - $lat_2;
        $lonDelta = $lon_1 - $lon_2;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($lat_2) * cos($lat_1) * pow(sin($lonDelta / 2), 2)));
        return round($angle * $earth_radius, 2);
    }

}
