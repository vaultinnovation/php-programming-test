<?php

namespace Vault\Vault;


class ArrayDifferences
{

	/**
	* Check for dirrences in two arrays.
	*
	* @param array $truth | Array to check for differences in
	* @param array $compare | Array to use to compare to truth array
	* @return array | Any differences from compare array as new array
	*/
	public function check(array $truth, array $compare) {

		// simple array dif
		$data = array_diff( $truth, $compare );

		// reset keys 
        $data = array_values( $data );

        return $data;
	}

}