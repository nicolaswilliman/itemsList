<?php

require_once(dirname(dirname(__FILE__))."/helper/functions.php");
$maxLength = 300;

function isImageUploaded(){
	$isImage = getimagesize($_FILES["image"]["tmp_name"]);
	return $isImage !== false;
}

function isImageValid(){
	$ext = strtolower(end((explode(".", $_FILES["image"]["name"]))));
	return ($ext == "jpg" || $ext == "png" || $ext == "gif");
}

function saveImage($id, $ext){

	$item = Functions::getItem($id);
	$fileName = realpath(dirname(dirname(dirname(__FILE__)))) . "/images/$id.$ext";
	$oldFileName = realpath(dirname(dirname(dirname(__FILE__)))) . "/images/$id.$item->ext";
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
	if(!isImageUploaded() || !isImageValid()){
		echo "Invalid image. File must be an image and the extension should be jpg/png/gif.";
		http_response_code(400);
		exit;
	}
	$ext = strtolower(end((explode(".", $_FILES["image"]["name"]))));
	$id = Functions::createItem($description, $ext);
	saveImage($id, $ext);
}else{ //edit
	if(!isDescriptionValid($description, $maxLength)){
		echo "Invalid description.";
		http_response_code(400);
		exit;
	}
	if(isImageUploaded()){
		if(!isImageValid()){
			echo "Invalid image. File must be an image and the extension should be jpg/png/gif.";
			http_response_code(400);
			exit;
		}
		$ext = strtolower(end((explode(".", $_FILES["image"]["name"]))));
		saveImage($id, $ext);
	}
	Functions::updateItem($id, $description, $ext);
}

exit;