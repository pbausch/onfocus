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

// thx, http://stackoverflow.com/questions/8990007/display-post-excerpts-limited-by-word-count
function first_x_words($text, $number_of_words) {
   $text = strip_tags($text);
   $text = preg_replace("/^\W*((\w[\w'-]*\b\W*){1,$number_of_words}).*/ms", '\\1', $text);
   return str_replace("\n", "", $text);
}

function truncate_to_x_words($text, $number_of_words) {
   $text = strip_tags($text);
   $excerpt = first_x_words($text, $number_of_words);
   if( str_word_count($text) !== str_word_count($excerpt) ) {
      $excerpt = trim($excerpt) . '...';
   }
   return $excerpt;
}

?>