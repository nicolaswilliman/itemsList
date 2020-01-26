<?php

require_once(dirname(dirname(dirname(__DIR__))) . "/vendor/autoload.php");

use MongoDB\Client as Mongo;

use \MongoDB\BSON\ObjectID as MongoID;

class Repository {

	private static $instance = null;

	private static function getInstance(){
		if(!self::$instance){
			self::$instance = new Mongo("mongodb://root:root@mongo-db:27017");
		}
		return self::$instance;
	}

	public static function getAllItems(){
		$connection = self::getInstance();
		$cursor = $connection->challengedb->items->find();
		$items = [];
		foreach($cursor as $doc){
			array_push($items, $doc);
		}
		return $items;
	}

	public static function createItem($description, $imageExt){
		$connection = self::getInstance();
		$items = $connection->challengedb->items;
		$item = [
			"description" => $description,
			"imageExt" => $imageExt,
			"index" => self::getNewIndex(),
		];
		$ret = $items->insertOne($item);
		return (string)$ret->getInsertedId();
	}

	public static function updateItem($id, $description, $imageExt, $index){
		$connection = self::getInstance();
		$items = $connection->challengedb->items;
		$item = [];
		if($description){
			$item['$set']["description"] = $description;
		}
		if($imageExt){
			$item['$set']["imageExt"] = $imageExt;
		}
		if($index){
			$item['$set']["index"] = $index;
		}
		$items->updateOne(["_id" => new MongoID($id)], $item);
	}

	public static function deleteItem($id){
		$connection = self::getInstance();
		$items = $connection->challengedb->items;
		$items->deleteOne([ "_id" => new MongoID($id) ]);
	}

	public static function getItem($id){
		$connection = self::getInstance();
		$item = $connection->challengedb->items->findOne(["_id" => new MongoID($id)]);
		return $item;
	}

	public static function getNewIndex(){
		$connection = self::getInstance();
		$items = $connection->challengedb->items;
		$options = ['sort' => ['index' => -1]]; // -1 is for desc
		$result = $items->findOne([], $options);
		if($result){
			return $result->index + 1;
		}else{
			return 0;
		}
	}
}