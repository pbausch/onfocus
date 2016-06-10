<?php require_once('colors.php'); ?>
<?php $page = $_SERVER["PHP_SELF"]; ?><!DOCTYPE html>
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
	<link rel="icon" type="image/ico" href="//d1x6es5xzge33k.cloudfront.net/<?php print $logocolor ?>.ico?v=<?php print $logocolor ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="http://xml.onfocus.com/posts" />
	<style>
		#logo, .tagline, .selected, #bottom, #infobox .post-text a, .navigation a {color: #<?php print $logocolor ?> !important;}
		body {
			background:  #<?php print $gradcolor ?>; /* Old browsers */
			background: -moz-linear-gradient(top,  #<?php print $gradcolor ?>, #ffffff); /* FF3.6-15 */
			background: -webkit-linear-gradient(top, #<?php print $gradcolor ?>, #ffffff); /* Chrome10-25,Safari5.1-6 */
			background: linear-gradient(to bottom,  #<?php print $gradcolor ?>, #ffffff); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php print $gradcolor ?>', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
			background-size: 1px 1px;
			background-repeat: repeat-x;
		}
		#footer, #bottom {
			background-color: #<?php print $gradcolor ?>;
			color: #<?php print $logocolor ?>;
		}
		#infobox .post-text a, .flourish, #copyright {
			opacity: 0.3;
		}
		#infobox .post-text a.selected, .navigation a {
			opacity: 0.8;
		}
		.tagline {
			opacity: 0.4;
		}
		.btn {
		    background-color: #<?php print $gradcolor ?>;
		    background-repeat: no-repeat;
		    border: 1px solid #<?php print $gradcolor ?>;
		    border-radius: 4px;
		    color: #<?php print $logocolor ?>;
		    cursor: pointer;
		    display: inline-block;
		    font-size: 14px;
		    line-height: normal;
		    padding: 8px 16px;
		    position: relative;
		}
		.btn:hover {
		    opacity: 0.9;
		}
		input, textarea {
			font-size: 1em;
		}
		@media screen and (max-width: 750px) {
			#header {
				border-bottom: solid 5px #<?php print $logocolor ?>;
			}
			#footer {
				border-top: solid 5px #<?php print $logocolor ?>;
			}
			#tophome {
				display: none;
			}
		}
	</style>
	<link rel="stylesheet" href="//d1x6es5xzge33k.cloudfront.net/screen060916bmin.css" />
	<title><?php if (isset($pagetitle)) { print $pagetitle; } else { print "onfocus"; } ?></title>
	<script src="//www.onfocus.com/swfobject.js"></script>
	<style>
		.twitter {
			padding-left:22px;
			background:url(http://www.onfocus.com/images/twitterbird.gif) no-repeat 0px 7px;
		}
	</style>
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