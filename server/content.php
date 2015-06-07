<?php

function the_header() {
	?>
	<!DOCTYPE html>
	<html>

		<head>
			<title>Bruce's Media</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/darkly/bootstrap.min.css" />

			<style>
				div.row > div {
					margin-bottom: 10px;
				}

				div.row > div > img {
					margin-bottom: 5px;
				}
			</style>
		</head>

		<body>
			<div class="container">
				<div class="col-xs-12">
	<?php
}

function footer() {
	?>
				</div>
			</div>
		</body>

	</html>
	<?php
}
