<?php

namespace Vault\Vault;

class ArraySorter 
{
	/**
	* Take an array and re-sort it.
	*
	* @param string $string
	* @return array
	*/
	public function numericDesc(array $array)
	{
		$data = [];

		foreach( $array as $value ) {

			$data[] = $this->numericType( $value );

		}

		sort( $data, SORT_NUMERIC );

		return $data;
	}

	/**
	* set proper numeric type.
	*
	* @param string $value
	* @return mixed | int | float
	*/
	private function numericType($value)
	{
		if ( is_numeric( $value ) ) { 

    		return $value + 0; 

  		} 
  		
  		return 0; 
	}
}