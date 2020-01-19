<?php

require_once(dirname(dirname(__FILE__)). "/data_access/repository.php");

class Functions {
	public static function getItems(){
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
		Repository::deleteItem($id);
	}

	public static function getItem($id){
		$item = Repository::getItem($id);
		return $item;
	}
}