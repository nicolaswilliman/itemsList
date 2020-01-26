<?php

include_once(dirname(__DIR__) . "/business/Item.php");

$id = $_POST["id"];

if(!$id){
	exit;
}

$item = Item::getItem($id);

$fileName = realpath(dirname(dirname(__DIR__))) . "/images/$id.$item->ext";

if(file_exists($fileName)){
	unlink($fileName);
}

Item::deleteItem($id);

exit;
