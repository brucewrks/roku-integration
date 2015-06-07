<?php

function the_header() {
	?>
	<!DOCTYPE html>
	<html>

		<head>
			<title>Roku Media Player</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/slate/bootstrap.min.css" />

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

			<script type="application/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
			<script type="application/javascript" src="/includes/site.js"></script>
		</body>

	</html>
	<?php
}
