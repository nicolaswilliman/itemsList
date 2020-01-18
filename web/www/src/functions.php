<?php

class Functions {
	public static function getItems(){
		$items = array();

		// MOKE CASES
		// $item = new stdClass();
		// $item->desc = "First Item";
		// $item2 = new stdClass();
		// $item2->desc = "Second Item";

		// array_push($items, $item, $item2);

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