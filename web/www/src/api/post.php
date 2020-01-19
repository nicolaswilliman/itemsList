<?php

require_once(dirname(dirname(__FILE__))."/helper/functions.php");

$id = $_POST["id"];
if(!$id){
	$id = 0;
}
$description = $_POST["description"];

if(!$description){
	http_response_code(400);
	echo "Invalid description";
	exit;
}

Functions::saveItem($id, $description, "");

exit;