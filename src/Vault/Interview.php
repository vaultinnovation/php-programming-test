<?php
/**
 * @author: Brice Djilo
 * Interview
 */



/**
 * Instructions:
 *
 * Create a class in the Vault namespace and rewrite each test to make the assertions pass.
 * NOTE: You can use any third party packages you deem necessary to complete the tests.
 */

namespace Vault\Vault;

/**
 * This class is use to run tests in tests/InterviewTests.php
 */
class Interview {

    /**
     * [ reverseArray:
     *      This method transforms the received string $string
     *      into an array of the words.
     *      The returned array contains words in their reverse order.
     *      Non-alphanumeric characters are ignored.
     * ]
     * @param  string $string [a string]
     * @return array          [Array containing the words of $string arranged in the reverse order
     *                          If $string is empty, an empty array is returned.]
     */
    public function reverseArray(string $string)
    {
        $result = preg_replace(
            '/[^a-zA-Z0-9\s]+|[\f\n\r\t\v]+|' .
            '[\x{00a0}\x{1680}\x{180e}\x{2000}-\x{200a}\x{2028}\x{2029}\x{202f}\x{205f}\x{3000}\x{feff}]/ui',
            "", $string
        );
        return array_reverse(explode(' ', $result), false);
    }


    /**
     * [ orderArray
     *      expects an array of integers, floats, doubles or a combination.
     *      It returns an array of the received numbers sorted in ascending order.
     * ]
     * @param  array  $array [Array of integers, floats, doubles, or a combination of the these.]
     * @return array        [An array of numbers in ascending order.]
     */
    public function orderArray(array $array)
    {
        $temp = [];
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

    /**
     * [ getDiffArray
     *      compares $compareFrom against $compareAgaisnt and returns the values
     *      in $compareFrom that are not present in $compareAgaisnt.
 *      ]
     * @param  array  $compareFrom    [An array of numbers to compare from]
     * @param  array  $compareAgaisnt [An array of numbers to compare against]
     * @return array                 [Returns an array containing all the entries from $compareFrom
 *                                    that are not present in $compareAgaisnt.]
     */
    public function getDiffArray(array $compareFrom, array $compareAgaisnt)
    {
        return array_values( array_diff( $compareFrom, $compareAgaisnt ) );
    }

    /**
     * [getDistance
     *      computes the distance between two points of the globe.
     *      The points are characterized by their latitude and longitude coordinates.]
     * @param  array  $place1 [First point: an associative array of longitude and latitude.]
     * @param  array  $place2 [Second point: an associative array of longitude and latitude.]
     * @return double         [The distance, in miles, between $place1 and $place2]
     */
    public function getDistance(array $place1, array $place2)
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

    /**
     * [getHumanTimeDiff
     *      Receives two strings in the date-time format (e.g. "2016-06-05T15:00:00"),
     *      computes the difference between them and prints it out as Y hours ago.
     * ]
     * @param  string $time1 [A non empty string representing time e.g. "2016-06-05T15:00:00"]
     * @param  string $time2 [A non emptystring representing time e.g "2016-06-05T15:00:00"]
     * @return string        [The difference between $time1 and $time2 printed as Y hours ago.]
     */
    public function getHumanTimeDiff(string $time1, string $time2)
    {
        $date_time1 = new \DateTime($time1);
        $date_time2 = new \DateTime($time2);
        $timeDiff = $date_time1->diff($date_time2);

        if ( !empty($time1) && !empty($time2) ) {

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
