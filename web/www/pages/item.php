<?php

include_once(dirname(dirname(__FILE__)) . "/src/helper/functions.php");

$id = $_GET["id"];
if($id){
	$item = Functions::getItem($id);
}
?>

<span>Description:</span>
<textarea id="description" rows="1" cols="50" maxlength="300"><?php echo $item->description?></textarea>
<br>
<span>Image:</span>
<input type="file" id="image">
<br>
<input type="button" id="submit" value="Create">&nbsp; <input type="button" id="cancel" value="Cancel">&nbsp;

<script>
	$('#cancel').click(e => {
		url = "pages/list.html";
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
				url = "pages/list.html";
				url += '?_=' + (new Date()).getTime();
				$('#content').load(url);
			},
			error: (xhr, status, error) => {
				console.log(xhr.response);
			}
		});
	});
</script>