<?php

require_once(dirname(__DIR__)."/helper/functions.php");

$id = $_POST["id"];

if(!$id){
	exit;
}

$item = Functions::getItem($id);

$fileName = realpath(dirname(dirname(__DIR__))) . "/images/$id.$item->ext";

if(file_exists($fileName)){
	unlink($fileName);
}

Functions::deleteItem($id);

exit;
