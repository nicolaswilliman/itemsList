<?php

require_once(dirname(dirname(__FILE__))."/helper/functions.php");

$itemsIds = $_POST["itemsList"];
$index = 1;
foreach($itemsIds as $id){
	Functions::updateItem($id, null, null, $index);
	$index++;
}

exit;