<?php

include_once(dirname(__DIR__) . "/business/Item.php");
$maxLength = 300;


function isFileUploaded(){
	return file_exists($_FILES["image"]["tmp_name"]) && is_uploaded_file($_FILES["image"]["tmp_name"]);
}

function isFileAnImage(){
	$isImage = getimagesize($_FILES["image"]["tmp_name"]);
	return $isImage !== false;
}

function isExtensionValid(){
	$ext = strtolower(end((explode(".", $_FILES["image"]["name"]))));
	return ($ext == "jpg" || $ext == "png" || $ext == "gif");
}

function saveImage($id, $ext){

	$item = Item::getItem($id);
	$fileName = realpath(dirname(dirname(__DIR__))) . "/images/$id.$ext";
	$oldFileName = realpath(dirname(dirname(__DIR__))) . "/images/$id.$item->ext";
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

//VALIDATIONS
if(!$id){ //create
	$id = 0;
	if(!isDescriptionValid($description, $maxLength)){
		echo "Invalid description.";
		http_response_code(400);
		exit;
	}
	if(!isFileAnImage() || !isExtensionValid()){
		echo "Invalid image. File must be an image and the extension should be jpg/png/gif.";
		http_response_code(400);
		exit;
	}
	$ext = strtolower(end((explode(".", $_FILES["image"]["name"]))));
	$id = Item::createItem($description, $ext);
	saveImage($id, $ext);
}else{ //edit
	if(!isDescriptionValid($description, $maxLength)){
		echo "Invalid description.";
		http_response_code(400);
		exit;
	}
	if(isFileAnImage()){
		if(!isExtensionValid()){
			echo "Invalid image. File must be an image and the extension should be jpg/png/gif.";
			http_response_code(400);
			exit;
		}
		$ext = strtolower(end((explode(".", $_FILES["image"]["name"]))));
		saveImage($id, $ext);
	}
	Item::updateItem($id, $description, $ext);
}

exit;