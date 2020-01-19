<?php

require_once(dirname(dirname(__FILE__))."/helper/functions.php");

$id = $_POST["id"];

if(!$id){
	exit;
}

Functions::deleteItem($id);

exit;
