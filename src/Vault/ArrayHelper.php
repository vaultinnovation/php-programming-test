<?php

namespace Vault\Vault;


class ArrayHelper 
{

	/**
	* Take a string and create an array.
	*
	* @param string $string
	* @param boolean $strip | false
	* @return array
	*/
	public function stringToArray(string $string, $strip = false)
	{
		// ensure no spaces at the begining or end of the string
		$string = trim( $string );

		// check if we want to strip off any punctuation
		if ( $strip ) {

			$string = preg_replace( '#[[:punct:]]#', '', $string );

		}

		// explode the string into an array at each space
		return explode( ' ', $string );
	}
}