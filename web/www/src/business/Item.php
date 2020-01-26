<?php

require_once(dirname(__DIR__). "/data_access/Repository.php");

class Item {

	const IMAGES_FOLDER = "http://challenge.test.com/images/";

	public function __construct($id = 0, $desc = "", $imageExt = ""){
		$this->id = $id;
		$this->desc = $desc;
		$this->imageExt = $imageExt;
		$this->image = self::IMAGES_FOLDER . "$id.$imageExt";
	}

	public static function getItems(){
		$itemsList = Repository::getAllItems();
		$items = [];
		foreach($itemsList as $key=>$item){
			$itemsList[$key]->_id = (string)$item->_id;
			$itemsList[$key]->image = self::IMAGES_FOLDER . "$item->_id.$item->imageExt";
		}
		return $itemsList;
	}

	public static function getItem($id){
		$item = Repository::getItem($id);
		return new Item($id, $item->description, $item->imageExt);
	}

	public function save(){
		if($this->id){
			Repository::updateItem($this->id, $this->desc, $this->imageExt, $this->index);
		}else{
			$retId = Repository::createItem($this->desc, $this->imageExt);
			return $retId;
		}
	}

	public static function createItem($desc, $imageExt){
		$retId = Repository::createItem($desc, $imageExt);
		return $retId;
	}

	public static function updateItem($id, $desc, $imageExt, $index = null){
		Repository::updateItem($id, $desc, $imageExt, $index);
	}

	public static function deleteItem($id){
		Repository::deleteItem($id);
	}


}