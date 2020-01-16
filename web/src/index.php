<!DOCTYPE html>
<html>

<head>
	<title>Challenge</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<style>
		li:hover {
    		cursor: move;
		}
	</style>
</head>

<body>
	<h1 id="title">
	</h1>
	<div id="content">

	</div>
	<script>
		function getItems(){
			$(() => {
				$.ajax({
					url: 'get.php',
					type: 'get',
					success: response => {
						let html = '';
						html += '<input type="button" id="create" value="Create item">';
						html += '<ul id="items">';
						$.each(JSON.parse(response), (key, data) => {
							html += '<li class="item">' + data.desc + '</li>'
						});
						html += '</ul>';

						$('#content').html(html);
						let items = $('#items');
						items.sortable({
							update: (event, ui) => {
								let list = [];
								$('#items li').each((idx, elem) => {
									list[idx] = $(elem).html();
								});
							}
						});
						items.disableSelection();
					},
					error: (xhr, ajaxOptions, thrownError) => {
						let errorMsg = 'Request failed: ' + xhr.responseText;
						$('#content').html(errorMsg);
					}
				});

			});
		}

		getItems();

		$('#create').click(() => {
			let html = '';
			html += '<span>Description:</span>';
			html += '<input type="text" id="desc">';
			html += '<br>';
			html += '<span>Image:</span>';
			html += '<input type="file" id="image">';
			$('#content').html(html);
		});

	</script>
</body>
</html>

