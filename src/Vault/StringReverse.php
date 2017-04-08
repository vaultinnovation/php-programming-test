<?php
namespace Vault\Vault;

/**
 * Class StringReverse
 * @package Vault\Vault
 */
class StringReverse
{
    /**
     * Reverse string and transform to an array.
     *
     * @param string $string
     * @return array
     */
    public function reverse(string $string)
    {
        return array_reverse(explode(' ', trim($string, '.')));
    }
}