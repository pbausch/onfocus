<?php require_once('lib/set-includes.php'); ?>
<?php $page = $_SERVER["PHP_SELF"]; ?>
<?php
	$logocolor = "fefefe";
	$gradcolor = "222";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="ICBM" content="44.564400,-123.260910" />
	<meta name="DC.title" content="<?php if (isset($pageTitle)) { print htmlspecialchars($pageTitle); } else { print "onfocus"; } ?>" />
	<meta name="keywords" content="<?php if (isset($pageKeywords)) { print htmlspecialchars($pageKeywords); } else { print "pb, Oregon, Corvallis, developer, photography"; } ?>" />
	<meta name="geo.country" content="US" />
	<meta name="dc.language" content="en" />
<?php if (isset($pageDescription)) { print "\t<meta name=\"description\" content=\"" . htmlspecialchars($pageDescription) . "\" />\n"; } ?>
	<meta name="verify-v1" content="l6Cjq8kY0ofKv+8EY2FMrKOUTC8ztnB/GzIhrMJW/Cs=" />
	<meta name="viewport" content="initial-scale=1" />
<?php if (($pageNum > 1) || ($isDateArchive)) { print "\t"; ?><meta name="ROBOTS" content="NOINDEX,FOLLOW"><?php }?>
	<link rel="icon" type="image/ico" href="<?php print CDN_URL ?>/<?php print $logocolor ?>.ico?v=<?php print $logocolor ?>" />
	<link rel="apple-touch-icon" href="<?php print CDN_URL ?>/<?php print $logocolor ?>.apple-touch-icon.png">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://xml.onfocus.com/posts" />
	<style>
		#logo, .tagline, .selected, #bottom, #infobox .post-text a, .navigation a {color: #<?php print $logocolor ?> !important;}
		html {
			background:  #<?php print $gradcolor ?>;
		}
		body {
    		background:  #<?php print $gradcolor ?>; /* Old browsers */
			background: -moz-linear-gradient(top,  #<?php print $gradcolor ?>, #ffffff); /* FF3.6-15 */
			background: -webkit-linear-gradient(top, #<?php print $gradcolor ?>, #ffffff); /* Chrome10-25,Safari5.1-6 */
			background: linear-gradient(to bottom,  #<?php print $gradcolor ?>, #ffffff); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php print $gradcolor ?>', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
			background-size: 1px 1px;
			background-repeat: repeat-x;
			background-image: linear-gradient(to bottom, #434343 0%, #222 100%);
		}
		#footer, #bottom {
			color: #<?php print $logocolor ?>;
		}
		.heartbox {
			margin-top: 20px;
		}
		.hearticon {
			cursor: pointer;
			fill: #<?php print $logocolor ?>;
		}
		.btn {
		    background-color: #<?php print $gradcolor ?>;
		    border: 1px solid #<?php print $logocolor ?>;
		    color: #<?php print $logocolor ?>;
		}
		@media screen and (max-width: 750px) {
			#header {
				border-bottom: solid 5px #<?php print $logocolor ?>;
			}
			#footer {
				border-top: solid 5px #<?php print $logocolor ?>;
			}
		}
	</style>
	<link rel="stylesheet" href="<?php print LIVE_STYLESHEET ?>" />
	<?php if (isset($pageHeaderAddition)) { 
		$pageHeaderAddition = str_replace("200808.twitter-card.png",$logocolor . ".twitter-card.png",$pageHeaderAddition);
		print $pageHeaderAddition; 
	} ?>
<title><?php if (isset($pageTitle)) { print $pageTitle; } else { print "onfocus"; } ?></title>
</head>
<body>
<div id="header" onclick="document.location='/';">
	<h1 id="logo" onmouseover="focusin(this)" onmouseout="defocus(this)">onfocus</h1>
	<p class="tagline">a weblog by pb</p>
	<div id="infobox">
		<div class="post-text">
			<a href="/" <?php if (($page == "/index.php") && ($pageNum == 1) && ($isDateArchive == 0)) { ?>class="selected"<?php } ?> id="tophome">Home</a>
			<a href="/about" <?php if ($page == "/about.php") { ?>class="selected"<?php } ?>>About</a>  
			<a href="/archive" <?php if ($page == "/archive.php") { ?>class="selected"<?php } ?>>Archive</a> 
		</div>
	</div>
</div>
<div id="blog">