<?php

require_once(dirname(dirname(__FILE__)). "/data_access/repository.php");

class Functions {
	public static function getItems(){



		// MOKE CASES
		// $items = array();
		// $item = new stdClass();
		// $item->desc = "First Item";
		// $item2 = new stdClass();
		// $item2->desc = "Second Item";

		// array_push($items, $item, $item2);
		$items = DataAccess::getAllItems();
		return $items;
	}

	public static function saveItem($id, $image, $desc){
		if($id){
			//edit

		}else{
			//create

		}
	}
}