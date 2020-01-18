<?php
require '../../vendor/autoload.php';
use MongoDB\Client as Mongo;

$connection = new Mongo("mongodb://root:root@mongo-db:27017");

try {
	$db = $connection->challengedb;
	$items = $db->selectCollection("items");
	$item = array(
		"description" => "First Item in MongoDB!"
	);
	$items->insertOne($item);

} catch (\Exception $e) {
	echo $e->getMessage();
}

exit;