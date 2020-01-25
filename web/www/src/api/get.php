<?php
require_once(dirname(__DIR__)."/helper/Functions.php");

function compare($item, $anotherItem){
	return $item->index > $anotherItem->index;
}

$items = Functions::getItems();

usort($items, "compare");
$response = new stdClass();
$response->items = $items;
$response->count = count($items);
echo json_encode($response);
exit;