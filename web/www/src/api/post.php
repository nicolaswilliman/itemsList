<?php

require_once(dirname(dirname(__FILE__))."/helper/functions.php");

$description = $_POST["description"];

if(!$description){
	Functions::response("Invalid description", http_response_code(400));
}

Functions::saveItem(0, $description, "");

Functions::response(new stdClass(), http_response_code(200));

exit;