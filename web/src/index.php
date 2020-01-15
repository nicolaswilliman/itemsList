<!DOCTYPE html>
<html>

<head>
	<title>Challenge</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>

<body>
	<div id="content">
		<h1>
			Items
		</h1>
		<ul id="items">

		</ul>
	</div>
	<script>
		$(function(){
			$.ajax({
				url: 'get.php',
				type: 'get',
				success: response => {
					let html = '';
					$.each(JSON.parse(response), (key, data) => {
						html += '<li class="item">' + data.desc + '</li>'
					});

					$('#items').html(html);
				},
				error: (xhr, ajaxOptions, thrownError) => {
					let errorMsg = 'Request failed: ' + xhr.responseText;
					$('#content').html(errorMsg);
				}
			});
			let items = $('#items');
			items.sortable({
				update: (event, ui) => {
					let list = [];
					$('#items li').each((idx, elem) => {
						list[idx] = $(elem).html();
					});
				}
			});
    		$('#items').disableSelection();
		});
	</script>
</body>

</html>

