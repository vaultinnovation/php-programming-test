

<?php
require_once 'tests/InterviewTests.php';


class Interview
{
	//Create a class that turns the below string into an array and reverse the words
	public function reverseArray($data)
	{
        //Split:
		$items = preg_split("/[\s.]+/", $data);
        //Get rid of empty elements:
        $items = array_filter($items);
        //Reverse the array:
		return array_reverse($items);

	}

    public function orderArray($data)
    {
        asort($data);

        $arrlength = count($data);
        for($x = 0; $x < $arrlength; $x++) {
            return $data[$x];
        }
    }

    public function getDiffArray($data1, $data2)
    {

        $result = array_diff($data1, $data2);

        $array = (array_values($result)); 


        return $array;

    }

}