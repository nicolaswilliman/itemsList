<?php

include_once(dirname(__DIR__) . "/business/Item.php");
const MAX_LENGTH = 300;

function isFileUploaded(){
	return file_exists($_FILES["image"]["tmp_name"]) && is_uploaded_file($_FILES["image"]["tmp_name"]);
}

function validateImage(){
	if(!isFileAnImage() || !isExtensionValid()){
		echo "Invalid image. File must be an image and the extension can be jpg/png/gif.";
		http_response_code(400);
		exit;
	}
}

function isFileAnImage(){
	$isImage = getimagesize($_FILES["image"]["tmp_name"]);
	return $isImage !== false;
}

function isExtensionValid(){
	$imageExt = strtolower(pathinfo($_FILES["image"]["name"])["extension"]);
	return ($imageExt == "jpg" || $imageExt == "png" || $imageExt == "gif");
}

function saveImage($id, $imageExt){

	$item = Item::getItem($id);
	$fileName = realpath(dirname(dirname(__DIR__))) . "/images/$id.$imageExt";
	$oldFileName = realpath(dirname(dirname(__DIR__))) . "/images/$id.$item->imageExt";
	if(file_exists($oldFileName)){
		unlink($oldFileName);
	}

	if (!move_uploaded_file($_FILES["image"]["tmp_name"], $fileName)){
		echo "Error uploading image.";
		http_response_code(500);
		exit;
	}
}

function isDescriptionValid($description, $maxLength){
	return $description && strlen($description) < $maxLength;
}

$id = $_POST["id"];
$description = $_POST["description"];

if(!$description){
	echo "Description is empty.";
	http_response_code(400);
	exit;
}

if(!isDescriptionValid($description, MAX_LENGTH)){
	echo "Invalid description. Max length is " . MAX_LENGTH . " char.";
	http_response_code(400);
	exit;
}

if(!$id){ //create
	if(!isFileUploaded()){
		echo "No image uploaded. Please, choose an image.";
		http_response_code(400);
		exit;
	}
	validateImage();
	$imageExt = strtolower(pathinfo($_FILES["image"]["name"])["extension"]);
	$id = Item::createItem($description, $imageExt);
	saveImage($id, $imageExt);
}else{ //edit
	if(isFileUploaded()){
		validateImage();
		$imageExt = strtolower(pathinfo($_FILES["image"]["name"])["extension"]);
		saveImage($id, $imageExt);
	}
	Item::updateItem($id, $description, $imageExt);
}

exit;