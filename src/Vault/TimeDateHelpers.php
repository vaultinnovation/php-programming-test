<?php

namespace Vault\Vault;

class TimeDateHelpers
{
	/**
	* Get the distance between two location points
	*
	* @param string $timestamp1
	* @param string $timestamp2
	* @return string
	*/
	public function diffForHumans(string $timestamp1, string $timestamp2)
	{
		// Normally use Carbon, but lets see what PHP can do!

		if ( strtotime( $timestamp1 ) < strtotime( $timestamp2 ) ) {

			$time = ( ( strtotime( $timestamp2 ) - strtotime( $timestamp1 ) ) / 60 ) / 60;

			// check for round numbers and make sure under 24 hrs.

			if ( $time < 24 && is_int( $time ) ) {

				return "{$time} hours ago";
			}

			// from here check for days, months, years etc.
		}
	}
}