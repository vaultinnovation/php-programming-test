<?php

namespace src\Vault;

class Utility {
    
    /**
     * Turns a string into an array and reverses the words
     */
    public function reverseArray($data)
    {
        $dataArray = explode($data);
        
        return array_reverse($dataArray);
    }
    
}
