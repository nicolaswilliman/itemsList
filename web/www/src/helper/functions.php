<?php

require_once(dirname(dirname(__FILE__)). "/data_access/repository.php");

class Functions {

	const IMAGES_FOLDER = "http://challenge.test.com/images/";

	public static function getItems(){
		$items = Repository::getAllItems();
		foreach($items as  $key=>$item){
			$items[$key]->_id = (string)$item->_id;
			$items[$key]->image = self::IMAGES_FOLDER . "$item->_id.$item->ext";
		}
		return $items;
	}

	public static function createItem($desc, $ext){
		$retId = Repository::createItem($desc, $ext);
		return $retId;
	}

	public static function updateItem($id, $desc, $ext){
		Repository::updateItem($id, $desc, $ext);
	}

	public static function deleteItem($id){
		Repository::deleteItem($id);
	}

	public static function getItem($id){
		$item = Repository::getItem($id);
		return $item;
	}
}