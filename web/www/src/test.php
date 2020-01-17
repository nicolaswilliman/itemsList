<?php
require '../../vendor/autoload.php';
use MongoDB\Client as Mongo;

$connection = new Mongo("mongodb://root:root@mongo-db:27017");

try {
	$dbs = $connection->listDatabases();
} catch (\Exception $e) {
	echo $e->getMessage();
}


//$collection = $connection->selectCollection('testdb', 'collection-name');
//var_dump($collection);
exit;