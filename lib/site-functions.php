<?php
function get_url_slug($title) {
	$title = strip_tags($title);
	$title = strtolower($title);
	$title = str_replace('.', '-', $title);
	$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
	$title = preg_replace('/\s+/', '-', $title);
	$title = trim($title,"-");
	$title = substr($title, 0, strlen($title));
	return $title;
}
?>