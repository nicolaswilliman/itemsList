<?php

include_once(dirname(dirname(__DIR__)) . "/config.php");
include_once(BUSINESS_FOLDER . "Item.php");

$id = $_POST["id"];

if(!$id){
	exit;
}

$item = Item::getItem($id);

$fileName = IMAGES_FOLDER . "$id.$item->imageExt";

if(file_exists($fileName)){
	unlink($fileName);
}

Item::deleteItem($id);

exit;
