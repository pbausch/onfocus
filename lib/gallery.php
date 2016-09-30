<?php
function gallery($con) {
	$url = $_SERVER["REQUEST_URI"];
	$dir = getcwd() . "/";

	$imageCount = 0;
	$images = glob($dir."*.{jpg,JPG}",GLOB_BRACE);
	if ($images) {
		$imageCount = count($images);
	}
	
	$query = "SELECT GalleryName, GalleryDescription, DateCreated FROM Galleries WHERE URL = '" . mysql_real_escape_string($url) . "'";
	if (!$result = @ mysql_query ($query, $con))
	   	logError();
	if ($result && (mysql_num_rows($result) > 0)) {
		while ($gallery = mysql_fetch_array($result)) {
			$galleryTitle = $gallery['GalleryName'];
			$galleryDescription = $gallery['GalleryDescription'];
			$galleryDateTime = $gallery['DateCreated'];
		}
	} 	
	else {
		$galleryTitle = "random gallery";
		$galleryDescription = "Just some pictures I threw into a directory for some reason.";
		$galleryDateTime = date("Y-m-d H:i:s");
	}
	
	$pageNum = 1;
	$isDateArchive = 0;
	$pageTitle = $galleryTitle . " | onfocus";
	require(ROOT_DIR . "header.php");
	
	$thisDate = date("M jS, Y",strtotime($galleryDateTime));
	
	$out = "<h2 class=\"archive-title gallery-title\">". str_replace(" | onfocus", "", $galleryTitle) . "</h2>\n";
	$out .= "<div id=\"gallery\" class=\"post archive\">\n";
	$out .= "<div class=\"post-text\">$galleryDescription</div>\n";
	$out .= "<div class=\"post-byline archive\">$thisDate &middot; $imageCount photos</div>\n";
	$out .= "<div class=\"post-text gallery-list\">\n";

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
	print $out;
	print "<div id=\"footer\">";
	print "	<div class=\"navigation\">";
	print "<a href=\"/\">Home</a>";
	print "	</div>";
	print "</div>";
	require(ROOT_DIR . "footer.php");
}
?>