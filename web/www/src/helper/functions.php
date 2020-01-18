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

	public static function saveItem($id, $desc, $image){
		if($id){
			//edit

		}else{
			DataAccess::createItem($desc, $image);
		}
	}

	public static function response($data, $httpCode){
		http_response_code($httpCode);
		echo json_encode($data);
		exit;
	}
}