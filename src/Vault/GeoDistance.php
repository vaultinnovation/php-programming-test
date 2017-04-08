<?php
namespace Vault\Vault;


final class GeoDistance
{
    /**
     * Earth radius in miles.
     *
     * @var int
     */
    const EARTH_RADIUS_MILES = 3959;

    /**
     * Earth radius in kilometers.
     *
     * @var int
     */
    const Earth_RADIUS_KM = 6371;

    /**
     * PI out to 15 digits. This will only allow up to 14 digits of precision.
     *
     * Note: This is a string to keep precision.
     *
     * @var string
     */
    const PI = '3.14159265358979';

    /**
     * @var array
     */
    private $left = [];

    /**
     * @var array
     */
    private $right = [];

    /**
     * GeoDistance constructor.
     * @param array $left
     * @param array $right
     */
    public function __construct(array $left, array $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    /**
     * @param int $scale
     *   The calculation has geo precision. This will set the final precision.
     * @return float
     */
    public function distance(int $scale = 2): float
    {
        $deltaLatitude = bcsub((string) $this->left['lat'], (string) $this->right['lat'], 10);
        $deltaLongitude = bcsub((string) $this->left['lon'], (string) $this->right['lon'], 10);

        $latitude = bcpow($deltaLatitude, 2, 10);
        $longitude = bcpow($deltaLongitude, 2, 10);

        $distance = bcsqrt(bcadd($latitude, $longitude, 10), 10);
        return round($distance, $scale);
    }

    /**
     * @param int $radius
     *   Earth radius, the units returned will be the same as units given.
     * @param int $scale
     *   The calculation has geo precision. This will set the final precision.
     * @return float
     */
    public function haversine(int $radius = self::EARTH_RADIUS_MILES, int $scale = 2): float
    {
        $latitude1Radians = $this->degreesToRadians($this->left['lat'], 10);
        $latitude2Radians = $this->degreesToRadians($this->right['lat'], 10);
        $longitude1Radians = $this->degreesToRadians($this->left['lon'], 10);
        $longitude2Radians = $this->degreesToRadians($this->right['lon'], 10);

        $deltaLatitude = bcsub($latitude2Radians, $latitude1Radians, 10);
        $deltaLongitude = bcsub($longitude2Radians, $longitude1Radians, 10);

        $sinDeltaLatitude = sin(bcdiv($deltaLatitude, 2, 10));
        $sinDeltaLongitude = sin(bcdiv($deltaLongitude, 2, 10));

        $a = bcadd(
            bcmul($sinDeltaLatitude, $sinDeltaLatitude, 10),
            bcmul(
                bcmul(cos($latitude1Radians), cos($latitude2Radians), 10),
                bcmul($sinDeltaLongitude, $sinDeltaLongitude, 10),
                10
            ),
            10
        );
        $c = bcmul(2, atan2(bcsqrt($a, 10), bcsqrt(bcsub(1, $a, 10), 10)), 10);
        return round(bcmul((string) $radius, $c, 10), $scale);
    }

    public function degreesToRadians($degrees, int $scale = 8): string
    {
        return bcdiv(bcmul((string) $degrees, self::PI, $scale), (string) 180, $scale);
    }
}