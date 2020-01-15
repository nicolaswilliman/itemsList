<?php

class Functions {
	public static function getItems(){
		$items = array();
		$item = new stdClass();
		$item->desc = "First Item";
		array_push($items, $item);

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