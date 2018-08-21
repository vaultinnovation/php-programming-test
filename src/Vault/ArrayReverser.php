<?php

namespace Vault\Vault;

use Vault\Vault\ArrayHelper;

class ArrayReverser
{
	/**
	* Take a string and create an array, then reverse it.
	*
	* @param string $string
	* @return array
	*/
	public function reverse(string $string)
	{
		// New up array helper class
		$helper = new ArrayHelper();

		// use helper class to create array from string, re-order array in reverse
		return array_reverse( $helper->stringToArray( $string, true ) );
	}
}