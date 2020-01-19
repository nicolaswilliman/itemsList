<?php
require_once(dirname(dirname(__FILE__))."/helper/functions.php");

$items = Functions::getItems();
$response = new stdClass();
$response->items = $items;
$response->count = count($items);
echo json_encode($response);
exit;