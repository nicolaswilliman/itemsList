<?php

include_once(dirname(dirname(__DIR__)) . "/config.php");
include_once(DATA_ACCESS_FOLDER . "Repository.php");

class Item {

	public function __construct($id = 0, $description = null, $imageExt = null, $index = null){
		$this->id = $id;
		$this->description = $description;
		$this->imageExt = $imageExt;
		$this->image = IMAGES_URL . "$id.$imageExt";
		$this->index = $index;
	}

	public static function getItems(){
		$itemsList = Repository::getAllItems();
		$items = [];
		foreach($itemsList as $key=>$value){
			$item = new Item((string)$value->_id, $value->description, $value->imageExt, $value->index);
			array_push($items, $item);
		}
		return $items;
	}

	public static function getItem($id){
		$item = Repository::getItem($id);
		return new Item($id, $item->description, $item->imageExt);
	}

	public function save(){
		if($this->id){
			Repository::updateItem($this->id, $this->description, $this->imageExt, $this->index);
			return $this->id;
		}else{
			$retId = Repository::createItem($this->description, $this->imageExt);
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