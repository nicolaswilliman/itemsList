<?php
include_once(dirname(__DIR__) . "/business/Item.php");

function compare($item, $anotherItem){
	return $item->index > $anotherItem->index;
}

$items = Item::getItems();

usort($items, "compare");
$response = new stdClass();
$response->items = $items;
$response->count = count($items);
echo json_encode($response);
exit;