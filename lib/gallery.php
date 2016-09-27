<?php
function gallery($dir, $title) {
	$out = "<h2 class=\"archive-title\">". str_replace(" | onfocus", "", $title) . "</h2>\n";
	$out .= "<div class=\"post archive\" style=\"margin-top:25px;\">\n";
	$out .= "<div id=\"gallery\" class=\"post-text\" style=\"text-align:center;\">\n";

	$images = glob($dir."*.jpg");
	foreach($images as $image) {
		list($width, $height, $type, $attr) = getimagesize($image);
		if ($width > 640) {
			$width = 640;
		}
		$out .= "<div class=\"galleryImage\" style=\"width:" . $width . "px;\">";
		$out .= '<img data-src="'.basename($image).'" src="'.basename($image).'" width="'.$width.'" height="'.$height.'"/><br />' . "\n";
		// Check for caption
		if (file_exists(basename($image).".xml")) {
			$xml = simplexml_load_file(basename($image).".xml");
			$out .= '<div class="galleryCaption">' . $xml->caption . '</div>';
		}
		$out .=  "</div>";
	}

	$out .=  "</div></div></div>";
	return $out;
}
?>