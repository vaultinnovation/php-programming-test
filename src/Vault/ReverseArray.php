<?php namespace Vault;


class ReverseArray {

    //Split an $input_string with a space delimiter, returning the resulting array in reverse order, stripped of non alpha-numeric characters
    public function Reverse($input_string)
    {
        $array = explode(" ", $input_string);
        foreach ($array as &$word) {
            $word = preg_replace("/[^a-zA-Z0-9]+/", "", $word);
        }
        return array_reverse($array);
    }

}
