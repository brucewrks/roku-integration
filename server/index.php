<?php
require(dirname(__FILE__) . '/includes/content.php');
require(dirname(__FILE__) . '/includes/thumbs.php');
the_header();

	$uri = $_SERVER['REQUEST_URI'];
	$req = dirname(__FILE__) . '/torrents' . urldecode($uri);

	if(is_dir($req)) {
		$files = scandir($req);

		echo '<h1>What do you want to watch?</h1>';
		echo '<div class="row">';
			foreach($files as $file) {
				if(strpos($file, '.') === 0 || strpos($file, '~') === 0) continue;

				$is_file = is_file($req . '/' . $file);
				$shortname = base64_encode($req . '/' . $file);
				$thumb = get_thumb($shortname);

				$link = 'http://192.168.1.144/' . trim($uri, '/') . '/' . $file;

				// Cleans up filenames to make them more legible
				$nicename = str_replace('_', ' ', $file);
				$nicename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $nicename);
				$nicename = preg_replace('/^\\[[a-z]+\\]/i', '', $nicename);
				$nicename = trim(preg_replace('/\([^)]+\)/', '', $nicename));
				$nicename = str_replace('.', ' ', $nicename);

				?>
				<div class="col-lg-3 col-md-4 col-xs-6" style="text-align: center;">
					<a href="<?php echo $link; ?>" <?php if($is_file) echo 'data-play="yes"' ?>>
						<img src="<?php echo $thumb; ?>" class="img-responsive" />
						<div class="center-block" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80%;">
							<?php echo $nicename;?>
						</div>
					</a>
				</div>
				<?php
			}
		echo '</div>';
	} elseif (is_file($req)) {
		echo '<h1>Sending Request to play on Roku...</h1>';

		$file = explode('/', $req);
		file_get_contents('http://127.0.0.1:1337/?url=' . rawurlencode('http://192.168.1.144/torrents/' . ltrim($uri, '/')) . '&name=' . rawurlencode(end($file)));
	} else {
		echo '<h1>Invalid URI</h1>';
	}

footer();
