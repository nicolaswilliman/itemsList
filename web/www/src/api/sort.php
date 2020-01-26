<?php

include_once(dirname(dirname(__DIR__)) . "/config.php");
include_once(BUSINESS_FOLDER . "Item.php");

$itemsIds = $_POST["itemsList"];
$index = 1;
foreach($itemsIds as $id){
	$item = new Item($id, null, null, $index);
	$item->save();
	$index++;
}

exit;