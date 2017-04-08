<?php
namespace Vault\Vault;


class NumericOrder
{
    public function sort($data)
    {
        $data = array_map(function($item) {
            if (strpos($item, '.') !== false) {
                return floatval($item);
            }
            return intval($item);
        }, $data);
        uasort($data, function($left, $right) {
            return bccomp($left, $right, 2);
        });
        return array_values($data);
    }
}