<?php

function get_thumb($shortname) {
	$link = '/thumbs/' . $shortname . '.jpg';

	if(file_exists(dirname(dirname(__FILE__)) . '/thumbs/' . $shortname . '.jpg'))
		return $link;

	generate_thumb($shortname);
	return $link;
}

function generate_thumb($shortname) {
	$seconds = rand(60*5, 60*10);
	$dir_or_file = base64_decode($shortname);

	// Pull first video from directory
	if(is_dir($dir_or_file)) $file = get_first_video($dir_or_file);
	elseif(is_file($dir_or_file)) $file = $dir_or_file;
	else return;

	$file = preg_replace('/\/+/', '/', $file);
	$thumbs_dir = dirname(dirname(__FILE__)) . '/thumbs/';
	$exec = 'ffmpeg -ss ' . $seconds . ' -i \'' . $file . '\' -t 1 -s 520x300 -f image2 \'' . $thumbs_dir . $shortname . '.jpg\'';

	if(file_exists($file) && is_file($file)) shell_exec($exec);
	else exit();
}

function get_first_video($dir) {
	$files = scandir($dir);

	foreach($files as $file) {
		if(strpos($file, '.') === 0 || strpos($file, '.dat') !== FALSE) continue;
		$file = $dir . '/' . $file;

		if(is_dir($file)) return get_first_video($file);
		return $file;
	}
}
