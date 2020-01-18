<?php
require_once(dirname(dirname(__FILE__))."/helper/functions.php");

$items = Functions::getItems();
echo json_encode($items);
exit;