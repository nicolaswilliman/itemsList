<?php
require '../../vendor/autoload.php';
use MongoDB\Client as Mongo;

$connection = new Mongo("mongodb://mongo-db:27017");

$collection = $connection->selectCollection('testdb', 'collection-name');
var_dump($collection);
exit;