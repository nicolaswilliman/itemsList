<?php
include_once(dirname(dirname(__DIR__)) . "/config.php");
include_once(BUSINESS_FOLDER . "Item.php");

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