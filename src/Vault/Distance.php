<?php

namespace Vault\Vault;

use Location\Coordinate;
use Location\Distance\Haversine;

class Distance
{
    protected $from;
    protected $to;
     
    // https://www.sfei.org/it/gis/map-interpretation/conversion-constants#sthash.KGpf4sQt.dpbs
    const METERS_TO_MILES = 0.0006213711922;
    
    /**
     * Construct a distance from two pairs of lat/lon coordinates
     *
     * @param array  $from  associative array with lat and lon keys
     * @param array  $to
     */
    public function __construct(array $from, array $to)
    {
        $this->from = new Coordinate($from["lat"], $from["lon"]);
        $this->to = new Coordinate($to["lat"], $to["lon"]);
    }
    
    /**
     * Find the distance in meters using the Haversine formula
     *
     * @return  float  distance in meters
     */
    public function meters(): float
    {
        return $this->from->getDistance($this->to, new Haversine());
    }

    /**
     * Distance in miles
     * 
     * @param  integer  $precision  rounds value to this precision
     * @return float                distance in miles
     */
    public function miles($precision = 2): float
    {
        
        // Convert to miles
        $miles = $this->meters() * self::METERS_TO_MILES;
        
        return round($miles, $precision);
    }
}
