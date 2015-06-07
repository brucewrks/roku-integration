<?php
require(dirname(__FILE__) . '/content.php');
the_header();

	$uri = $_SERVER['REQUEST_URI'];
	$req = dirname(__FILE__) . '/torrents' . urldecode($uri);

	if(is_dir($req)) {
		$files = scandir($req);

		echo '<h1>What do you want to watch?</h1>';
		echo '<ul style="font-size: 16px;">';
			foreach($files as $file) {
				if(strpos($file, '.') === 0 || strpos($file, '~') === 0) continue;

				echo '<li style="margin: 15px;"><a href="http://192.168.1.144/' . ltrim($uri, '/') . '/' . $file . '">' . $file . '</a></li>';
			}
		echo '</ul>';
	} elseif (is_file($req)) {
		echo '<h1>Sending Request to play on Roku...</h1>';

		$file = explode('/', $req);
		file_get_contents('http://127.0.0.1:1337/?url=' . urlencode('http://192.168.1.144/torrents/' . ltrim($uri, '/')) . '&name=' . urlencode(end($file)));
	} else {
		echo '<h1>Invalid URI</h1>';
	}

footer();
