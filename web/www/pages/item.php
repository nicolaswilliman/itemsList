<?php

include_once(dirname(dirname(__FILE__)) . "/src/helper/functions.php");

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
<h1><?php echo $title?></h1>
<span>Description:</span>
<input type="text" id="description" maxlength="300" value="<?php echo $item->description?>">
<br>
<span>Image:</span>
<input type="file" id="image">
<br>
<input type="button" id="submit" value="<?php echo $submitName ?>">&nbsp; <input type="button" id="cancel" value="Cancel">&nbsp;

<script>
	$('#cancel').click(e => {
		let url = "pages/list.html";
		url += '?_=' + (new Date()).getTime();
		$('#content').load(url);
	});

	$('#submit').click(e => {
		//validate
		$.ajax({
			url: 'src/api/post.php',
			type: 'post',
			data: {
				id: <?php echo "'".$id ."'"?>,
				description: $('#description').val(),
				image: ""
			},
			success: response => {
				let url = "pages/list.html";
				url += '?_=' + (new Date()).getTime();
				$('#content').load(url);
			},
			error: (xhr, status, error) => {

			}
		});
	});
</script>