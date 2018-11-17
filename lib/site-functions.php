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

function resizePhoto($original,$width,$height,$destination,$crop) {
	if ($originalImage  = @imagecreatefromjpeg($original)) {
		$originalWidth  = imagesx($originalImage);
		$originalHeight = imagesy($originalImage);
		
		$newImage  = imagecreatetruecolor($width, $height);
		
		//if we're creating a square thumb, remove 5 pixels around the edges
		if ($width == THUMB_MAX_S && $height == THUMB_MAX_S) {
			$cropWidth = ($originalWidth-10);
			$cropHeight = ($originalHeight-10);
			$cropImage  = imagecreatetruecolor($cropWidth, $cropHeight);

			//initial crop to remove border
			imagecopyresampled($cropImage, $originalImage, 0, 0, 5, 5, $cropWidth, $cropHeight, $cropWidth, $cropHeight);
			
			$originalWidth = $cropWidth;
			$originalHeight = $cropHeight;
		}
		
		if ($crop) {
			if ($originalWidth > $originalHeight) {
			   $offsetWidth = ($originalWidth-$originalHeight)/2;
			   $offsetHeight = 0;
			   $originalWidth = $originalHeight;
			} elseif ($originalHeight > $originalWidth) {
			   $offsetWidth = 0;
			   $offsetHeight = ($originalHeight-$originalWidth)/2;
			   $originalHeight = $originalWidth;
			} else {
			   $offsetWidth = 0;
			   $offsetHeight = 0;
			}
		  	imagecopyresampled($newImage, $cropImage, 0, 0, $offsetWidth, $offsetHeight, $width, $height, $originalWidth, $originalHeight);
		}
		else {
		  	imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
		}

		//Create the image file
		touch($destination);
		imagejpeg($newImage, $destination, PHOTO_QUALITY);
		chmod($destination, 0644);
		imagedestroy($newImage);
		imagedestroy($originalImage);
		if(isset($cropImage)) {
			imagedestroy($cropImage);
		}
		return true;
		
	}
	else {
		print "Couldn't load file: $original";
		return false;
	}
}
?>