<?php

require_once(dirname(__DIR__)."/helper/Functions.php");

$itemsIds = $_POST["itemsList"];
$index = 1;
foreach($itemsIds as $id){
	Functions::updateItem($id, null, null, $index);
	$index++;
}

exit;