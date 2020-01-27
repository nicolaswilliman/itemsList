<?php

include_once(dirname(__DIR__) . "/config.php");
include_once(BUSINESS_FOLDER . "Item.php");

$id = $_GET["id"];
if($id){
	$item = Item::getItem($id);
	$description = $item->description;
	$title = "Edit item";
	$submitName = "Update";
}else{
	$id = 0;
	$description = "";
	$title = "New item";
	$submitName = "Create";
}
?>

<form id="form">
	<h1><?php echo $title?></h1>
	<span>Description (max 300 chars):</span>
	<input type="text" id="description" maxlength="300" value="<?php echo $description?>">
	<br>
	<span>Image:</span>
	<input type="file" id="image" name="image">
	<br>
	<div id="buttons">
		<input type="submit" id="submit" value="<?php echo $submitName ?>">
		<input type="button" id="cancel" value="Cancel">
	</div>
</form>

<script>
	$('#description').focus();

	$('#cancel').click(e => {
		let url = "pages/list.html";
		url += '?_=' + (new Date()).getTime();
		$('#content').load(url);
		return false;
	});

	$('form').submit(function(e){

		const formData = new FormData();
		const id = <?php echo "'".$id ."'"?>;
		const image = $('#image').prop('files')[0];
		const description = $('#description').val();

		if(id) formData.append('id', id);
		if(image) formData.append('image', image);
		if(description) formData.append('description', description);

		$.ajax({
			url: 'src/api/post.php',
			type: 'post',
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			enctype: 'multipart/form-data',
			processData: false,
			success: response => {
				let url = "pages/list.html";
				url += '?_=' + (new Date()).getTime();
				$('#content').load(url);
			},
			error: (xhr, status, error) => {
				alert(xhr.responseText);
			}
		});
		return false;
	});

	$(()=>{
		addEventListener('keyup', event => {
			if(event.key === "Enter") {
				$('#submit').click();
			}
			return false;
		});
	});
</script>