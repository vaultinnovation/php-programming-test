<?php

/**
 * Instructions:
 *
 * Create a class in the Vault namespace and rewrite each test to make the assertions pass.
 * NOTE: You can use any third party packages you deem necessary to complete the tests.
 */

namespace Vault\Vault;


class Interview {

    public function reverseArray($string)
    {
        if ( is_string($string) ) {
            $result = preg_replace(
                '/[^a-zA-Z0-9\s]+|[\f\n\r\t\v]+|' .
                '[\x{00a0}\x{1680}\x{180e}\x{2000}-\x{200a}\x{2028}\x{2029}\x{202f}\x{205f}\x{3000}\x{feff}]/ui',
                "", $string
            );
            return array_reverse(explode(' ', $result), false);
        }
        return null;
    }


    public function orderArray($array)
    {
        $temp = [];
        if ( is_array($array) )
        {
            foreach ($array as $key => $value )
            {
                if ( preg_match('/\d+\.\d+|\d+/', $value) ) {
                    $temp[$key] = $value + 0;
                } else {
                    break;
                }
            }
            if ( count($temp) === count($array) ) {
                sort( $temp );
                return $temp;
            }
            return $array;
        }
        return null;
    }


    public function getDiffArray($compareFrom, $compareAgaisnt)
    {
        if ( is_array($compareFrom) && is_array($compareAgaisnt) ) {
            return array_values( array_diff( $compareFrom, $compareAgaisnt ) );
        }
        return null;
    }


    public function getDistance($place1, $place2)
    {
        // a = sin²(Δφ/2) + cos φ1 ⋅ cos φ2 ⋅ sin²(Δλ/2)
        $φ1 = deg2rad($place1['lat']);
        $φ2 = deg2rad($place2['lat']);

        $dφ = deg2rad($place1['lat'] - $place2['lat']);
        $dλ = deg2rad($place1['lon'] - $place2['lon']);

        $a =  pow(sin($dφ/2), 2) + cos($φ1) * cos($φ2) * pow(sin($dλ/2), 2);

        // c = 2 ⋅ atan2( √a, √(1−a) )
        $c = 2 * atan2( sqrt( $a ), sqrt( 1 - $a ) );

        // d = R ⋅ c and mean radius R = 6371 km
        $R = 6371 * 0.6214; // converting Earth radius to miles
        $d = $R * $c;

        return number_format( $d, 2 );
    }


    public function getHumanTimeDiff( $time1, $time2 )
    {
        $date_time1 = new \DateTime($time1);
        $date_time2 = new \DateTime($time2);
        $timeDiff = $date_time1->diff($date_time2);

        if ( is_string($time1) && is_string($time2) && !empty($time1) && !empty($time2) ) {

            $timeDiff = $date_time1->diff($date_time2);

            $sections = [
                "y" => "hour",
                "m" => "month",
                "d" => "day",
                "h" => "hour",
                "i" => "minute",
                "s" => "second"
            ];

            foreach( $sections as $section => $type)
            {
                if( $timeDiff->$section > 0 )
                {
                    $time = $timeDiff->$section;
                    return $time . ' ' . $type . ( $time > 1 ? 's' : '' ) . ' ago';
                }
            }
        }
        return null;
    }

}
