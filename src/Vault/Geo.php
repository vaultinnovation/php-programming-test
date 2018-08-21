<?php

namespace Vault\Vault;

class Geo
{
	/**
	* Get the distance between two location points
	*
	* @param array $location1
	* @param array $location2
	* @param string $unit
	* @return integer
	*/
	public function distanceBetween(array $location1, array $location2, $unit = 'm')
	{
		$theta = $location1['lon'] - $location2['lon'];

		$dist = sin( deg2rad( $location1['lat'] ) ) * sin( deg2rad( $location2['lat'] ) ) + cos( deg2rad( $location1['lat'] ) ) * cos( deg2rad( $location2['lat'] ) ) * cos( deg2rad( $theta ) );
		$dist = acos($dist);
		$dist = rad2deg($dist);

		$miles = $dist * 60 * 1.1515;

		$unit = strtoupper( $unit );

		if ( $unit === 'M' ) {	

			// checking precision in case we have more than two training numbers we need to round up
			if ( strlen( substr( strrchr( $miles, '.' ), 1 ) ) > 2 ) {

				// round up any extra distance
				$miles = round( $miles, 2 ) + .01;

			};


			return $miles;
		}

		/// code for more unit types
	}
}