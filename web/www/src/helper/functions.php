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
		$items = Repository::getAllItems();
		return $items;
	}

	public static function saveItem($id, $desc, $image){
		if($id){
			Repository::updateItem($id, $desc, $image);
		}else{
			Repository::createItem($desc, $image);
		}
	}

	public static function deleteItem($id){

	}

	public static function getItem($id){
		$item = Repository::getItem($id);
		return $item;
	}
}