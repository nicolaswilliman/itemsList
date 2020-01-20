<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/vendor/autoload.php");

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

	public static function createItem($description, $ext){
		$connection = self::getInstance();
		$items = $connection->challengedb->items;
		$item = [
			"description" => $description,
			"ext" => $ext,
		];
		$ret = $items->insertOne($item);
		return json_decode(json_encode($ret->getInsertedId()))->{'$oid'}; //TODO CHECK THIS UGLY THING
	}

	public static function updateItem($id, $description, $ext){
		$connection = self::getInstance();
		$items = $connection->challengedb->items;
		$item = ['$set' => [
			"description" => $description,
			"ext" => $ext,
			]
		];
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
}