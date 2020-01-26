<?php
include_once(dirname(dirname(__DIR__)) . "/config.php");
include_once(BUSINESS_FOLDER . "Item.php");

const MAX_LENGTH = 300;
const VALID_EXT = ["jpg", "png", "gif"];

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
	foreach(VALID_EXT as $ext){
		if($imageExt == $ext) return true;
	}
	return false;
}

function saveImage($id, $imageExt){
	$fileName = IMAGES_FOLDER . "$id.$imageExt";
	deleteRelatedImages($id);
	if (!move_uploaded_file($_FILES["image"]["tmp_name"], $fileName)){
		echo "Error uploading image.";
		http_response_code(500);
		exit;
	}
}

function deleteRelatedImages($id){
	foreach(VALID_EXT as $ext){
		$file = IMAGES_FOLDER . "$id.$ext";
		if(file_exists($file)){
			unlink($file);
		}
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
	$id = 0;
	if(!isFileUploaded()){
		echo "No image uploaded. Please, choose an image.";
		http_response_code(400);
		exit;
	}
	validateImage();
	$imageExt = strtolower(pathinfo($_FILES["image"]["name"])["extension"]);
	$item = new Item($id, $description, $imageExt);
	$id = $item->save();
	saveImage($id, $imageExt);
}else{ //edit
	if(isFileUploaded()){
		validateImage();
		$imageExt = strtolower(pathinfo($_FILES["image"]["name"])["extension"]);
		saveImage($id, $imageExt);
	}
	$item = new Item($id, $description, $imageExt);
	$item->save();
}

exit;