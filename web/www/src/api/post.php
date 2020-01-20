<?php

require_once(dirname(dirname(__FILE__))."/helper/functions.php");
$maxLength = 300;

$id = $_POST["id"];
if(!$id){
	$id = 0;
}

if ( 0 < $_FILES["error"]["error"] ) {
	echo 'Error: ' . $_FILES['image']['error'] . '<br>';
	http_response_code(400);
	exit;
}

$isImage = getimagesize($_FILES["image"]["tmp_name"]);
if($isImage === false) {
	echo "File is not an image.";
	http_response_code(400);
	exit;
}

$ext = strtolower(end((explode(".", $_FILES["image"]["name"]))));
if($ext != "jpg" && $ext != "png" && $ext != "gif") {
	echo $ext;
	echo "Please only upload JPG/PNG/GIF files.";
	http_response_code(400);
	exit;
}

$id = $_POST["id"];
if(!$id){
	$id = 0;
}

$description = $_POST["description"];

if(!$description){
	echo "Invalid description";
	http_response_code(400);
	exit;
}
if(strlen($description) > $maxLength){
	http_response_code(400);
	echo "Max lenght of description is $maxLength.";
	exit;
}

$id = Functions::saveItem($id, $description, $ext);

$fileName = realpath(dirname(dirname(dirname(__FILE__)))) . "/images/$id.$ext";

if(file_exists($fileName)){
	unlink($fileName);
}

if (!move_uploaded_file($_FILES["image"]["tmp_name"], $fileName)){
	echo "Error uploading image.";
	http_response_code(500);
	exit;
}
exit;