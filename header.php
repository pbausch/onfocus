<?php require_once('colors.php'); ?>
<?php $page = $_SERVER["PHP_SELF"]; ?>
<?php $cssfile = "/css/style.css"; ?><!DOCTYPE html>
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
	<meta name="viewport" content="initial-scale=1" />
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
	<link rel="stylesheet" href="<?php print $cssfile ?>" />
	<?php if (isset($pageHeaderAddition)) { print $pageHeaderAddition; } ?>
	<title><?php if (isset($pagetitle)) { print $pagetitle; } else { print "onfocus"; } ?></title>
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