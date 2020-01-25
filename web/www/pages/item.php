<?php

include_once(dirname(__DIR__) . "/src/helper/Functions.php");

$id = $_GET["id"];
if($id){
	$item = Functions::getItem($id);
	$description = $item->description;
	$title = "Edit item";
	$submitName = "Update";
}else{
	$description = "";
	$title = "New item";
	$submitName = "Create";
}
?>

<form id="form" enctype="multipart/form-data" method="POST">
	<h1><?php echo $title?></h1>
	<span>Description (max 300 chars):</span>
	<input type="text" id="description" maxlength="300" value="<?php echo $item->description?>">
	<br>
	<span>Image:</span>
	<input type="file" id="image" name="image">
	<br>
	<input type="submit" id="submit" value="<?php echo $submitName ?>">&nbsp; <input type="button" id="cancel" value="Cancel">&nbsp;
</form>

<script>
	$('#description').focus();

	$('#cancel').click(e => {
		let url = "pages/list.html";
		url += '?_=' + (new Date()).getTime();
		$('#content').load(url);
	});

	$('form').submit(function(e){

		const formData = new FormData(this);
		formData.append('description', $('#description').val());
		formData.append('id', <?php echo "'".$id ."'"?>);
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