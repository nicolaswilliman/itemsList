<?php
require_once(dirname(__FILE__)."/functions.php");

$items = Functions::getItems();
echo json_encode($items);
exit;