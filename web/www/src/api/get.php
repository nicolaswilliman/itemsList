<?php
require_once(dirname(dirname(__FILE__))."/helper/functions.php");

function compare($item, $anotherItem){
	return $item->index > $anotherItem->index;
}

$items = Functions::getItems();

usort($items, "compare");
// echo json_encode($items);
// exit;
$response = new stdClass();
$response->items = $items;
$response->count = count($items);
echo json_encode($response);
exit;