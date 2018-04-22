<?php
require("onfocus-ini.inc");
if (!isset($_GET['year']) || !isset($_GET['dir'])) {
	send404();
}
$year = $_GET['year'];
$dir = $_GET['dir'];
if (($dir == "front") || ($dir == "2004")) {
	send404();
}
if ($year == 0000) {
	$dir = "c:/sites/www.onfocus.com/cam/$dir/";
}
else {
	$dir = "c:/sites/www.onfocus.com/cam/$year/$dir/";
}
if (!is_dir($dir)) {
	send404();
}
$index[0] = "";
if ($dh = opendir($dir)) {
	while (($file = readdir($dh)) !== false) {
		$path_parts = pathinfo($dir . $file);
		if (isset($path_parts['extension'])) {
			if (($path_parts['extension'] == 'jpg') || ($path_parts['extension'] == 'JPG')) {
				$thisImageFile = $dir . $file;
				$index[] = $thisImageFile;
			}
		}
	}
}

$totalPages = (count($index)-1);
if ($totalPages == 0) {
	send404();
}

$page = 1;
if (isset($_GET['p'])) {
	$page = $_GET['p'];
}
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
if (($page <= 0) || ($page > $totalPages)) {
	send404();
}
$thisImageFile = $index[$page];
$thisCaptionFile = $thisImageFile.".xml";
list($width, $height, $type, $attr) = @getimagesize($thisImageFile);
$thisImageURL = preg_replace('!c:/sites/www\.onfocus\.com/!is','http://www.onfocus.com/',$thisImageFile);

// See if caption exists
$thisCaption = "";
if (file_exists($thisCaptionFile)) {
	$xml = simplexml_load_file($thisCaptionFile);
	$thisCaption = $xml->caption;
}

// Defaults
$pagetitle = "onfocus gallery";
$GalleryTitle = "onfocus gallery";
// Defaults
$baseURL = preg_replace('!c:/sites/www\.onfocus\.com/!is','http://www.onfocus.com/',$dir);
$query = "SELECT GalleryName, GalleryDescription, DateCreated FROM Galleries WHERE URL = '" . mysql_real_escape_string($baseURL) . "'";
if (!$result = @ mysql_query ($query, $connection))
   	logError();
if (mysql_num_rows($result) > 0) {
	while ($gallery = mysql_fetch_array($result)) {
		$GalleryTitle = $gallery['GalleryName'];
		$GalleryDescription = $gallery['GalleryDescription'];
		$GalleryDTM = $gallery['DateCreated'];
		$pagetitle = $GalleryTitle;
	}
}
$pageNum = 1;
$isDateArchive = 0;
require("header.php");
?>
<h2 class="title"><?php print $GalleryTitle ?></h2>
<div class="post" style="width:<?php print ($width + 30) ?>px;">
	<div style="">
	<div class="post-text" style="float:right;margin-bottom:5px;padding:7px 15px 0px 0px;"><?php print "$page of $totalPages" ?></div>
	<div class="post-text" style="padding:0px 15px 0px 15px;"><img src="<?php print $thisImageURL ?>" style="border:solid #aaa 1px;" width="<?php print $width ?>" height="<?php print $height ?>" alt="<?php print "photo $page in $GalleryTitle" ?>" /></div>
	<div class="post-byline" style="width:<?php print ($width + 30) ?>px;padding:0px 0px 5px 0px;margin-top:5px;border-top:none;">&nbsp;
		<?php
		if ($page > 1) {
			$previousPage = ($page - 1);
			print "<div style=\"float:left;margin-left:15px;\"><a href=\"$baseURL$previousPage\">back</a></div>";
		}
		if ($page < $totalPages) {
			$nextPage = ($page + 1);
			print "<div style=\"float:right;margin-right:15px;\"><a href=\"$baseURL$nextPage\">next</a></div>";
		}
		?>
	</div>
	<div>&nbsp;</div>
	</div>
</div>
<?php if ($thisCaption <> "") { ?><div class="post" style="margin-top:15px;width:<?php print ($width + 30) ?>px;text-align:center;"><div class="post-text" style="padding:0px 10px 0px 10px;"><?php print $thisCaption ?></div></div><?php } ?>
</div>
<div class="fill" style="margin-bottom:12px;"><div class="triangle-up-right rot90"></div><div class="triangle-up-left rotn90"></div></div>
<div id="footer">
	<div class="navigation">
		<a href="/">Home</a>
	</div>
</div>
<?php require("footer.php") ?>