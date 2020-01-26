<?php

include_once(dirname(__DIR__) . "/business/Item.php");

$itemsIds = $_POST["itemsList"];
$index = 1;
foreach($itemsIds as $id){
	Item::updateItem($id, null, null, $index);
	$index++;
}

exit;