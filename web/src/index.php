<!DOCTYPE html>
<html>

<head>
	<title>Challenge</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
				success: function(response){
					let html = '';
					$.each(JSON.parse(response), function(key, data){
						debugger;
						html += '<li class="ui-state-default">' + data.desc + '</li>'
					});

					$('#items').html(html);
				},
				error: function (xhr, ajaxOptions, thrownError) {
					let errorMsg = 'Request failed: ' + xhr.responseText;
					$('#content').html(errorMsg);
				}
			});
		});
	</script>
</body>

</html>

