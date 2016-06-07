<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="ICBM" content="44.564400,-123.260910" />
	<meta name="DC.title" content="onfocus" />
	<meta name="keywords" content="Oregon, Corvallis, developer, hiking, Web services, weblogs, books, bookwatch, photography" />
	<meta name="geo.country" content="US" />
	<meta name="dc.language" content="en" />
	<meta name="description" content="Thoughts and photos from a Web developer living in Oregon. " />
	<meta name="verify-v1" content="l6Cjq8kY0ofKv+8EY2FMrKOUTC8ztnB/GzIhrMJW/Cs=" />
	<meta name="viewport" content="width = 480" />
	<?php if (($pageNum > 1) || ($isDateArchive)) { ?><meta name="ROBOTS" content="NOINDEX,FOLLOW"><?php }?>
	<link rel="icon" type="image/ico" href="//www.onfocus.com/favicon032010.ico" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://xml.onfocus.com/posts" />
	<link rel="stylesheet" href="//o.snapgallery.net/screen112613.css" />
	<title><?php print $pagetitle ?></title>
	<script src="//www.onfocus.com/swfobject.js"></script>
	<style>
		.twitter {
			padding-left:22px;
			background:url(http://www.onfocus.com/images/twitterbird.gif) no-repeat 0px 7px;
		}
	</style>
</head>
<?php 
$page = $_SERVER["PHP_SELF"];
?>
<body>
<div id="header" onclick="document.location='/';">
	<div id="infobox">
		<div class="post-text">
			<a href="/" <?php if (($page == "/index.php") && ($pageNum == 1) && ($isDateArchive == 0)) { ?>class="selected"<?php } ?>>Home</a> &middot;
			<a href="/about" <?php if ($page == "/about.php") { ?>class="selected"<?php } ?>>About</a> &middot; 
			<a href="/archive" <?php if ($page == "/archive.php") { ?>class="selected"<?php } ?>>Archive</a> &middot; 
			<a href="http://xml.onfocus.com/posts">Feed</a>
		</div>
	</div>
</div>
<div id="blog">