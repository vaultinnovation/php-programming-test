

<?php
require_once 'tests/InterviewTests.php';


class Interview
{
	//Create a class that turns the below string into an array and reverse the words
	public function reverseArray($data)
	{


        //Split:
		$items = preg_split("/[\s.]+/", $data);
        //Reverse the array:

        $items = array_filter($items);
		return array_reverse($items);

	}

}