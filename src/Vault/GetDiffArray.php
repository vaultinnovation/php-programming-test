<?php namespace Vault;

class GetDiffArray {

    //Return an array of the values that are present in $arr2 that are not in $arr1, with 0 based indexing
    public function arr_diff($arr1, $arr2)
    {
        return array_values(array_diff($arr2, $arr1));
    }

}
