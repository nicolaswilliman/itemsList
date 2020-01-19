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
		$items = array();
		foreach($cursor as $doc){
			array_push($items, $doc);
		}
		return $items;
	}

	public static function createItem($description, $image){
		$connection = self::getInstance();
		$items = $connection->challengedb->items;
		$item = array(
			"description" => $description
		);
		$items->insertOne($item);
	}

	public static function updateItem($id, $description, $image){
		$connection = self::getInstance();
		$items = $connection->challengedb->items;
		$items->updateOne(["_id" => new MongoID($id)], ['$set' => ["description" => $description]]);
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